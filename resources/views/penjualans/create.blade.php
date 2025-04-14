<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Buat Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
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
        <h2>Tambah Penjualan</h2>
        <form action="{{ route('penjualans.store') }}" method="POST">
            @csrf

            @php $today = date('Y-m-d'); @endphp

            <!-- Tanggal Penjualan -->
            <div class="mb-3">
                <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan</label>
                <input type="date" class="form-control" name="TanggalPenjualan"
                    value="{{ old('TanggalPenjualan', $today) }}" min="{{ $today }}" required>
            </div>

            <!-- Pilih Pelanggan -->
            <div class="mb-3">
                <label for="PelangganID" class="form-label">Pilih Pelanggan</label>
                <select class="form-control select2" name="PelangganID" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->PelangganID }}"
                            {{ old('PelangganID') == $pelanggan->PelangganID ? 'selected' : '' }}>
                            {{ $pelanggan->NamaPelanggan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produk dan Jumlah Produk -->
            <hr>
            <h4>Tambah Produk</h4>
            <div id="produk-container">
                <div class="produk-row d-flex gap-2 mb-2">
                    <select class="form-control select2 produk-select" name="produk_id[]" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $produk)
                            <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                                {{ $produk->NamaProduk }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control" name="jumlah_produk[]" placeholder="Jumlah Produk" required min="1">
                    <input type="text" class="form-control harga-produk" name="harga_produk[]" placeholder="Harga" required readonly>
                    <button type="button" class="btn btn-danger" onclick="removeProduk(this)">X</button>
                </div>
            </div>

            <!-- Tambah Produk Baru -->
            <button type="button" class="btn btn-secondary" id="add-product-btn">Tambah Produk</button>

            <!-- Total Harga -->
            <div class="mb-3 mt-3">
                <label for="TotalHarga" class="form-label">Total Harga</label>
                <input type="text" class="form-control" name="TotalHarga" id="TotalHarga" value="{{ old('TotalHarga') }}" required readonly>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
        </form>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "-- Pilih --",
                allowClear: true
            });

            $('.produk-select').on('change', function () {
                let harga = $(this).find(':selected').data('harga');
                $(this).closest('.produk-row').find('.harga-produk').val(harga);
                updateTotalHarga();
            });

            $('input[name="jumlah_produk[]"]').on('input', updateTotalHarga);
        });

        function removeProduk(button) {
            $(button).closest('.produk-row').remove();
            updateTotalHarga();
        }

        document.getElementById('add-product-btn').addEventListener('click', function () {
            const produkContainer = document.getElementById('produk-container');
            const newRow = document.createElement('div');
            newRow.classList.add('produk-row', 'd-flex', 'gap-2', 'mb-2');

            newRow.innerHTML = `
                <select class="form-control select2 produk-select" name="produk_id[]" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                            {{ $produk->NamaProduk }}
                        </option>
                    @endforeach
                </select>
                <input type="number" class="form-control" name="jumlah_produk[]" placeholder="Jumlah Produk" required min="1">
                <input type="text" class="form-control harga-produk" name="harga_produk[]" placeholder="Harga" required readonly>
                <button type="button" class="btn btn-danger remove-product-btn">X</button>
            `;

            produkContainer.appendChild(newRow);

            $(newRow).find('.select2').select2({
                placeholder: "-- Pilih --",
                allowClear: true
            });

            $(newRow).find('.produk-select').on('change', function () {
                let harga = $(this).find(':selected').data('harga');
                $(this).closest('.produk-row').find('.harga-produk').val(harga);
                updateTotalHarga();
            });

            $(newRow).find('input[name="jumlah_produk[]"]').on('input', updateTotalHarga);

            newRow.querySelector('.remove-product-btn').addEventListener('click', function () {
                produkContainer.removeChild(newRow);
                updateTotalHarga();
            });

            updateTotalHarga();
        });

        function updateTotalHarga() {
            let totalHarga = 0;
            const rows = document.querySelectorAll('.produk-row');

            rows.forEach(row => {
                const select = row.querySelector('.produk-select');
                const jumlah = row.querySelector('input[name="jumlah_produk[]"]').value;
                const harga = select.options[select.selectedIndex]?.dataset.harga || 0;
                const subtotal = harga * jumlah;

                row.querySelector('.harga-produk').value = harga;
                totalHarga += subtotal;
            });

            document.getElementById('TotalHarga').value = totalHarga.toFixed(2);
        }

        updateTotalHarga();
    </script>
</body>
</html>
