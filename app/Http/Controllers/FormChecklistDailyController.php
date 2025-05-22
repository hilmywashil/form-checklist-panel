<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormChecklistDaily;
use App\Models\FormChecklistDailyItem;
use App\Models\FormChecklistPanel;
use App\Models\FormChecklistItem;
use App\Models\Lokasi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormChecklistDailyController extends Controller
{
    public function index(Request $request)
    {
        $lokasis = Lokasi::all();

        $query = FormChecklistPanel::with('lokasiRel', 'checklists');

        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }

        $panels = $query->get();

        return view('admin.formdailies.index', compact('panels', 'lokasis'));
    }

    public function laporan(Request $request)
    {
        $lokasis = Lokasi::all();
        $panels = collect();

        if ($request->has('lokasi')) {
            $panels = FormChecklistPanel::where('lokasi', $request->lokasi)->get();
        }

        return view('user.formdailies.laporan', compact('lokasis', 'panels'));
    }

    public function laporanDetail($id)
    {
        $panel = FormChecklistPanel::with('checklists')->findOrFail($id);

        $startDate = now()->subDays(7);
        $endDate = now();

        $tanggalList = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $tanggalList->push($date->format('Y-m-d'));
        }

        $checklists = $panel->checklists->keyBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        $selectedDate = request('tanggal', today()->toDateString());

        $dailyChecklist = $checklists->get($selectedDate);

        $daily = $dailyChecklist;

        $panelStatus = $dailyChecklist
            ? 'Panel diperiksa'
            : 'Panel tidak diperiksa pada tanggal ' . \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y');

        return view('user.formdailies.laporan-detail', compact(
            'panel',
            'tanggalList',
            'checklists',
            'selectedDate',
            'dailyChecklist',
            'panelStatus',
            'daily'
        ));
    }

    public function create()
    {
        $panels = FormChecklistPanel::all();
        return view('admin.formdailies.create', compact('panels'));
    }

    public function quickCreate(FormChecklistPanel $panel)
    {
        $existing = $panel->checklists()->whereDate('tanggal', today())->first();
        if ($existing) {
            return redirect()->route('adminFormDaily')->with('error', 'Pemeriksaan hari ini sudah ada untuk panel ini.');
        }

        $newChecklist = new FormChecklistDaily();
        $newChecklist->form_checklist_panel_id = $panel->id;
        $newChecklist->tanggal = today();
        $newChecklist->teknisi = auth()->user()->name ?? 'Teknisi';
        $newChecklist->save();

        $panelItems = $panel->formitems;
        foreach ($panelItems as $item) {
            FormChecklistDailyItem::create([
                'form_checklist_daily_id' => $newChecklist->id,
                'form_checklist_item_id' => $item->id,
                'kondisi' => null,
                'keterangan' => null,
            ]);
        }

        $url = url('/checklist-daily/' . $newChecklist->id);
        $qrCodePath = 'qrcodes/ceklis_' . $newChecklist->id . '.png';

        Storage::disk('public')->put($qrCodePath, QrCode::format('png')
            ->errorCorrection('M')
            ->size(300)
            ->generate($url));

        $newChecklist->update(['qr_code' => $qrCodePath]);

        return redirect()->route('formCheckDailyEdit', ['id' => $newChecklist->id])->with('success', 'Pemeriksaan berhasil dibuat.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_checklist_panel_id' => 'required|exists:form_checklist_panels,id',
            'tanggal' => 'required|date',
        ]);

        $exists = FormChecklistDaily::where('form_checklist_panel_id', $request->form_checklist_panel_id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return redirect()->route('adminFormDaily')->with('error', 'Checklist untuk panel ini pada tanggal tersebut sudah ada.');
        }

        $daily = FormChecklistDaily::create([
            'form_checklist_panel_id' => $request->form_checklist_panel_id,
            'tanggal' => $request->tanggal,
            'teknisi' => Auth::user()->name,
        ]);

        $panelItems = FormChecklistItem::where('panel_id', $request->form_checklist_panel_id)->get();
        foreach ($panelItems as $item) {
            FormChecklistDailyItem::create([
                'form_checklist_daily_id' => $daily->id,
                'form_checklist_item_id' => $item->id,
                'kondisi' => null
            ]);
        }

        $url = url('/checklist-daily/' . $daily->id);

        $qrCodePath = 'qrcodes/ceklis_' . $daily->id . '.png';

        Storage::disk('public')->put($qrCodePath, QrCode::format('png')
            ->errorCorrection('M')
            ->size(300)
            ->generate($url));

        $daily->update(['qr_code' => $qrCodePath]);

        return redirect()->route('adminFormDaily')->with('success', 'Checklist harian berhasil dibuat.');
    }

    public function edit($id)
    {
        $daily = FormChecklistDaily::with('items.item', 'panel.lokasiRel')->findOrFail($id);
        return view('admin.formdailies.edit', compact('daily'));
    }

    public function show(Request $request, $id)
    {
        $panel = FormChecklistDaily::with('items.item', 'panel.lokasiRel')->findOrFail($id);
        $daily = FormChecklistDaily::with('items.item', 'panel.lokasiRel')
            ->where('form_checklist_panel_id', $panel->form_checklist_panel_id)
            ->latest()
            ->when($request->has('tanggal'), function ($query) use ($request) {
                return $query->whereDate('tanggal', $request->tanggal);
            })
            ->first();

        $dateList = FormChecklistDaily::where('form_checklist_panel_id', $panel->form_checklist_panel_id)
            ->pluck('tanggal', 'id');

        return view('user.formdailies.show', compact('daily', 'dateList'));
    }

    public function update(Request $request, $id)
    {
        $daily = FormChecklistDaily::findOrFail($id);

        if (!$request->has('kondisi')) {
            return redirect()->back()->with('error', 'Tidak ada data kondisi yang dikirim.');
        }

        foreach ($request->kondisi as $itemId => $kondisi) {
            $keterangan = $request->keterangan[$itemId] ?? null;

            FormChecklistDailyItem::where('form_checklist_daily_id', $id)
                ->where('form_checklist_item_id', $itemId)
                ->update([
                    'kondisi' => $kondisi,
                    'keterangan' => $keterangan,
                ]);
        }

        return redirect()->back()->with('success', 'Checklist harian diperbarui.');
    }

    public function table(Request $request)
    {
        $bulanInput = $request->input('bulan', date('Y-m'));
        $bulan = date('m', strtotime($bulanInput));
        $tahun = date('Y', strtotime($bulanInput));

        $lokasis = Lokasi::pluck('nama_lokasi', 'id');
        $panels = FormChecklistPanel::when($request->lokasi_id, function ($query) use ($request) {
            return $query
                ->where('lokasi', $request->lokasi_id)
                ->pluck('nama_panel', 'id');
        });

        $items = FormChecklistItem::where('panel_id', $request->panel_id)->get();

        $checklists = FormChecklistDaily::where('form_checklist_panel_id', $request->panel_id)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->with('items')
            ->get()
            ->keyBy('tanggal');

        $selectedPanel = $request->panel_id;
        $selectedLocation = $request->lokasi_id;

        return view('user.formdailies.table', compact('bulan', 'tahun', 'lokasis', 'panels', 'selectedPanel', 'selectedLocation', 'items', 'checklists'));
    }
    public function destroy($id)
    {
        $checklist = FormChecklistDaily::find($id);

        if (!$checklist) {
            return redirect()->route('adminFormDaily')->with('error', 'Checklist tidak ditemukan.');
        }

        $qrPath = 'public/qrcodes/ceklis_' . $checklist->id . '.png';
        if (Storage::exists($qrPath)) {
            Storage::delete($qrPath);
        }

        $checklist->delete();


        return redirect()->route('adminFormDaily')->with('success', 'Checklist berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $panel_id = $request->input('panel_id');
        $bulan = $request->input('bulan');

        $tahun = date('Y', strtotime($bulan));
        $bulan = date('m', strtotime($bulan));

        $panel = FormChecklistPanel::find($panel_id);

        $panels = FormChecklistPanel::all();
        $selectedPanel = $panel_id;

        $items = FormChecklistItem::where('panel_id', $panel_id)->get();

        $checklists = FormChecklistDaily::with('items')
            ->where('form_checklist_panel_id', $panel_id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->keyBy('tanggal');

        return Pdf::loadView('admin.formdailies.daily-pdf', compact(
            'panels',
            'selectedPanel',
            'bulan',
            'tahun',
            'items',
            'checklists',
            'panel'
        ))->setPaper('a4', 'landscape')->download('tabel-harian.pdf');

        return $pdf->download('tabel-harian.pdf');
    }

    public function laporanPdf($panelId, Request $request)
    {
        $tanggal = $request->query('tanggal', now()->toDateString());
        $panel = FormChecklistPanel::with('lokasiRel', 'formitems')->findOrFail($panelId);

        $daily = FormChecklistDaily::where('form_checklist_panel_id', $panelId)
            ->whereDate('tanggal', $tanggal)
            ->first();

        $dailyChecklist = optional($daily)->load('items');

        $panelStatus = $dailyChecklist ? 'Panel diperiksa' : 'Panel belum diperiksa';

        $pdf = Pdf::loadView('laporan.pdf', compact('panel', 'daily', 'dailyChecklist', 'tanggal', 'panelStatus'));

        return $pdf->download('laporan-harian.pdf');
    }
}
