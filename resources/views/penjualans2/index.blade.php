@extends('layouts.tamplate')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f7ff;
        }
        .container {
            max-width: 900px;
            background: #ffffff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-weight: 600;
            color: #004a99;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background: linear-gradient(to right, #007bff, #0056b3);
        }
        thead th {
            color: white;
            font-weight: 600;
        }
        tbody tr:hover {
            background-color: #e3f2fd;
            transition: 0.3s;
        }
    </style>
</head>
<body>
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-blue-900 mb-6 text-center">Kasir Penjualan</h1></h1>
    
    <form action="{{ route('penjualans2.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan..." class="form-control" style="width: 300px; display: inline-block;">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
    

    <div class="mb-6 text-right">
        <a href="{{ route('penjualans.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded shadow">
            + Tambah Penjualan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 border border-green-500 text-green-900 px-4 py-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-blue-400 bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="text-center">
                    <th class="px-4 py-3 border border-blue-400">No</th>
                    <th class="px-4 py-3 border border-blue-400">Tanggal Penjualan</th>
                    <th class="px-4 py-3 border border-blue-400">Nama Pelanggan</th>
                    <th class="px-4 py-3 border border-blue-400">Nama Produk</th>
                    <th class="px-4 py-3 border border-blue-400">Jumlah Produk</th>
                    <th class="px-4 py-3 border border-blue-400">Harga</th>
                    <th class="px-4 py-3 border border-blue-400">Total Harga</th>
                    <th class="px-4 py-3 border border-blue-400">Metode Pembayaran</th>
                    <th class="px-4 py-3 border border-blue-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans2 as $index => $penjualan)
                    @php
                        $rowspan = count($penjualan->detailPenjualan);
                    @endphp
                    @foreach($penjualan->detailPenjualan as $key => $detail)
                        <tr class="text-center hover:bg-blue-50 transition">
                            @if($key == 0)
                                <td class="px-4 py-3 border border-blue-400 align-middle" rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border border-blue-400 text-left w-40 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $penjualan->TanggalPenjualan }}</td>
                                <td class="px-4 py-3 border border-blue-400 text-left w-40 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $penjualan->pelanggan->NamaPelanggan ?? '-' }}</td>
                            @endif
            
                            <td class="px-4 py-3 border border-blue-400 text-left w-40 whitespace-nowrap">{{ $detail->produk->NamaProduk ?? '-' }}</td>
                            <td class="px-4 py-3 border border-blue-400 text-center">{{ $detail->JumlahProduk }}</td>
                            <td class="px-4 py-3 border border-blue-400 text-right">Rp {{ number_format($detail->SubTotal, 2, ',', '.') }}</td>
            
                            @if($key == 0)
                                <td class="px-4 py-3 border border-blue-400 align-middle" rowspan="{{ $rowspan }}">Rp {{ number_format($penjualan->TotalHarga, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 border border-blue-400 align-middle" rowspan="{{ $rowspan }}">{{ $penjualan->pembayaran->MetodePembayaran ?? 'Cash' }}</td>
                                <td class="px-4 py-3 border border-blue-400 align-middle flex flex-col gap-1 items-center" rowspan="{{ $rowspan }}">
                                    {{-- <a href="{{ route('penjualans.edit', $penjualan->PenjualanID) }}" class="px-3 py-1 bg-yellow-400 text-white rounded shadow hover:bg-yellow-500">Edit</a>
                                    <form action="{{ route('penjualans.destroy', $penjualan->PenjualanID) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded shadow hover:bg-red-600">Hapus</button>
                                    </form> --}}
                                    <a href="{{ route('penjualans.cetak', $penjualan->PenjualanID) }}" class="px-3 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600">Cetak Struk</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
