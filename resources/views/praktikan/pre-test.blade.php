<x-subpage-layout title="Sesi Pre-test Aktif">
    <div class="space-y-10">
        <div class="p-8 bg-blue-100 dark:bg-blue-950 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <div class="flex justify-between items-center flex-wrap gap-4 mb-6">
                <h3 class="text-lg font-black uppercase tracking-wider text-slate-900 dark:text-white">Modul 04: Spektroskopi UV-Vis</h3>
                <div class="px-4 py-2 bg-rose-450 text-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl text-xs font-black uppercase tracking-widest shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] animate-pulse">09:54 Sisa Waktu</div>
            </div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300 leading-relaxed">Jawablah pertanyaan berikut dengan teliti. Anda hanya memiliki satu kesempatan untuk mengirimkan jawaban.</p>
        </div>

        <form action="{{ route('praktikan.pre-test.store') }}" method="POST" class="space-y-12">
            @csrf
            @foreach([
                'Apa prinsip utama dari hukum Lambert-Beer dalam spektroskopi?',
                'Sebutkan komponen utama dari alat spektrofotometer yang Anda gunakan.',
                'Mengapa larutan blanko diperlukan dalam pengukuran absorbansi?'
            ] as $i => $q)
                <div class="space-y-4 p-6 border-b-[3px] border-slate-900 dark:border-white last:border-0">
                    <p class="font-black text-slate-900 dark:text-white flex gap-4 uppercase tracking-wide">
                        <span class="text-[var(--accent-color)]">{{ $i + 1 }}.</span>
                        {{ $q }}
                    </p>
                    <textarea rows="3" class="w-full neu-input p-6 text-sm font-black" placeholder="Ketik jawaban Anda di sini..."></textarea>
                </div>
            @endforeach

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest neu-btn">
                    Kirim Jawaban Pre-test
                </button>
            </div>
        </form>
    </div>
</x-subpage-layout>
