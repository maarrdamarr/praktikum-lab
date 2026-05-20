<x-subpage-layout title="Pemilihan Jadwal Praktikum">
    <div class="space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['Senin', '08:00 - 12:00', 'Lab Kimia Dasar', '12 Sisa'],
                ['Selasa', '13:00 - 17:00', 'Lab Fisika Atom', '5 Sisa'],
                ['Kamis', '08:00 - 12:00', 'Lab Komputer A', 'Full']
            ] as $jadwal)
                <div class="p-8 neu-card hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-blue-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-900 font-black shadow-[2px_2px_0px_#000]">{{ substr($jadwal[0], 0, 1) }}</div>
                        <span class="px-3 py-1 border-2 border-slate-900 dark:border-white {{ $jadwal[3] == 'Full' ? 'bg-rose-400' : 'bg-emerald-450' }} text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000]">{{ $jadwal[3] }}</span>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 dark:text-white mb-1 uppercase">{{ $jadwal[2] }}</h4>
                    <p class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-6">{{ $jadwal[0] }}, {{ $jadwal[1] }}</p>
                    
                    <form action="{{ route('praktikan.pilih-jadwal.store') }}" method="POST">
                        @csrf
                        <button type="submit" {{ $jadwal[3] == 'Full' ? 'disabled' : '' }} 
                            class="w-full py-3 {{ $jadwal[3] == 'Full' ? 'bg-gray-200 text-gray-500 border-[3px] border-slate-900 dark:border-white rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed opacity-50' : 'bg-[var(--accent-color)] text-white font-black rounded-xl text-[10px] font-black uppercase tracking-widest neu-btn' }}">
                            Pilih Sesi Ini
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
