<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Detail Penjualan</h1>

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

        <!-- Form untuk mengedit detail penjualan -->
        <form action="{{ route('detailpenjualans.update', $detailpenjualan->DetailID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="PenjualanID">Penjualan</label>
                <select class="form-control" id="PenjualanID" name="PenjualanID" required>
                    <option value="">Pilih Penjualan</option>
                    @foreach($penjualans as $penjualan)
                        <option value="{{ $penjualan->PenjualanID }}" {{ old('PenjualanID', $detailpenjualan->PenjualanID) == $penjualan->PenjualanID ? 'selected' : '' }}>
                            Penjualan ID: {{ $penjualan->PenjualanID }} | Tanggal: {{ $penjualan->TanggalPenjualan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ProdukID">Produk</label>
                <select class="form-control" id="ProdukID" name="ProdukID" required>
                    <option value="">Pilih Produk</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->ProdukID }}" {{ old('ProdukID', $detailpenjualan->ProdukID) == $produk->ProdukID ? 'selected' : '' }}>
                            {{ $produk->NamaProduk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="JumlahProduk">Jumlah Produk</label>
                <input type="number" class="form-control" id="JumlahProduk" name="JumlahProduk" value="{{ old('JumlahProduk', $detailpenjualan->JumlahProduk) }}" required min="1">
            </div>

            <div class="form-group">
                <label for="SubTotal">SubTotal</label>
                <input type="number" class="form-control" id="SubTotal" name="SubTotal" value="{{ old('SubTotal', $detailpenjualan->SubTotal) }}" step="0.01" required readonly>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('detailpenjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        // Menambahkan perhitungan subtotal berdasarkan jumlah produk dan harga produk
        document.getElementById('JumlahProduk').addEventListener('input', function() {
            var jumlahProduk = parseInt(this.value) || 0;
            var produkHarga = {{ $produk->Harga ?? 0 }};
            var subtotal = jumlahProduk * produkHarga;
            document.getElementById('SubTotal').value = subtotal.toFixed(2);
        });
    </script>
</body>
</html>
