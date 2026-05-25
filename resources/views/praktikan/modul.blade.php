<x-app-layout>
    {{-- ─── Page Header ─── --}}
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-1 uppercase">Modul Praktikum</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white">Modul Praktikum</span>
            </nav>
        </div>
        <span class="px-4 py-2 bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
            {{ $moduls->count() }} Modul Tersedia
        </span>
    </div>

    <div class="space-y-6">
        @if($moduls->isEmpty())
            <div class="p-16 text-center bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 dark:bg-blue-900/30 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada modul yang tersedia untuk Anda saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($moduls as $modul)
                    <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] transition-all overflow-hidden flex flex-col">

                        {{-- Color top bar --}}
                        <div class="h-2 bg-blue-500"></div>

                        <div class="p-6 flex-1 flex flex-col">
                            {{-- Nomor & Status --}}
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                                    {{ $modul->nomor_modul }}
                                </span>
                                @php
                                    $ext = strtolower(pathinfo($modul->file_original_name ?? '', PATHINFO_EXTENSION));
                                    $label = match($ext) { 'pdf' => 'PDF', 'doc','docx' => 'DOC', 'ppt','pptx' => 'PPT', 'zip' => 'ZIP', default => 'FILE' };
                                    $color = match($ext) { 'pdf' => 'bg-rose-500', 'doc','docx' => 'bg-blue-600', 'ppt','pptx' => 'bg-orange-500', default => 'bg-slate-500' };
                                @endphp
                                <div class="w-12 h-12 {{ $color }} border-[2px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-white font-black text-[10px] shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                                    {{ $label }}
                                </div>
                            </div>

                            {{-- Judul --}}
                            <h3 class="text-lg font-black text-slate-900 dark:text-white leading-tight mb-2">{{ $modul->judul }}</h3>

                            @if($modul->mata_kuliah)
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">📚 {{ $modul->mata_kuliah }}</p>
                            @endif

                            @if($modul->deskripsi)
                                <p class="text-xs font-bold text-slate-500 dark:text-slate-400 mb-4 flex-1">{{ Str::limit($modul->deskripsi, 120) }}</p>
                            @else
                                <div class="flex-1"></div>
                            @endif

                            <div class="flex items-center justify-between mt-4 pt-4 border-t-[2px] border-slate-200 dark:border-slate-700">
                                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span>v{{ $modul->versi }}</span>
                                    @if($modul->file_size) <span class="ml-2">{{ $modul->file_size_format }}</span> @endif
                                </div>
                                @if($modul->file_path)
                                    <a href="{{ route('praktikan.modul.download', $modul->id) }}"
                                       class="flex items-center gap-2 px-5 py-2.5 bg-blue-500 text-white border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh
                                    </a>
                                @else
                                    <span class="px-5 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-400 border-[2px] border-slate-300 dark:border-slate-600 text-[9px] font-black uppercase tracking-widest rounded-xl">Belum ada file</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
