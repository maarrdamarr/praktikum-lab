<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Jadwal Lab</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Pilih & Atur Jadwal Laboratorium</span>
            </nav>
        </div>
        <div class="flex gap-3">
            <span class="px-4 py-2 bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Jadwal Saya: {{ $jadwalSaya->count() }}
            </span>
            <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Tersedia: {{ $jadwalKosong->count() }}
            </span>
        </div>
    </div>

    <div class="space-y-10">

        {{-- ─── JADWAL SAYA ─── --}}
        <section>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-amber-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                    <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-widest text-slate-900 dark:text-white">Jadwal Lab Saya</h2>
            </div>

            @if($jadwalSaya->isEmpty())
                <div class="p-12 text-center bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <div class="w-16 h-16 mx-auto mb-4 bg-amber-100 dark:bg-amber-900/30 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Anda belum mengambil jadwal lab. Pilih dari daftar tersedia di bawah.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($jadwalSaya as $j)
                        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all overflow-hidden">

                            {{-- Top accent --}}
                            <div class="h-2 bg-amber-400"></div>

                            <div class="p-6">
                                {{-- Hari & Jam --}}
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="px-4 py-2.5 bg-amber-400 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] text-center">
                                        <span class="text-[10px] font-black text-slate-900 block uppercase">{{ $j->hari }}</span>
                                        <span class="text-sm font-black text-slate-900">{{ substr($j->jam_mulai,0,5) }}</span>
                                        <span class="text-[10px] font-black text-slate-700 block">→ {{ substr($j->jam_selesai,0,5) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-black text-slate-900 dark:text-white leading-tight">{{ $j->mata_kuliah ?? 'Jadwal Lab' }}</h4>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $j->modul ?? '' }} | Kelas {{ $j->kelas ?? '-' }}</p>
                                    </div>
                                </div>

                                {{-- Ruangan --}}
                                <div class="flex items-center gap-2 mb-3 p-3 bg-slate-50 dark:bg-slate-800 border-[2px] border-slate-200 dark:border-slate-700 rounded-xl">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    <span class="text-xs font-black text-slate-700 dark:text-slate-300">{{ $j->ruangan ? $j->ruangan->nama : 'Ruangan belum ditetapkan' }}</span>
                                    @if($j->ruangan)
                                        <span class="ml-auto text-[9px] font-black text-slate-400">{{ $j->ruangan->kapasitas }} orang</span>
                                    @endif
                                </div>

                                {{-- Nomor Surat --}}
                                <div class="mb-4 p-2 bg-emerald-50 dark:bg-emerald-900/20 border-[2px] border-emerald-400 rounded-lg">
                                    <span class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">✓ Nomor Surat:</span>
                                    <span class="text-[10px] font-black text-slate-700 dark:text-slate-300 ml-1">{{ $j->nomor_surat ?? '-' }}</span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="border-t-[3px] border-slate-900 dark:border-white grid grid-cols-2 divide-x-[3px] divide-slate-900 dark:divide-white">
                                {{-- Unduh Surat PDF --}}
                                <a href="{{ route('dosen.jadwal-lab.surat-pdf', $j->id) }}" target="_blank"
                                   class="flex items-center justify-center gap-2 p-4 bg-amber-400 hover:bg-amber-500 transition-all text-slate-900 font-black text-[10px] uppercase tracking-widest group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2 2 4-4"/></svg>
                                    Surat PDF
                                </a>

                                {{-- Lepas Jadwal --}}
                                <form action="{{ route('dosen.jadwal-lab.lepas', $j->id) }}" method="POST"
                                      onsubmit="return confirm('Lepas jadwal ini? Surat yang diterbitkan tidak lagi berlaku.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full h-full flex items-center justify-center gap-2 p-4 bg-white dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all text-rose-600 font-black text-[10px] uppercase tracking-widest">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Lepas
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- ─── JADWAL TERSEDIA ─── --}}
        <section>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-emerald-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                    <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-widest text-slate-900 dark:text-white">Jadwal Tersedia untuk Diambil</h2>
            </div>

            @if($jadwalKosong->isEmpty())
                <div class="p-12 text-center bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <div class="w-16 h-16 mx-auto mb-4 bg-emerald-100 dark:bg-emerald-900/30 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Semua jadwal sudah diambil atau belum ada jadwal yang dibuat admin.</p>
                </div>
            @else
                <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
                    {{-- Table header --}}
                    <div class="grid grid-cols-6 gap-4 px-8 py-4 bg-slate-50 dark:bg-slate-800 border-b-[3px] border-slate-900 dark:border-white">
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Hari</span>
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Waktu</span>
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Ruangan</span>
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Modul</span>
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Kelas</span>
                        <span class="col-span-1 text-[9px] font-black text-slate-500 uppercase tracking-widest">Aksi</span>
                    </div>

                    <div class="divide-y-[2px] divide-slate-200 dark:divide-slate-700">
                        @foreach($jadwalKosong as $j)
                            <div class="grid grid-cols-6 gap-4 px-8 py-5 items-center hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors group">
                                <div class="col-span-1">
                                    <span class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 border-[2px] border-slate-900 dark:border-white text-slate-900 dark:text-white text-[10px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                                        {{ $j->hari }}
                                    </span>
                                </div>
                                <div class="col-span-1">
                                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ substr($j->jam_mulai,0,5) }}</span>
                                    <span class="text-slate-400 mx-1">–</span>
                                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ substr($j->jam_selesai,0,5) }}</span>
                                </div>
                                <div class="col-span-1">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $j->ruangan ? $j->ruangan->nama : '-' }}</span>
                                    @if($j->ruangan)
                                        <span class="block text-[9px] font-black text-slate-400 uppercase">{{ $j->ruangan->kapasitas }} orang</span>
                                    @endif
                                </div>
                                <div class="col-span-1">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $j->modul ?? '—' }}</span>
                                    @if($j->mata_kuliah)
                                        <span class="block text-[9px] font-black text-slate-400 uppercase truncate">{{ $j->mata_kuliah }}</span>
                                    @endif
                                </div>
                                <div class="col-span-1">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $j->kelas ?? '—' }}</span>
                                </div>
                                <div class="col-span-1">
                                    <form action="{{ route('dosen.jadwal-lab.ambil', $j->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-5 py-2.5 bg-emerald-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all">
                                            Ambil
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        {{-- ─── INFO SURAT PDF ─── --}}
        <div class="p-8 bg-amber-50 dark:bg-amber-900/20 border-[3px] border-amber-500 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-amber-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shrink-0 shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                    <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-black uppercase tracking-widest text-slate-900 dark:text-white mb-2">Cara Mengunduh Surat Penggunaan Lab</h3>
                    <ul class="space-y-1.5">
                        <li class="flex gap-2 text-sm font-bold text-slate-700 dark:text-slate-300">
                            <span class="text-amber-600 font-black">1.</span>
                            Pilih jadwal yang tersedia dan klik tombol <strong>Ambil</strong>.
                        </li>
                        <li class="flex gap-2 text-sm font-bold text-slate-700 dark:text-slate-300">
                            <span class="text-amber-600 font-black">2.</span>
                            Jadwal yang diambil akan muncul di bagian <strong>Jadwal Lab Saya</strong>.
                        </li>
                        <li class="flex gap-2 text-sm font-bold text-slate-700 dark:text-slate-300">
                            <span class="text-amber-600 font-black">3.</span>
                            Klik tombol <strong>Surat PDF</strong> untuk membuka surat izin penggunaan laboratorium.
                        </li>
                        <li class="flex gap-2 text-sm font-bold text-slate-700 dark:text-slate-300">
                            <span class="text-amber-600 font-black">4.</span>
                            Di halaman surat, gunakan <strong>Ctrl+P</strong> atau tombol cetak browser untuk menyimpan sebagai PDF.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
