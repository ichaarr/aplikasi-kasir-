<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Penjualan</h1>

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

        <!-- Form untuk mengedit penjualan -->
        <form action="{{ route('penjualans.update', $penjualan->PenjualanID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="TanggalPenjualan">Tanggal Penjualan</label>
                <input type="date" class="form-control" id="TanggalPenjualan" name="TanggalPenjualan" value="{{ old('TanggalPenjualan', $penjualan->TanggalPenjualan) }}" required>
            </div>

            <div class="form-group">
                <label for="TotalHarga">Total Harga</label>
                <input type="number" class="form-control" id="TotalHarga" name="TotalHarga" value="{{ old('TotalHarga', $penjualan->TotalHarga) }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="PelangganID">Pelanggan</label>
                <select class="form-control" id="PelangganID" name="PelangganID" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->PelangganID }}" {{ old('PelangganID', $penjualan->PelangganID) == $pelanggan->PelangganID ? 'selected' : '' }}>
                            {{ $pelanggan->NamaPelanggan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
