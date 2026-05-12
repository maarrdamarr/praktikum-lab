<x-subpage-layout title="Penilaian Pre-test">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl shadow-sm space-y-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center font-bold text-blue-600">
                            {{ substr($name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">{{ $name }}</h4>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Modul: Spektroskopi UV-Vis</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-amber-50 dark:bg-amber-900/20 text-amber-600 rounded-xl text-[10px] font-black uppercase tracking-widest">Belum Dinilai</div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-slate-800 rounded-2xl italic text-sm text-slate-600 dark:text-slate-400 leading-relaxed border-l-4 border-blue-500">
                    "Hukum Lambert-Beer menyatakan bahwa absorbansi suatu larutan berbanding lurus dengan konsentrasi dan ketebalan medium..."
                </div>

                <form action="{{ route('asisten.nilai-pre-test.store') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="number" name="grade" placeholder="Masukkan Nilai (0-100)" class="w-full bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-blue-700 transition-all">Simpan</button>
                </form>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
