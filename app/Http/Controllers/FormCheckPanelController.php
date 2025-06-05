<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistItem;
use App\Models\FormChecklistPanel;
use App\Models\Lokasi;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormCheckPanelController extends Controller
{
    public function index(Request $request)
    {
        $formpanels = FormChecklistPanel::with('lokasiRel')->paginate();

        return view('admin.formpanels.index', compact('formpanels'));
    }
    public function userPanels(Request $request)
    {
        $formpanels = FormChecklistPanel::with('lokasiRel')->paginate();

        return view('user.formpanels.index', compact('formpanels'));
    }
    public function create(): View
    {

        $lokasiList = Lokasi::all();
        return view('admin.formpanels.create', compact('lokasiList'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_panel' => 'required',
            'lokasi' => 'required',
            'nama_pekerjaan' => 'nullable',
            'nomor_spk' => 'nullable',
            'tanggal_spk' => 'nullable'
        ]);

        FormChecklistPanel::create([
            'nama_panel' => $request->nama_panel,
            'lokasi' => $request->lokasi,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'nomor_spk' => $request->nomor_spk,
            'tanggal_spk' => $request->tanggal_spk
        ]);

        return redirect()->route('adminFormpanels')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function copy(Request $request): RedirectResponse
    {
        $existsPanel = FormChecklistPanel::with('formitems')->find($request->id);

        $newPanel = $existsPanel->replicate();
        $newPanel->created_at = Carbon::now();
        $newPanel->save();

        // Replicate formitems
        foreach ($existsPanel->formitems as $item) {
            $newItem = $item->replicate();
            $newItem->panel_id = $newPanel->id;
            $newItem->created_at = Carbon::now();
            $newItem->save();
        }

        return redirect()->route('adminFormpanels')->with(['success' => 'Data Berhasil Disalin!']);
    }

    public function show($id)
    {
        $formpanel = FormChecklistPanel::with('lokasiRel')->findOrFail($id);
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
        $lokasiList = Lokasi::all();

        return view('admin.formpanels.edit', compact('formpanel', 'lokasiList'));
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
