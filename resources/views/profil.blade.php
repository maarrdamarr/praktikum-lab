<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6">
        @php
            $user         = auth()->user();
            $nameValue    = $user->name          ?? '';
            $emailValue   = $user->email         ?? '';
            $phoneValue   = $user->phone         ?? '';
            $prodiValue   = $user->prodi         ?? '';
            $identityPath = $user->identity_path ?? null;
        @endphp

        <div class="mb-12">
            <h2 class="text-4xl font-black tracking-tighter mb-2 uppercase">Profil Saya</h2>
            <p class="text-slate-600 dark:text-slate-400 font-bold">Lengkapi informasi pribadi dan unggah kartu identitas untuk akses penuh.</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <!-- Personal Info -->
            <div class="p-10 neu-card">
                <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Informasi Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $nameValue }}"
                               class="w-full neu-input px-6 py-4 text-sm font-black">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Email Institusi</label>
                        <input type="email" value="{{ $emailValue }}" disabled
                               class="w-full bg-gray-100 dark:bg-slate-800 border-[3px] border-slate-900 dark:border-white rounded-xl px-6 py-4 text-sm font-black text-slate-500 dark:text-slate-400 cursor-not-allowed opacity-75">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                        <input type="text" name="phone" value="{{ $phoneValue }}" placeholder="0812xxxx"
                               class="w-full neu-input px-6 py-4 text-sm font-black">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Program Studi</label>
                        <input type="text" name="prodi" value="{{ $prodiValue }}" placeholder="Teknik..."
                               class="w-full neu-input px-6 py-4 text-sm font-black">
                    </div>
                </div>
            </div>

            <!-- Identity Upload -->
            <div class="p-10 neu-card">
                <h3 class="text-xl font-black uppercase tracking-widest mb-2 text-slate-900 dark:text-white">Unggah Identitas (KTM/KTP)</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mb-8 font-bold italic">Wajib diunggah agar dapat melakukan absensi dan pengumpulan laporan.</p>

                @if($identityPath)
                    <div class="mb-8 p-6 bg-emerald-100 dark:bg-emerald-950 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-500 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-white shadow-[2px_2px_0px_#000]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">Identitas Terverifikasi</p>
                            <p class="text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-500 opacity-80">
                                Identitas sudah diunggah &mdash; unggah ulang di bawah untuk mengganti
                            </p>
                        </div>
                    </div>
                @endif

                <div class="p-12 border-[3px] border-dashed border-slate-900 dark:border-white bg-white dark:bg-slate-900 rounded-xl hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all group relative">
                    <input type="file" name="identity" id="identity_file" class="hidden"
                           accept=".jpg,.jpeg,.png,.pdf"
                           {{ $identityPath ? '' : 'required' }}>
                    <label for="identity_file" class="cursor-pointer">
                        <div class="w-16 h-16 bg-blue-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-900 mx-auto mb-4 shadow-[2px_2px_0px_#000] group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span id="file-name-label" class="text-sm font-black text-slate-900 dark:text-white block uppercase tracking-wider">
                            {{ $identityPath ? 'Klik untuk ganti identitas' : 'Klik untuk unggah identitas' }}
                        </span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-2 block">Format: JPG, PNG, PDF (Max 2MB)</span>
                    </label>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-6 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest text-sm neu-btn">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('identity_file').addEventListener('change', function () {
            const label = document.getElementById('file-name-label');
            if (this.files && this.files[0]) {
                label.textContent = this.files[0].name;
            }
        });
    </script>
</x-app-layout>
