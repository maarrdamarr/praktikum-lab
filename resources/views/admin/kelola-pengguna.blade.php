<x-subpage-layout title="Kelola Pengguna (Mahasiswa)">
    <div class="space-y-10">
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex gap-4">
                <form action="{{ route('admin.kelola-pengguna.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" id="import_excel" class="hidden">
                    <label for="import_excel" class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 cursor-pointer transition-all shadow-lg shadow-emerald-600/20">Import Excel</label>
                </form>
                <a href="{{ route('admin.kelola-pengguna.export') }}" class="px-6 py-3 bg-white border border-gray-100 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all">Export Excel</a>
            </div>
            <button onclick="document.getElementById('add_user_form').scrollIntoView({behavior: 'smooth'})" class="px-8 py-3 bg-rose-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-700 transition-all shadow-lg shadow-rose-600/20">Tambah Mahasiswa Manual</button>
        </div>

        <!-- User Table -->
        <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-slate-800/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Mahasiswa</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">NIM</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800/50">
                    @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari', 'Dewi Sartika'] as $name)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/20 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center font-bold text-slate-400 text-xs">{{ substr($name, 0, 1) }}</div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-500">2021000{{ $loop->index + 1 }}</td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-500">{{ strtolower(str_replace(' ', '.', $name)) }}@univ.ac.id</td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 text-slate-400 hover:text-rose-600 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
                                    <button class="p-2 text-slate-400 hover:text-rose-600 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User Form -->
        <div id="add_user_form" class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <h3 class="text-xl font-bold mb-8 text-slate-900 dark:text-white">Tambah Mahasiswa Manual</h3>
            <form action="{{ route('admin.kelola-pengguna.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">NIM</label>
                    <input type="text" name="nim" required class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Institusi</label>
                    <input type="email" name="email" required class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                </div>
                <div class="lg:col-span-3 pt-4">
                    <button type="submit" class="w-full py-5 bg-rose-600 text-white font-black rounded-2xl shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all uppercase tracking-widest text-sm">
                        Simpan Akun Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
