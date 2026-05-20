<x-subpage-layout title="Input Nilai Aktivitas Praktikum">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 neu-card flex flex-col md:flex-row items-center gap-8 group hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all">
                <div class="flex items-center gap-6 flex-1">
                    <div class="w-14 h-14 bg-emerald-450 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center font-black text-slate-900 text-lg shadow-[2px_2px_0px_#000]">{{ substr($name, 0, 1) }}</div>
                    <div>
                        <h4 class="text-md font-black text-slate-900 dark:text-white uppercase">{{ $name }}</h4>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-1">Meja 0{{ $loop->index + 1 }} | Sesi A</p>
                    </div>
                </div>

                <form action="{{ route('asisten.input-nilai.store') }}" method="POST" class="flex items-center gap-4 w-full md:w-auto">
                    @csrf
                    <input type="number" name="grade" placeholder="0-100" class="w-24 neu-input px-4 py-3 text-center text-sm font-black">
                    <button type="submit" class="px-8 py-3 bg-[var(--accent-color)] border-[3px] border-slate-900 dark:border-white text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all cursor-pointer">Update</button>
                </form>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
