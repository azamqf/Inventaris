<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI TIK - Homepage</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans min-h-screen">

    <!-- Navbar -->
    <header class="bg-[#1F2A44]/95 backdrop-blur-md shadow-md fixed w-full top-0 z-50 border-b border-[#2C3E50]/40">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full border-2 border-white shadow-lg">
                <h1 class="text-2xl font-bold text-white">SI TIK</h1>
            </div>
            <nav class="space-x-6 hidden md:flex">
                <a href="#features" class="hover:text-[#D32F2F] transition">Fitur</a>
                <a href="#about" class="hover:text-[#D32F2F] transition">Tentang</a>
                <a href="#contact" class="hover:text-[#D32F2F] transition">Kontak</a>
                <a href="{{ route('filament.admin.auth.login') }}"
                   class="bg-[#D32F2F] text-white px-4 py-2 rounded-lg shadow-lg hover:bg-[#B71C1C] font-bold transition">
                   Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="text-center pt-40 pb-32 bg-gradient-to-r from-[#1F2A44] to-[#2C3E50] flex flex-col justify-center items-center">
        <h2 class="text-5xl md:text-6xl font-extrabold mb-6 text-white drop-shadow">
            Selamat Datang di <span class="text-[#D32F2F]">SI TIK</span>
        </h2>
        <p class="text-lg md:text-xl mb-10 max-w-2xl mx-auto text-gray-200">
            Sistem Informasi modern untuk manajemen anggota & inventaris dengan dashboard elegan berbasis Laravel Filament.
        </p>
        <a href="{{ route('filament.admin.auth.login') }}"
           class="bg-[#D32F2F] text-white px-8 py-3 rounded-xl font-semibold hover:scale-110 transition shadow-lg">
           🚀 Mulai Sekarang
        </a>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 px-6 max-w-6xl mx-auto">
        <h3 class="text-3xl font-bold text-center mb-16 text-[#1F2A44]">Fitur Utama</h3>
        <div class="grid md:grid-cols-3 gap-10">

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:scale-105 transition border border-[#1F2A44]">
                <div class="text-[#1F2A44] text-5xl mb-4">📊</div>
                <h4 class="text-xl font-semibold mb-3">Dashboard Modern</h4>
                <p class="text-gray-600">Pantau data anggota dengan statistik interaktif & real-time.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:scale-105 transition border border-[#1F2A44]">
                <div class="text-[#1F2A44] text-5xl mb-4">🔒</div>
                <h4 class="text-xl font-semibold mb-3">Keamanan Role</h4>
                <p class="text-gray-600">Akses terkontrol dengan sistem role-based authorization.</p>
            </div>

            <div class="bg-[#1F2A44] p-6 rounded-2xl shadow-lg hover:scale-105 transition border border-[#2C3E50]">
                <div class="text-white text-5xl mb-4">📑</div>
                <h4 class="text-xl font-semibold mb-3 text-white">Export Data</h4>
                <p class="text-white">Ekspor data ke PDF untuk laporan instan dan profesional.</p>
            </div>

        </div>
    </section>

    <!-- About -->
    <section id="about" class="bg-gray-100 py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-3xl font-bold mb-6 text-[#1F2A44]">Tentang Aplikasi</h3>
            <p class="text-gray-700 leading-relaxed">
                Aplikasi <b class="text-[#D32F2F]">SI TIK</b> dibuat untuk memudahkan manajemen data dengan antarmuka elegan, aman, dan modern.
                Dibangun menggunakan <span class="text-[#1F2A44]">Laravel</span> & <span class="text-[#1F2A44]">Filament</span> dengan teknologi terbaru untuk pengalaman terbaik.
            </p>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 px-6 max-w-5xl mx-auto">
        <h3 class="text-3xl font-bold text-center mb-12 text-[#1F2A44]">Hubungi Kami</h3>
        <div class="grid md:grid-cols-2 gap-10">
            <div>
                <h4 class="text-xl font-semibold mb-4">Alamat</h4>
                <p class="text-gray-600">Jl. Raya Mojosari 2 Kepanjen, Indonesia</p>
                <h4 class="text-xl font-semibold mt-6 mb-4">Email</h4>
                <p class="text-gray-600">radenrahmat@uniramalang.ac.id</p>
                <h4 class="text-xl font-semibold mt-6 mb-4">Telepon</h4>
                <p class="text-gray-600">(0341) 399099</p>
            </div>
            <div>
                <form class="bg-white p-6 rounded-2xl shadow-lg border border-[#1F2A44]">
                    <input type="text" placeholder="Nama" class="w-full mb-4 px-4 py-2 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1F2A44]">
                    <input type="email" placeholder="Email" class="w-full mb-4 px-4 py-2 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1F2A44]">
                    <textarea rows="4" placeholder="Pesan" class="w-full mb-4 px-4 py-2 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1F2A44]"></textarea>
                    <button type="submit" class="bg-[#D32F2F] text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-[#B71C1C] transition">Kirim</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1F2A44] text-center py-6 border-t border-[#2C3E50]/50">
        <p class="text-white text-sm">© {{ date('Y') }} <span class="font-bold">PKL Polres Malang Unira Malang</span>. All rights reserved.</p>
    </footer>

</body>
</html>
