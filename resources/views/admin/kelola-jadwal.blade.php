<x-subpage-layout title="Kelola Jadwal Praktikum">
    <div class="space-y-10">
        <div class="p-10 neu-card">
            <h3 class="text-xl font-black mb-8 uppercase tracking-wide text-slate-900 dark:text-white">Tambah Sesi Baru</h3>
            <form action="{{ route('admin.kelola-jadwal.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Hari</label>
                    <select class="w-full neu-input px-6 py-4 text-sm font-black text-slate-900 dark:text-white">
                        <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Waktu</label>
                    <input type="text" placeholder="08:00 - 12:00" class="w-full neu-input px-6 py-4 text-sm font-black">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Modul</label>
                    <select class="w-full neu-input px-6 py-4 text-sm font-black text-slate-900 dark:text-white">
                        <option>Modul 01</option><option>Modul 02</option><option>Modul 03</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-4 bg-[var(--accent-color)] text-white text-[10px] font-black uppercase tracking-widest rounded-xl neu-btn">Publish Jadwal</button>
                </div>
            </form>
        </div>

        <div class="p-10 neu-card">
            <h3 class="text-xl font-black mb-8 uppercase tracking-wide text-slate-900 dark:text-white px-2">Jadwal Terdaftar</h3>
            <div class="space-y-4">
                @foreach(['Senin, 08:00 - Modul 01', 'Selasa, 13:00 - Modul 02'] as $item)
                    <div class="p-6 bg-gray-50 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl flex justify-between items-center group shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                        <span class="text-sm font-black uppercase tracking-wide text-slate-900 dark:text-white">{{ $item }}</span>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-white dark:bg-slate-900 border-2 border-slate-900 dark:border-white text-slate-900 dark:text-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-rose-450 hover:text-slate-900 transition-all cursor-pointer">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-subpage-layout>
