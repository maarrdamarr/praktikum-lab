<x-subpage-layout title="Manajemen Ruangan Lab">
    <div class="space-y-10">
        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex justify-between items-center bg-rose-600 p-8 rounded-[2.5rem] shadow-xl shadow-rose-600/20 text-white">
            @csrf
            <div>
                <h3 class="text-2xl font-black mb-1">Total Ruangan: 8</h3>
                <p class="text-xs font-bold text-rose-100 uppercase tracking-widest">6 Aktif | 2 Perawatan</p>
            </div>
            <button type="submit" class="px-6 py-3 bg-white text-rose-600 rounded-xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-all">Tambah Ruang</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(['Lab Kimia Dasar', 'Lab Fisika Atom', 'Lab Komputer A', 'Lab Mikrobiologi'] as $room)
                <div class="p-8 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-3xl shadow-sm hover:border-rose-500 transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-gray-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-rose-50 transition-all font-bold">R{{ $loop->index + 1 }}</div>
                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black uppercase tracking-widest rounded-lg">Available</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $room }}</h4>
                    <p class="text-xs text-slate-500 mb-6 font-medium">Kapasitas: 40 Mahasiswa</p>
                    <div class="flex gap-4 pt-4 border-t border-gray-50 dark:border-slate-800">
                        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-2 text-[10px] font-black text-rose-600 uppercase tracking-widest hover:bg-rose-50 rounded-lg transition-all">Detail</button>
                        </form>
                        <form action="{{ route('admin.kelola-ruangan.store') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:bg-gray-50 rounded-lg transition-all">Edit</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
