<!-- create.blade.php untuk Produk -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .form-control {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Produk</h1>
    
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('produks.store') }}" method="POST">
            @csrf
    
            <head>
                <!-- Tambahkan CDN Select2 -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
            </head>
            
            <body>
                <div class="form-group">
                    <label for="KategoriID">Nama Kategori</label>
                    <select name="KategoriID" id="KategoriID" class="form-control select2" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->KategoriID }}" {{ old('KategoriID') == $kategori->KategoriID ? 'selected' : '' }}>
                                {{ $kategori->NamaKategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
                <!-- Tambahkan jQuery & Select2 -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
            
                <script>
                    $(document).ready(function() {
                        $('#KategoriID').select2({
                            placeholder: "Pilih Kategori",
                            allowClear: true
                        });
                    });
                </script>
            </body>
            
    
            <div class="form-group">
                <label for="NamaProduk">Nama Produk</label>
                <input type="text" class="form-control" id="NamaProduk" name="NamaProduk" value="{{ old('NamaProduk') }}" required>
            </div>            
    
            <div class="form-group">
                <label for="Harga">Harga</label>
                <input type="number" class="form-control" id="Harga" name="Harga" value="{{ old('Harga') }}" step="0.01" required>
            </div>
    
            <div class="form-group">
                <label for="Stok">Stok</label>
                <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok') }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
