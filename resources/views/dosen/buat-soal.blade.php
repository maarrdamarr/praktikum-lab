<x-subpage-layout title="Bank Soal Pre-Test">
    <div class="space-y-10">
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex gap-4">
                <form action="{{ route('dosen.buat-soal.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" id="import_soal_excel" class="hidden">
                    <label for="import_soal_excel" class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 cursor-pointer transition-all shadow-lg shadow-emerald-600/20">Import Excel</label>
                </form>
                <a href="{{ route('dosen.buat-soal.export') }}" class="px-6 py-3 bg-white border border-gray-100 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all">Export Excel</a>
            </div>
            <button onclick="document.getElementById('add_soal_form').scrollIntoView({behavior: 'smooth'})" class="px-8 py-3 bg-amber-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20">Tambah Soal Manual</button>
        </div>

        <div id="add_soal_form" class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <h3 class="text-xl font-bold mb-8">Tambah Pertanyaan Baru</h3>
            <form action="{{ route('dosen.buat-soal.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Mata Kuliah / Modul</label>
                    <select class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Kimia Dasar I - Modul 01</option>
                        <option>Kimia Dasar I - Modul 02</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Pertanyaan</label>
                    <textarea rows="4" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik pertanyaan pre-test..."></textarea>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest text-xs">Simpan ke Bank Soal</button>
                </div>
            </form>
        </div>

        <div class="p-8 bg-gray-50 dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-slate-700">
            <h3 class="text-lg font-bold mb-6">Pratinjau Soal Terdaftar</h3>
            <div class="space-y-4">
                @foreach([
                    'Jelaskan perbedaan antara standar primer dan sekunder.',
                    'Bagaimana cara menghitung normalitas larutan?'
                ] as $q)
                    <div class="p-5 bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 flex justify-between items-center group">
                        <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ $q }}</span>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">Edit</button>
                            <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-subpage-layout>
