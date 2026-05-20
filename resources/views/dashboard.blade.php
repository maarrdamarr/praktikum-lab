<x-app-layout>
    @php
        $user = auth()->user();
        $role = isset($user->role) ? $user->role : 'praktikan';
        $name = isset($user->name) ? explode(' ', $user->name)[0] : '';
    @endphp

    <div class="mb-12 flex justify-between items-end flex-wrap gap-6">
        <div>
            <h2 class="text-4xl font-black tracking-tighter mb-2 uppercase">Halo, {{ $name }}!</h2>
            <p class="text-slate-600 dark:text-slate-400 font-bold">Sistem PCM Lab siap mendukung produktivitas Anda hari ini.</p>
        </div>
        <div class="hidden md:flex gap-4 p-3 bg-white dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <div class="px-6 py-3 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Status Server</p>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 bg-emerald-500 border-2 border-slate-900 rounded-full animate-pulse"></span>
                    <span class="text-xs font-black uppercase">Optimal</span>
                </div>
            </div>
            <div class="px-6 py-3 flex flex-col justify-center">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Waktu Sistem</p>
                <span class="text-xs font-black uppercase">{{ date('H:i') }} WIB</span>
            </div>
        </div>
    </div>

    <!-- Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        @if($role == 'praktikan')
            <x-metric-card color="blue" title="Modul Berjalan" value="Modul 04" sub="Spektroskopi UV-Vis" />
            <x-metric-card color="indigo" title="Progres Praktikum" value="65%" sub="5 dari 8 Modul" />
            <x-metric-card color="emerald" title="Indeks Prestasi" value="3.82" sub="Predikat: Sangat Baik" />
            <x-metric-card color="rose" title="Sisa Sesi" value="3 Sesi" sub="Hingga UAS" />
        @elseif($role == 'asisten')
            <x-metric-card color="emerald" title="Review Menunggu" value="18" sub="Laporan Praktikan" />
            <x-metric-card color="blue" title="Total Bimbingan" value="42" sub="Mahasiswa Aktif" />
            <x-metric-card color="amber" title="Jam Terbang" value="128h" sub="Semester Ini" />
            <x-metric-card color="rose" title="Deadline Nilai" value="2 Hari" sub="Sesi Spektroskopi" />
        @elseif($role == 'admin')
            <x-metric-card color="blue" title="Okupansi Lab" value="82%" sub="Kapasitas Ruangan" />
            <x-metric-card color="emerald" title="Asisten Aktif" value="12/15" sub="On-Duty" />
            <x-metric-card color="amber" title="Maintenance" value="2 Ruang" sub="Lab Komputer B & C" />
            <x-metric-card color="purple" title="Modul Terbit" value="24" sub="Dokumen Digital" />
        @elseif($role == 'dosen')
            <x-metric-card color="indigo" title="Rata-rata Kelas" value="84.2" sub="Naik 5% dari modul lalu" />
            <x-metric-card color="blue" title="Sesi Berjalan" value="3 Sesi" sub="Monitoring Live" />
            <x-metric-card color="emerald" title="Berita Acara" value="Ready" sub="Siap Validasi" />
            <x-metric-card color="rose" title="Bank Soal" value="156" sub="Total Pertanyaan" />
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Activity Area -->
        <div class="lg:col-span-2 space-y-12">
            @if($role == 'praktikan')
                <div class="p-10 neu-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8">
                        <span class="px-4 py-2 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]" style="background-color: var(--accent-color); color: #ffffff">Next Session</span>
                    </div>
                    <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Jadwal Terdekat</h3>
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="w-32 h-32 rounded-xl flex flex-col items-center justify-center text-white border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]" style="background-color: var(--accent-color)">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-80">Kamis</span>
                            <span class="text-4xl font-black">14</span>
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-80">Mei</span>
                        </div>
                        <div class="flex-1 space-y-2">
                            <h4 class="text-2xl font-black text-slate-900 dark:text-white">Laboratorium Kimia Dasar</h4>
                            <p class="text-slate-600 dark:text-slate-400 font-bold italic">"Analisis Kuantitatif Senyawa Organik"</p>
                            <div class="flex gap-4 pt-4">
                                <span class="px-4 py-2 bg-gray-50 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">08:00 - 12:00</span>
                                <span class="px-4 py-2 bg-gray-50 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">Meja 04</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-10 neu-card">
                <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Aktivitas & Log</h3>
                <div class="space-y-6">
                    @php
                        $logs = [
                            'praktikan' => [
                                ['Laporan Modul 03 telah divalidasi', '2 jam yang lalu', 'success'],
                                ['Pre-test Modul 04 dibuka besok', '5 jam yang lalu', 'info'],
                                ['Pembayaran praktikum terverifikasi', 'Kemarin', 'success']
                            ],
                            'asisten' => [
                                ['Ahmad Fauzi mengunggah laporan baru', '15 menit yang lalu', 'info'],
                                ['Sesi Spektroskopi selesai', '1 jam yang lalu', 'success'],
                                ['Review Laporan Kelompok A tertunda', '3 jam yang lalu', 'warning']
                            ],
                            'admin' => [
                                ['Maintenance Lab Komputer B selesai', '1 jam yang lalu', 'success'],
                                ['Jadwal baru dirilis untuk Juni', '4 jam yang lalu', 'info'],
                                ['Peringatan suhu Lab Kimia tinggi', '6 jam yang lalu', 'warning']
                            ],
                            'dosen' => [
                                ['Rata-rata nilai kelas A meningkat', '2 jam yang lalu', 'success'],
                                ['Permintaan validasi Berita Acara', '4 jam yang lalu', 'info'],
                                ['Soal Pre-test belum lengkap (Modul 08)', '8 jam yang lalu', 'warning']
                            ]
                        ][$role] ?? [];
                    @endphp

                    @foreach($logs as $log)
                        <div class="flex items-center gap-6 p-6 rounded-xl border-[3px] border-slate-900 dark:border-white bg-gray-50 dark:bg-slate-800/50 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all">
                            <div class="w-4 h-4 rounded-full border-2 border-slate-900 dark:border-white {{ $log[2] == 'success' ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : ($log[2] == 'warning' ? 'bg-amber-500 shadow-[0_0_10px_rgba(245,158,11,0.5)]' : 'bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]') }}"></div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-slate-900 dark:text-white">{{ $log[0] }}</p>
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-1">{{ $log[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar Activity -->
        <div class="space-y-12">
            <div class="p-8 neu-card relative overflow-hidden">
                <div class="absolute -bottom-12 -right-12 w-48 h-48 blur-3xl rounded-full" style="background-color: rgba(var(--accent-rgb), 0.1)"></div>
                <h3 class="text-lg font-black uppercase tracking-widest mb-6 text-slate-900 dark:text-white">Progres Capaian</h3>
                <div class="space-y-6 relative z-10">
                    @php
                        $progressItems = [
                            'Teori' => ['value' => 90, 'class' => 'w-[90%]'],
                            'Praktek' => ['value' => 65, 'class' => 'w-[65%]'],
                            'Laporan' => ['value' => 80, 'class' => 'w-[80%]'],
                        ];
                    @endphp

                    @foreach($progressItems as $label => $item)
                        <div class="space-y-2">
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                <span>{{ $label }}</span>
                                <span>{{ $item['value'] }}%</span>
                            </div>
                            <div class="w-full h-4 bg-gray-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-lg overflow-hidden">
                                <div class="h-full transition-all duration-1000 {{ $item['class'] }}" style="background-color: var(--accent-color);"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="w-full mt-10 py-4 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[var(--accent-color)] dark:hover:bg-[var(--accent-color)] hover:text-white transition-all neu-btn">Detail Kompetensi</button>
            </div>

            <div class="p-8 neu-card">
                <h3 class="text-lg font-black uppercase tracking-widest mb-6 text-slate-900 dark:text-white">Butuh Bantuan?</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 font-bold leading-relaxed mb-6">Hubungi administrator laboratorium jika Anda mengalami kendala teknis atau memiliki pertanyaan terkait jadwal.</p>
                <div class="space-y-4">
                    <a href="#" class="block p-4 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-center text-[10px] font-black uppercase tracking-widest neu-btn">Pusat Bantuan</a>
                    <a href="#" class="block p-4 text-center text-[10px] font-black uppercase tracking-widest neu-btn text-white" style="background-color: var(--accent-color)">Kirim Tiket</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
