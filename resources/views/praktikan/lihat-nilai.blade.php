<x-subpage-layout title="Lihat Nilai" icon="📊" color="cyan">
    <div class="overflow-hidden rounded-3xl border border-white/5 bg-white/5">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                    <th class="px-8 py-6">Modul</th>
                    <th class="px-8 py-6 text-center">Pre-test</th>
                    <th class="px-8 py-6 text-center">Laporan</th>
                    <th class="px-8 py-6 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach(['Kimia Organik 1', 'Destilasi Bertingkat', 'Uji Kualitas Air'] as $modul)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-all">
                        <td class="px-8 py-6 font-bold text-white">{{ $modul }}</td>
                        <td class="px-8 py-6 text-center text-cyan-400 font-bold">85</td>
                        <td class="px-8 py-6 text-center text-cyan-400 font-bold">90</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-500 text-[10px] font-black uppercase tracking-tighter">Verified</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-subpage-layout>
