@if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
        class="fixed bottom-10 right-10 z-[100] animate-in slide-in-from-right duration-500">
        <div class="glass p-6 rounded-[2rem] border border-white/10 shadow-2xl flex items-center gap-6 min-w-[320px] relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-violet-500"></div>
            <div class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-2xl">✅</div>
            <div>
                <h4 class="text-white font-bold text-sm">Berhasil!</h4>
                <p class="text-xs text-slate-400 font-medium">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-auto text-slate-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
        class="fixed bottom-10 right-10 z-[100] animate-in slide-in-from-right duration-500">
        <div class="glass p-6 rounded-[2rem] border border-white/10 shadow-2xl flex items-center gap-6 min-w-[320px] relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-rose-500"></div>
            <div class="w-12 h-12 bg-rose-500/20 rounded-2xl flex items-center justify-center text-2xl">⚠️</div>
            <div>
                <h4 class="text-white font-bold text-sm">Terjadi Kesalahan</h4>
                <p class="text-xs text-slate-400 font-medium">{{ session('error') }}</p>
            </div>
            <button @click="show = false" class="ml-auto text-slate-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
@endif
