<x-subpage-layout title="Alokasi Asisten Lab">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Plotting Jadwal (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
                <div class="px-8 py-6 border-b-[3px] border-slate-900 dark:border-white flex justify-between items-center bg-gray-50 dark:bg-slate-800">
                    <h3 class="text-xl font-black uppercase tracking-wide text-slate-900 dark:text-white">Plotting Jadwal</h3>
                    <span class="px-4 py-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-[9px] font-black uppercase tracking-widest rounded-lg">
                        {{ $jadwals->count() }} Jadwal Aktif
                    </span>
                </div>
                <div class="p-8">
                    <form action="{{ route('admin.alokasi-asisten.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        @if($jadwals->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada jadwal yang tersedia.<br>Silakan kelola jadwal terlebih dahulu.</p>
                            </div>
                        @else
                            <div class="grid gap-6">
                                @foreach($jadwals as $jadwal)
                                    <div class="border-[2px] border-slate-200 dark:border-slate-700 rounded-xl p-6 hover:border-slate-900 dark:hover:border-white transition-colors bg-slate-50 dark:bg-slate-800/50">
                                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
                                            
                                            <!-- Info Jadwal -->
                                            <div>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 border-[2px] border-blue-200 text-[10px] font-black uppercase rounded">{{ $jadwal->hari }}</span>
                                                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ $jadwal->jam_mulai_format }} - {{ $jadwal->jam_selesai_format }}</span>
                                                </div>
                                                <h4 class="text-base font-black text-slate-900 dark:text-white leading-tight mb-2">{{ $jadwal->mata_kuliah ?: 'Praktikum Reguler' }} {{ $jadwal->kelas ? '('.$jadwal->kelas.')' : '' }}</h4>
                                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest space-y-1">
                                                    <p>📍 {{ $jadwal->ruangan->nama ?? 'Ruangan belum diset' }}</p>
                                                    <p>Modul: {{ $jadwal->modul ?: '-' }}</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Select Asisten (Checkbox List) -->
                                            <div class="w-full">
                                                <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block mb-3">Pilih Asisten</label>
                                                <div class="space-y-2 max-h-48 overflow-y-auto pr-2 rounded-xl custom-scrollbar">
                                                    @foreach($asistens as $asisten)
                                                        <label class="flex items-center gap-3 p-2.5 border-[2px] border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                                            <input type="checkbox" name="jadwal_asisten[{{ $jadwal->id }}][]" value="{{ $asisten->id }}" 
                                                                {{ $jadwal->asistens->contains($asisten->id) ? 'checked' : '' }}
                                                                class="w-4 h-4 accent-[var(--accent-color)] bg-white border-slate-300 rounded shrink-0">
                                                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300 leading-tight">{{ $asisten->name }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="pt-4 flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-[var(--accent-color)] text-white text-xs font-black uppercase tracking-widest border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] transition-all">
                                Simpan Plotting Asisten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Status Beban Kerja (1/3 width) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden sticky top-6 max-h-[calc(100vh-3rem)] flex flex-col">
                <div class="px-6 py-5 border-b-[3px] border-slate-900 dark:border-white bg-amber-50 dark:bg-amber-900/20 flex items-center gap-3 shrink-0">
                    <div class="w-8 h-8 bg-amber-400 border-[2px] border-slate-900 dark:border-white rounded-lg flex items-center justify-center shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                        <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-black uppercase tracking-wide text-slate-900 dark:text-white">Beban Kerja</h3>
                </div>
                
                <div class="p-6 overflow-y-auto flex-1">
                    @if(empty($bebanKerja))
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest text-center py-4">Belum ada data asisten.</p>
                    @else
                        <div class="space-y-5">
                            @foreach($bebanKerja as $name => $load)
                                <div class="space-y-2 group">
                                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                        <span class="truncate pr-2" title="{{ $name }}">{{ $name }}</span>
                                        <span class="{{ $load > 80 ? 'text-rose-500' : 'text-blue-600 dark:text-blue-400' }}">{{ round($load) }}%</span>
                                    </div>
                                    <div class="w-full h-4 bg-slate-100 dark:bg-slate-800 border-[2px] border-slate-900 dark:border-white rounded-md overflow-hidden shadow-[1px_1px_0px_#000] dark:shadow-[1px_1px_0px_#fff]">
                                        <div class="h-full {{ $load > 80 ? 'bg-rose-500' : 'bg-blue-400' }} border-r-[2px] border-slate-900 dark:border-white transition-all duration-1000 group-hover:brightness-110" style="width: {{ $load }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-4 border-t-[2px] border-dashed border-slate-200 dark:border-slate-700">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest text-center leading-relaxed">
                                Beban kerja dihitung berdasar persentase jumlah jadwal. <br>Lebih dari 80% menandakan beban tinggi.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</x-subpage-layout>
