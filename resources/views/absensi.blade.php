<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6" x-data="{ status: 'hadir', hasLocation: false, lat: '', lng: '' }">
        <div class="mb-12">
            <h2 class="text-4xl font-black tracking-tighter mb-2 uppercase">Presensi Kehadiran</h2>
            <p class="text-slate-600 dark:text-slate-400 font-bold">Verifikasi kehadiran Anda menggunakan kamera dan lokasi GPS.</p>
        </div>

        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <!-- Camera Section -->
            <div class="p-10 neu-card overflow-hidden relative">
                <div class="absolute top-0 right-0 p-8">
                    <span class="px-4 py-2 bg-emerald-400 text-slate-900 border-[3px] border-slate-900 dark:border-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">Camera Live</span>
                </div>
                <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Verifikasi Wajah</h3>
                
                <div class="aspect-video bg-gray-50 dark:bg-slate-800 rounded-xl overflow-hidden relative border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <video id="video" autoplay playsinline class="w-full h-full object-cover"></video>
                    <canvas id="canvas" class="hidden"></canvas>
                    <div class="absolute inset-0 border-[3px] border-dashed border-white/40 pointer-events-none rounded-lg m-4 animate-pulse"></div>
                </div>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-6 text-center">Pastikan wajah Anda terlihat jelas dalam bingkai</p>
            </div>

            <!-- Location Section -->
            <div class="p-10 neu-card" x-init="
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(pos => {
                        lat = pos.coords.latitude;
                        lng = pos.coords.longitude;
                        hasLocation = true;
                    });
                }
            ">
                <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Titik Lokasi GPS</h3>
                <div class="flex items-center gap-6 p-6 bg-gray-50 dark:bg-slate-800 rounded-xl border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <div class="w-14 h-14 bg-rose-450 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff]">
                        <svg class="w-7 h-7 text-rose-600 dark:text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900 dark:text-white" x-text="hasLocation ? lat.toFixed(6) + ', ' + lng.toFixed(6) : 'Mendeteksi Lokasi...'"></p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-widest mt-1">Koordinat Terdeteksi Otomatis</p>
                    </div>
                </div>
                <input type="hidden" name="latitude" :value="lat">
                <input type="hidden" name="longitude" :value="lng">
            </div>

            <!-- Status Section -->
            <div class="p-10 neu-card">
                <h3 class="text-xl font-black uppercase tracking-widest mb-8 text-slate-900 dark:text-white">Status Kehadiran</h3>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <button type="button" @click="status = 'hadir'" :class="status === 'hadir' ? 'bg-emerald-450 text-slate-900 border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000]' : 'bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white text-slate-400 dark:text-slate-500'" 
                            class="p-6 rounded-xl text-center transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] active:translate-x-[2px] active:translate-y-[2px] active:shadow-[2px_2px_0px_#000]">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-black uppercase tracking-widest">Hadir</span>
                    </button>
                    <button type="button" @click="status = 'tidak'" :class="status === 'tidak' ? 'bg-rose-455 text-slate-900 border-[3px] border-slate-900 dark:border-white shadow-[4px_4px_0px_#000]' : 'bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white text-slate-400 dark:text-slate-500'"
                            class="p-6 rounded-xl text-center transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000] active:translate-x-[2px] active:translate-y-[2px] active:shadow-[2px_2px_0px_#000]">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-black uppercase tracking-widest">Tidak Hadir</span>
                    </button>
                </div>
                <input type="hidden" name="status" :value="status">

                <!-- Conditional Inputs for 'Tidak Hadir' -->
                <div x-show="status === 'tidak'" x-transition class="space-y-8 pt-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Alasan Tidak Hadir</label>
                        <textarea name="reason" rows="3" class="w-full neu-input px-6 py-4 text-sm font-black" placeholder="Berikan alasan yang jelas..."></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Surat Keterangan (PDF/Image)</label>
                        <div class="p-8 border-[3px] border-dashed border-slate-900 dark:border-white bg-white dark:bg-slate-900 rounded-xl text-center hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[4px_4px_0px_#000] dark:hover:shadow-[4px_4px_0px_#fff] transition-all group relative">
                            <input type="file" name="attachment" id="attachment" class="hidden">
                            <label for="attachment" class="cursor-pointer">
                                <svg class="w-8 h-8 mx-auto mb-2 text-slate-400 group-hover:text-rose-500 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <span class="text-xs font-black uppercase text-slate-900 dark:text-white">Klik untuk upload surat</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-6 bg-[var(--accent-color)] text-white font-black rounded-xl uppercase tracking-widest text-sm neu-btn">
                    Kirim Laporan Kehadiran
                </button>
            </div>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
                video.srcObject = stream;
                video.play();
            });
        }
    </script>
</x-app-layout>
