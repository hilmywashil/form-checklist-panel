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
        $formpanels = FormChecklistPanel::query()->paginate();

        return view('admin.formpanels.index', compact('formpanels'));
    }
    public function userPanels(Request $request)
    {
        $formpanels = FormChecklistPanel::query()->paginate();

        return view('user.formpanels.index', compact('formpanels'));
    }
    public function create(): View
    {
        return view('admin.formpanels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_panel'     => 'required',
            'lokasi'   => 'required',
            'nama_pekerjaan'   => 'nullable',
            'nomor_spk'   => 'nullable',
            'tanggal_spk'   => 'nullable'
        ]);

        $panel = FormChecklistPanel::create([
            'nama_panel' => $request->nama_panel,
            'lokasi'     => $request->lokasi,
            'nama_pekerjaan'    => $request->nama_pekerjaan,
            'nomor_spk'    => $request->nomor_spk,
            'tanggal_spk'    => $request->tanggal_spk
        ]);

        $url = url('/formpanels/' . $panel->id);

        $qrCodePath = 'qrcodes/panel_' . $panel->id . '.png';

        Storage::disk('public')->put($qrCodePath, QrCode::format('png')
            ->errorCorrection('M')
            ->size(300)
            ->generate($url));

        $panel->update(['qr_code' => $qrCodePath]);

        return redirect()->route('adminFormpanels')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $formpanel = FormChecklistPanel::findOrFail($id);
        $formitems = FormChecklistItem::where('panel_id', $formpanel->id)->paginate();

        return view('admin.formpanels.show', compact('formpanel', 'formitems'));
    }

    public function userShow($id)
    {
        $formpanel = FormChecklistPanel::findOrFail($id);
        $formitems = FormChecklistItem::where('panel_id', $formpanel->id)->paginate();

        return view('user.formpanels.show', compact('formpanel', 'formitems'));
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
            'nama_pekerjaan' => $request->nama_pekerjaan ?? $formpanel->nama_pekerjaan,
            'nomor_spk' => $request->nomor_spk ?? $formpanel->nomor_spk,
            'tanggal_spk' => $request->tanggal_spk ?? $formpanel->tanggal_spk
        ]);

        return redirect()->route('adminFormpanels')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id): RedirectResponse
    {
        $formpanel = FormChecklistPanel::findOrFail($id);

        $qrPath = 'public/qrcodes/panel_' . $formpanel->id . '.png';
        if (Storage::exists($qrPath)) {
            Storage::delete($qrPath);
        }

        $formpanel->delete();

        return redirect()->route('adminFormpanels')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
