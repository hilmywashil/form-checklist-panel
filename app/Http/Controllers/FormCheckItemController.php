<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistItem;
use App\Models\FormChecklistPanel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class FormCheckItemController extends Controller
{
    // public function index(): View
    // {
    //     return view('admin.formitems.index');
    // }
    public function create($panel_id = null): View
    {
        $panels = FormChecklistPanel::all();
        return view('admin.formitems.create', compact('panels', 'panel_id'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'panel_id' => 'required|exists:form_checklist_panels,id',
            'item_pemeriksaan'     => 'required',
        ]);

        FormChecklistItem::create([
            'panel_id'   => $request->panel_id,
            'item_pemeriksaan'     => $request->item_pemeriksaan,
        ]);

        return redirect()->route('adminFormpanelShow', $request->panel_id)->with(['success' => 'Data berhasil ditambahkan!']);
    }

    public function edit($id)
    {
        $formitem = FormChecklistItem::findOrFail($id);
        $panels = FormChecklistPanel::all();
        return view('admin.formitems.edit', compact('formitem', 'panels'));
    }
    public function addKeterangan($id)
    {
        $formitem = FormChecklistItem::findOrFail($id);
        $panels = FormChecklistPanel::all();
        return view('admin.formitems.tambahKeterangan', compact('formitem', 'panels'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $formitem = FormChecklistItem::findOrFail($id);

        $formitem->update([
            'item_pemeriksaan' => $request->item_pemeriksaan ?? $formitem->item_pemeriksaan,
            'panel_id' => $formitem->panel_id
        ]);

        return redirect()->route('adminFormpanelShow', $formitem->panel_id)
            ->with(['success' => 'Data berhasil diperbarui!']);
    }

    public function destroy($id): RedirectResponse
    {
        $formitem = FormChecklistItem::findOrFail($id);
        $panel_id = $formitem->panel_id;

        $formitem->delete();

        return redirect()->route('adminFormpanelShow', $panel_id)->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
