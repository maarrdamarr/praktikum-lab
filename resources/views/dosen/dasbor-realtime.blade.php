<x-subpage-layout title="Dasbor Real-time" icon="📡" color="rose">
    <div class="space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="p-8 neu-card">
                  <p class="text-[10px] font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest mb-2">Live Status</p>
                  <h4 class="text-slate-900 dark:text-white font-black text-lg mb-6 uppercase tracking-wider">Praktikan Aktif</h4>
                  <div class="flex items-end gap-3 h-32 border-b-[3px] border-slate-900 dark:border-white pb-1">
                      @foreach([30, 50, 80, 40, 90, 60, 75] as $h)
                          <div class="flex-1 bg-rose-400 border-[3px] border-slate-900 dark:border-white border-b-0 rounded-t-lg hover:bg-rose-500 transition-all" style="height: {{ $h }}%"></div>
                      @endforeach
                  </div>
             </div>
             <div class="p-8 neu-card">
                  <p class="text-[10px] font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest mb-2">Log Stream</p>
                  <div class="space-y-4">
                      @foreach(['User ID 82 logged in', 'Pre-test session started', 'Module updated by Admin'] as $log)
                         <div class="flex gap-4 text-[10px] font-black text-slate-500 dark:text-slate-400 border-b-[3px] border-slate-900 dark:border-white pb-2">
                             <span class="text-rose-500 font-black">16:45</span>
                             <span class="text-slate-700 dark:text-slate-350">{{ $log }}</span>
                         </div>
                      @endforeach
                  </div>
             </div>
        </div>

        <div class="p-10 neu-card">
             <div class="flex justify-between items-center flex-wrap gap-4">
                  <div>
                     <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase">Pantauan Kamera 01</h3>
                     <p class="text-xs text-rose-600 dark:text-rose-400 font-black uppercase tracking-widest">Main Laboratory Hall</p>
                  </div>
                  <div class="px-4 py-2 border-2 border-slate-900 dark:border-white rounded-lg bg-rose-400 text-slate-900 text-[10px] font-black uppercase tracking-widest shadow-[2px_2px_0px_#000] animate-pulse">Live Feed</div>
             </div>
             <div class="mt-8 aspect-video bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-500 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                  <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"></path></svg>
             </div>
        </div>
    </div>
</x-subpage-layout>
