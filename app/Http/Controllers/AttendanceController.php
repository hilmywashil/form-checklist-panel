<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $daysInMonth = now()->daysInMonth;

        $attendances = Attendance::whereMonth('date', $currentMonth)
            ->get()
            ->groupBy('employee_name')
            ->sortBy(fn($value, $key) => strtolower($key)); // Urutkan sesuai alfabet

        return view('attendance.index', compact('daysInMonth', 'attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
        ]);

        $today = Carbon::now()->toDateString();

        Attendance::updateOrCreate(
            ['employee_name' => $request->employee_name, 'date' => $today],
            ['status' => true]
        );

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }
    public function destroy($employee_name)
    {
        Attendance::where('employee_name', $employee_name)->delete();

        return redirect()->back()->with('success', 'Karyawan berhasil dihapus.');
    }
}
