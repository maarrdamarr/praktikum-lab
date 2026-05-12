<x-subpage-layout title="Sesi Pre-test Aktif">
    <div class="space-y-10">
        <div class="p-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-3xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-blue-900 dark:text-blue-100">Modul 04: Spektroskopi UV-Vis</h3>
                <div class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold animate-pulse">09:54 Sisa Waktu</div>
            </div>
            <p class="text-sm text-blue-700 dark:text-blue-300 leading-relaxed">Jawablah pertanyaan berikut dengan teliti. Anda hanya memiliki satu kesempatan untuk mengirimkan jawaban.</p>
        </div>

        <form action="{{ route('praktikan.pre-test.store') }}" method="POST" class="space-y-12">
            @csrf
            @foreach([
                'Apa prinsip utama dari hukum Lambert-Beer dalam spektroskopi?',
                'Sebutkan komponen utama dari alat spektrofotometer yang Anda gunakan.',
                'Mengapa larutan blanko diperlukan dalam pengukuran absorbansi?'
            ] as $i => $q)
                <div class="space-y-4 p-6 border-b border-gray-100 dark:border-slate-800 last:border-0">
                    <p class="font-bold text-slate-900 dark:text-white flex gap-4">
                        <span class="text-blue-600">{{ $i + 1 }}.</span>
                        {{ $q }}
                    </p>
                    <textarea rows="3" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl p-6 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Ketik jawaban Anda di sini..."></textarea>
                </div>
            @endforeach

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-blue-600 text-white font-extrabold rounded-2xl shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest">
                    Kirim Jawaban Pre-test
                </button>
            </div>
        </form>
    </div>
</x-subpage-layout>
