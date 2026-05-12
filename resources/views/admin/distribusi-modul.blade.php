<x-subpage-layout title="Distribusi Modul Digital">
    <div class="space-y-10">
        <form action="{{ route('admin.distribusi-modul.store') }}" method="POST" class="p-10 border-2 border-dashed border-gray-200 dark:border-slate-800 rounded-[3rem] text-center bg-gray-50/50 dark:bg-slate-900/50">
            @csrf
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Unggah Modul Baru</h3>
            <p class="text-xs text-slate-500 mb-8 font-medium">Seret dan lepas file PDF modul untuk didistribusikan ke asisten dan praktikan.</p>
            <button type="submit" class="px-10 py-4 bg-blue-600 text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-600/20 hover:scale-105 transition-all">Pilih Berkas</button>
        </form>

        <div class="space-y-4">
            <h4 class="text-lg font-bold text-slate-900 dark:text-white px-4">Daftar Modul Terbit</h4>
            @foreach(['Modul 01: Pengenalan Lab', 'Modul 02: Titrasi Asam Basa', 'Modul 03: Kristalisasi'] as $modul)
                <div class="p-6 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-3xl shadow-sm flex items-center justify-between group hover:border-blue-500 transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-gray-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center font-bold text-slate-400 group-hover:text-blue-600 transition-colors">PDF</div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $modul }}</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Versi 2.0 | 4.2 MB</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button class="px-6 py-2 bg-gray-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-50 hover:text-rose-600 transition-all">Tarik Akses</button>
                        <button class="px-6 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-600 hover:text-white transition-all">Update</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
