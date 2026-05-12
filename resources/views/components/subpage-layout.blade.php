@props(['title' => '', 'color' => 'blue'])

<x-app-layout>
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">{{ $title }}</h1>
            <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                <a href="/dashboard" class="hover:text-blue-600 transition-colors">Beranda</a>
                <span class="text-gray-300">/</span>
                <span class="text-blue-600">{{ $title }}</span>
            </nav>
        </div>
        <div class="flex gap-4">
            <button class="px-6 py-3 rounded-xl bg-gray-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-slate-700 transition-all">Perbarui</button>
            <button class="px-6 py-3 rounded-xl bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">Aksi Utama</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="p-10 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="p-8 rounded-3xl bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700">
                <h3 class="text-lg font-bold mb-6">Informasi Sesi</h3>
                <div class="space-y-4">
                    @foreach(['Status' => 'Aktif', 'Batas Waktu' => '24 Mei 2026', 'Progress' => '75%'] as $label => $val)
                        <div class="flex justify-between items-center p-4 bg-white dark:bg-slate-900 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $label }}</span>
                            <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $val }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 shadow-sm">
                <h3 class="text-lg font-bold mb-6">Petunjuk</h3>
                <ul class="space-y-4">
                    @foreach([
                        'Pastikan koneksi internet stabil.',
                        'Simpan data setiap melakukan perubahan.',
                        'Hubungi asisten jika terdapat kendala.'
                    ] as $tip)
                        <li class="flex gap-4 text-xs text-slate-500 leading-relaxed">
                            <span class="text-blue-600">•</span>
                            {{ $tip }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
