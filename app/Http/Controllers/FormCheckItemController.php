<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistItem;
use App\Models\FormChecklistPanel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class FormCheckItemController extends Controller
{
    public function create($panel_id = null): View
    {
        $panels = FormChecklistPanel::all();
        return view('formitems.create', compact('panels', 'panel_id'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'panel_id' => 'required|exists:form_checklist_panels,id',
            'item_pemeriksaan'     => 'required',
            'keterangan'   => 'nullable'
        ]);

        FormChecklistItem::create([
            'panel_id'   => $request->panel_id,
            'item_pemeriksaan'     => $request->item_pemeriksaan,
            'keterangan'   => $request->keterangan
        ]);

        return redirect()->route('formpanels.show', $request->panel_id)->with(['success' => 'Data berhasil ditambahkan!']);
    }

    // public function show(string $id): View
    // {
    //     $formitem = FormChecklistItem::findOrFail($id);

    //     return view('formitems.show', compact('formitems'));
    // }
    public function edit($id)
    {
        $formitem = FormChecklistItem::findOrFail($id);
        $panels = FormChecklistPanel::all(); 
        return view('formitems.edit', compact('formitem', 'panels'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $formitem = FormChecklistItem::findOrFail($id);

        $formitem->update([
            'item_pemeriksaan' => $request->item_pemeriksaan ?? $formitem->item_pemeriksaan,
            'check' => $request->check ?? $formitem->check,
            'keterangan' => $request->keterangan ?? $formitem->keterangan,
            'panel_id' => $request->panel_id ?? $formitem->panel_id
        ]);

        return redirect()->route('formpanels.show', $request->panel_id)->with(['success' => 'Data berhasil diperbarui!']);
    }

    public function updateCheck(Request $request, $id): RedirectResponse
    {
        $formitem = FormChecklistItem::findOrFail($id);

        $request->validate([
            'check' => 'required|in:normal,perbaikan'
        ]);

        $formitem->update([
            'check' => $request->check
        ]);

        return back()->with(['success' => 'Check berhasil!']);
    }

    public function destroy($id): RedirectResponse
    {
        $formitem = FormChecklistItem::findOrFail($id);
        $panel_id = $formitem->panel_id;

        $formitem->delete();

        return redirect()->route('formpanels.show', $panel_id)->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
