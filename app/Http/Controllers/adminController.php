<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $lawyers = Lawyer::all();
        return view('admin', compact('lawyers'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:lawyers,phone_number',
            'years_of_experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        // Menyimpan data
        Lawyer::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'years_of_experience' => $request->years_of_experience,
            'consultation_fee' => $request->consultation_fee,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'Data lawyer berhasil ditambahkan.');
    }

    public function update(Request $request, Lawyer $lawyer)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:lawyers,phone_number,' . $lawyer->id,
            'years_of_experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        // Memperbarui data
        $lawyer->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'years_of_experience' => $request->years_of_experience,
            'consultation_fee' => $request->consultation_fee,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'Data lawyer berhasil diperbarui.');
    }

    /**
     * Menghapus data lawyer.
     */
    public function destroy(Lawyer $lawyer)
    {
        // Menghapus data
        $lawyer->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'Data lawyer berhasil dihapus.');
    }
}
