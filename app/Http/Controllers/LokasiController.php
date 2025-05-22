<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LokasiController extends Controller
{
    public function index(): View {
        $lokasis = Lokasi::orderBy('nama_lokasi', 'asc')->get();

        return view('admin.lokasi.index', compact('lokasis'));
    }

    public function create(): View {
        return view('admin.lokasi.create');
    }

    public function store(Request $request) : RedirectResponse {
        $request->validate([
            'nama_lokasi' => ['required', 'string']
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi')->with('success', 'Lokasi created successfully');
    }

    public function edit($id) : View {
        $lokasi = Lokasi::findOrFail($id);

        return view('admin.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, $id) : RedirectResponse {
        $request->validate([
            'nama_lokasi' => ['required', 'string']
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        return redirect()->route('lokasi')->with('success', 'Lokasi updated successfully');
    }

    public function destroy($id) : RedirectResponse {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('lokasi')->with('success', 'Lokasi deleted successfully');
    }
}
