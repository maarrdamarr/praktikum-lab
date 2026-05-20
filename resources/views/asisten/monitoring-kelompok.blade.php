<x-subpage-layout title="Monitoring Kelompok" icon="👥" color="emerald">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach(['Kelompok A' => 85, 'Kelompok B' => 40, 'Kelompok C' => 95] as $group => $progress)
            <div class="p-8 neu-card space-y-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-slate-900 dark:text-white font-black uppercase">{{ $group }}</h4>
                    <span class="px-3 py-1 border-2 border-slate-900 dark:border-white rounded-lg bg-emerald-450 text-slate-900 text-[10px] font-black uppercase tracking-widest shadow-[2px_2px_0px_#000]">{{ $progress }}% Active</span>
                </div>
                <div class="w-full h-4 bg-gray-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-lg overflow-hidden">
                    <div class="h-full bg-emerald-450 transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                    <span>3 Mahasiswa</span>
                    <button class="text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white px-3 py-1.5 rounded-lg bg-white dark:bg-slate-800 hover:bg-[var(--accent-color)] dark:hover:bg-[var(--accent-color)] hover:text-white shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all">Detail ↗</button>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
