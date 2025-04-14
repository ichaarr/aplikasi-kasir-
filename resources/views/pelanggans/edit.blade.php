@extends('layouts.tamplate')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pelanggan</h1>
        <form action="{{ route('pelanggans.update', $pelanggan->PelangganID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="NamaPelanggan">Nama Pelanggan:</label>
                <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" value="{{ $pelanggan->NamaPelanggan }}" required>
            </div>

            <div class="form-group">
                <label for="Alamat">Alamat:</label>
                <textarea class="form-control" id="Alamat" name="Alamat" required>{{ $pelanggan->Alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="NomerTelepon">Nomer Telepon:</label>
                <input type="text" class="form-control" id="NomerTelepon" name="NomerTelepon" value="{{ $pelanggan->NomerTelepon }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
@endsection