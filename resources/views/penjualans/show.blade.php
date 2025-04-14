@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Penjualan</h2>
    <div class="card p-4">
        <table class="table table-bordered">
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Diketahui' }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($penjualan->TotalHarga, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tanggal Penjualan</th>
                <td>{{ $penjualan->created_at->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Jumlah Bayar</th>
                <td>
                    <input type="text" id="jumlahBayar" class="form-control"
                        value="Rp {{ number_format($penjualan->pembayaran->JumlahDibayarkan ?? 0, 0, ',', '.') }}"
                        readonly>
                </td>
            </tr>
            <tr>
                <th>Kembalian</th>
                <td>
                    <span id="kembalian">
                        Rp {{ number_format($penjualan->pembayaran->Kembalian ?? 0, 0, ',', '.') }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

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

    <!-- Button untuk Cetak Struk -->
    <a href="{{ route('penjualans.cetak', $penjualan->PenjualanID) }}" class="btn btn-success">Cetak Struk</a>

    <!-- Button untuk Kembali ke Halaman Index Penjualan -->
    <a href="{{ route('penjualans.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection
