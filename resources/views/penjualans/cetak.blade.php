@extends('layouts.tamplate')

@section('content')
<style>
    .struk-container {
        font-family: 'Courier New', monospace;
        font-size: 13px;
        width: 250px;
        padding: 10px;
        border: 1px solid black;
        background: white;
        margin: auto;
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
        padding: 2px;
        text-align: left;
    }
    hr {
        border: none;
        border-top: 1px dashed black;
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
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container">
    <div id="struk" class="struk-container">
        <p class="center">====================</p>
        <h4 class="center">BARE & BLOOM 🌸</h4>
        <p class="center">Jl. Contoh No. 123</p>
        <p class="center">Telp: 0812-3456-7890</p>
        <p class="center">====================</p>

        <p><strong>Tanggal:</strong> {{ $penjualan->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>No. Transaksi:</strong> {{ $penjualan->PenjualanID ?? $penjualan->id }}</p>
        <p><strong>Kasir:</strong> Admin</p>
        <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->NamaPelanggan ?? 'Umum' }}</p>
        <hr>

        <table class="struk-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detailPenjualan as $detail)
                <tr>
                    <td>{{ $detail->produk->NamaProduk ?? 'Produk' }}</td>
                    <td>{{ $detail->JumlahProduk }}</td>
                    <td>{{ number_format($detail->produk->Harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($detail->SubTotal ?? 0, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>

        <p><strong>Total:</strong> Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</p>

        @if($penjualan->pembayaran)
        <p><strong>Bayar:</strong> Rp {{ number_format($penjualan->pembayaran->JumlahDibayarkan, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp {{ number_format($penjualan->pembayaran->Kembalian, 0, ',', '.') }}</p>
        @else
        <p class="text-danger">Cash</p>
        @endif

        <p class="center">====================</p>
        <p class="center">TERIMA KASIH</p>
        <p class="center">BARANG YANG SUDAH DIBELI</p>
        <p class="center">TIDAK DAPAT DITUKAR/KEMBALI</p>
        <p class="center">====================</p>

        <div class="center mt-3 no-print">
            <button class="btn btn-success btn-sm" onclick="window.print()">Cetak Struk</button>
            <a href="{{ route('penjualans.index') }}" class="btn btn-primary btn-sm">Kembali</a>
        </div>
    </div>
</div>
@endsection
