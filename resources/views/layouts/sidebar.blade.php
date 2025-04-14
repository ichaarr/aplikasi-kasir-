<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="{{ url('/') }}" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title" style="font-size: 20px; font-weight: bold; color: #4A4A4A;">GlowSkin</span>
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href="{{ url('dashboard') }}">
                        <span class="icon home" aria-hidden="true"></span>Dashboard
                    </a>
                </li>

                <style>
                    .menu-container {
                        width: 220px;
                        background: #f8f9fa;
                        border-radius: 8px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        padding: 10px;
                        font-family: Arial, sans-serif;
                    }
                
                    .menu-item {
                        background: white;
                        border-radius: 5px;
                        margin-bottom: 5px;
                        overflow: hidden;
                        border: 1px solid #ddd;
                    }
                
                    .menu-btn {
                        width: 100%;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 10px;
                        font-size: 14px;
                        cursor: pointer;
                        background: white;
                        border: none;
                        outline: none;
                        text-align: left;
                        transition: background 0.3s;
                    }
                
                    .menu-btn:hover {
                        background: #e3e6ea;
                    }
                
                    .submenu {
                        display: none;
                        padding-left: 15px;
                        background: #f1f3f5;
                    }
                
                    .submenu a {
                        display: block;
                        padding: 8px;
                        font-size: 13px;
                        text-decoration: none;
                        color: #333;
                    }
                
                    .submenu a:hover {
                        color: #007bff;
                    }
                </style>

                <div class="menu-container">
                    @if(Auth::user()->role == 'admin')
                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>📦 Data Produk</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('kategoris') }}">Kategori</a>
                                <a href="{{ url('produks') }}">Produk</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>🧑 Data Pelanggan</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('pelanggans') }}">Pelanggan</a>
                                <a href="{{ url('penjualans') }}">Penjualan</a>
                            </div>
                        </div>
                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>🖨️ Cetak Laporan</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('laporan') }}">Cetak</a>
                            </div>
                        </div>

                    @elseif(Auth::user()->role == 'kasir')
                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>📦 Data Produk</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('produks2') }}">Produk</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span> 🧑Data Pelanggan</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('pelanggans2') }}">Pelanggan</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>🛒 Data Penjualan</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('penjualans2') }}">Penjualan</a>
                            </div>
                        </div>
                        <div class="menu-item">
                            <button class="menu-btn" onclick="toggleMenu(this)">
                                <span>🖨️ Cetak Laporan</span>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="submenu">
                                <a href="{{ url('laporan') }}">Cetak</a>
                            </div>
                        </div>
                    @endif
                </div>

                <script>
                    function toggleMenu(element) {
                        let submenu = element.nextElementSibling;
                        let icon = element.querySelector(".toggle-icon");
                        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                        icon.textContent = submenu.style.display === "block" ? "-" : "+";
                    }
                </script>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture>
                    <source srcset="{{ asset('img/avatar/avatar-illustrated-01.webp') }}" type="image/webp">
                    <img src="{{ asset('img/avatar/avatar-illustrated-01.png') }}" alt="User name">
                </picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">{{ Auth::user()->name }}</span>
            </div>
        </a>
    </div>
</aside>
