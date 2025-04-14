<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Kategori</h1>

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

        <!-- Form untuk mengedit kategori -->
        <form action="{{ route('kategoris.update', $kategori->KategoriID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="NamaKategori">Nama Kategori</label>
                <input type="text" class="form-control" id="NamaKategori" name="NamaKategori" value="{{ old('NamaKategori', $kategori->NamaKategori) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
