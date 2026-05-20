<x-subpage-layout title="Pendaftaran Praktikum">
    <div class="max-w-4xl mx-auto">
        <div class="p-10 neu-card">
            <h3 class="text-2xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Formulir Pendaftaran</h3>
            
            <form action="{{ route('praktikan.pendaftaran.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Nomor Induk Mahasiswa</label>
                        <input type="text" name="nim" required class="w-full neu-input px-6 py-4 text-sm font-black">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Program Studi</label>
                        <select name="prodi" class="w-full neu-input px-6 py-4 text-sm font-black">
                            <option>Teknik Kimia</option>
                            <option>Teknik Fisika</option>
                            <option>Teknik Elektro</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Motivasi Bergabung</label>
                    <textarea name="motivation" rows="4" class="w-full neu-input px-6 py-4 text-sm font-black" placeholder="Apa tujuan Anda mengikuti praktikum ini?"></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest text-sm neu-btn">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
