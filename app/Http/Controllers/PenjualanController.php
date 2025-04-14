<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\DetailPenjualan;
use App\Pelanggan;
use App\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function cetakStruk($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'pembayaran'])->findOrFail($id);
    
        $pdf = Pdf::loadView('pdf.struk', compact('penjualan'))->setPaper('A5', 'portrait');
    
        return $pdf->stream('Struk_Penjualan_'.$penjualan->id.'.pdf');
    }
    
    public function index(Request $request)
{
    $query = Penjualan::with(['pelanggan', 'pembayaran', 'detailPenjualan.produk']);

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->whereHas('pelanggan', function ($q) use ($search) {
            $q->where('NamaPelanggan', 'like', '%' . $search . '%');
        });
    }

    $penjualans = $query->get();

    return view('penjualans.index', compact('penjualans'));
}

    
public function index2(Request $request)
{
    $query = Penjualan::with(['pelanggan', 'pembayaran', 'detailPenjualan.produk']);

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->whereHas('pelanggan', function ($q) use ($search) {
            $q->where('NamaPelanggan', 'like', '%' . $search . '%');
        });
    }

    $penjualans2 = $query->get();

    return view('penjualans2.index', compact('penjualans2'));
}

    
    public function show($id)
{
    $penjualan = Penjualan::with('pembayaran')->findOrFail($id);
    return view('penjualans.show', compact('penjualan'));
}



public function cetak($id)
{
    $penjualan = Penjualan::with('pelanggan', 'pembayaran', 'detailPenjualan')->find($id);

    if (!$penjualan) {
        return redirect()->route('penjualans.index')->with('error', 'Data tidak ditemukan');
    }

    return view('penjualans.cetak', compact('penjualan'));
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