<x-subpage-layout title="Unggah Laporan Mingguan">
    <div class="max-w-4xl mx-auto space-y-12">
        <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Pilih Berkas Laporan</h3>
                <p class="text-sm text-slate-500">Pastikan format file adalah PDF dengan ukuran maksimal 5MB.</p>
            </div>

            <form action="{{ route('praktikan.upload-laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Modul</label>
                    <select name="modul" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Modul 01: Pengenalan Lab</option>
                        <option>Modul 02: Titrasi Asam Basa</option>
                    </select>
                </div>

                <div class="p-12 border-2 border-dashed border-gray-100 dark:border-slate-800 rounded-3xl text-center bg-gray-50/50 dark:bg-slate-900/50 hover:border-blue-500 transition-all group">
                    <input type="file" name="report" id="report_file" class="hidden" required>
                    <label for="report_file" class="cursor-pointer">
                        <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-600 mx-auto mb-4 group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-900 dark:text-white block">Klik untuk pilih file</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 block">atau seret dan lepas di sini</span>
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest text-sm">
                        Unggah Laporan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
