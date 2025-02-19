<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistItem;
use App\Models\FormChecklistPanel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class FormCheckPanelController extends Controller
{
    public function index(Request $request)
    {
        $query = FormChecklistPanel::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $formpanels = $query->paginate();

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

        FormChecklistPanel::create([
            'nama_panel'     => $request->nama_panel,
            'tanggal'     => $request->tanggal,
            'lokasi'   => $request->lokasi,
            'teknisi'   => $request->teknisi
        ]);

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

        $formpanel->delete();

        return redirect()->route('formpanels.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
