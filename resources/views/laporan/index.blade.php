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
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
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
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>
    
    <form action="{{ route('laporan.cetak') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Cetak PDF</button>
            </div>
        </div>
    </form>
</div>

<!-- jQuery & Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#tanggal_mulai", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
    flatpickr("#tanggal_selesai", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
</script>

</body>
</html>

@endsection
