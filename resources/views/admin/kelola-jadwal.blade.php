<x-subpage-layout title="Kelola Jadwal Praktikum">
    <div class="space-y-10">
        <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <h3 class="text-xl font-bold mb-8 text-slate-900 dark:text-white">Tambah Sesi Baru</h3>
            <form action="{{ route('admin.kelola-jadwal.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Hari</label>
                    <select class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                        <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Waktu</label>
                    <input type="text" placeholder="08:00 - 12:00" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Modul</label>
                    <select class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-rose-500">
                        <option>Modul 01</option><option>Modul 02</option><option>Modul 03</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-4 bg-rose-600 text-white font-black rounded-2xl shadow-lg shadow-rose-600/20 hover:bg-rose-700 transition-all uppercase tracking-widest text-[10px]">Publish Jadwal</button>
                </div>
            </form>
        </div>

        <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <h3 class="text-xl font-bold mb-8 text-slate-900 dark:text-white px-4">Jadwal Terdaftar</h3>
            <div class="space-y-4">
                @foreach(['Senin, 08:00 - Modul 01', 'Selasa, 13:00 - Modul 02'] as $item)
                    <div class="p-6 bg-gray-50 dark:bg-slate-800 rounded-3xl flex justify-between items-center group hover:bg-white dark:hover:bg-slate-700 border border-transparent hover:border-rose-100 transition-all">
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $item }}</span>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-white dark:bg-slate-900 text-slate-400 text-[10px] font-bold uppercase tracking-widest rounded-xl hover:text-rose-600">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-subpage-layout>
