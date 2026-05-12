<x-subpage-layout title="Dasbor Real-time" icon="📡" color="rose">
    <div class="space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
                 <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-2">Live Status</p>
                 <h4 class="text-white font-bold text-lg mb-6">Praktikan Aktif</h4>
                 <div class="flex items-end gap-3 h-32">
                     @foreach([30, 50, 80, 40, 90, 60, 75] as $h)
                         <div class="flex-1 bg-rose-500/30 rounded-t-lg hover:bg-rose-500 transition-all" style="height: {{ $h }}%"></div>
                     @endforeach
                 </div>
             </div>
             <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
                 <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-2">Log Stream</p>
                 <div class="space-y-4">
                     @foreach(['User ID 82 logged in', 'Pre-test session started', 'Module updated by Admin'] as $log)
                        <div class="flex gap-4 text-[10px] font-bold text-slate-500 border-b border-white/5 pb-2">
                            <span class="text-rose-500 font-black">16:45</span>
                            <span class="text-slate-300">{{ $log }}</span>
                        </div>
                     @endforeach
                 </div>
             </div>
        </div>

        <div class="p-10 rounded-[3rem] bg-gradient-to-r from-rose-600/20 to-transparent border border-rose-500/20">
             <div class="flex justify-between items-center">
                 <div>
                    <h3 class="text-2xl font-black text-white mb-2">Pantauan Kamera 01</h3>
                    <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Main Laboratory Hall</p>
                 </div>
                 <div class="px-4 py-2 rounded-xl bg-rose-500 text-white text-[10px] font-black uppercase tracking-widest animate-pulse">Live Feed</div>
             </div>
             <div class="mt-8 aspect-video bg-slate-900 rounded-[2rem] flex items-center justify-center text-slate-700">
                 <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"></path></svg>
             </div>
        </div>
    </div>
</x-subpage-layout>
