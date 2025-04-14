<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Detail Penjualan</h1>

        <!-- Menampilkan pesan error dari session -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

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

        <!-- Form untuk menambah detail penjualan -->
        <form action="{{ route('detailpenjualans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="PenjualanID">Penjualan</label>
                <select class="form-control" id="PenjualanID" name="PenjualanID" required>
                    <option value="">Pilih Penjualan</option>
                    @foreach($penjualans as $penjualan)
                        <option value="{{ $penjualan->PenjualanID }}" {{ old('PenjualanID') == $penjualan->PenjualanID ? 'selected' : '' }}>
                            Nama Pelanggan: {{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Ada' }} 
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ProdukID">Produk</label>
                <select class="form-control" id="ProdukID" name="ProdukID" required>
                    <option value="">Pilih Produk</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->ProdukID }}" {{ old('ProdukID') == $produk->ProdukID ? 'selected' : '' }}>
                            {{ $produk->NamaProduk }} (Rp {{ number_format($produk->Harga, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="JumlahProduk">Jumlah Produk</label>
                <input type="number" class="form-control" id="JumlahProduk" name="JumlahProduk" value="{{ old('JumlahProduk') }}" required min="1">
            </div>

            <div class="form-group">
                <label for="SubTotal">SubTotal</label>
                <input type="number" class="form-control" id="SubTotal" name="SubTotal" value="{{ old('SubTotal') }}" step="0.01" required readonly>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Detail Penjualan</button>
            <a href="{{ route('detailpenjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        document.getElementById('ProdukID').addEventListener('change', function() {
            var selectedProduk = this.options[this.selectedIndex];
            var harga = selectedProduk.text.match(/\(Rp ([\d,]+.\d{2})\)/);
            var hargaProduk = harga ? parseFloat(harga[1].replace(',', '')) : 0;
            document.getElementById('JumlahProduk').addEventListener('input', function() {
                var jumlahProduk = parseInt(this.value) || 0;
                document.getElementById('SubTotal').value = (jumlahProduk * hargaProduk).toFixed(2);
            });
        });
    </script>
</body>
</html>
