@extends('layouts.tamplate')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">📊 Dashboard Penjualan</h1>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $stats = [
                    ['icon' => 'fa-users', 'color' => 'bg-blue-100 text-blue-600', 'label' => 'Total Pelanggan', 'value' => $totalPelanggan],
                    ['icon' => 'fa-shopping-cart', 'color' => 'bg-green-100 text-green-600', 'label' => 'Total Penjualan', 'value' => $totalPenjualan],
                    ['icon' => 'fa-th-large', 'color' => 'bg-yellow-100 text-yellow-600', 'label' => 'Total Kategori', 'value' => $totalKategori],
                    ['icon' => 'fa-box', 'color' => 'bg-red-100 text-red-600', 'label' => 'Total Produk', 'value' => $totalProduk]
                ];
            @endphp

            @foreach($stats as $stat)
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center space-y-4">
                <div class="p-3 rounded-full {{ $stat['color'] }}">
                    <i class="fas {{ $stat['icon'] }} text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-600">{{ $stat['label'] }}</h3>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($stat['value']) }}</p>
            </div>
            @endforeach
        </div>

        <!-- Statistik Produk -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">📈 Statistik Produk</h2>
            <div class="h-64">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            
            // Gradient background
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#2563EB');
            gradient.addColorStop(1, '#BFDBFE');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pelanggan', 'Penjualan', 'Kategori', 'Produk'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $totalPelanggan }}, {{ $totalPenjualan }}, {{ $totalKategori }}, {{ $totalProduk }}],
                        backgroundColor: gradient,
                        borderRadius: 8,
                        barThickness: 24,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { weight: 500 } }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#64748b', font: { weight: 500 } }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
@endsection
