<x-subpage-layout title="Rekapitulasi Nilai" icon="📈" color="rose">
    <div class="space-y-8">
        <div class="flex justify-between items-center">
            <div class="flex gap-4">
                <button class="px-6 py-2 rounded-xl bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase tracking-widest hover:bg-rose-500 hover:border-rose-500 transition-all">Ganjil 2026</button>
                <button class="px-6 py-2 rounded-xl bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase tracking-widest hover:bg-rose-500 hover:border-rose-500 transition-all">Genap 2025</button>
            </div>
            <button class="px-6 py-3 rounded-xl bg-rose-500 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-500/20">Download PDF</button>
        </div>

        <div class="overflow-hidden rounded-3xl border border-white/5 bg-white/5">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/10 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-8 py-6">Nama Mahasiswa</th>
                        <th class="px-8 py-6 text-center">Avg Pre-test</th>
                        <th class="px-8 py-6 text-center">Avg Laporan</th>
                        <th class="px-8 py-6 text-right">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach(['Ahmad', 'Budi', 'Citra', 'Dedi', 'Euis'] as $name)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-all">
                            <td class="px-8 py-6 font-bold text-white">{{ $name }}</td>
                            <td class="px-8 py-6 text-center font-bold">82.5</td>
                            <td class="px-8 py-6 text-center font-bold">88.0</td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-rose-400 font-black text-lg">A-</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-subpage-layout>
