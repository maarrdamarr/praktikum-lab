<x-subpage-layout title="Distribusi Modul Digital">
    <div class="space-y-10">
        <form action="{{ route('admin.distribusi-modul.store') }}" method="POST" class="p-10 border-[3px] border-dashed border-slate-900 dark:border-white rounded-xl text-center bg-white dark:bg-slate-900 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            @csrf
            <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2 uppercase tracking-wide">Unggah Modul Baru</h3>
            <p class="text-xs font-bold text-slate-650 dark:text-slate-400 mb-8">Seret dan lepas file PDF modul untuk didistribusikan ke asisten dan praktikan.</p>
            <button type="submit" class="px-10 py-4 bg-[var(--accent-color)] text-white text-sm font-black uppercase tracking-widest rounded-xl neu-btn hover:scale-[1.01]">Pilih Berkas</button>
        </form>

        <div class="space-y-4">
            <h4 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider px-2">Daftar Modul Terbit</h4>
            @foreach(['Modul 01: Pengenalan Lab', 'Modul 02: Titrasi Asam Basa', 'Modul 03: Kristalisasi'] as $modul)
                <div class="p-6 bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex items-center justify-between flex-wrap gap-4 group transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-red-400 border-2 border-slate-900 dark:border-white rounded-lg flex items-center justify-center font-black text-slate-900 shadow-[2px_2px_0px_#000]">PDF</div>
                        <div>
                            <p class="text-sm font-black uppercase tracking-wide text-slate-900 dark:text-white">{{ $modul }}</p>
                            <p class="text-[10px] text-slate-650 dark:text-slate-400 font-black uppercase tracking-widest mt-1">Versi 2.0 | 4.2 MB</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button class="px-6 py-2 bg-rose-450 border-2 border-slate-900 dark:border-white text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] transition-all hover:bg-rose-500 cursor-pointer">Tarik Akses</button>
                        <button class="px-6 py-2 bg-blue-400 border-2 border-slate-900 dark:border-white text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-lg shadow-[2px_2px_0px_#000] transition-all hover:bg-blue-500 cursor-pointer">Update</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-subpage-layout>
