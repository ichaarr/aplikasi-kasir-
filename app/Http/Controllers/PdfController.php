<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\user;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $users = User::all(); // Ambil semua data dari tabel users

        $data = [
            'title' => 'Laporan PDF Laravel',
            'users' => $users
        ];

        $pdf = PDF::loadView('pdf.my-pdf', $data);
        return $pdf->download('laporan.pdf');
    }
}
