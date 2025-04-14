<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Buat Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff; /* Biru muda */
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: #007bff;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table-light {
            background-color: #e3f2fd;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center text-primary mb-4">Pembayaran - Buat Pembayaran</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Detail Penjualan</h5>
            <p><strong>Tanggal Penjualan:</strong> {{ date('d-m-Y', strtotime($penjualan->TanggalPenjualan)) }}</p>
            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->NamaPelanggan }}</p>
            
            <h6 class="mt-3">Rincian Pembelian:</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nama Produk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->detailPenjualan as $detail)
                        @php
                            $harga_satuan = optional($detail->produk)->Harga ?? 0;
                            $subtotal = $detail->JumlahProduk * $harga_satuan;
                        @endphp
                        <tr>
                            <td>{{ optional($detail->produk)->NamaProduk ?? 'Produk Tidak Ditemukan' }}</td>
                            <td class="text-center">{{ $detail->JumlahProduk }}</td>
                            <td class="text-end">Rp {{ number_format($harga_satuan, 2, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>                
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Total Harga:</th>
                        <th class="text-end">Rp {{ number_format($penjualan->TotalHarga, 2, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Pembayaran</h5>
            <form id="pembayaranForm" action="{{ route('pembayaran.store') }}" method="POST">
                @csrf
                <input type="hidden" name="PenjualanID" value="{{ $penjualan->PenjualanID }}">

                <div class="mb-3">
                    <label for="MetodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="MetodePembayaran" id="MetodePembayaran" class="form-control" required>
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                        <option value="E-Wallet">E-Wallet</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="TotalBayar" class="form-label">Total Bayar</label>
                    <input type="text" class="form-control text-end" id="TotalBayar" value="Rp {{ number_format($penjualan->TotalHarga, 2, ',', '.') }}" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="JumlahDibayarkan" class="form-label">Jumlah Dibayarkan</label>
                    <input type="text" class="form-control text-end" name="JumlahDibayarkan" id="JumlahDibayarkan" required>
                </div>
                
                <div class="mb-3">
                    <label for="Kembalian" class="form-label">Kembalian</label>
                    <input type="text" class="form-control text-end" id="Kembalian" readonly>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Bayar</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahDibayarkanInput = document.getElementById('JumlahDibayarkan');
        const kembalianInput = document.getElementById('Kembalian');
        const totalHarga = parseFloat({{ $penjualan->TotalHarga ?? 0 }}); // Pastikan tidak undefined
    
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
        }
    
        function toNumber(rupiah) {
            return parseFloat(rupiah.replace(/[^0-9]/g, '')) || 0;
        }
    
        jumlahDibayarkanInput.addEventListener('input', function () {
            let jumlahDibayarkan = toNumber(this.value);
            this.value = formatRupiah(jumlahDibayarkan);
    
            let kembalian = jumlahDibayarkan - totalHarga;
            kembalianInput.value = kembalian < 0 ? "Pembayaran kurang!" : formatRupiah(kembalian);
        });
    
        jumlahDibayarkanInput.addEventListener('blur', function () {
            // Pastikan nilai tetap angka saat dikirim ke server
            this.value = toNumber(this.value);
        });
    });
    </script>
    
</body>
</html>
