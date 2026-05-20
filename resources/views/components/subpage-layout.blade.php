@props(['title' => '', 'color' => 'blue'])

<x-app-layout>
    <div class="mb-12 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter mb-2 uppercase">{{ $title }}</h1>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:underline transition-all">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-slate-900 dark:text-white">{{ $title }}</span>
            </nav>
        </div>
        <div class="flex gap-4">
            <button class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs font-black uppercase tracking-widest neu-btn">Perbarui</button>
            <button class="px-6 py-3 bg-[var(--accent-color)] text-white text-xs font-black uppercase tracking-widest neu-btn">Aksi Utama</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="p-10 neu-card relative overflow-hidden">
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="p-8 neu-card">
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-widest mb-6">Informasi Sesi</h3>
                <div class="space-y-4">
                    @foreach(['Status' => 'Aktif', 'Batas Waktu' => '24 Mei 2026', 'Progress' => '75%'] as $label => $val)
                        <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-slate-800/50 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                            <span class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">{{ $label }}</span>
                            <span class="text-sm font-black text-slate-900 dark:text-white">{{ $val }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-8 neu-card">
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-widest mb-6">Petunjuk</h3>
                <ul class="space-y-4">
                    @foreach([
                        'Pastikan koneksi internet stabil.',
                        'Simpan data setiap melakukan perubahan.',
                        'Hubungi asisten jika terdapat kendala.'
                    ] as $tip)
                        <li class="flex gap-4 text-xs text-slate-800 dark:text-slate-300 leading-relaxed font-bold">
                            <span class="text-[var(--accent-color)] font-black text-base leading-none">•</span>
                            {{ $tip }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
