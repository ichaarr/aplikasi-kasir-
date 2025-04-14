<?php

namespace App\Http\Controllers;


use App\Produk; // Perbaiki namespace model jika ada di dalam folder Models
use App\Kategori;
use App\Pelanggan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
public function index(Request $request)
{
    $query = Produk::with('kategori')->orderBy('NamaProduk', 'asc');

    if ($request->has('search') && $request->search != '') {
        $query->where('NamaProduk', 'like', '%' . $request->search . '%');
    }

    $produks = $query->get();
    return view('produks.index', compact('produks'));
}

public function index2(Request $request)
{
    $query = Produk::with('kategori')->orderBy('NamaProduk', 'asc');

    if ($request->has('search') && $request->search != '') {
        $query->where('NamaProduk', 'like', '%' . $request->search . '%');
    }

    $produks2 = $query->get();
    return view('produks2.index', compact('produks2'));
}



    

    public function create()
{
    $kategoris = Kategori::orderBy('NamaKategori', 'asc')->get();
    return view('produks.create', compact('kategoris'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'KategoriID' => 'required|exists:kategoris,KategoriID',
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
        ]);

        Produk::create($validated);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show($id)
{
    $produk = Produk::findOrFail($id);
    $pelanggan = Pelanggan::where('PelangganID', 1)->first(); // Contoh pelanggan dengan ID 1
    return view('produks.show', compact('produk', 'pelanggan'));
}


    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('produks.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
            'KategoriID' => 'required|exists:kategoris,KategoriID',
        ]);

        $produk->update($validated);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus');
    }
}