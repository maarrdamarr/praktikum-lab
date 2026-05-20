<x-subpage-layout title="Manajemen Ruangan Lab">
    <div class="space-y-10">
        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex justify-between items-center flex-wrap gap-4 bg-rose-100 dark:bg-rose-950 p-8 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] text-slate-900 dark:text-white">
            @csrf
            <div>
                <h3 class="text-2xl font-black mb-1 uppercase text-slate-900 dark:text-white">Total Ruangan: 8</h3>
                <p class="text-xs font-black text-slate-650 dark:text-slate-400 uppercase tracking-widest">6 Aktif | 2 Perawatan</p>
            </div>
            <button type="submit" class="px-6 py-3 bg-[var(--accent-color)] text-white border-[3px] border-slate-900 dark:border-white rounded-xl text-xs font-black uppercase tracking-widest shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all cursor-pointer">Tambah Ruang</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(['Lab Kimia Dasar', 'Lab Fisika Atom', 'Lab Komputer A', 'Lab Mikrobiologi'] as $room)
                <div class="p-8 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-rose-455 border-2 border-slate-900 dark:border-white rounded-lg flex items-center justify-center text-slate-900 font-black shadow-[2px_2px_0px_#000]">R{{ $loop->index + 1 }}</div>
                        <span class="px-3 py-1 bg-emerald-400 text-slate-900 border-2 border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000]">Available</span>
                    </div>
                    <h4 class="text-lg font-black uppercase tracking-wide text-slate-900 dark:text-white mb-2">{{ $room }}</h4>
                    <p class="text-xs text-slate-650 dark:text-slate-450 mb-6 font-black uppercase tracking-wider">Kapasitas: 40 Mahasiswa</p>
                    <div class="flex gap-4 pt-4 border-t-[3px] border-slate-900 dark:border-white">
                        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-2 bg-[var(--accent-color)] border-2 border-slate-900 dark:border-white text-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] hover:bg-rose-500 transition-all cursor-pointer">Detail</button>
                        </form>
                        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-2 bg-white dark:bg-slate-800 border-2 border-slate-900 dark:border-white text-slate-900 dark:text-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-gray-100 transition-all cursor-pointer">Edit</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
