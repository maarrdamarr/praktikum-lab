<x-subpage-layout title="Lihat Nilai" icon="📊" color="cyan">
    <div class="overflow-hidden rounded-xl border-[3px] border-slate-900 dark:border-white bg-white dark:bg-slate-900 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-[3px] border-slate-900 dark:border-white text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest bg-gray-50 dark:bg-slate-800">
                    <th class="px-8 py-6">Modul</th>
                    <th class="px-8 py-6 text-center">Pre-test</th>
                    <th class="px-8 py-6 text-center">Laporan</th>
                    <th class="px-8 py-6 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach(['Basis Data', 'Struktur Data', 'Jaringan Komputer'] as $modul)
                    <tr class="border-b-[3px] border-slate-900 dark:border-white last:border-0 hover:bg-gray-50 dark:hover:bg-slate-800 transition-all">
                        <td class="px-8 py-6 font-black text-slate-900 dark:text-white">{{ $modul }}</td>
                        <td class="px-8 py-6 text-center text-cyan-600 dark:text-cyan-400 font-black">85</td>
                        <td class="px-8 py-6 text-center text-cyan-600 dark:text-cyan-400 font-black">90</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1.5 border-2 border-slate-900 dark:border-white rounded-lg bg-emerald-450 text-slate-900 text-[10px] font-black uppercase tracking-widest shadow-[2px_2px_0px_#000]">Verified</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-subpage-layout>
