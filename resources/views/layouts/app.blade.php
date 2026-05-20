<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        theme: localStorage.getItem('theme') || 'light', 
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        mobileMenuOpen: false
      }" 
      x-init="$watch('theme', v => { localStorage.setItem('theme', v); applyTheme(v); }); $watch('sidebarCollapsed', v => localStorage.setItem('sidebarCollapsed', v))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PCM Lab') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Theme Management
        const theme = localStorage.getItem('theme') || 'light';
        
        function applyTheme(target) {
            if (target === 'dark') {
                document.documentElement.classList.add('dark');
            } else if (target === 'light') {
                document.documentElement.classList.remove('dark');
            } else {
                // System default
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }

        applyTheme(theme);

        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        @php
            $user = auth()->user();
            $role = isset($user->role) ? $user->role : 'praktikan';
            $userName = isset($user->name) ? $user->name : '';
            $accent = [
                'praktikan' => 'blue',
                'asisten' => 'emerald',
                'dosen' => 'amber',
                'admin' => 'rose'
            ][$role] ?? 'blue';
            $accentHex = [
                'praktikan' => '#2563eb',
                'asisten' => '#059669',
                'dosen' => '#f59e0b',
                'admin' => '#e11d48'
            ][$role] ?? '#2563eb';
        @endphp
        .sidebar-active { background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color); font-weight: 700; }
        .sidebar-active svg { color: var(--accent-color); }
        .dark .sidebar-active { background-color: rgba(var(--accent-rgb), 0.2); color: var(--accent-light); }
        .dark .sidebar-active svg { color: var(--accent-light); }
        
        :root {
            --accent-color: {{ $accentHex }};
            --accent-rgb: {{ $accent == 'blue' ? '37, 99, 235' : ($accent == 'emerald' ? '5, 150, 105' : ($accent == 'amber' ? '245, 158, 11' : '225, 29, 72')) }};
            --accent-light: {{ $accent == 'blue' ? '#60a5fa' : ($accent == 'emerald' ? '#34d399' : ($accent == 'amber' ? '#fbbf24' : '#fb7185')) }};
        }

        .notification-drop { animation: dropDown 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards; }
        @keyframes dropDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased font-sans transition-colors duration-300">

    <div class="flex h-screen overflow-hidden bg-gray-50 dark:bg-slate-950">
        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" x-cloak class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[70] lg:hidden"></div>

        <!-- Sidebar -->
        <aside 
            :class="{ 
                'w-72': !sidebarCollapsed, 
                'w-24': sidebarCollapsed,
                'translate-x-0': mobileMenuOpen,
                '-translate-x-full': !mobileMenuOpen
            }"
            class="fixed lg:relative inset-y-0 left-0 bg-white dark:bg-slate-900 border-r border-gray-200 dark:border-slate-800 flex flex-col z-[80] transition-all duration-500 ease-in-out lg:translate-x-0 shadow-2xl lg:shadow-none">
            
            <div class="p-8 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between overflow-hidden">
                <a href="/" class="flex items-center gap-4 shrink-0">
                    <div class="w-12 h-12 flex items-center justify-center overflow-hidden rounded-xl shadow-md border border-gray-100 dark:border-slate-700 bg-gray-50">
                        <img src="{{ asset('assets/logo/eucase-logo.png') }}" alt="EUCASE" class="w-full h-full object-cover">
                    </div>
                    <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300 class="text-2xl font-black tracking-tighter" style="color: var(--accent-color)">PCM Lab</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto p-6 space-y-2">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <div class="space-y-1">
                    @if($role == 'praktikan')
                        <x-nav-link route="praktikan.dashboard" icon="m3 12 2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" />
                        <x-nav-link route="absensi" icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" label="Absensi Kehadiran" />
                        <x-nav-link route="praktikan.pendaftaran" icon="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" label="Pendaftaran" />
                        <x-nav-link route="praktikan.pilih-jadwal" icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" label="Pilih Jadwal" />
                        <x-nav-link route="praktikan.pre-test" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" label="Pre-test" />
                        <x-nav-link route="praktikan.upload-laporan" icon="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" label="Upload Laporan" />
                        <x-nav-link route="profile" icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" label="Profil Saya" />
                    @elseif($role == 'asisten')
                        <x-nav-link route="asisten.dashboard" icon="m3 12 2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" />
                        <x-nav-link route="absensi" icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" label="Absensi Kehadiran" />
                        <x-nav-link route="asisten.validasi-presensi" icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" label="Validasi Presensi" />
                        <x-nav-link route="asisten.nilai-pre-test" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" label="Nilai Pre-test" />
                        <x-nav-link route="asisten.review-laporan" icon="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" label="Review Laporan" />
                        <x-nav-link route="asisten.input-nilai" icon="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" label="Input Nilai" />
                        <x-nav-link route="profile" icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" label="Profil Saya" />
                    @elseif($role == 'admin')
                        <x-nav-link route="admin.dashboard" icon="m3 12 2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" />
                        <x-nav-link route="absensi" icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" label="Absensi Kehadiran" />
                        <x-nav-link route="admin.kelola-jadwal" icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" label="Kelola Jadwal" />
                        <x-nav-link route="admin.kelola-pengguna" icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" label="Kelola Pengguna" />
                        <x-nav-link route="admin.alokasi-asisten" icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" label="Alokasi Asisten" />
                        <x-nav-link route="admin.distribusi-modul" icon="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" label="Distribusi Modul" />
                        <x-nav-link route="admin.kelola-ruangan" icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Kelola Ruangan" />
                        <x-nav-link route="profile" icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" label="Profil Saya" />
                    @elseif($role == 'dosen')
                        <x-nav-link route="dosen.dashboard" icon="m3 12 2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" />
                        <x-nav-link route="absensi" icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" label="Absensi Kehadiran" />
                        <x-nav-link route="dosen.buat-soal" icon="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" label="Buat Soal" />
                        <x-nav-link route="dosen.nilai-responsi" icon="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" label="Nilai Responsi" />
                        <x-nav-link route="dosen.cetak-berita" icon="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" label="Cetak Berita" />
                        <x-nav-link route="profile" icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" label="Profil Saya" />
                    @endif
                </div>
            </nav>

            <div class="p-6 border-t border-gray-100 dark:border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full p-3 text-rose-500 font-bold hover:bg-rose-50 dark:hover:bg-rose-900/10 rounded-xl transition-all overflow-hidden">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300>Keluar</span>
                    </button>
                </form>
            </div>

            <!-- Collapse Button (Desktop Only) -->
            <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex absolute top-1/2 -right-4 w-8 h-8 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-full items-center justify-center shadow-lg text-slate-400 hover:text-blue-600 transition-all z-50">
                <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': sidebarCollapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto relative flex flex-col">
            <!-- Elegant Top Notification -->
            @if(session('success') || session('error'))
                <div class="fixed top-8 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-6 notification-drop">
                    <div class="bg-white dark:bg-slate-900 border {{ session('success') ? 'border-emerald-500/30' : 'border-rose-500/30' }} shadow-2xl rounded-2xl p-4 flex items-center gap-4 backdrop-blur-xl">
                        <div class="w-10 h-10 {{ session('success') ? 'bg-emerald-500' : 'bg-rose-500' }} rounded-xl flex items-center justify-center text-white">
                            @if(session('success'))
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-black uppercase tracking-widest {{ session('success') ? 'text-emerald-600' : 'text-rose-600' }} mb-1">{{ session('success') ? 'Berhasil' : 'Peringatan' }}</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ session('success') ?? session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->check() && !auth()->user()->identity_path)
                <div class="bg-amber-500 text-white px-12 py-3 flex justify-between items-center sticky top-0 z-[55] shadow-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-xs font-black uppercase tracking-widest">Peringatan: Profil Belum Lengkap! Harap unggah kartu identitas (KTM/KTP) untuk membuka akses fitur.</p>
                    </div>
                    <a href="{{ route('profile') }}" class="px-4 py-1.5 bg-white text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all">Lengkapi Sekarang</a>
                </div>
            @endif

            <header class="bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 h-20 flex items-center justify-between px-6 lg:px-12 sticky top-0 z-50 shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-2 text-slate-600 dark:text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest truncate max-w-[150px] md:max-w-none">Panel {{ ucfirst($role) }} | PCM Lab</h2>
                </div>
                <div class="flex items-center gap-6">
                    <!-- Theme Selector -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-2.5 rounded-xl bg-gray-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-gray-200 dark:hover:bg-slate-700 transition-all flex items-center gap-2">
                            <template x-if="theme === 'light'">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </template>
                            <template x-if="theme === 'dark'">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            </template>
                            <template x-if="theme === 'system'">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </template>
                            <span class="text-[10px] font-black uppercase tracking-widest hidden md:block" x-text="theme"></span>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-cloak 
                             class="absolute right-0 mt-3 w-48 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl shadow-2xl p-2 z-[60] overflow-hidden">
                            <button @click="theme = 'light'; open = false" class="w-full text-left p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 flex items-center gap-3 transition-all">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <span class="text-xs font-bold">Terang</span>
                            </button>
                            <button @click="theme = 'dark'; open = false" class="w-full text-left p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 flex items-center gap-3 transition-all">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                <span class="text-xs font-bold">Gelap</span>
                            </button>
                            <button @click="theme = 'system'; open = false" class="w-full text-left p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 flex items-center gap-3 transition-all border-t border-gray-50 dark:border-slate-800 mt-1 pt-3">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-bold">Default PC</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 border-l border-gray-200 dark:border-slate-800 pl-6">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-sm" style="background-color: var(--accent-color)">{{ $userName ? substr($userName, 0, 1) : '' }}</div>
                        <span class="font-bold hidden md:block">{{ $userName }}</span>
                    </div>
                </div>
            </header>

            <div class="p-12">
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>

            <x-notifications />
        </main>
    </div>
</body>
</html>