<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6">
        @php
            $user = auth()->user();
            $nameValue = isset($user->name) ? $user->name : '';
            $emailValue = isset($user->email) ? $user->email : '';
            $identityPath = isset($user->identity_path) ? $user->identity_path : null;
        @endphp
        <div class="mb-12">
            <h2 class="text-4xl font-black tracking-tighter mb-2">Profil Saya</h2>
            <p class="text-slate-500 font-medium">Lengkapi informasi pribadi dan unggah kartu identitas untuk akses penuh.</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <!-- Personal Info -->
            <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
                <h3 class="text-xl font-bold mb-8">Informasi Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $nameValue }}" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Institusi</label>
                        <input type="email" value="{{ $emailValue }}" disabled class="w-full bg-gray-100 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold text-slate-400 cursor-not-allowed">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                        <input type="text" name="phone" placeholder="0812xxxx" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Program Studi</label>
                        <input type="text" name="prodi" placeholder="Teknik..." class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Identity Upload -->
            <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
                <h3 class="text-xl font-bold mb-2">Unggah Identitas (KTM/KTP)</h3>
                <p class="text-xs text-slate-500 mb-8 font-medium italic">Wajib diunggah agar dapat melakukan absensi dan pengumpulan laporan.</p>
                
                @if($identityPath)
                    <div class="mb-8 p-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-500/20 rounded-3xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-emerald-600">Identitas Terverifikasi</p>
                            <p class="text-[10px] font-black uppercase tracking-widest text-emerald-500 opacity-60">Terunggah: {{ date('d M Y') }}</p>
                        </div>
                    </div>
                @endif

                <div class="p-12 border-2 border-dashed border-gray-100 dark:border-slate-800 rounded-3xl text-center bg-gray-50/50 dark:bg-slate-900/50 hover:border-blue-500 transition-all group relative">
                    <input type="file" name="identity" id="identity_file" class="hidden" {{ $identityPath ? '' : 'required' }}>
                    <label for="identity_file" class="cursor-pointer">
                        <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-600 mx-auto mb-4 group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-900 dark:text-white block">Klik untuk ganti identitas</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 block">Format: JPG, PNG, PDF (Max 2MB)</span>
                    </label>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-6 bg-blue-600 text-white font-black rounded-3xl shadow-xl shadow-blue-600/20 hover:scale-[1.02] transition-all uppercase tracking-widest text-sm">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
