<?php

namespace App\Http\Controllers;
use App\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
    {
        // Mengambil semua data pelanggan
        $pelanggans = Pelanggan::all(); 
    
        // Mengirim data ke view
        return view('pelanggans.index', compact('pelanggans'));
    }
    
    /**
     * Menampilkan form tambah pelanggan.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggans.create', compact('pelanggan'));
    }

    /**
     * Menyimpan data pelanggan baru.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'NomerTelepon' => 'required|string|max:15',
        ]);

        // Menyimpan data pelanggan ke database
        Pelanggan::create([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomerTelepon' => $request->NomerTelepon,
        ]);

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pelanggan.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggans.show', compact('pelanggan'));
    }

    /**
     * Menampilkan form edit pelanggan.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggans.edit', compact('pelanggan'));
    }

    /**
     * Memperbarui data pelanggan.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Validasi input dari form edit
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'NomerTelepon' => 'required|string|max:15',
        ]);

        // Mengupdate data pelanggan
        $pelanggan->update([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomerTelepon' => $request->NomerTelepon,
        ]);

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus pelanggan.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}