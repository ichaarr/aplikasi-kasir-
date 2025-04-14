<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan {{ $tanggal }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan Tanggal {{ $tanggal }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $key => $penjualan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $penjualan->TanggalPenjualan }}</td>
                    <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Ada' }}</td>
                    <td>Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
