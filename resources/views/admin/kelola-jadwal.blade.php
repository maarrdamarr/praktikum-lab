<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Kelola Jadwal</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Kelola Jadwal Praktikum</span>
            </nav>
        </div>
        <div class="flex gap-3">
            <span class="px-4 py-2 bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Total: {{ $jadwals->count() }} Jadwal
            </span>
        </div>
    </div>

    <div class="space-y-10" x-data="jadwalManager()">

        {{-- ─── FORM TAMBAH ─── --}}
        <div class="p-8 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Tambah Sesi Jadwal Baru</h3>
            </div>

            <form action="{{ route('admin.kelola-jadwal.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

                    {{-- Hari --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Hari</label>
                        <select name="hari" required class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jam Mulai --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Jam Mulai</label>
                        <select name="jam_mulai" required class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            @for($h = 0; $h < 24; $h++)
                                @php $val = sprintf('%02d:00', $h) @endphp
                                <option value="{{ $val }}" {{ old('jam_mulai') == $val ? 'selected' : '' }}>{{ $val }} WIB</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Jam Selesai --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Jam Selesai</label>
                        <select name="jam_selesai" required class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            @for($h = 1; $h <= 24; $h++)
                                @php $val = sprintf('%02d:00', $h % 24) @endphp
                                <option value="{{ $val }}" {{ old('jam_selesai', '02:00') == $val ? 'selected' : '' }}>{{ $val }} WIB</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Modul --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Modul</label>
                        <input type="text" name="modul" value="{{ old('modul') }}" placeholder="Modul 01, 02, …"
                               class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                    </div>

                    {{-- Mata Kuliah --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" placeholder="Kimia Dasar I, …"
                               class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                    </div>

                    {{-- Kelas --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="A, B, C, …"
                               class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                    </div>

                    {{-- Ruangan --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Ruangan (Opsional)</label>
                        <select name="ruangan_id" class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            <option value="">— Pilih Ruangan —</option>
                            @foreach($ruangans as $r)
                                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama }} ({{ $r->kapasitas }} org)</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dosen --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Dosen (Opsional)</label>
                        <select name="dosen_id" class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            <option value="">— Pilih Dosen —</option>
                            @foreach($dosens as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="px-8 py-4 bg-rose-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[2px_2px_0px_#000] transition-all">
                        + Publish Jadwal
                    </button>
                </div>
            </form>
        </div>

        {{-- ─── DAFTAR JADWAL ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
            <div class="p-8 border-b-[3px] border-slate-900 dark:border-white flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-900 dark:bg-white border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        <svg class="w-5 h-5 text-white dark:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Jadwal Terdaftar</h3>
                </div>
            </div>

            @if($jadwals->isEmpty())
                <div class="p-16 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada jadwal. Tambahkan jadwal pertama!</p>
                </div>
            @else
                {{-- Group by hari --}}
                @foreach($hariUrutan as $hari)
                    @php $jadwalHari = $jadwals->where('hari', $hari); @endphp
                    @if($jadwalHari->isNotEmpty())
                        <div class="border-b-[3px] border-slate-200 dark:border-slate-700 last:border-b-0">
                            <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800 border-b-[2px] border-slate-200 dark:border-slate-700">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">{{ $hari }}</span>
                                <span class="ml-2 px-2 py-0.5 bg-rose-500 text-white text-[9px] font-black rounded-full">{{ $jadwalHari->count() }}</span>
                            </div>
                            <div class="divide-y-[2px] divide-slate-200 dark:divide-slate-700">
                                @foreach($jadwalHari as $j)
                                    <div class="px-8 py-5 flex flex-wrap items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                                         x-data="{ editing: false }">

                                        {{-- Time badge --}}
                                        <div class="flex-shrink-0 px-4 py-2 bg-rose-500 text-white border-[2px] border-slate-900 dark:border-white rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] min-w-[130px] text-center">
                                            <span class="text-[10px] font-black block uppercase tracking-widest opacity-80">{{ $j->hari }}</span>
                                            <span class="text-sm font-black">{{ substr($j->jam_mulai,0,5) }} – {{ substr($j->jam_selesai,0,5) }}</span>
                                        </div>

                                        {{-- Info --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                                @if($j->mata_kuliah)
                                                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ $j->mata_kuliah }}</span>
                                                @endif
                                                @if($j->modul)
                                                    <span class="px-2 py-0.5 bg-amber-400 text-slate-900 border border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg">{{ $j->modul }}</span>
                                                @endif
                                                @if($j->kelas)
                                                    <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 border border-blue-300 text-[9px] font-black uppercase rounded-lg">Kelas {{ $j->kelas }}</span>
                                                @endif
                                            </div>
                                            <div class="flex flex-wrap gap-3 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                                <span>🏛 {{ $j->ruangan ? $j->ruangan->nama : 'Ruangan belum ditetapkan' }}</span>
                                                <span>👤 {{ $j->dosen ? $j->dosen->name : 'Dosen belum ditetapkan' }}</span>
                                                <span>📄 {{ $j->nomor_surat ?? '-' }}</span>
                                            </div>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="flex gap-2 flex-shrink-0">
                                            <button @click="editing = !editing"
                                                    class="px-4 py-2 bg-amber-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.kelola-jadwal.destroy', $j->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-white dark:bg-slate-800 text-rose-600 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-rose-50 transition-all">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Edit Form (inline expand) --}}
                                        <div x-show="editing" x-cloak x-transition
                                             class="w-full mt-4 p-6 bg-amber-50 dark:bg-amber-900/20 border-[2px] border-amber-400 rounded-xl">
                                            <form action="{{ route('admin.kelola-jadwal.update', $j->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Hari</label>
                                                        <select name="hari" class="w-full neu-input px-3 py-2 text-sm font-bold text-slate-900 dark:text-white">
                                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                                                                <option value="{{ $hari }}" {{ $j->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Jam Mulai</label>
                                                        <select name="jam_mulai" class="w-full neu-input px-3 py-2 text-sm font-bold text-slate-900 dark:text-white">
                                                            @for($h = 0; $h < 24; $h++)
                                                                @php $v = sprintf('%02d:00', $h) @endphp
                                                                <option value="{{ $v }}" {{ substr($j->jam_mulai,0,5) == $v ? 'selected' : '' }}>{{ $v }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Jam Selesai</label>
                                                        <select name="jam_selesai" class="w-full neu-input px-3 py-2 text-sm font-bold text-slate-900 dark:text-white">
                                                            @for($h = 1; $h <= 24; $h++)
                                                                @php $v = sprintf('%02d:00', $h % 24) @endphp
                                                                <option value="{{ $v }}" {{ substr($j->jam_selesai,0,5) == $v ? 'selected' : '' }}>{{ $v }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Modul</label>
                                                        <input type="text" name="modul" value="{{ $j->modul }}" class="w-full neu-input px-3 py-2 text-sm font-bold">
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Mata Kuliah</label>
                                                        <input type="text" name="mata_kuliah" value="{{ $j->mata_kuliah }}" class="w-full neu-input px-3 py-2 text-sm font-bold">
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Kelas</label>
                                                        <input type="text" name="kelas" value="{{ $j->kelas }}" class="w-full neu-input px-3 py-2 text-sm font-bold">
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Ruangan</label>
                                                        <select name="ruangan_id" class="w-full neu-input px-3 py-2 text-sm font-bold text-slate-900 dark:text-white">
                                                            <option value="">— Pilih —</option>
                                                            @foreach($ruangans as $r)
                                                                <option value="{{ $r->id }}" {{ $j->ruangan_id == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block mb-1">Dosen</label>
                                                        <select name="dosen_id" class="w-full neu-input px-3 py-2 text-sm font-bold text-slate-900 dark:text-white">
                                                            <option value="">— Pilih —</option>
                                                            @foreach($dosens as $d)
                                                                <option value="{{ $d->id }}" {{ $j->dosen_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="flex gap-3 mt-4">
                                                    <button type="submit"
                                                            class="px-6 py-2.5 bg-emerald-500 text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                                        Simpan
                                                    </button>
                                                    <button type="button" @click="editing = false"
                                                            class="px-6 py-2.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all">
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

    </div>

    <script>
        function jadwalManager() {
            return {};
        }
    </script>
</x-app-layout>
