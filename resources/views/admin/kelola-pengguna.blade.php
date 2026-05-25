<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Kelola Pengguna</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Manajemen Akun Mahasiswa</span>
            </nav>
        </div>
        <div class="flex gap-3 flex-wrap">
            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                Total: {{ $stats['total'] }} Mahasiswa
            </span>
        </div>
    </div>

    {{-- ─── statistics Cards ─── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="p-6 bg-rose-100 dark:bg-rose-950 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex items-center gap-4">
            <div class="w-12 h-12 bg-rose-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center font-black text-white text-xs shadow-[2px_2px_0px_#000]">TI</div>
            <div>
                <p class="text-[9px] font-black text-rose-700 dark:text-rose-300 uppercase tracking-widest">Teknik Informatika</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ $stats['informatika'] }} <span class="text-xs font-bold text-slate-500">Mahasiswa</span></h3>
            </div>
        </div>
        <div class="p-6 bg-amber-100 dark:bg-amber-950 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center font-black text-white text-xs shadow-[2px_2px_0px_#000]">SI</div>
            <div>
                <p class="text-[9px] font-black text-amber-700 dark:text-amber-300 uppercase tracking-widest">Sistem Informasi</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ $stats['sistem_informasi'] }} <span class="text-xs font-bold text-slate-500">Mahasiswa</span></h3>
            </div>
        </div>
        <div class="p-6 bg-blue-100 dark:bg-blue-950 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex items-center gap-4 sm:col-span-2 lg:col-span-1">
            <div class="w-12 h-12 bg-blue-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center font-black text-white text-xs shadow-[2px_2px_0px_#000]">PTI</div>
            <div>
                <p class="text-[9px] font-black text-blue-700 dark:text-blue-300 uppercase tracking-widest">Pendidikan Teknologi Informasi</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ $stats['pendidikan'] }} <span class="text-xs font-bold text-slate-500">Mahasiswa</span></h3>
            </div>
        </div>
    </div>

    {{-- ─── Main Controller & Alpine State ─── --}}
    <div x-data="{ 
        importModalOpen: false,
        searchQuery: '',
        prodiFilter: '',
        showAddForm: false
    }" class="space-y-8">

        {{-- ─── Action Bar ─── --}}
        <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4">
            <div class="flex gap-3 flex-wrap">
                {{-- Import Excel Button --}}
                <button @click="importModalOpen = true"
                        class="px-6 py-3.5 bg-emerald-400 text-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] transition-all cursor-pointer">
                    📥 Import Excel
                </button>
                {{-- Export Excel Button --}}
                <a href="{{ route('admin.kelola-pengguna.export') }}" 
                   class="px-6 py-3.5 bg-white dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white text-slate-900 dark:text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] transition-all flex items-center">
                    📤 Export Excel
                </a>
            </div>
            <button @click="showAddForm = !showAddForm; if(showAddForm){ setTimeout(() => document.getElementById('add_user_card').scrollIntoView({behavior: 'smooth'}), 100) }" 
                    class="px-6 py-3.5 bg-[var(--accent-color)] text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                ➕ Tambah Mahasiswa Manual
            </button>
        </div>

        {{-- ─── Search & Filter Bar ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white p-6 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" x-model="searchQuery" 
                       placeholder="Cari mahasiswa berdasarkan Nama, NIM, atau Email..."
                       class="w-full neu-input pl-12 pr-6 py-3.5 text-sm font-bold placeholder-slate-400">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
            <div class="md:w-64">
                <select x-model="prodiFilter" class="w-full neu-input px-6 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200">
                    <option value="">Semua Program Studi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                </select>
            </div>
        </div>

        {{-- ─── Student Table Container ─── --}}
        <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[5px_5px_0px_#000] dark:shadow-[5px_5px_0px_#fff] overflow-hidden">
            <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white flex items-center gap-3">
                <div class="w-8 h-8 bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-2 border-slate-900 rounded-lg flex items-center justify-center font-black shadow-[2px_2px_0px_#000]">👥</div>
                <h3 class="text-lg font-black uppercase tracking-wide text-slate-900 dark:text-white">Daftar Akun Mahasiswa</h3>
            </div>
            
            {{-- Wrap in overflow-x-auto to prevent layout clipping --}}
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="border-b-[3px] border-slate-900 dark:border-white text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest bg-slate-50 dark:bg-slate-800">
                            <th class="px-8 py-5">Nama Mahasiswa</th>
                            <th class="px-8 py-5">NIM</th>
                            <th class="px-8 py-5">Email</th>
                            <th class="px-8 py-5">Program Studi</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y-[3px] divide-slate-900 dark:divide-white">
                        @if($users->isEmpty())
                            <tr>
                                <td colspan="6" class="px-8 py-16 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-2xl">📭</div>
                                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada data mahasiswa terdaftar.</p>
                                </td>
                            </tr>
                        @else
                            @foreach($users as $user)
                                <tr x-data="{ editing: false }"
                                    x-show="(searchQuery === '' || '{{ strtolower($user->name) }}'.includes(searchQuery.toLowerCase()) || '{{ $user->nim }}'.includes(searchQuery) || '{{ strtolower($user->email) }}'.includes(searchQuery.toLowerCase())) && (prodiFilter === '' || '{{ $user->prodi }}' === prodiFilter)"
                                    class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    
                                    {{-- Read mode --}}
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-rose-400 border-2 border-slate-900 dark:border-white rounded-lg flex items-center justify-center font-black text-slate-900 text-xs shadow-[2px_2px_0px_#000]">{{ substr($user->name, 0, 1) }}</div>
                                            <div>
                                                <span class="text-sm font-black uppercase tracking-wide text-slate-900 dark:text-white block">{{ $user->name }}</span>
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 font-bold text-slate-900 dark:text-white">{{ $user->nim }}</td>
                                    <td class="px-8 py-5 font-bold text-slate-500 dark:text-slate-400">{{ $user->email }}</td>
                                    <td class="px-8 py-5">
                                        <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-wider rounded-lg border-2 border-slate-900 dark:border-white shadow-[1.5px_1.5px_0px_#000] dark:shadow-[1.5px_1.5px_0px_#fff]
                                            {{ $user->prodi == 'Teknik Informatika' ? 'bg-rose-100 text-rose-700' : ($user->prodi == 'Sistem Informasi' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ $user->prodi }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            {{-- Inline Edit Trigger --}}
                                            <button @click="editing = !editing" 
                                                    class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-amber-400 hover:translate-x-[-1px] hover:translate-y-[-1px] shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] active:translate-x-[1px] active:translate-y-[1px] transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            
                                            {{-- Delete Form --}}
                                            <form action="{{ route('admin.kelola-pengguna.destroy', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun mahasiswa {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-rose-500 hover:translate-x-[-1px] hover:translate-y-[-1px] shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] active:translate-x-[1px] active:translate-y-[1px] transition-all cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- ─── INLINE EDIT CARD ─── --}}
                                        <template x-if="editing">
                                            <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
                                                <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] w-full max-w-2xl text-left overflow-hidden">
                                                    <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white bg-amber-400 flex items-center justify-between">
                                                        <h4 class="text-lg font-black uppercase text-slate-900">Edit Akun Mahasiswa</h4>
                                                        <button @click="editing = false" class="text-slate-900 font-black hover:scale-110 transition-transform">✕</button>
                                                    </div>
                                                    <form action="{{ route('admin.kelola-pengguna.update', $user->id) }}" method="POST" class="p-8 space-y-6">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                                            <div class="space-y-2">
                                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Nama Lengkap</label>
                                                                <input type="text" name="name" value="{{ $user->name }}" required class="w-full neu-input px-4 py-3 text-sm font-bold">
                                                            </div>
                                                            <div class="space-y-2">
                                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">NIM</label>
                                                                <input type="text" name="nim" value="{{ $user->nim }}" required class="w-full neu-input px-4 py-3 text-sm font-bold">
                                                            </div>
                                                            <div class="space-y-2 md:col-span-2">
                                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Email Institusi</label>
                                                                <input type="email" name="email" value="{{ $user->email }}" required class="w-full neu-input px-4 py-3 text-sm font-bold">
                                                            </div>
                                                            <div class="space-y-2 md:col-span-2">
                                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Program Studi</label>
                                                                <select name="prodi" class="w-full neu-input px-4 py-3 text-sm font-bold text-slate-900 dark:text-white">
                                                                    <option value="Teknik Informatika" {{ $user->prodi == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                                                    <option value="Sistem Informasi" {{ $user->prodi == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                                                    <option value="Pendidikan Teknologi Informasi" {{ $user->prodi == 'Pendidikan Teknologi Informasi' ? 'selected' : '' }}>Pendidikan Teknologi Informasi</option>
                                                                </select>
                                                            </div>
                                                            <div class="space-y-2 md:col-span-2">
                                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block">Password Baru (Biarkan kosong jika tidak diubah)</label>
                                                                <input type="password" name="password" class="w-full neu-input px-4 py-3 text-sm font-bold" placeholder="••••••••">
                                                            </div>
                                                        </div>

                                                        <div class="flex gap-3 justify-end pt-4">
                                                            <button type="button" @click="editing = false" class="px-6 py-3 bg-white text-slate-900 border-[3px] border-slate-900 text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">Batal</button>
                                                            <button type="submit" class="px-8 py-3 bg-amber-400 text-slate-900 border-[3px] border-slate-900 text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ─── Add User Form Card ─── --}}
        <div id="add_user_card" x-show="showAddForm" x-transition x-cloak
             class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
            <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-rose-500 text-white border-2 border-slate-900 rounded-lg flex items-center justify-center font-black shadow-[2px_2px_0px_#000]">➕</div>
                    <h3 class="text-lg font-black uppercase tracking-wide text-slate-900 dark:text-white">Tambah Mahasiswa Manual</h3>
                </div>
                <button @click="showAddForm = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white font-black">✕</button>
            </div>
            
            <form action="{{ route('admin.kelola-pengguna.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">Nama Lengkap *</label>
                        <input type="text" name="name" required placeholder="Ahmad Fauzi"
                               class="w-full neu-input px-5 py-3.5 text-sm font-bold">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">NIM (Nomor Induk Mahasiswa) *</label>
                        <input type="text" name="nim" required placeholder="20210001"
                               class="w-full neu-input px-5 py-3.5 text-sm font-bold">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">Email Institusi *</label>
                        <input type="email" name="email" required placeholder="ahmad@univ.ac.id"
                               class="w-full neu-input px-5 py-3.5 text-sm font-bold">
                    </div>
                    <div class="space-y-2 lg:col-span-3">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">Program Studi *</label>
                        <select name="prodi" class="w-full neu-input px-5 py-3.5 text-sm font-bold text-slate-900 dark:text-white">
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                        </select>
                    </div>
                </div>

                <div class="border-t-[2px] border-dashed border-slate-200 dark:border-slate-800 pt-6 flex gap-3 justify-end">
                    <button type="button" @click="showAddForm = false"
                            class="px-6 py-3.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] transition-all">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-8 py-3.5 bg-[var(--accent-color)] text-white border-[3px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] transition-all">
                        Simpan Akun Mahasiswa
                    </button>
                </div>
            </form>
        </div>

        {{-- ─── ALPINE IMPORT EXCEL MODAL ─── --}}
        <div x-show="importModalOpen" x-transition x-cloak
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
            <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] w-full max-w-xl overflow-hidden"
                 @click.away="importModalOpen = false">
                <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white bg-emerald-400 flex items-center justify-between">
                    <h3 class="text-lg font-black uppercase text-slate-900">Import Akun Mahasiswa via Excel</h3>
                    <button @click="importModalOpen = false" class="text-slate-900 font-black hover:scale-110 transition-transform">✕</button>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="p-5 bg-slate-50 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000]">
                        <h4 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white mb-2">Panduan Pengisian Data</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-400 font-bold leading-relaxed mb-4">
                            Unduh template Excel resmi kami, isi data mahasiswa Anda sesuai format yang telah ditentukan, kemudian unggah kembali di sini.
                        </p>
                        
                        <div class="flex gap-2 flex-wrap">
                            {{-- Download Excel Template --}}
                            <a href="{{ route('admin.kelola-pengguna.export-template-excel') }}"
                               class="px-4 py-2 bg-white dark:bg-slate-700 text-slate-900 dark:text-white border-[2.5px] border-slate-900 text-[10px] font-black uppercase tracking-wider rounded-lg shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center gap-1.5">
                                📄 Excel Template
                            </a>
                            {{-- Download PDF Template Guide --}}
                            <a href="{{ route('admin.kelola-pengguna.export-template-pdf') }}" target="_blank"
                               class="px-4 py-2 bg-rose-450 text-slate-900 border-[2.5px] border-slate-900 text-[10px] font-black uppercase tracking-wider rounded-lg shadow-[2px_2px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center gap-1.5">
                                📕 PDF Guide
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.kelola-pengguna.import') }}" method="POST" enctype="multipart/form-data" 
                          x-data="{ fileName: '' }" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block mb-2">Pilih File Excel (.xlsx, .xls, .csv - Maks. 10MB)</label>
                            <label for="import_file_input" 
                                   class="flex flex-col items-center justify-center p-8 border-[3px] border-dashed border-slate-350 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 rounded-xl cursor-pointer hover:border-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/10 transition-all group">
                                <div class="w-12 h-12 bg-emerald-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center mb-3 shadow-[2.5px_2.5px_0px_#000] group-hover:scale-105 transition-transform">
                                    📥
                                </div>
                                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider text-center" x-text="fileName || 'Klik untuk pilih berkas Excel'"></span>
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">atau seret berkas Anda kemari</span>
                                <input type="file" id="import_file_input" name="file" required class="hidden" accept=".xlsx,.xls,.csv"
                                       @change="fileName = $event.target.files[0]?.name || ''">
                            </label>
                        </div>

                        <div class="flex gap-3 justify-end pt-4 border-t-[2px] border-dashed border-slate-200 dark:border-slate-800">
                            <button type="button" @click="importModalOpen = false"
                                    class="px-6 py-3 bg-white text-slate-900 border-[3px] border-slate-900 text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-8 py-3 bg-emerald-400 text-slate-900 border-[3px] border-slate-900 text-xs font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] transition-all">
                                Unggah &amp; Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
