<x-subpage-layout title="Penilaian Ujian Responsi">
    <div class="space-y-8">
        <div class="p-8 bg-blue-600 rounded-[2.5rem] text-white shadow-xl shadow-blue-600/20">
            <h3 class="text-xl font-bold mb-2">Input Nilai Responsi</h3>
            <p class="text-xs text-blue-100 font-bold uppercase tracking-widest">Periode Ganjil 2026 | Sesi Akhir</p>
        </div>

        <div class="overflow-hidden rounded-3xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-slate-800 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-8 py-6">Nama Mahasiswa</th>
                        <th class="px-8 py-6">NIM</th>
                        <th class="px-8 py-6 text-center">Input Nilai</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
                        <tr class="border-b border-gray-50 dark:border-slate-800/50 hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-all">
                            <td class="px-8 py-6 font-bold text-slate-900 dark:text-white">{{ $name }}</td>
                            <td class="px-8 py-6 text-slate-500">2021000{{ $loop->index + 1 }}</td>
                            <td class="px-8 py-6">
                                <form action="{{ route('dosen.nilai-responsi.store') }}" method="POST" class="flex justify-center items-center gap-4">
                                    @csrf
                                    <input type="number" name="grade" placeholder="0-100" class="w-24 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2 text-center text-sm font-bold focus:ring-2 focus:ring-amber-500 outline-none">
                                    <button type="submit" class="px-6 py-2 bg-amber-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-amber-600 transition-all shadow-md shadow-amber-500/20">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-subpage-layout>
