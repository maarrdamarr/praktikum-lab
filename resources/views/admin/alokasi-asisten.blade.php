<x-subpage-layout title="Alokasi Asisten Lab">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="p-8 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl shadow-sm">
            <h3 class="text-xl font-bold mb-8">Plotting Jadwal</h3>
            <form action="{{ route('admin.alokasi-asisten.store') }}" method="POST" class="space-y-6">
                @csrf
                @foreach(['Senin, 08:00 - Modul A', 'Selasa, 13:00 - Modul B'] as $slot)
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $slot }}</label>
                        <select class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Pilih Asisten...</option>
                            <option>Dinda Putri</option>
                            <option>Fahri Ramadhan</option>
                            <option>Gita Savitri</option>
                        </select>
                    </div>
                @endforeach
                <div class="pt-6">
                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest text-xs">Simpan Plotting</button>
                </div>
            </form>
        </div>

        <div class="space-y-8">
            <div class="p-8 bg-gray-50 dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-slate-700">
                <h3 class="text-lg font-bold mb-6">Status Beban Kerja</h3>
                <div class="space-y-4">
                    @foreach(['Dinda Putri' => 80, 'Fahri Ramadhan' => 40, 'Gita Savitri' => 100] as $name => $load)
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-slate-500">
                                <span>{{ $name }}</span>
                                <span class="{{ $load > 80 ? 'text-rose-500' : 'text-blue-600' }}">{{ $load }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full {{ $load > 80 ? 'bg-rose-500' : 'bg-blue-600' }} transition-all duration-1000" style="width: {{ $load }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-subpage-layout>
