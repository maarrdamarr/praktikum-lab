<x-subpage-layout title="Cetak Berita Acara Praktikum">
    <div class="space-y-10">
        <div class="p-10 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-[3rem] shadow-sm flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-gray-50 dark:bg-slate-800 rounded-3xl flex items-center justify-center mb-8">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Dokumen Berita Acara</h3>
            <p class="text-sm text-slate-500 max-w-md mb-10 leading-relaxed">Pilih sesi praktikum yang telah selesai dilaksanakan untuk mencetak berita acara sebagai bukti validasi kegiatan laboratorium.</p>
            
            <form action="{{ route('dosen.cetak-berita.pdf') }}" method="POST" class="w-full max-w-md space-y-4">
                @csrf
                <select class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 dark:text-white outline-none">
                    <option>Pilih Sesi Praktikum...</option>
                    <option>Sesi A - Spektroskopi (12 Mei)</option>
                    <option>Sesi B - Titrasi (14 Mei)</option>
                </select>
                <button type="submit" class="w-full py-5 bg-blue-600 text-white font-extrabold rounded-2xl shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest flex items-center justify-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Dokumen PDF
                </button>
            </form>
        </div>

        <div class="p-8 bg-gray-50 dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-slate-700">
            <h3 class="text-lg font-bold mb-6">Arsip Berita Acara</h3>
            <div class="space-y-4">
                @foreach(['BA_Spektroskopi_120526.pdf', 'BA_KimiaOrganik_100526.pdf'] as $file)
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $file }}</span>
                        <button class="text-blue-600 text-[10px] font-black uppercase tracking-widest hover:underline">Download</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-subpage-layout>
