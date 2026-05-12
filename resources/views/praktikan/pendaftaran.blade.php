<x-subpage-layout title="Pendaftaran Praktikum">
    <div class="max-w-4xl mx-auto">
        <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
            <h3 class="text-2xl font-black mb-8 text-slate-900 dark:text-white">Formulir Pendaftaran</h3>
            
            <form action="{{ route('praktikan.pendaftaran.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Induk Mahasiswa</label>
                        <input type="text" name="nim" required class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Program Studi</label>
                        <select name="prodi" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Teknik Kimia</option>
                            <option>Teknik Fisika</option>
                            <option>Teknik Elektro</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Motivasi Bergabung</label>
                    <textarea name="motivation" rows="4" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-medium outline-none focus:ring-2 focus:ring-blue-500" placeholder="Apa tujuan Anda mengikuti praktikum ini?"></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest text-sm">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-subpage-layout>
