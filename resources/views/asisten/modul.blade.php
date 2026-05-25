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
        <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
            {{ $moduls->count() }} Modul Tersedia
        </span>
    </div>

    <div class="space-y-6">
        @if($moduls->isEmpty())
            <div class="p-16 text-center bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <div class="w-20 h-20 mx-auto mb-4 bg-emerald-100 dark:bg-emerald-900/30 border-[3px] border-slate-900 dark:border-white rounded-2xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada modul yang tersedia untuk Anda saat ini.</p>
            </div>
        @else
            {{-- Table view for asisten - more info-dense --}}
            <div class="bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] overflow-hidden">
                <div class="px-8 py-5 border-b-[3px] border-slate-900 dark:border-white bg-emerald-50 dark:bg-emerald-900/20">
                    <div class="grid grid-cols-5 gap-4 text-[9px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                        <span class="col-span-2">Modul</span>
                        <span>Mata Kuliah</span>
                        <span>Versi / Ukuran</span>
                        <span>Aksi</span>
                    </div>
                </div>
                <div class="divide-y-[2px] divide-slate-200 dark:divide-slate-700">
                    @foreach($moduls as $modul)
                        @php
                            $ext = strtolower(pathinfo($modul->file_original_name ?? '', PATHINFO_EXTENSION));
                            $label = match($ext) { 'pdf' => 'PDF', 'doc','docx' => 'DOC', 'ppt','pptx' => 'PPT', 'zip' => 'ZIP', default => 'FILE' };
                            $color = match($ext) { 'pdf' => 'bg-rose-500', 'doc','docx' => 'bg-blue-600', 'ppt','pptx' => 'bg-orange-500', default => 'bg-slate-500' };
                        @endphp
                        <div class="px-8 py-5 grid grid-cols-5 gap-4 items-center hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors">
                            <div class="col-span-2 flex items-center gap-4">
                                <div class="w-12 h-12 {{ $color }} border-[2px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-white font-black text-[10px] shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] shrink-0">
                                    {{ $label }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 border border-slate-900 dark:border-white text-[9px] font-black uppercase rounded">{{ $modul->nomor_modul }}</span>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white leading-tight">{{ $modul->judul }}</h4>
                                    @if($modul->deskripsi)
                                        <p class="text-[10px] text-slate-400 font-bold mt-0.5">{{ Str::limit($modul->deskripsi, 60) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $modul->mata_kuliah ?? '—' }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-black text-slate-700 dark:text-slate-300">v{{ $modul->versi }}</span>
                                @if($modul->file_size)
                                    <span class="block text-[10px] font-black text-slate-400 uppercase">{{ $modul->file_size_format }}</span>
                                @endif
                            </div>
                            <div>
                                @if($modul->file_path)
                                    <a href="{{ route('asisten.modul.download', $modul->id) }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-400 text-slate-900 border-[2px] border-slate-900 dark:border-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_#000] transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh
                                    </a>
                                @else
                                    <span class="text-[10px] font-black text-slate-400 uppercase">Belum ada file</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
