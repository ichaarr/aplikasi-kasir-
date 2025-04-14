<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Penjualan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data Pembayaran beserta relasi Penjualan
        $pembayaran = Pembayaran::with('penjualan')->get();
        return view('penjualans.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($penjualanId)
    {
        // Ambil data penjualan berdasarkan ID
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($penjualanId);
    
        // Tampilkan form pembayaran dengan data penjualan
        return view('pembayarans.create', compact('penjualan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // dd($request->all()); // Debugging
    try {
        // Validasi input
        $validatedData = $request->validate([
            'PenjualanID' => 'required|exists:penjualans,PenjualanID',
            'MetodePembayaran' => 'required|string',
            'JumlahDibayarkan' => 'required|numeric',
            'Kembalian' => 'required|numeric',
        ]);

        $jumlahDibayarkan = str_replace(['Rp', '.', ','], ['', '', '.'], $request->JumlahDibayarkan);
$jumlahDibayarkan = floatval($jumlahDibayarkan); // Konversi ke angka desimal

$penjualan = Penjualan::findOrFail($request->PenjualanID);
$jumlahDibayarkan = $request->JumlahDibayarkan;
$kembalian = $jumlahDibayarkan - $penjualan->TotalHarga;

Pembayaran::create([
    'PenjualanID' => $penjualan->PenjualanID,
    'MetodePembayaran' => $request->MetodePembayaran,
    'JumlahDibayarkan' => $jumlahDibayarkan,
    'Kembalian' => max($kembalian, 0), // Pastikan kembalian tidak negatif
]);

        // Redirect ke halaman index penjualans
        return redirect()->route('penjualans.index')->with('success', 'Pembayaran berhasil ditambahkan!');

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengambil data Pembayaran dan Penjualan untuk di-edit
        $pembayaran = Pembayaran::findOrFail($id);
        $penjualans = Penjualan::all();
        return view('penjualans.edit', compact('pembayaran', 'penjualans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'JumlahDibayarkan' => 'required|numeric|min:0',
        'MetodePembayaran' => 'required|string|in:Cash,Transfer,QRIS,Debit,Kredit',
    ]);

    // Mengambil data Pembayaran berdasarkan ID
    $pembayaran = Pembayaran::findOrFail($id);

    // Mengambil data Penjualan untuk mendapatkan total yang harus dibayar
    $penjualan = Penjualan::findOrFail($pembayaran->PenjualanID);

    // Menghitung kembalian
    $pembayaran->JumlahDibayarkan = $request->JumlahDibayarkan;
    $pembayaran->Kembalian = $request->JumlahDibayarkan - $penjualan->TotalBayar;
    $pembayaran->MetodePembayaran = $request->MetodePembayaran;
    $pembayaran->Status = $request->JumlahDibayarkan >= $penjualan->TotalBayar ? 'Lunas' : 'Belum Lunas';

    // Menyimpan perubahan
    $pembayaran->save();

    // Mengarahkan ke halaman index pembayaran dengan pesan sukses
    return redirect()->route('penjualans.index')->with('success', 'Pembayaran berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mengambil dan menghapus data Pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        // Mengarahkan ke halaman index pembayaran dengan pesan sukses
        return redirect()->route('penjualans.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
