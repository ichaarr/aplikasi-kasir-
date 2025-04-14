<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use App\Penjualan;
use App\Kategori;
use App\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();
    
        return view('dashboard', compact('totalPelanggan', 'totalPenjualan', 'totalKategori', 'totalProduk'));
        }
}
