<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Skincare Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f0f0, #e3f2fd);
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #f0f0f0 !important;
        }

        header {
            background: linear-gradient(135deg, #0096c7, #48cae4);
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .product-card {
            border: none;
            transition: 0.3s;
            background: linear-gradient(135deg, #ffffff, #cfe9f3);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        footer {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
            border-radius: 50px 50px 0 0;
        }

        .btn-login {
            background: linear-gradient(135deg, #ff6b6b, #ff8e72);
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff4757, #ff6b6b);
        }

        /* Styling Form Kontak */
        .contact-section {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-send {
            background: linear-gradient(135deg, #28a745, #60d394);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-send:hover {
            background: linear-gradient(135deg, #69a7e4, #85c2f1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Skincare Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- <li class="nav-white"><a class="nav-link" href="#">Home</a></li> --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li> --}}
                    <li class="nav-white"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <a href="{{ route('dashboard')}}" class="btn btn-dashboard ms-3 text-white">
                    <i class="bi bi-box-arrow-in-right"></i> Home
                </a>
                <a href="{{ route('produks.index')}}" class="btn btn-produks ms-3 text-white">
                    <i class="bi bi-box-arrow-in-right"></i> Produk
                </a>
                
                <a href="{{ route('login') }}" class="btn btn-login ms-3">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <header>
        <h1>Temukan Skincare Terbaik untuk Kulitmu</h1>
    </header>

    <section id="produk" class="container my-5">
        <h2 class="text-center mb-4">Produk Pilihan</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card product-card text-center">
                    <h5 class="card-title">Serum Wajah</h5>
                    <p class="card-text">Menutrisi dan mencerahkan kulit wajah.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card text-center">
                    <h5 class="card-title">Moisturizer</h5>
                    <p class="card-text">Melembapkan dan menjaga elastisitas kulit.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card text-center">
                    <h5 class="card-title">Sunscreen</h5>
                    <p class="card-text">Melindungi kulit dari sinar UV.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Kontak -->
    <section id="kontak" class="container my-5">
        <div class="contact-section">
            <h2>Hubungi Kami</h2>
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan</label>
                    <textarea id="pesan" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-send">Kirim Pesan</button>

<style>
    .btn-send {
        background: linear-gradient(135deg, #0077b6, #00b4d8); /* Warna biru */
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 8px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-send:hover {
        background: linear-gradient(135deg, #005f99, #0096c7); /* Biru lebih gelap saat hover */
    }
</style>

            </form>
        </div>
    </section>
    
    <style>
        .contact-section {
            background: #cfe9f3; /* Warna biru muda */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    
        .contact-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    
        .btn-send {
            background: linear-gradient(135deg, #0252ff, #2c70ed);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
    
        .btn-send:hover {
            background: linear-gradient(135deg, #1e7e34, #28a745);
        }
    </style>
    

    <footer>
        <p>&copy; 2025 Skincare Store. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
