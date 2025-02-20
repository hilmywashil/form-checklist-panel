<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistItem;
use App\Models\FormChecklistPanel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormCheckPanelController extends Controller
{
    public function index(Request $request)
    {
        $query = FormChecklistPanel::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $formpanels = $query->orderBy('tanggal', 'desc')->paginate(20);

        if (auth()->check()) {
            return view('admin.formpanels.index', compact('formpanels'));
        } else {
            return view('formpanels.index', compact('formpanels'));
        }
    }
    public function create(): View
    {
        return view('admin.formpanels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_panel'     => 'required',
            'tanggal'   => 'required',
            'lokasi'   => 'required',
            'teknisi'   => 'required'
        ]);

        $panel = FormChecklistPanel::create([
            'nama_panel' => $request->nama_panel,
            'tanggal'    => $request->tanggal,
            'lokasi'     => $request->lokasi,
            'teknisi'    => $request->teknisi
        ]);

        $url = url('/formpanels/' . $panel->id);

        $qrCodePath = 'qrcodes/panel_' . $panel->id . '.png';

        Storage::disk('public')->put($qrCodePath, QrCode::format('png')
            ->merge('/public/images/favicon.png')
            ->errorCorrection('M')
            ->size(300)
            ->generate($url));

        $panel->update(['qr_code' => $qrCodePath]);

        return redirect()->route('formpanels.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $formpanel = FormChecklistPanel::findOrFail($id);
        $formitems = FormChecklistItem::where('panel_id', $formpanel->id)->paginate();

        if (auth()->check()) {
            return view('admin.formpanels.show', compact('formpanel', 'formitems'));
        } else {
            return view('formpanels.show', compact('formpanel', 'formitems'));
        }
    }

    public function downloadPDF($id)
    {
        $formpanel = FormChecklistPanel::findOrFail($id);
        $formitems = FormChecklistItem::where('panel_id', $formpanel->id)->get();

        $pdf = FacadePdf::loadView('admin.formpanels.pdf', compact('formpanel', 'formitems'));

        return $pdf->download('formpanel_' . $formpanel->id . '.pdf');
    }

    public function edit(string $id): View
    {
        $formpanel = FormChecklistPanel::findOrFail($id);

        return view('admin.formpanels.edit', compact('formpanel'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $formpanel = FormChecklistPanel::findOrFail($id);

        $formpanel->update([
            'nama_panel' => $request->nama_panel ?? $formpanel->nama_panel,
            'lokasi' => $request->lokasi ?? $formpanel->lokasi,
            'tanggal' => $request->tanggal ?? $formpanel->tanggal,
            'teknisi' => $request->teknisi ?? $formpanel->teknisi
        ]);

        return redirect()->route('formpanels.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id): RedirectResponse
    {
        $formpanel = FormChecklistPanel::findOrFail($id);

        $qrPath = 'public/qrcodes/panel_' . $formpanel->id . '.png';
        if (Storage::exists($qrPath)) {
            Storage::delete($qrPath);
        }

        $formpanel->delete();

        return redirect()->route('formpanels.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
