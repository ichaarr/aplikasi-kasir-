<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\Penjualan;
use App\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    // Menampilkan daftar detail penjualan
    public function index()
    {
        $details = DetailPenjualan::with('penjualan', 'produk')->get();
        return view('detailpenjualans.index', compact('details'));
    }

    // Menampilkan form untuk menambah detail penjualan baru
    public function create()
    {
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detailpenjualans.create', compact('penjualans', 'produks'));
    }

    // Menyimpan detail penjualan baru ke database
    public function store(Request $request)
{
    $request->validate([
        'PenjualanID' => 'required|exists:penjualans,PenjualanID',
        'ProdukID' => 'required|exists:produks,ProdukID',
        'JumlahProduk' => 'required|integer|min:1',
    ]);

    $produk = Produk::findOrFail($request->ProdukID);

    if (!$produk->kurangiStok($request->JumlahProduk)) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi!');
    }

    DetailPenjualan::create([
        'PenjualanID' => $request->PenjualanID,
        'ProdukID' => $request->ProdukID,
        'JumlahProduk' => $request->JumlahProduk,
        'SubTotal' => $produk->Harga * $request->JumlahProduk,
    ]);

    return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil ditambahkan!');
}



    // Menampilkan form untuk mengedit detail penjualan
    public function edit($id)
    {
        $detail = DetailPenjualan::findOrFail($id);
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detailpenjualans.edit', compact('detail', 'penjualans', 'produks'));
    }

    // Menyimpan perubahan detail penjualan yang sudah diedit
    public function update(Request $request, $id)
{
    $request->validate([
        'PenjualanID' => 'required|exists:penjualans,PenjualanID',
        'ProdukID' => 'required|exists:produks,ProdukID',
        'JumlahProduk' => 'required|integer|min:1',
    ]);

    $detail = DetailPenjualan::findOrFail($id);
    $produk = Produk::findOrFail($request->ProdukID);

    // Kembalikan stok produk sebelumnya
    $produk->tambahStok($detail->JumlahProduk);

    // Cek stok sebelum mengurangi kembali
    if (!$produk->kurangiStok($request->JumlahProduk)) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi untuk perubahan ini!');
    }

    // Update data detail penjualan
    $detail->update([
        'PenjualanID' => $request->PenjualanID,
        'ProdukID' => $request->ProdukID,
        'JumlahProduk' => $request->JumlahProduk,
        'SubTotal' => $produk->Harga * $request->JumlahProduk,
    ]);

    return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil diperbarui!');
}


    // Menghapus detail penjualan berdasarkan ID
    public function destroy($id)
{
    $detail = DetailPenjualan::findOrFail($id);
    $produk = $detail->produk;

    // Kembalikan stok sebelum menghapus
    if ($produk) {
        $produk->tambahStok($detail->JumlahProduk);
    }

    $detail->delete();

    return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil dihapus!');
}

}
