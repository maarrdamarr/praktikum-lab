<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6" x-data="{ status: 'hadir', hasLocation: false, lat: '', lng: '' }">
        <div class="mb-12">
            <h2 class="text-4xl font-black tracking-tighter mb-2">Presensi Kehadiran</h2>
            <p class="text-slate-500 font-medium">Verifikasi kehadiran Anda menggunakan kamera dan lokasi GPS.</p>
        </div>

        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <!-- Camera Section -->
            <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm overflow-hidden relative">
                <div class="absolute top-0 right-0 p-8">
                    <span class="px-4 py-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl">Camera Live</span>
                </div>
                <h3 class="text-xl font-bold mb-8">Verifikasi Wajah</h3>
                
                <div class="aspect-video bg-gray-50 dark:bg-slate-800 rounded-3xl overflow-hidden relative border border-gray-100 dark:border-slate-700 shadow-inner">
                    <video id="video" autoplay playsinline class="w-full h-full object-cover"></video>
                    <canvas id="canvas" class="hidden"></canvas>
                    <div class="absolute inset-0 border-2 border-dashed border-white/20 pointer-events-none rounded-3xl m-4"></div>
                </div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-6 text-center">Pastikan wajah Anda terlihat jelas dalam bingkai</p>
            </div>

            <!-- Location Section -->
            <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm" x-init="
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(pos => {
                        lat = pos.coords.latitude;
                        lng = pos.coords.longitude;
                        hasLocation = true;
                    });
                }
            ">
                <h3 class="text-xl font-bold mb-8">Titik Lokasi GPS</h3>
                <div class="flex items-center gap-6 p-6 bg-gray-50 dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-slate-700">
                    <div class="w-14 h-14 bg-white dark:bg-slate-900 rounded-2xl flex items-center justify-center text-rose-500 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 dark:text-white" x-text="hasLocation ? lat.toFixed(6) + ', ' + lng.toFixed(6) : 'Mendeteksi Lokasi...'"></p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Koordinat Terdeteksi Otomatis</p>
                    </div>
                </div>
                <input type="hidden" name="latitude" :value="lat">
                <input type="hidden" name="longitude" :value="lng">
            </div>

            <!-- Status Section -->
            <div class="p-10 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-[3rem] shadow-sm">
                <h3 class="text-xl font-bold mb-8">Status Kehadiran</h3>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <button type="button" @click="status = 'hadir'" :class="status === 'hadir' ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600' : 'border-gray-100 dark:border-slate-800 text-slate-400'" 
                            class="p-6 border rounded-3xl text-center transition-all">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-black uppercase tracking-widest">Hadir</span>
                    </button>
                    <button type="button" @click="status = 'tidak'" :class="status === 'tidak' ? 'border-rose-500 bg-rose-50 dark:bg-rose-900/20 text-rose-600' : 'border-gray-100 dark:border-slate-800 text-slate-400'"
                            class="p-6 border rounded-3xl text-center transition-all">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-black uppercase tracking-widest">Tidak Hadir</span>
                    </button>
                </div>
                <input type="hidden" name="status" :value="status">

                <!-- Conditional Inputs for 'Tidak Hadir' -->
                <div x-show="status === 'tidak'" x-transition class="space-y-8 pt-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alasan Tidak Hadir</label>
                        <textarea name="reason" rows="3" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-medium outline-none focus:ring-2 focus:ring-rose-500" placeholder="Berikan alasan yang jelas..."></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Surat Keterangan (PDF/Image)</label>
                        <div class="p-8 border-2 border-dashed border-gray-100 dark:border-slate-800 rounded-3xl text-center bg-gray-50/50 dark:bg-slate-900/50 hover:border-rose-500 transition-all group">
                            <input type="file" name="attachment" id="attachment" class="hidden">
                            <label for="attachment" class="cursor-pointer">
                                <svg class="w-8 h-8 mx-auto mb-2 text-slate-300 group-hover:text-rose-500 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <span class="text-xs font-bold text-slate-500">Klik untuk upload surat</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-6 bg-blue-600 text-white font-black rounded-3xl shadow-xl shadow-blue-600/20 hover:scale-[1.02] transition-all uppercase tracking-widest text-sm">
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
