@extends('layouts.tamplate')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Detail Penjualan</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100">

        <!-- Konten Utama -->
        <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
            <!-- Judul Halaman -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Data Detail Penjualan</h1>

            <!-- Tombol Tambah -->
            <div class="mb-6 text-right">
                <a href="{{ route('detailpenjualans.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow">
                    + Tambah Detail Penjualan
                </a>
            </div>

            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 bg-white shadow rounded-lg">
                    <thead class="bg-gray-800 text-white text-center">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300 w-1/12">No</th>
                            <th class="px-4 py-3 border border-gray-300 w-2/12">ID Penjualan</th>
                            <th class="px-4 py-3 border border-gray-300 w-3/12">Produk</th>
                            <th class="px-4 py-3 border border-gray-300 w-2/12">Jumlah</th>
                            <th class="px-4 py-3 border border-gray-300 w-2/12">SubTotal</th>
                            <th class="px-4 py-3 border border-gray-300 w-3/12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr class="hover:bg-gray-100 text-center text-gray-800">
                                <td class="px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 border border-gray-300">
                                    {{ $detail->penjualan->pelanggan->NamaPelanggan ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 border border-gray-300 text-left">{{ $detail->produk->NamaProduk }}
                                </td>
                                <td class="px-4 py-3 border border-gray-300">{{ $detail->JumlahProduk }}</td>
                                <td class="px-4 py-3 border border-gray-300">
                                    {{ number_format($detail->SubTotal, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 border border-gray-300">
                                    <a href="{{ route('detailpenjualans.edit', $detail->DetailID) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">Edit</a>
                                    <form action="{{ route('detailpenjualans.destroy', $detail->DetailID) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus detail penjualan ini?')">Hapus</button>
                                    </form>
                                    <a href="{{ route('detailpenjualans.show', $detail->DetailID) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </body>

    </html>
@endsection
