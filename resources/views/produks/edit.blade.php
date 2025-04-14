<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Produk</h1>

        <!-- Menampilkan pesan error validasi -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk mengedit produk -->
        <form action="{{ route('produks.update', $produk->ProdukID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="NamaProduk">Nama Kategori</label>
                <input type="text" class="form-control" id="NamaProduk" name="NamaProduk" value="{{ old('NamaProduk', $produk->NamaProduk) }}" required>
            </div>

            <div class="form-group">
                <label for="Nama">Nama Produk</label>
                <input type="text" class="form-control" id="Nama" name="Nama" value="{{ old('Nama', $produk->Nama) }}" required>
            </div>

            <div class="form-group">
                <label for="Harga">Harga</label>
                <input type="number" class="form-control" id="Harga" name="Harga" value="{{ old('Harga', $produk->Harga) }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Stok">Stok</label>
                <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok', $produk->Stok) }}" required>
            </div>

            <div class="form-group">
                <label for="KategoriID">Kategori</label>
                <select class="form-control" id="KategoriID" name="KategoriID" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->KategoriID }}" {{ old('KategoriID', $produk->KategoriID) == $kategori->KategoriID ? 'selected' : '' }}>
                            {{ $kategori->NamaKategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
