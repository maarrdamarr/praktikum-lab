<x-subpage-layout title="Alokasi Asisten Lab">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="p-8 neu-card">
            <h3 class="text-xl font-black mb-8 uppercase tracking-wide text-slate-900 dark:text-white">Plotting Jadwal</h3>
            <form action="{{ route('admin.alokasi-asisten.store') }}" method="POST" class="space-y-6">
                @csrf
                @foreach(['Senin, 08:00 - Modul A', 'Selasa, 13:00 - Modul B'] as $slot)
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">{{ $slot }}</label>
                        <select class="w-full neu-input px-6 py-4 text-sm font-black text-slate-900 dark:text-white">
                            <option>Pilih Asisten...</option>
                            <option>Dinda Putri</option>
                            <option>Fahri Ramadhan</option>
                            <option>Gita Savitri</option>
                        </select>
                    </div>
                @endforeach
                <div class="pt-6">
                    <button type="submit" class="w-full py-4 bg-[var(--accent-color)] text-white text-xs font-black uppercase tracking-widest rounded-xl neu-btn">Simpan Plotting</button>
                </div>
            </form>
        </div>

        <div class="space-y-8">
            <div class="p-8 bg-gray-50 dark:bg-slate-800 rounded-xl border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                <h3 class="text-lg font-black uppercase tracking-wide mb-6 text-slate-900 dark:text-white">Status Beban Kerja</h3>
                <div class="space-y-4">
                    @foreach(['Dinda Putri' => 80, 'Fahri Ramadhan' => 40, 'Gita Savitri' => 100] as $name => $load)
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                <span>{{ $name }}</span>
                                <span class="{{ $load > 80 ? 'text-rose-500' : 'text-blue-600 dark:text-blue-400' }}">{{ $load }}%</span>
                            </div>
                            <div class="w-full h-4 bg-white dark:bg-slate-900 border-2 border-slate-900 dark:border-white rounded-md overflow-hidden shadow-[1px_1px_0px_#000]">
                                <div class="h-full {{ $load > 80 ? 'bg-rose-450' : 'bg-blue-400' }} border-r-2 border-slate-900 dark:border-white transition-all duration-1000" style="width: {{ $load }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-subpage-layout>
