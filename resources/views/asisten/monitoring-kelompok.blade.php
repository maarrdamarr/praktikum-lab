<x-subpage-layout title="Monitoring Kelompok" icon="👥" color="emerald">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach(['Kelompok A' => 85, 'Kelompok B' => 40, 'Kelompok C' => 95] as $group => $progress)
            <div class="p-8 glass rounded-[2rem] border border-white/5 space-y-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-white font-bold">{{ $group }}</h4>
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ $progress }}% Active</span>
                </div>
                <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex justify-between items-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    <span>3 Mahasiswa</span>
                    <button class="text-emerald-400 hover:text-white transition-colors">Detail ↗</button>
                </div>
            </div>
        @endforeach
    </div>
</x-subpage-layout>
