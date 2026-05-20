<x-subpage-layout title="Rekapitulasi Nilai" icon="📈" color="rose">
    <div class="space-y-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div class="flex gap-4">
                <button class="px-6 py-2 border-[3px] border-slate-900 dark:border-white rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-[10px] font-black uppercase tracking-widest hover:bg-rose-450 dark:hover:bg-rose-500 transition-all shadow-[2px_2px_0px_#000]">Ganjil 2026</button>
                <button class="px-6 py-2 border-[3px] border-slate-900 dark:border-white rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-[10px] font-black uppercase tracking-widest hover:bg-rose-450 dark:hover:bg-rose-500 transition-all shadow-[2px_2px_0px_#000]">Genap 2025</button>
            </div>
            <button class="px-6 py-3 bg-[var(--accent-color)] text-white text-[10px] font-black uppercase tracking-widest rounded-xl neu-btn">Download PDF</button>
        </div>

        <div class="overflow-hidden rounded-xl border-[3px] border-slate-900 dark:border-white bg-white dark:bg-slate-900 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-[3px] border-slate-900 dark:border-white text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest bg-gray-50 dark:bg-slate-800">
                        <th class="px-8 py-6">Nama Mahasiswa</th>
                        <th class="px-8 py-6 text-center">Avg Pre-test</th>
                        <th class="px-8 py-6 text-center">Avg Laporan</th>
                        <th class="px-8 py-6 text-right">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach(['Ahmad', 'Budi', 'Citra', 'Dedi', 'Euis'] as $name)
                        <tr class="border-b-[3px] border-slate-900 dark:border-white last:border-0 hover:bg-gray-50 dark:hover:bg-slate-800 transition-all">
                            <td class="px-8 py-6 font-black text-slate-900 dark:text-white uppercase">{{ $name }}</td>
                            <td class="px-8 py-6 text-center font-black text-slate-900 dark:text-white">82.5</td>
                            <td class="px-8 py-6 text-center font-black text-slate-900 dark:text-white">88.0</td>
                            <td class="px-8 py-6 text-right">
                                <span class="px-3 py-1.5 border-2 border-slate-900 dark:border-white rounded-lg bg-rose-450 text-slate-900 text-sm font-black uppercase tracking-widest shadow-[2px_2px_0px_#000]">A-</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-subpage-layout>
