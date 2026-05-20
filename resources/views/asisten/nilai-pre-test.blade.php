<x-subpage-layout title="Penilaian Pre-test">
    <div class="space-y-6">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-8 neu-card space-y-6">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 border-[3px] border-slate-900 dark:border-white rounded-xl bg-blue-400 flex items-center justify-center font-black text-slate-900 shadow-[2px_2px_0px_#000]">
                            {{ substr($name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 dark:text-white uppercase">{{ $name }}</h4>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest">Modul: Spektroskopi UV-Vis</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 border-2 border-slate-900 dark:border-white bg-amber-400 text-slate-900 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-[2px_2px_0px_#000]">Belum Dinilai</div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-slate-800 rounded-xl italic text-sm text-slate-650 dark:text-slate-300 leading-relaxed border-[3px] border-slate-900 dark:border-white border-l-[6px]">
                    "Hukum Lambert-Beer menyatakan bahwa absorbansi suatu larutan berbanding lurus dengan konsentrasi dan ketebalan medium..."
                </div>

                <form action="{{ route('asisten.nilai-pre-test.store') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="number" name="grade" placeholder="Masukkan Nilai (0-100)" class="w-full neu-input px-4 py-3 text-sm font-black">
                    </div>
                    <button type="submit" class="px-8 py-3 bg-[var(--accent-color)] text-white text-xs font-black uppercase tracking-widest rounded-xl neu-btn">Simpan</button>
                </form>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
