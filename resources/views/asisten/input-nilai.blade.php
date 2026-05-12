<x-subpage-layout title="Input Nilai Aktivitas Praktikum">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[2.5rem] shadow-sm flex flex-col md:flex-row items-center gap-8 group hover:border-emerald-500 transition-all">
                <div class="flex items-center gap-6 flex-1">
                    <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center font-bold text-emerald-600 text-lg">{{ substr($name, 0, 1) }}</div>
                    <div>
                        <h4 class="text-md font-bold text-slate-900 dark:text-white">{{ $name }}</h4>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Meja 0{{ $loop->index + 1 }} | Sesi A</p>
                    </div>
                </div>

                <form action="{{ route('asisten.input-nilai.store') }}" method="POST" class="flex items-center gap-4 w-full md:w-auto">
                    @csrf
                    <input type="number" name="grade" placeholder="0-100" class="w-24 bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-xl px-4 py-3 text-center text-sm font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    <button type="submit" class="px-8 py-3 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition-all">Update</button>
                </form>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
