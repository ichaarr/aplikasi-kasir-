<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            font-weight: 600;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-group label {
            font-weight: 500;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Pelanggan</h1>
        <form action="{{ route('pelanggans.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="NamaPelanggan">Nama Pelanggan:</label>
                <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="Alamat">Alamat:</label>
                <textarea name="Alamat" id="Alamat" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="NomerTelepon">Nomor Telepon:</label>
                <input type="text" name="NomerTelepon" id="NomerTelepon" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
