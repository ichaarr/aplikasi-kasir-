<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index(Request $request)
{
    $query = Kategori::orderBy('NamaKategori', 'asc');

    if ($request->has('search')) {
        $search = $request->input('search');

        $query->where('NamaKategori', 'like', '%' . $search . '%');
    }

    $kategoris = $query->get();

    return view('kategoris.index', compact('kategoris'));
}



    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('kategoris.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'NamaKategori' => 'required|string|max:255',
        ]);

        // Ambil ID kategori terakhir, jika tidak ada maka mulai dari 1
        $newKategoriID = Kategori::max('KategoriID') + 1;

        Kategori::create([
            'KategoriID' => $newKategoriID,
            'NamaKategori' => $request->NamaKategori,
        ]);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));
    }

    // Mengupdate data kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaKategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update(['NamaKategori' => $request->NamaKategori]);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diupdate');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
