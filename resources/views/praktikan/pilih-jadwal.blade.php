<x-subpage-layout title="Pemilihan Jadwal Praktikum">
    <div class="space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['Senin', '08:00 - 12:00', 'Lab Kimia Dasar', '12 Sisa'],
                ['Selasa', '13:00 - 17:00', 'Lab Fisika Atom', '5 Sisa'],
                ['Kamis', '08:00 - 12:00', 'Lab Komputer A', 'Full']
            ] as $jadwal)
                <div class="p-8 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-3xl shadow-sm hover:border-blue-500 transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-600 font-bold">{{ substr($jadwal[0], 0, 1) }}</div>
                        <span class="px-3 py-1 {{ $jadwal[3] == 'Full' ? 'bg-rose-500/10 text-rose-500' : 'bg-emerald-500/10 text-emerald-500' }} text-[10px] font-black uppercase tracking-widest rounded-lg">{{ $jadwal[3] }}</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-1">{{ $jadwal[2] }}</h4>
                    <p class="text-sm text-slate-500 mb-6 font-medium">{{ $jadwal[0] }}, {{ $jadwal[1] }}</p>
                    
                    <form action="{{ route('praktikan.pilih-jadwal.store') }}" method="POST">
                        @csrf
                        <button type="submit" {{ $jadwal[3] == 'Full' ? 'disabled' : '' }} 
                            class="w-full py-3 {{ $jadwal[3] == 'Full' ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-600/20' }} rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                            Pilih Sesi Ini
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
