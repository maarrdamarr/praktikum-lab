<x-subpage-layout title="Review Laporan Mahasiswa">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[2.5rem] shadow-sm flex flex-col md:flex-row justify-between items-center gap-8 group hover:border-emerald-500 transition-all">
                <div class="flex items-center gap-6 flex-1">
                    <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center font-bold text-emerald-600 text-xl">{{ substr($name, 0, 1) }}</div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">{{ $name }}</h4>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Laporan Modul 02 | 2 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex gap-4 w-full md:w-auto">
                    <a href="#" class="px-6 py-3 bg-gray-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-100 transition-all">Buka PDF</a>
                    
                    <form action="{{ route('asisten.review-laporan.store') }}" method="POST" class="flex-1 md:flex-none">
                        @csrf
                        <button type="submit" class="w-full px-8 py-3 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition-all">Validasi & Selesai</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
