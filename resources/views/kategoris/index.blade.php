@extends('layouts.tamplate')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
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

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-900 mb-6">Data Kategori</h1>
    
        <form action="{{ route('kategoris.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="form-control" style="width: 300px; display: inline-block;">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        

        <div class="mb-6 text-right">
            <a href="{{ route('kategoris.create') }}" class="bg-blue-500 hover:bg-sky-600 text-white font-semibold px-5 py-2 rounded shadow">
                + Tambah Kategori
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
                        <th class="px-4 py-3 border border-blue-400">Nama Kategori</th>
                        <th class="px-4 py-3 border border-blue-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                    <tr class="hover:bg-blue-100 text-center text-gray-900">
                        <td class="px-4 py-3 border border-blue-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border border-blue-400">{{ $kategori->NamaKategori }}</td>
                        <td class="px-4 py-3 border border-blue-400 space-x-2">
                            <a href="{{ route('kategoris.edit', $kategori->KategoriID) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">Edit</a>
                            <form action="{{ route('kategoris.destroy', $kategori->KategoriID) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
