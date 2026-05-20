<x-subpage-layout title="Validasi Presensi">
    <div class="space-y-4">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-6 neu-card flex justify-between items-center group hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 border-2 border-slate-900 dark:border-white rounded-lg bg-gray-250 dark:bg-slate-700 flex items-center justify-center font-black text-slate-900 dark:text-white shadow-[1px_1px_0px_#000] dark:shadow-[1px_1px_0px_#fff]">
                        {{ substr($name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-slate-900 dark:text-white font-black text-sm uppercase tracking-wide">{{ $name }}</p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest">Menunggu Validasi</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('asisten.validasi-presensi.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 border-2 border-slate-900 dark:border-white rounded-lg bg-rose-400 text-slate-900 text-[10px] font-black uppercase tracking-widest hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[2px_2px_0px_#000] transition-all shadow-[1px_1px_0px_#000] cursor-pointer">Tolak</button>
                    </form>
                    <form action="{{ route('asisten.validasi-presensi.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 border-2 border-slate-900 dark:border-white rounded-lg bg-blue-400 text-slate-900 text-[10px] font-black uppercase tracking-widest hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[2px_2px_0px_#000] transition-all shadow-[1px_1px_0px_#000] cursor-pointer">Terima</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
