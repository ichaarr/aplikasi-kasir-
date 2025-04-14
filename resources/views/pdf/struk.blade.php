<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            padding: 10px;
            border: 1px solid #000;
        }
        h2 {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Struk Penjualan</h2>
        <p><strong>Tanggal:</strong> {{ $penjualan->created_at->format('d-m-Y') }}</p>
        <p><strong>Nama Pelanggan:</strong> {{ optional($penjualan->pelanggan)->NamaPelanggan ?? 'Tidak Diketahui' }}</p>

        <table>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($penjualan->TotalHarga, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ optional($penjualan->pembayaran)->MetodePembayaran ?? 'Belum ada data' }}</td>
            </tr>
            <tr>
                <th>Jumlah Dibayarkan</th>
                <td>Rp {{ number_format((float) (optional($penjualan->pembayaran)->JumlahDibayarkan ?? 0), 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Kembalian</th>
                <td>Rp {{ number_format((float) (optional($penjualan->pembayaran)->Kembalian ?? 0), 2, ',', '.') }}</td>
            </tr>
        </table>

        <p class="total">Terima kasih atas pembelian Anda!</p>
    </div>
</body>
</html>
