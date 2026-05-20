<x-subpage-layout title="Penilaian Ujian Responsi">
    <div class="space-y-8">
        <div class="p-8 bg-blue-100 dark:bg-blue-950 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <h3 class="text-xl font-black mb-2 uppercase tracking-wide text-slate-900 dark:text-white">Input Nilai Responsi</h3>
            <p class="text-xs text-slate-650 dark:text-slate-400 font-black uppercase tracking-widest">Periode Ganjil 2026 | Sesi Akhir</p>
        </div>

        <div class="overflow-hidden rounded-xl border-[3px] border-slate-900 dark:border-white bg-white dark:bg-slate-900 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-[3px] border-slate-900 dark:border-white text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest bg-gray-50 dark:bg-slate-800">
                        <th class="px-8 py-6">Nama Mahasiswa</th>
                        <th class="px-8 py-6">NIM</th>
                        <th class="px-8 py-6 text-center">Input Nilai & Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach(['Ahmad Fauzi', 'Budi Santoso', 'Citra Lestari'] as $name)
                        <tr class="border-b-[3px] border-slate-900 dark:border-white last:border-0 hover:bg-gray-50 dark:hover:bg-slate-800 transition-all">
                            <td class="px-8 py-6 font-black text-slate-900 dark:text-white uppercase">{{ $name }}</td>
                            <td class="px-8 py-6 font-bold text-slate-550 dark:text-slate-400">2021000{{ $loop->index + 1 }}</td>
                            <td class="px-8 py-6">
                                <form action="{{ route('dosen.nilai-responsi.store') }}" method="POST" class="flex justify-center items-center gap-4">
                                    @csrf
                                    <input type="number" name="grade" placeholder="0-100" class="w-24 neu-input px-4 py-2 text-center text-sm font-black">
                                    <button type="submit" class="px-6 py-2 bg-[var(--accent-color)] text-white text-[10px] font-black uppercase tracking-widest rounded-xl neu-btn">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-subpage-layout>
