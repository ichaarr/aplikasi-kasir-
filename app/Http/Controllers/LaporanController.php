<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil data penjualan berdasarkan rentang tanggal
        $penjualans = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])
            ->whereBetween('TanggalPenjualan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('TanggalPenjualan', 'desc')
            ->get();

        // Buat PDF
        $pdf = PDF::loadView('laporan.cetak', compact('penjualans'));

        return $pdf->download('laporan_penjualan.pdf');
    }
}
