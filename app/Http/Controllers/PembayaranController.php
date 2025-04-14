<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Penjualan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index()
    {
        // Mengambil data Pembayaran beserta relasi Penjualan
        $pembayaran = Pembayaran::with('penjualan')->get();
        return view('pembayarans.index', compact('pembayaran'));
    }

    /**
     * Menampilkan form pembayaran berdasarkan ID Penjualan.
     */
    public function create($penjualanId)
    {
        // Ambil data penjualan berdasarkan ID
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($penjualanId);

        // Tampilkan form pembayaran dengan data penjualan
        return view('pembayarans.create', compact('penjualan'));
    }

    /**
     * Menyimpan data pembayaran ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'PenjualanID'      => 'required|exists:penjualans,PenjualanID',
        'MetodePembayaran' => 'required|string|in:Cash,Transfer,QRIS,Debit,Kredit',
        'JumlahDibayarkan' => 'required|numeric|min:0',
    ]);

    // Ambil data penjualan, jika tidak ditemukan, otomatis gagal (404)
    $penjualan = Penjualan::where('PenjualanID', $request->PenjualanID)->firstOrFail();

    // Cek apakah pembayaran sudah ada
    if (Pembayaran::where('PenjualanID', $request->PenjualanID)->exists()) {
        return redirect()->route('penjualans.index')
                         ->with('error', 'Pembayaran sudah dilakukan untuk transaksi ini.');
    }

    // Pastikan jumlah dibayarkan cukup
    if ($request->JumlahDibayarkan < $penjualan->TotalHarga) {
        return redirect()->route('penjualans.index')->with('error', 'Jumlah dibayarkan kurang dari total harga!');
    }

    // Hitung kembalian (tidak boleh negatif)
    $kembalian = max(0, $request->JumlahDibayarkan - $penjualan->TotalHarga);

    // Tentukan status pembayaran
    $status = 'Lunas';

    // Simpan data pembayaran
    Pembayaran::create([
        'PenjualanID'      => $request->PenjualanID,
        'MetodePembayaran' => $request->MetodePembayaran,
        'JumlahDibayarkan' => $request->JumlahDibayarkan,
        'Kembalian'        => $kembalian,
        'Status'           => $status,
    ]);

    return redirect()->route('penjualans2.index')
                     ->with('success', 'Pembayaran berhasil disimpan.');
}




    /**
     * Menampilkan form edit pembayaran.
     */
    public function edit($id)
    {
        // Mengambil data Pembayaran dan Penjualan untuk di-edit
        $pembayaran = Pembayaran::findOrFail($id);
        $penjualans = Penjualan::all();
        return view('pembayarans.edit', compact('pembayaran', 'penjualans'));
    }

    /**
     * Memperbarui data pembayaran.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'JumlahDibayarkan' => 'required|numeric|min:0',
            'MetodePembayaran' => 'required|string|in:Cash,Transfer,QRIS,Debit,Kredit',
        ]);

        // Mengambil data pembayaran dan penjualan terkait
        $pembayaran = Pembayaran::findOrFail($id);
        $penjualan = Penjualan::findOrFail($pembayaran->PenjualanID);

        // Mengupdate data pembayaran
        $pembayaran->update([
            'JumlahDibayarkan' => $request->JumlahDibayarkan,
            'Kembalian'        => $request->JumlahDibayarkan - $penjualan->TotalHarga,
            'MetodePembayaran' => $request->MetodePembayaran,
            'Status'           => $request->JumlahDibayarkan >= $penjualan->TotalHarga ? 'Lunas' : 'Belum Lunas',
        ]);

        return redirect()->route('pembayarans.index')
                         ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pembayaran.
     */
    public function destroy($id)
    {
        // Mengambil dan menghapus data pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayarans.index')
                         ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
