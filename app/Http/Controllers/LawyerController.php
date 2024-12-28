<?php

namespace App\Http\Controllers;

use App\Models\Lawyer; // Pastikan model Lawyer sudah diimport
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function index()
    {
        // Ambil data pengacara dari database
        $lawyers = Lawyer::all();

        // Kirim data ke view
        return view('lawyerPage', compact('lawyers'));
    }
}
