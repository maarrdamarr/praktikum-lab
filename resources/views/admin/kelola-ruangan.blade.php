<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Kelola Ruangan</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Manajemen Ruangan Lab</span>
            </nav>
        </div>
        <div class="flex gap-3">
            <span class="px-4 py-2 bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Total: {{ $ruangans->count() }} Ruangan
            </span>
            <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Aktif: {{ $ruangans->where('status','aktif')->count() }}
            </span>
        </div>
    </div>

    <div class="space-y-10" x-data="{ showForm: false, editId: null }">

        {{-- ─── FORM TAMBAH RUANGAN ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
            <button @click="showForm = !showForm"
                    class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Tambah Ruangan Baru</span>
                </div>
                <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{ 'rotate-180': showForm }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div x-show="showForm" x-cloak x-transition class="border-t-[3px] border-slate-900 dark:border-white p-8">
                <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div class="lg:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Nama Ruangan *</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                   placeholder="Lab Komputer Dasar, Lab Komputer A, …"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Kapasitas (Orang) *</label>
                            <input type="number" name="kapasitas" value="{{ old('kapasitas', 30) }}" required min="1" max="500"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Status *</label>
                            <select name="status" class="w-full neu-input px-4 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                                <option value="aktif" {{ old('status','aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="perawatan" {{ old('status') == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                            </select>
                        </div>
                        <div class="lg:col-span-4 space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Keterangan (Opsional)</label>
                            <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                                   placeholder="Lokasi, fasilitas khusus, dll."
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>
                    </div>
                    <div class="mt-6 flex gap-3 justify-end">
                        <button type="button" @click="showForm = false"
                                class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-rose-600 text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[2px_2px_0px_#000] transition-all">
                            Simpan Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ─── GRID RUANGAN ─── --}}
        @if($ruangans->isEmpty())
            <div class="p-16 text-center bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <div class="w-20 h-20 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada ruangan. Klik tombol "Tambah Ruangan Baru" di atas.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ruangans as $ruangan)
                    <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all group overflow-hidden"
                         x-data="{ editMode: false }">

                        {{-- Card Header --}}
                        <div class="p-6 border-b-[3px] border-slate-900 dark:border-white flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-white font-black text-sm shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                                    R{{ $loop->index + 1 }}
                                </div>
                                <div>
                                    <h4 class="text-base font-black uppercase tracking-wide text-slate-900 dark:text-white leading-tight">{{ $ruangan->nama }}</h4>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kapasitas: {{ $ruangan->kapasitas }} org</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 {{ $ruangan->status == 'aktif' ? 'bg-emerald-400 text-slate-900' : 'bg-amber-400 text-slate-900' }} border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                                {{ $ruangan->status == 'aktif' ? '● Aktif' : '⚠ Perawatan' }}
                            </span>
                        </div>

                        {{-- Stats --}}
                        <div class="px-6 py-4 grid grid-cols-2 gap-3">
                            <div class="p-3 bg-slate-50 dark:bg-slate-800 border-[2px] border-slate-200 dark:border-slate-700 rounded-xl text-center">
                                <span class="text-xl font-black text-rose-500">{{ $ruangan->jadwals_count }}</span>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest">Jadwal</span>
                            </div>
                            <div class="p-3 bg-slate-50 dark:bg-slate-800 border-[2px] border-slate-200 dark:border-slate-700 rounded-xl text-center">
                                <span class="text-xl font-black text-slate-900 dark:text-white">{{ $ruangan->kapasitas }}</span>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest">Kapasitas</span>
                            </div>
                        </div>

                        @if($ruangan->keterangan)
                            <div class="px-6 pb-4">
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold">{{ $ruangan->keterangan }}</p>
                            </div>
                        @endif

                        {{-- Edit Form --}}
                        <div x-show="editMode" x-cloak x-transition class="border-t-[3px] border-amber-400 bg-amber-50 dark:bg-amber-900/20 p-5">
                            <form action="{{ route('admin.kelola-ruangan.update', $ruangan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="space-y-3">
                                    <input type="text" name="nama" value="{{ $ruangan->nama }}" required
                                           class="w-full neu-input px-3 py-2.5 text-sm font-bold" placeholder="Nama Ruangan">
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="number" name="kapasitas" value="{{ $ruangan->kapasitas }}" required min="1"
                                               class="w-full neu-input px-3 py-2.5 text-sm font-bold" placeholder="Kapasitas">
                                        <select name="status" class="w-full neu-input px-3 py-2.5 text-sm font-bold text-slate-900 dark:text-white">
                                            <option value="aktif" {{ $ruangan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="perawatan" {{ $ruangan->status == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                                        </select>
                                    </div>
                                    <input type="text" name="keterangan" value="{{ $ruangan->keterangan }}"
                                           class="w-full neu-input px-3 py-2.5 text-sm font-bold" placeholder="Keterangan (opsional)">
                                </div>
                                <div class="flex gap-2 mt-3">
                                    <button type="submit"
                                            class="flex-1 py-2 bg-emerald-500 text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] transition-all">
                                        Simpan
                                    </button>
                                    <button type="button" @click="editMode = false"
                                            class="flex-1 py-2 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Actions --}}
                        <div class="p-5 border-t-[3px] border-slate-900 dark:border-white grid grid-cols-3 gap-2">
                            <a href="{{ route('admin.kelola-ruangan.detail', $ruangan->id) }}"
                               class="py-2.5 bg-rose-500 text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all text-center block">
                                Detail
                            </a>
                            <button @click="editMode = !editMode"
                                    class="py-2.5 bg-amber-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                Edit
                            </button>
                            <form action="{{ route('admin.kelola-ruangan.destroy', $ruangan->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus ruangan {{ $ruangan->nama }}? Semua jadwal terkait akan terputus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full py-2.5 bg-white dark:bg-slate-800 text-rose-600 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-rose-50 transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
