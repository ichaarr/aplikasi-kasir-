<?php

namespace App\Http\Controllers;
use App\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index(Request $request)
{
    // Mulai query untuk pelanggan
    $query = Pelanggan::orderBy('NamaPelanggan', 'asc');

    // Jika ada input pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('NamaPelanggan', 'like', '%' . $search . '%');
    }

    // Ambil data hasil pencarian atau semua jika kosong
    $pelanggans = $query->get();

    return view('pelanggans.index', compact('pelanggans'));
}


public function index2(Request $request)
{
    $query = Pelanggan::orderBy('NamaPelanggan', 'asc');

    if ($request->has('search')) {
        $search = $request->input('search');

        $query->where(function($q) use ($search) {
            $q->where('NamaPelanggan', 'like', '%' . $search . '%')
              ->orWhere('Alamat', 'like', '%' . $search . '%')
              ->orWhere('NomerTelepon', 'like', '%' . $search . '%');
        });
    }

    $pelanggans2 = $query->get();

    return view('pelanggans2.index', compact('pelanggans2'));
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