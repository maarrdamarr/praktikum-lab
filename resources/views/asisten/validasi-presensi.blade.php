<x-subpage-layout title="Validasi Presensi">
    <div class="space-y-4">
        @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 flex justify-between items-center group shadow-sm hover:border-blue-500 transition-all">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center font-bold text-slate-500">
                        {{ substr($name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-slate-900 dark:text-white font-bold text-sm">{{ $name }}</p>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Menunggu Validasi</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('asisten.validasi-presensi.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 text-rose-600 text-[10px] font-bold uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all border border-rose-100">Tolak</button>
                    </form>
                    <form action="{{ route('asisten.validasi-presensi.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all border border-blue-100">Terima</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
