<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Detail Ruangan</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <a href="{{ route('admin.kelola-ruangan') }}" class="hover:underline">Kelola Ruangan</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">{{ $ruangan->nama }}</span>
            </nav>
        </div>
        <a href="{{ route('admin.kelola-ruangan') }}"
           class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all flex items-center gap-2">
            ← Kembali
        </a>
    </div>

    <div class="space-y-8" x-data="{ activeHari: '{{ $hariList[0] }}', showTambah: false, selectedHari: '', selectedJam: '' }">

        {{-- ─── INFO RUANGAN ─── --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 p-8 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <div class="flex items-center gap-5 mb-6">
                    <div class="w-16 h-16 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black uppercase tracking-tight text-slate-900 dark:text-white">{{ $ruangan->nama }}</h2>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400">{{ $ruangan->keterangan ?? 'Tidak ada keterangan' }}</p>
                    </div>
                    <span class="ml-auto px-4 py-2 {{ $ruangan->status == 'aktif' ? 'bg-emerald-400' : 'bg-amber-400' }} text-slate-900 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        {{ strtoupper($ruangan->status) }}
                    </span>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="p-4 bg-rose-50 dark:bg-rose-900/20 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] text-center">
                        <span class="text-3xl font-black text-rose-600">{{ $ruangan->kapasitas }}</span>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">Kapasitas</p>
                    </div>
                    <div class="p-4 bg-slate-50 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] text-center">
                        <span class="text-3xl font-black text-slate-900 dark:text-white">{{ $jadwals->count() }}</span>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">Total Jadwal</p>
                    </div>
                    <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] text-center">
                        <span class="text-3xl font-black text-emerald-600">{{ 168 - $jadwals->count() }}</span>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">Slot Kosong</p>
                    </div>
                </div>
            </div>

            {{-- ─── LEGENDA ─── --}}
            <div class="p-8 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Legenda Grid</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-8 bg-emerald-400 border-[2px] border-slate-900 dark:border-white rounded-lg flex items-center justify-center">
                            <span class="text-[9px] font-black text-slate-900">✓</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Slot Kosong — klik untuk tambah jadwal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-8 bg-rose-500 border-[2px] border-slate-900 dark:border-white rounded-lg flex items-center justify-center">
                            <span class="text-[9px] font-black text-white">✗</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Slot Terisi — sudah ada jadwal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-8 bg-amber-400 border-[2px] border-slate-900 dark:border-white rounded-lg flex items-center justify-center">
                            <span class="text-[9px] font-black text-slate-900">↔</span>
                        </div>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Slot Aktif (bagian dari jadwal)</span>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t-[3px] border-slate-900 dark:border-white">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Grid menampilkan 24 jam penuh (00:00 – 23:00)</p>
                </div>
            </div>
        </div>

        {{-- ─── FORM TAMBAH JADWAL (modal bawah) ─── --}}
        <div x-show="showTambah" x-cloak x-transition
             class="bg-amber-50 dark:bg-amber-900/20 border-[3px] border-amber-500 rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-black uppercase tracking-widest text-slate-900 dark:text-white">
                    Tambah Jadwal ke Ruangan Ini
                </h3>
                <button @click="showTambah = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.kelola-ruangan.atur-jadwal', $ruangan->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Hari</label>
                        <select name="hari" x-model="selectedHari" required class="w-full neu-input px-4 py-3 text-sm font-bold text-slate-900 dark:text-white">
                            @foreach($hariList as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Jam Mulai</label>
                        <select name="jam_mulai" x-model="selectedJam" required class="w-full neu-input px-4 py-3 text-sm font-bold text-slate-900 dark:text-white">
                            @for($h = 0; $h < 24; $h++)
                                <option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Jam Selesai</label>
                        <select name="jam_selesai" required class="w-full neu-input px-4 py-3 text-sm font-bold text-slate-900 dark:text-white">
                            @for($h = 1; $h <= 24; $h++)
                                <option value="{{ sprintf('%02d:00', $h % 24) }}">{{ sprintf('%02d:00', $h % 24) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Modul</label>
                        <input type="text" name="modul" placeholder="Modul 01 …" class="w-full neu-input px-4 py-3 text-sm font-bold">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" placeholder="Kimia Dasar I …" class="w-full neu-input px-4 py-3 text-sm font-bold">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Kelas</label>
                        <input type="text" name="kelas" placeholder="A, B …" class="w-full neu-input px-4 py-3 text-sm font-bold">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block">Dosen</label>
                        <select name="dosen_id" class="w-full neu-input px-4 py-3 text-sm font-bold text-slate-900 dark:text-white">
                            <option value="">— Pilih Dosen —</option>
                            @foreach($dosens as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit"
                            class="px-8 py-3 bg-rose-600 text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] transition-all">
                        + Tambah Jadwal
                    </button>
                    <button type="button" @click="showTambah = false"
                            class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] transition-all">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        {{-- ─── TAB HARI ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">

            {{-- Tab buttons --}}
            <div class="flex overflow-x-auto border-b-[3px] border-slate-900 dark:border-white">
                @foreach($hariList as $hari)
                    @php $hariCount = collect($grid[$hari])->filter()->count(); @endphp
                    <button @click="activeHari = '{{ $hari }}'"
                            :class="activeHari === '{{ $hari }}'
                                ? 'bg-rose-500 text-white border-r-[3px] border-slate-900 dark:border-white'
                                : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 border-r-[3px] border-slate-200 dark:border-slate-700'"
                            class="flex-1 min-w-[90px] px-4 py-4 text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap relative">
                        {{ $hari }}
                        @if($hariCount > 0)
                            <span class="absolute top-2 right-2 w-4 h-4 bg-amber-400 text-slate-900 text-[8px] font-black rounded-full flex items-center justify-center border border-slate-900">{{ $hariCount }}</span>
                        @endif
                    </button>
                @endforeach
            </div>

            {{-- Grid untuk setiap hari --}}
            @foreach($hariList as $hari)
                <div x-show="activeHari === '{{ $hari }}'" x-cloak class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h4 class="text-lg font-black uppercase tracking-wide text-slate-900 dark:text-white">{{ $hari }}</h4>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                {{ collect($grid[$hari])->filter()->count() }} slot terisi •
                                {{ 24 - collect($grid[$hari])->filter()->count() }} slot kosong
                            </p>
                        </div>
                        <button @click="showTambah = true; selectedHari = '{{ $hari }}'"
                                class="px-5 py-2.5 bg-rose-500 text-white border-[3px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                            + Tambah Jadwal {{ $hari }}
                        </button>
                    </div>

                    {{-- 24-jam grid --}}
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2">
                        @foreach($grid[$hari] as $jam => $jadwal)
                            @if($jadwal)
                                {{-- Slot Terisi --}}
                                <div class="relative group" x-data="{ tooltip: false }">
                                    <div @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                         class="p-2 bg-rose-500 border-[2px] border-slate-900 dark:border-white rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-center cursor-default">
                                        <span class="text-[10px] font-black text-white block">{{ $jam }}</span>
                                        <span class="text-[8px] font-black text-rose-100 block leading-tight mt-0.5 truncate">
                                            {{ $jadwal->modul ?? 'Terisi' }}
                                        </span>
                                    </div>
                                    {{-- Tooltip --}}
                                    <div x-show="tooltip" x-cloak x-transition
                                         class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 z-50 w-48 bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-[2px] border-white dark:border-slate-900 rounded-xl p-3 shadow-[4px_4px_0px_rgba(0,0,0,0.2)]">
                                        <p class="text-[10px] font-black uppercase tracking-widest mb-1">{{ $jadwal->hari }} {{ substr($jadwal->jam_mulai,0,5) }}–{{ substr($jadwal->jam_selesai,0,5) }}</p>
                                        <p class="text-xs font-bold">{{ $jadwal->mata_kuliah ?? '-' }}</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500">{{ $jadwal->modul ?? '' }} | Kelas {{ $jadwal->kelas ?? '-' }}</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500">👤 {{ $jadwal->dosen ? $jadwal->dosen->name : 'Dosen belum ditetapkan' }}</p>
                                    </div>
                                </div>
                            @else
                                {{-- Slot Kosong --}}
                                <button @click="showTambah = true; selectedHari = '{{ $hari }}'; selectedJam = '{{ $jam }}'"
                                        class="p-2 bg-emerald-400 border-[2px] border-slate-900 dark:border-white rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-center hover:bg-emerald-500 hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all group">
                                    <span class="text-[10px] font-black text-slate-900 block">{{ $jam }}</span>
                                    <span class="text-[8px] font-black text-emerald-800 block opacity-0 group-hover:opacity-100 transition-opacity">+ Atur</span>
                                </button>
                            @endif
                        @endforeach
                    </div>

                    {{-- List jadwal hari ini --}}
                    @php $jadwalHari = $jadwals->where('hari', $hari); @endphp
                    @if($jadwalHari->isNotEmpty())
                        <div class="mt-6 pt-6 border-t-[3px] border-slate-200 dark:border-slate-700">
                            <h5 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Detail Jadwal Hari {{ $hari }}</h5>
                            <div class="space-y-3">
                                @foreach($jadwalHari->sortBy('jam_mulai') as $j)
                                    <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800 border-[2px] border-slate-200 dark:border-slate-700 rounded-xl">
                                        <div class="px-3 py-2 bg-rose-500 border-[2px] border-slate-900 dark:border-white rounded-lg text-center shrink-0">
                                            <span class="text-xs font-black text-white">{{ substr($j->jam_mulai,0,5) }}</span>
                                            <span class="text-[9px] font-black text-rose-200 block">→ {{ substr($j->jam_selesai,0,5) }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-black text-slate-900 dark:text-white">{{ $j->mata_kuliah ?? 'Tanpa Mata Kuliah' }} {{ $j->modul ? '· '.$j->modul : '' }}</p>
                                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                                Kelas {{ $j->kelas ?? '-' }} •
                                                {{ $j->dosen ? $j->dosen->name : 'Dosen belum ditetapkan' }} •
                                                {{ $j->nomor_surat ?? '-' }}
                                            </p>
                                        </div>
                                        <form action="{{ route('admin.kelola-jadwal.destroy', $j->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-2 bg-white dark:bg-slate-700 text-rose-600 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-rose-50 transition-all">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-6 p-6 text-center border-t-[3px] border-slate-200 dark:border-slate-700">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum ada jadwal di hari {{ $hari }}. Klik slot hijau untuk menambahkan.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
