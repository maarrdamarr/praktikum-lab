<x-subpage-layout title="Cetak Berita Acara Praktikum">
    <div class="space-y-10">
        <div class="p-10 neu-card flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-blue-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center mb-8 shadow-[4px_4px_0px_#000]">
                <svg class="w-10 h-10 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase">Dokumen Berita Acara</h3>
            <p class="text-sm font-bold text-slate-650 dark:text-slate-350 max-w-md mb-10 leading-relaxed">Pilih sesi praktikum yang telah selesai dilaksanakan untuk mencetak berita acara sebagai bukti validasi kegiatan laboratorium.</p>
            
            <form action="{{ route('dosen.cetak-berita.pdf') }}" method="POST" class="w-full max-w-md space-y-4">
                @csrf
                <select class="w-full neu-input px-6 py-4 text-sm font-black text-slate-900 dark:text-white">
                    <option>Pilih Sesi Praktikum...</option>
                    <option>Sesi A - Pemrograman Web (12 Mei)</option>
                    <option>Sesi B - Titrasi (14 Mei)</option>
                </select>
                <button type="submit" class="w-full py-5 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest flex items-center justify-center gap-3 neu-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Dokumen PDF
                </button>
            </form>
        </div>

        <div class="p-8 bg-gray-50 dark:bg-slate-800 rounded-xl border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <h3 class="text-lg font-black uppercase mb-6 text-slate-900 dark:text-white">Arsip Berita Acara</h3>
            <div class="space-y-4">
                @foreach(['BA_Pemrograman Web_120526.pdf', 'BA_InformatikaOrganik_100526.pdf'] as $file)
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border-[3px] border-slate-900 dark:border-white flex justify-between items-center">
                        <span class="text-xs font-black text-slate-650 dark:text-slate-400">{{ $file }}</span>
                        <button class="text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white px-3 py-1.5 rounded-lg bg-white dark:bg-slate-800 hover:bg-[var(--accent-color)] hover:text-white shadow-[2px_2px_0px_#000] text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer">Download</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-subpage-layout>
