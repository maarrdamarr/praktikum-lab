<x-subpage-layout title="Review Laporan Mahasiswa">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 neu-card flex flex-col md:flex-row justify-between items-center gap-8 group hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all">
                <div class="flex items-center gap-6 flex-1">
                    <div class="w-16 h-16 bg-emerald-450 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center font-black text-slate-900 text-xl shadow-[2px_2px_0px_#000]">{{ substr($name, 0, 1) }}</div>
                    <div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white uppercase">{{ $name }}</h4>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-1">Laporan Modul 02 | 2 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex gap-4 w-full md:w-auto">
                    <a href="#" class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-center">Buka PDF</a>
                    
                    <form action="{{ route('asisten.review-laporan.store') }}" method="POST" class="flex-1 md:flex-none">
                        @csrf
                        <button type="submit" class="w-full px-8 py-3 bg-[var(--accent-color)] text-white text-[10px] font-black uppercase tracking-widest rounded-xl neu-btn whitespace-nowrap">Validasi & Selesai</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
