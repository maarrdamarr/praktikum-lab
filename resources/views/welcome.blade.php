<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PCM-Lab - Modern Laboratory Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
    </style>
</head>
<body class="bg-transparent text-slate-900 antialiased" x-data="{ scrollY: 0, mouseX: 0, mouseY: 0 }" @scroll.window="scrollY = window.scrollY">
    <!-- Fixed Background Canvas for 3D Sequence -->
    <div class="fixed inset-0 -z-50 w-full h-full bg-[#faf6f0] dark:bg-slate-950 overflow-hidden">
        <canvas id="bg-3d-canvas" class="w-full h-full object-cover opacity-85"></canvas>
        <!-- Loading Progress Bar -->
        <div id="canvas-loader" class="absolute bottom-6 right-6 px-4 py-2 bg-white dark:bg-slate-900 border-2 border-slate-900 dark:border-white rounded-lg text-[10px] font-black uppercase shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] flex items-center gap-2 z-50">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
            <span>Memuat Visual 3D: <span id="load-pct">0</span>%</span>
        </div>
    </div>

    <nav class="h-24 flex items-center justify-between px-12 border-b-[3px] border-slate-900 bg-white relative z-50">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 overflow-hidden rounded-lg border-2 border-slate-900 shadow-[2px_2px_0px_#000]">
                <img src="{{ asset('assets/logo/eucase-logo.png') }}" alt="PCM-Lab" class="w-full h-full object-cover">
            </div>
            <span class="text-xl font-black tracking-tighter text-slate-900 uppercase">PCM-Lab</span>
        </div>
        <div class="hidden md:flex items-center gap-8 font-black uppercase text-xs tracking-wider">
            <a href="#beranda" class="hover:text-blue-600 transition-colors">Beranda</a>
            <a href="#about" class="hover:text-blue-600 transition-colors">About</a>
            <a href="#berita" class="hover:text-blue-600 transition-colors">Berita</a>
            <a href="#kontak" class="hover:text-blue-600 transition-colors">Kontak</a>
        </div>
        <div class="flex items-center gap-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-black uppercase tracking-wider text-slate-900 hover:text-blue-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-black uppercase tracking-wider text-slate-900 hover:text-blue-600 transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-400 text-slate-900 border-[3px] border-slate-900 rounded-lg text-xs font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">Daftar Sekarang</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Main Centered Layout Container -->
    <div id="main-scroll-container" class="max-w-4xl mx-auto px-6 py-16 space-y-32 min-h-screen">
        
        <!-- Hero Section (Beranda) -->
        <section id="beranda" class="min-h-[80vh] flex flex-col justify-center space-y-8 bg-white/90 backdrop-blur-md border-[3px] border-slate-900 rounded-2xl shadow-[6px_6px_0px_#000] p-8 lg:p-12">
            <div class="inline-flex w-fit items-center gap-3 px-4 py-2 bg-yellow-300 border-[3px] border-slate-900 rounded-xl text-xs font-black uppercase tracking-widest shadow-[3px_3px_0px_#000]">
                🤖 COLLABORATIVE FUTURE
            </div>
            <h1 class="text-5xl lg:text-6xl font-black tracking-tighter leading-none uppercase text-slate-900">
                Manajemen Laboratorium <br> <span class="text-blue-600">Tanpa Batas.</span>
            </h1>
            <p class="text-lg text-slate-700 leading-relaxed font-bold">
                Platform modern dengan asisten AI untuk mengelola praktikum, penjadwalan otomatis, dan penilaian secara real-time.
            </p>
            <div class="flex flex-wrap gap-6 pt-4">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-blue-400 border-[3px] border-slate-900 text-slate-900 rounded-xl font-black uppercase tracking-widest shadow-[5px_5px_0px_#000] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[7px_7px_0px_#000] transition-all">Mulai Sekarang</a>
                <a href="#about" class="px-10 py-5 bg-white border-[3px] border-slate-900 text-slate-900 rounded-xl font-black uppercase tracking-widest shadow-[5px_5px_0px_#000] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[7px_7px_0px_#000] transition-all">Pelajari Lebih Lanjut</a>
            </div>
        </section>

        <!-- About Section (Halaman Selanjutnya) -->
        <section id="about" class="min-h-[85vh] flex flex-col justify-center space-y-12 bg-blue-400/85 backdrop-blur-md border-[3px] border-slate-900 rounded-2xl shadow-[6px_6px_0px_#000] p-8 lg:p-12">
            <div class="space-y-6">
                <span class="px-3 py-1 bg-yellow-300 border-[2px] border-slate-900 rounded-md text-[10px] font-black uppercase tracking-wider text-slate-900 shadow-[2px_2px_0px_#000]">Halaman Selanjutnya</span>
                <h2 class="text-4xl font-black uppercase tracking-wider text-slate-900">Tentang PCM-Lab</h2>
                <p class="text-base text-slate-900 leading-relaxed font-bold">
                    PCM-Lab adalah platform modern untuk pengelolaan dan manajemen laboratorium terintegrasi. Dirancang khusus untuk mempermudah praktikan, asisten, dosen, dan laboran dalam menjalankan kegiatan akademik secara paperless, efisien, dan transparan.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 bg-white/90 backdrop-blur-sm border-[3px] border-slate-900 rounded-xl shadow-[4px_4px_0px_#000]">
                    <h3 class="text-base font-black uppercase tracking-wider mb-3 text-slate-900">Penjadwalan Otomatis</h3>
                    <p class="text-xs text-slate-700 leading-relaxed font-bold">Mengatur sesi praktikum secara efisien tanpa resiko bentrok jadwal antar kelompok atau ruangan.</p>
                </div>
                <div class="p-6 bg-white/90 backdrop-blur-sm border-[3px] border-slate-900 rounded-xl shadow-[4px_4px_0px_#000]">
                    <h3 class="text-base font-black uppercase tracking-wider mb-3 text-slate-900">Input Nilai Real-time</h3>
                    <p class="text-xs text-slate-700 leading-relaxed font-bold">Asisten dapat langsung menginput nilai pre-test dan laporan secara instan ke sistem.</p>
                </div>
                <div class="p-6 bg-white/90 backdrop-blur-sm border-[3px] border-slate-900 rounded-xl shadow-[4px_4px_0px_#000] md:col-span-2">
                    <h3 class="text-base font-black uppercase tracking-wider mb-3 text-slate-900">Presensi Berbasis QR</h3>
                    <p class="text-xs text-slate-700 leading-relaxed font-bold">Validasi presensi cepat menggunakan QR Code dan pencocokan koordinat GPS lokasi lab.</p>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section id="berita" class="min-h-[85vh] flex flex-col justify-center space-y-12 bg-white/90 backdrop-blur-md border-[3px] border-slate-900 rounded-2xl shadow-[6px_6px_0px_#000] p-8 lg:p-12">
            <div class="space-y-4">
                <span class="px-3 py-1 bg-green-300 border-[2px] border-slate-900 rounded-md text-[10px] font-black uppercase tracking-wider text-slate-900 shadow-[2px_2px_0px_#000]">Info Berita</span>
                <h2 class="text-4xl font-black uppercase tracking-wider text-slate-900">Berita Terbaru</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Kiri - Berita 1 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-yellow-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Pengumuman</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Jadwal Praktikum Semester Genap Dirilis</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Seluruh praktikan diwajibkan untuk segera melakukan login dan memilih jadwal praktikum di portal masing-masing sebelum batas waktu pengisian berakhir.</p>
                </div>
                <!-- Kanan - Berita 2 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-purple-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Pembaruan Sistem</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Integrasi Asisten AI Pada Dasbor Utama</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Kini sistem PCM-Lab dilengkapi dengan deteksi clash otomatis berbasis kecerdasan buatan untuk mencegah bentrok jadwal asisten dan ruangan secara realtime.</p>
                </div>
                <!-- Kiri - Berita 3 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-green-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Rekrutmen</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Pendaftaran Asisten Lab Dibuka</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Dibuka pendaftaran asisten praktikum baru untuk semester genap. Segera daftarkan diri Anda sebelum tanggal penutupan pendaftaran.</p>
                </div>
                <!-- Kanan - Berita 4 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-red-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Maintenance</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Pemeliharaan Server Mingguan</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Optimalisasi database dan pemeliharaan server berkala akan dilakukan hari Sabtu pukul 22.00 WIB untuk meningkatkan performa layanan.</p>
                </div>
                <!-- Kiri - Berita 5 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-blue-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Panduan</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Pembayaran Praktikum H2H Mahasiswa</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Panduan lengkap mengenai tata cara pembayaran praktikum mahasiswa melalui metode host-to-host virtual account bank kini dapat diunduh.</p>
                </div>
                <!-- Kanan - Berita 6 -->
                <div class="p-4 bg-[#faf6f0]/90 backdrop-blur-sm border-[2.5px] border-slate-900 rounded-lg shadow-[3px_3px_0px_#000] space-y-2 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                    <span class="px-2 py-0.5 bg-cyan-300 border border-slate-900 rounded text-[8px] font-black uppercase inline-block">Modul Baru</span>
                    <h3 class="text-sm font-black uppercase tracking-wide text-slate-900">Modul Praktikum Internet of Things (IoT)</h3>
                    <p class="text-[10px] text-slate-700 font-bold leading-relaxed">Modul dan petunjuk praktikum IoT berbasis ESP32 dan Blynk versi terbaru kini sudah siap diunduh di dashboard asisten & mahasiswa.</p>
                </div>
            </div>
        </section>

    </div>

    <!-- Footer Section -->
    <footer id="kontak" class="bg-blue-600 text-white border-t-[4px] border-slate-900 py-16 px-12 relative z-40">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Brand Column -->
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 overflow-hidden rounded-lg border-2 border-white shadow-[2px_2px_0px_#fff] bg-white">
                        <img src="{{ asset('assets/logo/eucase-logo.png') }}" alt="PCM-Lab" class="w-full h-full object-cover">
                    </div>
                    <span class="text-xl font-black tracking-tighter text-white uppercase">PCM-Lab</span>
                </div>
                <p class="text-xs text-white/80 font-semibold leading-relaxed">
                    Ecosystem platform pembelajaran dan manajemen praktikum laboratorium berbasis web yang interaktif, modern, dan handal.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-9 h-9 bg-white border-2 border-slate-900 rounded-lg flex items-center justify-center text-slate-900 font-bold shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all">
                        𝕏
                    </a>
                    <a href="#" class="w-9 h-9 bg-white border-2 border-slate-900 rounded-lg flex items-center justify-center text-slate-900 font-bold shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all">
                        📸
                    </a>
                </div>
            </div>

            <!-- Menu Column -->
            <div class="space-y-6">
                <h4 class="text-sm font-black uppercase tracking-wider text-white">Menu</h4>
                <ul class="space-y-3">
                    <li><a href="#beranda" class="text-xs font-bold text-white/80 hover:text-yellow-300 transition-colors">Beranda</a></li>
                    <li><a href="#about" class="text-xs font-bold text-white/80 hover:text-yellow-300 transition-colors">About</a></li>
                    <li><a href="#berita" class="text-xs font-bold text-white/80 hover:text-yellow-300 transition-colors">Berita</a></li>
                    <li><a href="#kontak" class="text-xs font-bold text-white/80 hover:text-yellow-300 transition-colors">Kontak</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="space-y-6">
                <h4 class="text-sm font-black uppercase tracking-wider text-white">Newsletter</h4>
                <p class="text-xs text-white/80 font-semibold leading-relaxed">
                    Dapatkan pembaruan terbaru mengenai modul praktikum baru, informasi penjadwalan, dan pemeliharaan server lab.
                </p>
                <div class="flex gap-2">
                    <input type="email" placeholder="Alamat email Anda..." class="w-full bg-white border-[2.5px] border-slate-900 rounded-lg px-4 py-2.5 text-xs font-black text-slate-900 placeholder-slate-400 focus:outline-none shadow-[2px_2px_0px_#000]">
                    <button class="bg-yellow-400 border-[2.5px] border-slate-900 text-slate-900 rounded-lg px-4 py-2.5 text-xs font-black uppercase tracking-wider shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all">Subscribe</button>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto border-t-2 border-white/20 my-8 pt-8 flex flex-col md:flex-row justify-between items-center gap-6 relative font-black uppercase tracking-widest text-[10px] text-white/70">
            <p>
                &copy; 2026 PCM-Lab Ecosystem. All rights reserved.
            </p>
            <div class="flex flex-wrap gap-6 font-black uppercase tracking-widest text-[10px] text-white/70">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
            </div>
            
            <!-- Back to top button -->
            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="absolute -top-6 right-0 md:relative md:top-0 w-11 h-11 bg-yellow-400 border-[2.5px] border-slate-900 rounded-full flex items-center justify-center text-slate-900 font-black shadow-[2px_2px_0px_#000] hover:translate-y-[-2px] hover:shadow-[3px_3px_0px_#000] transition-all" title="Back to Top">
                ↑
            </button>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('bg-3d-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const loader = document.getElementById('canvas-loader');
            const pctSpan = document.getElementById('load-pct');

            const frameCount = 100;
            const basePath = "{{ asset('assets/images/3d-sequence-new') }}";
            const currentFrame = index => `${basePath}/${String(index).padStart(3, '0')}.jpg`;

            const images = [];
            let loadedCount = 0;

            // Load first frame immediately to render background fast
            const firstImg = new Image();
            firstImg.src = currentFrame(0);
            firstImg.onload = () => {
                images[0] = firstImg;
                loadedCount++;
                drawFrame(0);
            };

            // Preload all other frames
            for (let i = 0; i < frameCount; i++) {
                if (i === 0) continue;
                const img = new Image();
                img.src = currentFrame(i);
                img.onload = () => {
                    loadedCount++;
                    if (pctSpan) {
                        pctSpan.textContent = Math.round((loadedCount / frameCount) * 100);
                    }
                    if (loadedCount === frameCount) {
                        if (loader) {
                            loader.style.transition = 'opacity 0.5s ease';
                            loader.style.opacity = '0';
                            setTimeout(() => {
                                loader.style.display = 'none';
                            }, 500);
                        }
                    }
                };
                img.onerror = () => {
                    loadedCount++;
                    if (loadedCount === frameCount && loader) {
                        loader.style.display = 'none';
                    }
                };
                images.push(img);
                images[i] = img;
            }

            function drawFrame(index) {
                const img = images[index];
                if (!img || !img.complete) return;
                
                // Adjust canvas resolution dynamically to match window sizing
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                const imgRatio = img.width / img.height;
                const canvasRatio = canvas.width / canvas.height;
                
                let drawWidth, drawHeight, drawX, drawY;
                
                if (imgRatio > canvasRatio) {
                    drawHeight = canvas.height;
                    drawWidth = canvas.height * imgRatio;
                    drawX = (canvas.width - drawWidth) / 2;
                    drawY = 0;
                } else {
                    drawWidth = canvas.width;
                    drawHeight = canvas.width / imgRatio;
                    drawX = 0;
                    drawY = (canvas.height - drawHeight) / 2;
                }
                
                ctx.drawImage(img, drawX, drawY, drawWidth, drawHeight);
            }

            function updateFrame() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight;
                const winHeight = window.innerHeight;
                const scrollable = docHeight - winHeight;
                
                let scrollFraction = scrollable > 0 ? scrollTop / scrollable : 0;
                if (scrollFraction < 0) scrollFraction = 0;
                if (scrollFraction > 1) scrollFraction = 1;
                
                const frameIndex = Math.min(
                    frameCount - 1,
                    Math.floor(scrollFraction * frameCount)
                );
                
                drawFrame(frameIndex);
            }

            window.addEventListener('scroll', () => {
                requestAnimationFrame(updateFrame);
            });

            window.addEventListener('resize', () => {
                requestAnimationFrame(updateFrame);
            });
        });
    </script>
</body>
</html>
