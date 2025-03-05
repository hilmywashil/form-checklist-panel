<?php

namespace App\Http\Controllers;

use App\Models\FormChecklistDaily;
use App\Models\FormChecklistPanel;
use Illuminate\Http\Request;

class FormChecklistDailyController extends Controller
{
    public function index()
    {
        $panels = FormChecklistPanel::with('checklists')->get();
        return view('admin.formchecklistdaily.index', compact('panels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_pemeriksaan' => 'required',
            'panel_id' => 'required|exists:form_checklist_panels,id',
        ]);

        FormChecklistDaily::create([
            'item_pemeriksaan' => $request->item_pemeriksaan,
            'date' => today(),
            'status' => false,
            'panel_id' => $request->panel_id,
        ]);

        return redirect()->back()->with('success', 'Checklist harian ditambahkan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $checklist = FormChecklistDaily::findOrFail($id);
        $checklist->status = !$checklist->status;
        $checklist->save();

        return response()->json(['success' => true]);
    }
}
