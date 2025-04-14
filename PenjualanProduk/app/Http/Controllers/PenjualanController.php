<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\DetailPenjualan;
use App\Pelanggan;
use App\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // Mengambil data penjualan dengan pembayaran dan relasi lainnya
        $penjualans = Penjualan::with('pelanggan', 'pembayaran')->get();
        return view('penjualans.index', compact('penjualans'));
    }
    

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('penjualans.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'TanggalPenjualan' => 'required|date',
            'TotalHarga' => 'required|numeric',
            'PelangganID' => 'required|exists:pelanggans,PelangganID',
            'produk_id.*' => 'required|exists:produks,ProdukID',
            'jumlah_produk.*' => 'required|numeric|min:1',
        ]);

        // Simpan penjualan
        $penjualan = Penjualan::create([
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'TotalHarga' => $request->TotalHarga,
            'PelangganID' => $request->PelangganID,
        ]);

        // Simpan detail penjualan
        foreach ($request->produk_id as $index => $produkID) {
            DetailPenjualan::create([
                'PenjualanID' => $penjualan->PenjualanID,
                'ProdukID' => $produkID,
                'JumlahProduk' => $request->jumlah_produk[$index],
                'SubTotal' => Produk::find($produkID)->Harga * $request->jumlah_produk[$index],
            ]);
        }

        return redirect()->route('pembayarans.create', ['penjualanId' => $penjualan->PenjualanID])
                         ->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($id);
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('penjualans.edit', compact('penjualan', 'pelanggans', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'TanggalPenjualan' => 'required|date',
            'TotalHarga' => 'required|numeric',
            'PelangganID' => 'required|exists:pelanggans,PelangganID',
            'produk_id.*' => 'required|exists:produks,ProdukID',
            'jumlah_produk.*' => 'required|numeric|min:1',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'TotalHarga' => $request->TotalHarga,
            'PelangganID' => $request->PelangganID,
        ]);

        // Hapus detail lama dan buat ulang
        DetailPenjualan::where('PenjualanID', $id)->delete();
        foreach ($request->produk_id as $index => $produkID) {
            DetailPenjualan::create([
                'PenjualanID' => $id,
                'ProdukID' => $produkID,
                'JumlahProduk' => $request->jumlah_produk[$index],
                'SubTotal' => Produk::find($produkID)->Harga * $request->jumlah_produk[$index],
            ]);
        }

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        DetailPenjualan::where('PenjualanID', $id)->delete();
        $penjualan->delete();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}