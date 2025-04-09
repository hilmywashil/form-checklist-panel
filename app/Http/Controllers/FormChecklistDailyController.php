<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormChecklistDaily;
use App\Models\FormChecklistDailyItem;
use App\Models\FormChecklistPanel;
use App\Models\FormChecklistItem;
use Illuminate\Support\Facades\Auth;

class FormChecklistDailyController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $checklists = FormChecklistDaily::with('panel')
            ->whereDate('tanggal', $today)
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.formdailies.index', compact('checklists'));
    }

    // public function userDaily()
    // {
    //     $checklists = FormChecklistDaily::with('panel')->orderBy('tanggal', 'desc')->get();
    //     return view('user.formdailies.index', compact('checklists'));
    // }

    public function create()
    {
        $panels = FormChecklistPanel::all();
        return view('admin.formdailies.create', compact('panels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_checklist_panel_id' => 'required|exists:form_checklist_panels,id',
            'tanggal' => 'required|date',
        ]);

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
                'kondisi' => 'baik'
            ]);
        }
        return redirect()->route('adminFormDaily')->with('success', 'Checklist harian berhasil dibuat.');
    }

    public function edit($id)
    {
        $daily = FormChecklistDaily::with('items.item')->findOrFail($id);
        return view('admin.formdailies.edit', compact('daily'));
    }

    // public function show($id)
    // {
    //     $daily = FormChecklistDaily::with('items.item')->findOrFail($id);
    //     return view('user.formdailies.show', compact('daily'));
    // }

    public function update(Request $request, $id)
    {
        $daily = FormChecklistDaily::findOrFail($id);

        foreach ($request->kondisi as $itemId => $kondisi) {
            $keterangan = $request->keterangan[$itemId] ?? null;

            FormChecklistDailyItem::where('form_checklist_daily_id', $id)
                ->where('form_checklist_item_id', $itemId)
                ->update([
                    'kondisi' => $kondisi,
                    'keterangan' => $keterangan,
                ]);
        }

        return redirect()->route('adminFormDaily')->with('success', 'Checklist harian diperbarui.');
    }

    public function table(Request $request)
    {
        $bulanInput = $request->input('bulan', date('Y-m'));
        $bulan = date('m', strtotime($bulanInput));
        $tahun = date('Y', strtotime($bulanInput));

        $panels = FormChecklistPanel::all();
        $selectedPanel = $request->input('panel_id', $panels->first()->id ?? null);

        $items = FormChecklistItem::where('panel_id', $selectedPanel)->get();

        $checklists = FormChecklistDaily::where('form_checklist_panel_id', $selectedPanel)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->with('items')
            ->get()
            ->keyBy('tanggal');

        return view('user.formdailies.table', compact('bulan', 'tahun', 'panels', 'selectedPanel', 'items', 'checklists'));
    }
    public function destroy($id)
    {
        $checklist = FormChecklistDaily::find($id);

        if (!$checklist) {
            return redirect()->route('adminFormDaily')->with('error', 'Checklist tidak ditemukan.');
        }

        $checklist->delete();

        return redirect()->route('adminFormDaily')->with('success', 'Checklist berhasil dihapus.');
    }
}
