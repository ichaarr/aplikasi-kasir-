@extends('layouts.tamplate')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
    </style>
</head>
<body>

   
    
<div class="max-w-6xl mx-auto mt-12 px-6">
    <div class="bg-white p-8 rounded-2xl shadow-xl">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Daftar Pelanggan</h1>

        <form action="{{ route('pelanggans2.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, alamat, atau no. telepon..." class="form-control" style="width: 300px; display: inline-block;">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600 text-white text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No</th>
                        <th class="px-6 py-3 text-left font-semibold">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left font-semibold">Alamat</th>
                        <th class="px-6 py-3 text-left font-semibold">No. Telepon</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($pelanggans2 as $pelanggan)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pelanggan->NamaPelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pelanggan->Alamat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pelanggan->NomerTelepon }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">Tidak ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
