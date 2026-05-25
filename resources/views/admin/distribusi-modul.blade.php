<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Distribusi Modul</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Distribusi Modul Digital</span>
            </nav>
        </div>
        <div class="flex gap-3 flex-wrap">
            <span class="px-4 py-2 bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Total: {{ $moduls->count() }} Modul
            </span>
            <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Aktif: {{ $moduls->where('status','aktif')->count() }}
            </span>
        </div>
    </div>

    <div class="space-y-8" x-data="{ showForm: false }">

        {{-- ─── FORM UNGGAH MODUL BARU ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
            <button @click="showForm = !showForm"
                    class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Unggah Modul Baru</span>
                </div>
                <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{ 'rotate-180': showForm }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div x-show="showForm" x-cloak x-transition class="border-t-[3px] border-slate-900 dark:border-white p-8">
                <form action="{{ route('admin.distribusi-modul.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                        {{-- Judul --}}
                        <div class="lg:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Judul Modul *</label>
                            <input type="text" name="judul" required value="{{ old('judul') }}"
                                   placeholder="Pengenalan Keselamatan Laboratorium"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>

                        {{-- Nomor --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Nomor Modul *</label>
                            <input type="text" name="nomor_modul" required value="{{ old('nomor_modul') }}"
                                   placeholder="Modul 01"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>

                        {{-- Mata Kuliah --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}"
                                   placeholder="Kimia Dasar I"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>

                        {{-- Versi --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Versi</label>
                            <input type="text" name="versi" value="{{ old('versi', '1.0') }}"
                                   placeholder="1.0"
                                   class="w-full neu-input px-4 py-3.5 text-sm font-bold">
                        </div>

                        {{-- Akses Role --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Akses Role</label>
                            <div class="p-4 neu-input rounded-xl space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="akses_asisten" value="1" checked class="w-4 h-4 accent-rose-500">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Asisten</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="akses_praktikan" value="1" checked class="w-4 h-4 accent-rose-500">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Praktikan</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="akses_dosen" value="1" checked class="w-4 h-4 accent-rose-500">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Dosen</span>
                                </label>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="lg:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                      placeholder="Deskripsi singkat isi modul …"
                                      class="w-full neu-input px-4 py-3.5 text-sm font-bold resize-none">{{ old('deskripsi') }}</textarea>
                        </div>

                    </div>

                    {{-- Upload Area --}}
                    <div class="mb-6" x-data="{ fileName: '' }">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block mb-2">File Modul (PDF, Word, PPT, ZIP — maks. 20MB)</label>
                        <label for="file_modul_input"
                               class="flex flex-col items-center justify-center p-10 border-[3px] border-dashed border-slate-400 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 rounded-xl cursor-pointer hover:border-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/10 transition-all group">
                            <div class="w-14 h-14 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center mb-4 shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            </div>
                            <span class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider" x-text="fileName || 'Klik untuk pilih file'"></span>
                            <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-2">atau seret & lepas di sini</span>
                            <input type="file" id="file_modul_input" name="file_modul" class="hidden"
                                   accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                        </label>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button type="button" @click="showForm = false"
                                class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-rose-600 text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] transition-all">
                            Distribusikan Modul
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ─── DAFTAR MODUL ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
            <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white flex items-center gap-4">
                <div class="w-10 h-10 bg-slate-900 dark:bg-white border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                    <svg class="w-5 h-5 text-white dark:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Daftar Modul Terdistribusi</h3>
            </div>

            @if($moduls->isEmpty())
                <div class="p-16 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada modul. Klik "Unggah Modul Baru" untuk memulai.</p>
                </div>
            @else
                <div class="divide-y-[2px] divide-slate-200 dark:divide-slate-700">
                    @foreach($moduls as $modul)
                        <div class="px-8 py-6 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                             x-data="{ editing: false }">

                            <div class="flex flex-wrap items-center gap-5">

                                {{-- Icon --}}
                                <div class="w-14 h-14 rounded-xl border-[3px] border-slate-900 dark:border-white flex items-center justify-center font-black text-[10px] text-white shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] shrink-0
                                    {{ $modul->status === 'aktif' ? 'bg-rose-500' : 'bg-slate-400' }}">
                                    @php
                                        $ext = strtolower(pathinfo($modul->file_original_name ?? '', PATHINFO_EXTENSION));
                                        $label = match($ext) { 'pdf' => 'PDF', 'doc','docx' => 'DOC', 'ppt','pptx' => 'PPT', 'zip' => 'ZIP', default => 'FILE' };
                                    @endphp
                                    {{ $label }}
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                        <span class="px-2 py-0.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">{{ $modul->nomor_modul }}</span>
                                        <h4 class="text-base font-black text-slate-900 dark:text-white">{{ $modul->judul }}</h4>
                                        <span class="px-2 py-0.5 {{ $modul->status === 'aktif' ? 'bg-emerald-400 text-slate-900' : 'bg-amber-400 text-slate-900' }} border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg">
                                            {{ $modul->status === 'aktif' ? '● Aktif' : '⏸ Arsip' }}
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                        @if($modul->mata_kuliah) <span>📚 {{ $modul->mata_kuliah }}</span> @endif
                                        <span>v{{ $modul->versi }}</span>
                                        @if($modul->file_size) <span>📁 {{ $modul->file_size_format }}</span> @endif
                                        <span>🔑
                                            {{ collect(['A' => $modul->akses_asisten, 'P' => $modul->akses_praktikan, 'D' => $modul->akses_dosen])->filter()->keys()->implode(', ') ?: 'Tidak ada akses' }}
                                        </span>
                                        @if($modul->uploader) <span>👤 {{ $modul->uploader->name }}</span> @endif
                                    </div>
                                    @if($modul->deskripsi)
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-bold">{{ $modul->deskripsi }}</p>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="flex flex-wrap gap-2 shrink-0">
                                    @if($modul->file_path)
                                        <a href="{{ route('admin.distribusi-modul.download', $modul->id) }}"
                                           class="px-4 py-2 bg-blue-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                            Unduh
                                        </a>
                                    @endif
                                    <button @click="editing = !editing"
                                            class="px-4 py-2 bg-amber-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.distribusi-modul.toggle', $modul->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-4 py-2 {{ $modul->status === 'aktif' ? 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300' : 'bg-emerald-400 text-slate-900' }} border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                            {{ $modul->status === 'aktif' ? 'Arsipkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.distribusi-modul.destroy', $modul->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus modul {{ $modul->judul }}? File akan ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-white dark:bg-slate-800 text-rose-600 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-rose-50 transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Edit Form --}}
                            <div x-show="editing" x-cloak x-transition
                                 class="mt-5 p-6 bg-amber-50 dark:bg-amber-900/20 border-[2px] border-amber-400 rounded-xl">
                                <form action="{{ route('admin.distribusi-modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                        <div class="col-span-2 space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Judul</label>
                                            <input type="text" name="judul" value="{{ $modul->judul }}" required class="w-full neu-input px-3 py-2.5 text-sm font-bold">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Nomor Modul</label>
                                            <input type="text" name="nomor_modul" value="{{ $modul->nomor_modul }}" required class="w-full neu-input px-3 py-2.5 text-sm font-bold">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Mata Kuliah</label>
                                            <input type="text" name="mata_kuliah" value="{{ $modul->mata_kuliah }}" class="w-full neu-input px-3 py-2.5 text-sm font-bold">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Versi</label>
                                            <input type="text" name="versi" value="{{ $modul->versi }}" class="w-full neu-input px-3 py-2.5 text-sm font-bold">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Status</label>
                                            <select name="status" class="w-full neu-input px-3 py-2.5 text-sm font-bold text-slate-900 dark:text-white">
                                                <option value="aktif" {{ $modul->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="arsip" {{ $modul->status === 'arsip' ? 'selected' : '' }}>Arsip</option>
                                            </select>
                                        </div>
                                        <div class="col-span-2 space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Deskripsi</label>
                                            <textarea name="deskripsi" rows="2" class="w-full neu-input px-3 py-2.5 text-sm font-bold resize-none">{{ $modul->deskripsi }}</textarea>
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Akses Role</label>
                                            <div class="space-y-1.5">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" name="akses_asisten" value="1" {{ $modul->akses_asisten ? 'checked' : '' }} class="accent-rose-500">
                                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Asisten</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" name="akses_praktikan" value="1" {{ $modul->akses_praktikan ? 'checked' : '' }} class="accent-rose-500">
                                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Praktikan</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" name="akses_dosen" value="1" {{ $modul->akses_dosen ? 'checked' : '' }} class="accent-rose-500">
                                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Dosen</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-span-2 space-y-1">
                                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest block">Ganti File (opsional)</label>
                                            <input type="file" name="file_modul" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
                                                   class="w-full text-sm text-slate-700 dark:text-slate-300 font-bold file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-[2px] file:border-slate-900 dark:file:border-white file:text-[9px] file:font-black file:uppercase file:bg-rose-500 file:text-white file:cursor-pointer hover:file:bg-rose-600 transition-all">
                                            @if($modul->file_original_name)
                                                <p class="text-[9px] text-slate-400 font-bold mt-1">File saat ini: {{ $modul->file_original_name }} ({{ $modul->file_size_format }})</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <button type="submit"
                                                class="px-6 py-2.5 bg-emerald-500 text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase rounded-lg shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                            Simpan Perubahan
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
            @endif
        </div>

    </div>
</x-app-layout>
