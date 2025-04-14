<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .struk-container {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            width: 300px;
            padding: 10px;
            border: 1px solid black;
            background: white;
        }
        .center {
            text-align: center;
        }
        .struk-table {
            width: 100%;
            border-collapse: collapse;
        }
        .struk-table th, .struk-table td {
            border-bottom: 1px dashed black;
            padding: 5px;
            text-align: left;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            #struk, #struk * {
                visibility: visible;
            }
            #struk {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Detail Produk</h2>
        <div class="card p-4">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $produk->NamaProduk }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($produk->Harga, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $produk->Stok }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td><input type="text" id="namaPelanggan" class="form-control" value="{{ $pelanggan->NamaPelanggan ?? '' }}" readonly></td>
                </tr>
                <tr>
                    <th>Jumlah Bayar</th>
                    <td><input type="number" id="jumlahBayar" class="form-control" value="{{ $produk->Harga }}" min="{{ $produk->Harga }}" step="1000"></td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td><span id="kembalian">Rp 0</span></td>
                </tr>
            </table>
        </div>
        <button class="btn btn-success" onclick="hitungKembalian()">Hitung Kembalian</button>
        <button class="btn btn-primary" onclick="cetakStruk()">Cetak Struk</button>
        <a href="{{ route('produks.index') }}" class="btn btn-secondary mt-3">Kembali</a>

        <!-- STRUK TEMPLATE -->
        <div id="struk" class="struk-container" style="display: none;">
            <h2 class="center">Bare & Bloom 🌸</h2>
            <p class="center">Jl. Contoh No. 123, Jakarta</p>
            <p class="center">Telp: 0882-1415-4628</p>
            <hr>
            <p><strong>Kasir:</strong> tootideea</p>
            <p><strong>Pelanggan:</strong> {{ $pelanggan->NamaPelanggan ?? 'Tanpa Nama' }}</p>
            <p><strong>Tanggal:</strong> {{ now()->format('d/m/Y H:i') }}</p>
            <hr>
            <table class="struk-table">
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>{{ $produk->NamaProduk }}</td>
                    <td>1</td>
                    <td>Rp {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                </tr>
            </table>
            <hr>
            <p><strong>Jumlah Bayar:</strong> Rp <span id="bayar">{{ number_format($produk->Harga, 0, ',', '.') }}</span></p>
            <p><strong>Kembalian:</strong> Rp <span id="strukKembalian">0</span></p>
            <hr>
            <p class="center">** TERIMA KASIH **</p>
            <p class="center">Barang yang sudah dibeli</p>
            <p class="center">tidak dapat dikembalikan</p>
        </div>
    </div>

    <script>
        function hitungKembalian() {
            let harga = {{ $produk->Harga }};
            let bayar = parseFloat(document.getElementById('jumlahBayar').value);
            let kembalian = bayar - harga;

            if (kembalian < 0) {
                alert("Uang kurang!");
                document.getElementById('kembalian').innerText = "Rp 0";
                document.getElementById('strukKembalian').innerText = "0";
            } else {
                document.getElementById('kembalian').innerText = "Rp " + kembalian.toLocaleString('id-ID');
                document.getElementById('strukKembalian').innerText = kembalian.toLocaleString('id-ID');
            }
        }

        function cetakStruk() {
            let bayar = parseFloat(document.getElementById('jumlahBayar').value);
            let harga = {{ $produk->Harga }};

            if (bayar < harga) {
                alert("Pembayaran kurang!");
                return;
            }

            document.getElementById("struk").style.display = "block";
            window.print();
            document.getElementById("struk").style.display = "none";
        }
    </script>
</body>
</html>
