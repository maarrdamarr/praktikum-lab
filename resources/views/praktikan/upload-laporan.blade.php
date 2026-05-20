<x-subpage-layout title="Unggah Laporan Mingguan">
    <div class="max-w-4xl mx-auto space-y-12">
        <div class="p-10 neu-card">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase">Pilih Berkas Laporan</h3>
                <p class="text-xs font-bold text-slate-600 dark:text-slate-400">Pastikan format file adalah PDF dengan ukuran maksimal 5MB.</p>
            </div>

            <form action="{{ route('praktikan.upload-laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Pilih Modul</label>
                    <select name="modul" class="w-full neu-input px-6 py-4 text-sm font-black">
                        <option>Modul 01: Pengenalan Lab</option>
                        <option>Modul 02: Titrasi Asam Basa</option>
                    </select>
                </div>

                <div class="p-12 border-[3px] border-dashed border-slate-900 dark:border-white bg-white dark:bg-slate-900 rounded-xl text-center hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all group relative">
                    <input type="file" name="report" id="report_file" class="hidden" required>
                    <label for="report_file" class="cursor-pointer">
                        <div class="w-16 h-16 bg-blue-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-900 mx-auto mb-4 shadow-[2px_2px_0px_#000] group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <span class="text-sm font-black text-slate-900 dark:text-white block uppercase tracking-wider">Klik untuk pilih file</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-2 block">atau seret dan lepas di sini</span>
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest text-sm neu-btn">
                        Unggah Laporan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
