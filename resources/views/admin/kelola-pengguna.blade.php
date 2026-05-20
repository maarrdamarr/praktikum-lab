<x-subpage-layout title="Kelola Pengguna (Mahasiswa)">
    <div class="space-y-10">
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex gap-4 flex-wrap">
                <form action="{{ route('admin.kelola-pengguna.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" id="import_excel" class="hidden">
                    <label for="import_excel" class="px-6 py-3 bg-emerald-400 text-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all cursor-pointer">Import Excel</label>
                </form>
                <a href="{{ route('admin.kelola-pengguna.export') }}" class="px-6 py-3 bg-white dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white text-slate-900 dark:text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">Export Excel</a>
            </div>
            <button onclick="document.getElementById('add_user_form').scrollIntoView({behavior: 'smooth'})" class="px-8 py-3 bg-[var(--accent-color)] text-white text-[10px] font-black uppercase tracking-widest rounded-xl neu-btn">Tambah Mahasiswa Manual</button>
        </div>

        <!-- User Table -->
        <div class="overflow-hidden rounded-xl border-[3px] border-slate-900 dark:border-white bg-white dark:bg-slate-900 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-[3px] border-slate-900 dark:border-white text-[10px] font-black text-slate-550 dark:text-slate-400 uppercase tracking-widest bg-gray-50 dark:bg-slate-800">
                        <th class="px-8 py-6">Nama Mahasiswa</th>
                        <th class="px-8 py-6">NIM</th>
                        <th class="px-8 py-6">Email</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari', 'Dewi Sartika'] as $name)
                        <tr class="border-b-[3px] border-slate-900 dark:border-white last:border-0 hover:bg-gray-50 dark:hover:bg-slate-800 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-rose-455 border-2 border-slate-900 dark:border-white rounded-lg flex items-center justify-center font-black text-slate-900 text-xs shadow-[2px_2px_0px_#000]">{{ substr($name, 0, 1) }}</div>
                                    <span class="text-sm font-black uppercase tracking-wide text-slate-900 dark:text-white">{{ $name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 font-bold text-slate-900 dark:text-white">2021000{{ $loop->index + 1 }}</td>
                            <td class="px-8 py-6 font-bold text-slate-650 dark:text-slate-400">{{ strtolower(str_replace(' ', '.', $name)) }}@univ.ac.id</td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-white dark:bg-slate-800 hover:bg-amber-450 hover:text-slate-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
                                    <button class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-white dark:bg-slate-800 hover:bg-rose-455 hover:text-slate-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User Form -->
        <div id="add_user_form" class="p-10 neu-card">
            <h3 class="text-xl font-black mb-8 uppercase tracking-wide text-slate-900 dark:text-white">Tambah Mahasiswa Manual</h3>
            <form action="{{ route('admin.kelola-pengguna.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full neu-input px-6 py-4 text-sm font-black">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">NIM</label>
                    <input type="text" name="nim" required class="w-full neu-input px-6 py-4 text-sm font-black">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Email Institusi</label>
                    <input type="email" name="email" required class="w-full neu-input px-6 py-4 text-sm font-black">
                </div>
                <div class="lg:col-span-3 pt-4">
                    <button type="submit" class="w-full py-5 bg-[var(--accent-color)] text-white text-sm font-black uppercase tracking-widest rounded-xl neu-btn">
                        Simpan Akun Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
