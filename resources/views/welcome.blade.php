<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PCM-Lab - Modern Laboratory Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased">
    <nav class="h-24 flex items-center justify-between px-12 border-b border-gray-100">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 overflow-hidden rounded-lg shadow-sm">
                <img src="{{ asset('assets/logo/eucase-logo.png') }}" alt="PCM-Lab" class="w-full h-full object-cover">
            </div>
            <span class="text-xl font-black tracking-tighter text-blue-600">PCM-Lab</span>
        </div>
        <div class="flex items-center gap-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-blue-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold hover:text-blue-600 transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all">Daftar Sekarang</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-24 text-center">
        <h1 class="text-6xl font-black tracking-tighter mb-8 leading-tight">
            Manajemen Laboratorium <br> <span class="text-blue-600">Tanpa Batas.</span>
        </h1>
        <p class="text-xl text-slate-500 max-w-2xl mx-auto mb-12 leading-relaxed">
            Platform modern untuk mengelola praktikum, penjadwalan, dan penilaian secara efisien dan terorganisir dalam satu ekosistem digital.
        </p>
        <div class="flex justify-center gap-6">
            <a href="{{ route('register') }}" class="px-10 py-5 bg-blue-600 text-white rounded-2xl font-bold shadow-xl shadow-blue-600/20 hover:scale-105 transition-all">Mulai Sekarang</a>
            <a href="#fitur" class="px-10 py-5 bg-gray-50 text-slate-600 rounded-2xl font-bold border border-gray-200 hover:bg-gray-100 transition-all">Pelajari Fitur</a>
        </div>
    </main>

    <section id="fitur" class="bg-gray-50 py-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach(['Penjadwalan Otomatis', 'Input Nilai Real-time', 'Presensi Berbasis QR'] as $feature)
                    <div class="p-8 bg-white rounded-3xl border border-gray-100 shadow-sm">
                        <h3 class="text-lg font-bold mb-4">{{ $feature }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">Sistem cerdas yang membantu pengelolaan data laboratorium Anda dengan tingkat akurasi tinggi dan aksesibilitas maksimal.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="py-12 border-t border-gray-100 text-center text-slate-400 text-sm">
        &copy; 2026 PCM-Lab Ecosystem. All rights reserved.
    </footer>
</body>
</html>
