<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Plottingan;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    /**
     * Tampilkan list SHIFT (untuk admin).
     */
    public function index()
    {
        // Ambil semua shift
        $shifts = Shift::orderBy('date', 'asc')
                       ->orderBy('time_start', 'asc')
                       ->get();

        // Return ke Blade 'admin.shift'
        return view('admin.shift', compact('shifts'));
    }

    /**
     * Simpan SHIFT baru (Add Shift).
     */
    public function store(Request $request)
    {
        $request->validate([
            'shift_no'   => 'required|string|max:50',
            'date'       => 'required|date',
            'time_start' => 'required',
            'time_end'   => 'required',
            'kuota'      => 'required|integer|min:0',
        ]);

        Shift::create([
            'shift_no'   => $request->shift_no,
            'date'       => $request->date,
            'time_start' => $request->time_start,
            'time_end'   => $request->time_end,
            'kuota'      => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Shift created successfully!');
    }

    /**
     * Menampilkan detail SHIFT tertentu (opsional).
     */
    public function show($id)
    {
        $shift = Shift::findOrFail($id);
        return view('admin.shift-show', compact('shift'));
    }

    /**
     * Update SHIFT (Edit Shift).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'shift_no'   => 'required|string|max:50',
            'date'       => 'required|date',
            'time_start' => 'required',
            'time_end'   => 'required',
            'kuota'      => 'required|integer|min:0',
        ]);

        $shift = Shift::findOrFail($id);
        $shift->update([
            'shift_no'   => $request->shift_no,
            'date'       => $request->date,
            'time_start' => $request->time_start,
            'time_end'   => $request->time_end,
            'kuota'      => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Shift updated successfully!');
    }

    /**
     * Hapus SHIFT (Delete).
     */
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        // Opsi: Hapus Plottingan milik SHIFT ini jg
        // Plottingan::where('shift_id',$id)->delete();
        $shift->delete();

        return redirect()->back()->with('success', 'Shift deleted successfully!');
    }

    /**
     * RESET SHIFT: hapus semua SHIFT (dan Plottingan jika diperlukan).
     */
    public function resetShifts()
    {
        DB::transaction(function() {
            Shift::truncate();
            // Jika ingin sekalian reset plottingan
            // Plottingan::truncate();
        });

        return redirect()->back()->with('success', 'All Shifts have been reset!');
    }

    /**
     * RESET PLOT: hapus semua data Plottingan.
     */
    public function resetPlot()
    {
        Plottingan::truncate();
        return redirect()->back()->with('success', 'All Plots have been reset!');
    }
}
