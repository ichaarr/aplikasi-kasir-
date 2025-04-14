<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p style="text-align: center;">Periode: {{ request('tanggal_mulai') }} - {{ request('tanggal_selesai') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $index => $penjualan)
                @php
                    $rowspan = $penjualan->detailPenjualan->count();
                @endphp
                @foreach($penjualan->detailPenjualan as $key => $detail)
                    <tr>
                        @if($key == 0)
                            <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                            <td rowspan="{{ $rowspan }}">{{ date('d-m-Y', strtotime($penjualan->TanggalPenjualan)) }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $penjualan->pelanggan->NamaPelanggan ?? '-' }}</td>
                        @endif
                        <td>{{ $detail->produk->NamaProduk ?? '-' }}</td>
                        <td>{{ $detail->JumlahProduk }}</td>
                        <td>Rp{{ number_format($detail->SubTotal, 2, ',', '.') }}</td>
                        @if($key == 0)
                            <td rowspan="{{ $rowspan }}">Rp{{ number_format($penjualan->TotalHarga, 2, ',', '.') }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
