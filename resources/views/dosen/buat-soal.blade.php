<x-app-layout>
    <div x-data="{
        questionType: 'short_answer',
        title: '',
        instructions: '',
        options: ['Opsi A', 'Opsi B'],
        points: 100,
        isUngraded: false,
        dueDate: '2026-05-24',
        dueTime: '23:59',
        topic: 'Modul 01',
        canReply: true,
        canEdit: false,
        selectedClass: 'Kimia Dasar I - Modul 01',
        
        editMode: false,
        editId: null,
        activeTab: 'create', // 'create' or 'bank'
        expandedTopic: 'Modul 01',

        addOption() {
            let charCode = 65 + this.options.length; // A, B, C, ...
            if (charCode > 90) charCode = 90; // Limit to Z
            this.options.push('Opsi ' + String.fromCharCode(charCode));
        },
        removeOption(index) {
            if (this.options.length > 1) {
                this.options.splice(index, 1);
            }
        },
        startEdit(q) {
            this.editMode = true;
            this.editId = q.id;
            this.title = q.pertanyaan;
            this.instructions = q.petunjuk || '';
            this.questionType = q.tipe;
            this.options = q.opsi ? JSON.parse(JSON.stringify(q.opsi)) : ['Opsi A', 'Opsi B'];
            this.points = q.poin !== null ? q.poin : 100;
            this.isUngraded = q.poin === null;
            this.dueDate = q.tenggat_tanggal || '';
            this.dueTime = q.tenggat_waktu || '';
            this.topic = q.topik || 'Tidak ada topik';
            this.canReply = q.bisa_melihat_rekap;
            this.canEdit = q.bisa_memperbaiki;
            this.selectedClass = q.kelas || 'Kimia Dasar I - Modul 01';
            this.activeTab = 'create';
            
            // Scroll to form smoothly
            document.getElementById('question-submit-form').scrollIntoView({behavior: 'smooth'});
        },
        resetForm() {
            this.editMode = false;
            this.editId = null;
            this.title = '';
            this.instructions = '';
            this.questionType = 'short_answer';
            this.options = ['Opsi A', 'Opsi B'];
            this.points = 100;
            this.isUngraded = false;
            this.dueDate = '2026-05-24';
            this.dueTime = '23:59';
            this.topic = 'Modul 01';
            this.canReply = true;
            this.canEdit = false;
            this.selectedClass = 'Kimia Dasar I - Modul 01';
        }
    }" class="max-w-7xl mx-auto space-y-8">

        <!-- Modern PCM Lab Header Banner (Transparent) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-6 border-b border-gray-200 dark:border-slate-800">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500/10 dark:bg-amber-500/20 rounded-2xl flex items-center justify-center text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white" x-text="editMode ? 'Edit Soal Pre-Test' : 'Kelola Soal Pre-Test'">Kelola Soal Pre-Test</h1>
                </div>
                <p class="text-sm text-slate-500 max-w-xl font-medium">Platform penyusunan soal ujian pre-test berbasis modul praktikum dengan sistem input terpadu.</p>
            </div>

            <!-- Tab Buttons in Banner -->
            <div class="flex bg-gray-100 dark:bg-slate-800 p-1 rounded-2xl shrink-0">
                <button @click="activeTab = 'create'" :class="activeTab === 'create' ? 'bg-white dark:bg-slate-700 text-amber-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all">
                    Buat Soal Baru
                </button>
                <button @click="activeTab = 'bank'" :class="activeTab === 'bank' ? 'bg-white dark:bg-slate-700 text-amber-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all">
                    Daftar Bank Soal
                </button>
            </div>
        </div>

        <!-- Create Mode -->
        <div x-show="activeTab === 'create'" class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <!-- Left Panel: Content -->
            <form id="question-submit-form" :action="editMode ? '/dosen/buat-soal/' + editId : '{{ route('dosen.buat-soal.store') }}'" method="POST" class="lg:col-span-2 space-y-8">
                @csrf
                
                <!-- Hidden inputs to submit Alpine state to Laravel controller -->
                <input type="hidden" name="tipe" :value="questionType">
                <input type="hidden" name="opsi" :value="JSON.stringify(options)">
                <input type="hidden" name="poin" :value="points">
                <input type="hidden" name="is_ungraded" :value="isUngraded ? 1 : 0">
                <input type="hidden" name="tenggat_tanggal" :value="dueDate">
                <input type="hidden" name="tenggat_waktu" :value="dueTime">
                <input type="hidden" name="topik" :value="topic">
                <input type="hidden" name="bisa_melihat_rekap" :value="canReply ? 1 : 0">
                <input type="hidden" name="bisa_memperbaiki" :value="canEdit ? 1 : 0">
                <input type="hidden" name="kelas" :value="selectedClass">
                <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                
                <!-- Main Input Card -->
                <div class="bg-white dark:bg-slate-900 border border-gray-150 dark:border-slate-800 rounded-[2.5rem] p-8 md:p-10 shadow-sm space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 dark:border-slate-800 pb-5">
                        <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-wider" x-text="editMode ? 'Edit Detail Soal' : 'Identifikasi Soal'">Identifikasi Soal</h3>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mr-2">Tipe Jawaban:</span>
                            <div class="inline-flex p-1 bg-gray-100 dark:bg-slate-800 rounded-xl">
                                <button type="button" @click="questionType = 'short_answer'" :class="questionType === 'short_answer' ? 'bg-white dark:bg-slate-700 text-amber-600 shadow-sm' : 'text-slate-500'" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all">Singkat</button>
                                <button type="button" @click="questionType = 'multiple_choice'" :class="questionType === 'multiple_choice' ? 'bg-white dark:bg-slate-700 text-amber-600 shadow-sm' : 'text-slate-500'" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all">Pilihan Ganda</button>
                            </div>
                        </div>
                    </div>

                    <!-- Question Input -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi Pertanyaan</label>
                        <input type="text" x-model="title" name="pertanyaan" required placeholder="Tuliskan butir soal disini..."
                               class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-semibold outline-none focus:ring-2 focus:ring-amber-500 focus:bg-white dark:focus:bg-slate-900 transition-all">
                    </div>

                    <!-- Instructions / Editor Panel -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Petunjuk Tambahan / Langkah Pengerjaan</label>
                        <textarea x-model="instructions" name="petunjuk" rows="4" placeholder="Tuliskan arahan langkah pengerjaan opsional bagi praktikan..."
                                  class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-sm font-medium outline-none focus:ring-2 focus:ring-amber-500 focus:bg-white dark:focus:bg-slate-900 transition-all"></textarea>
                    </div>

                    <!-- Dynamic Options based on Question Type -->
                    <div class="pt-6 border-t border-gray-100 dark:border-slate-800/60">
                        <!-- Short Answer Mode -->
                        <div x-show="questionType === 'short_answer'" x-transition class="flex items-center gap-3 p-5 bg-amber-50/50 dark:bg-amber-950/10 rounded-2xl border border-dashed border-amber-200 dark:border-amber-900/30">
                            <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            </div>
                            <span class="text-xs text-amber-600 dark:text-amber-500 font-bold uppercase tracking-wider">Praktikan akan menginputkan jawaban teks pendek secara langsung</span>
                        </div>

                        <!-- Multiple Choice Mode -->
                        <div x-show="questionType === 'multiple_choice'" x-transition class="space-y-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">Pilihan Alternatif Jawaban</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="(opt, idx) in options" :key="idx">
                                    <div class="flex items-center gap-3 bg-gray-50 dark:bg-slate-850 p-3 rounded-2xl border border-gray-100 dark:border-slate-800 group transition-all hover:border-amber-200 dark:hover:border-amber-900/30">
                                        <div class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 text-[10px] font-black shrink-0">
                                            <span x-text="String.fromCharCode(65 + idx)"></span>
                                        </div>
                                        <input type="text" x-model="options[idx]" :placeholder="'Opsi ' + String.fromCharCode(65 + idx)"
                                               class="flex-1 bg-transparent border-none p-0 text-sm font-semibold outline-none focus:ring-0">
                                        <button type="button" @click="removeOption(idx)" class="p-1 text-slate-400 hover:text-rose-500 transition-colors opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <button type="button" @click="addOption" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-amber-600 hover:text-amber-700 transition-all pt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Pilihan Jawaban
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Right Panel: Configurations -->
            <div class="space-y-6">
                <!-- Configurations Details Card -->
                <div class="bg-white dark:bg-slate-900 border border-gray-150 dark:border-slate-800 rounded-[2.5rem] p-8 shadow-sm space-y-6">
                    <h3 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-wider border-b border-gray-100 dark:border-slate-800 pb-4">Konfigurasi Target</h3>

                    <!-- Target Modul -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mata Kuliah / Modul</label>
                        <select x-model="selectedClass" class="w-full bg-gray-50 dark:bg-slate-850 border border-gray-200 dark:border-slate-750 rounded-2xl px-5 py-3 text-xs font-bold outline-none focus:ring-2 focus:ring-amber-500">
                            <option>Kimia Dasar I - Modul 01</option>
                            <option>Kimia Dasar I - Modul 02</option>
                            <option>Kimia Dasar I - Modul 03</option>
                        </select>
                    </div>

                    <!-- Poin / Points -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Poin Nilai</label>
                            <label class="inline-flex items-center gap-1.5 text-[11px] font-bold text-slate-500 cursor-pointer">
                                <input type="checkbox" x-model="isUngraded" class="w-3.5 h-3.5 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                                Tanpa Nilai
                            </label>
                        </div>
                        <input type="number" x-model="points" :disabled="isUngraded" :class="isUngraded ? 'bg-gray-100 dark:bg-slate-850 border-gray-150 dark:border-slate-800 text-slate-400 cursor-not-allowed' : 'bg-gray-50 dark:bg-slate-850 border-gray-200 dark:border-slate-750 focus:ring-2 focus:ring-amber-500'" 
                               class="w-full rounded-2xl px-5 py-3 text-xs font-bold outline-none transition-all">
                    </div>

                    <!-- Due Date -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Batas Pengumpulan (Tenggat)</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <input type="date" x-model="dueDate" class="w-full bg-gray-50 dark:bg-slate-850 border border-gray-200 dark:border-slate-750 rounded-2xl px-4 py-2.5 text-xs font-bold outline-none focus:ring-2 focus:ring-amber-500">
                            <input type="time" x-model="dueTime" class="w-full bg-gray-50 dark:bg-slate-850 border border-gray-200 dark:border-slate-750 rounded-2xl px-4 py-2.5 text-xs font-bold outline-none focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <!-- Topic / Grouping -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori Topik</label>
                        <select x-model="topic" class="w-full bg-gray-50 dark:bg-slate-850 border border-gray-200 dark:border-slate-750 rounded-2xl px-5 py-3 text-xs font-bold outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="Tidak ada topik">Tidak ada kategori</option>
                            <option value="Modul 01">Modul 01</option>
                            <option value="Modul 02">Modul 02</option>
                            <option value="Modul 03">Modul 03</option>
                        </select>
                    </div>

                    <!-- Custom Toggles Permissions -->
                    <div class="pt-4 border-t border-gray-150 dark:border-slate-800/60 space-y-3">
                        <label class="inline-flex items-start gap-2.5 text-xs text-slate-500 cursor-pointer">
                            <input type="checkbox" x-model="canReply" class="mt-0.5 w-4 h-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                            <span>Siswa dapat melihat rekap tanggapan</span>
                        </label>
                        <br>
                        <label class="inline-flex items-start gap-2.5 text-xs text-slate-500 cursor-pointer">
                            <input type="checkbox" x-model="canEdit" class="mt-0.5 w-4 h-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                            <span>Siswa dapat memperbaiki berkas jawaban</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2">
                    <button type="button" onclick="document.getElementById('question-submit-form').submit()" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-md shadow-amber-500/10 transition-all text-xs uppercase tracking-wider">
                        <span x-text="editMode ? 'Simpan Perubahan' : 'Terbitkan Pre-Test'">Terbitkan Pre-Test</span>
                    </button>
                    <template x-if="editMode">
                        <button type="button" @click="resetForm()" class="w-full py-2.5 bg-gray-100 dark:bg-slate-850 hover:bg-gray-200 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold rounded-xl transition-all text-xs uppercase tracking-wider">
                            Batal Edit
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Bank / Classwork View Tab -->
        <div x-show="activeTab === 'bank'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white dark:bg-slate-900 p-8 border border-gray-150 dark:border-slate-800 rounded-[2rem] shadow-sm gap-4">
                <div class="space-y-1">
                    <h2 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-wider">Bank Soal Terdaftar</h2>
                    <p class="text-xs text-slate-400 font-medium">Manajemen seluruh bank soal pre-test praktikum aktif berdasarkan topik.</p>
                </div>
                <button @click="resetForm(); activeTab = 'create';" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-amber-500/20">
                    + Tambah Baru
                </button>
            </div>

            <!-- List of Topics & Questions (PCM Style Accordion) -->
            <div class="space-y-4">
                @php
                    $groupedQuestions = $questions->groupBy(function($item) {
                        return $item->topik ?: 'Tidak ada kategori';
                    });
                @endphp

                @forelse($groupedQuestions as $topicName => $topicQuestions)
                    <div class="bg-white dark:bg-slate-900 border border-gray-150 dark:border-slate-800 rounded-[2rem] overflow-hidden shadow-sm">
                        <!-- Topic Header -->
                        <div @click="expandedTopic = (expandedTopic === '{{ $topicName }}' ? '' : '{{ $topicName }}')" class="flex justify-between items-center px-8 py-5 bg-gray-50/50 dark:bg-slate-800/20 cursor-pointer hover:bg-gray-100/50 dark:hover:bg-slate-800/40 transition-all border-b border-gray-100 dark:border-slate-800">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <span class="text-sm font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">{{ $topicName }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400 px-3 py-1 rounded-full uppercase tracking-wider">{{ $topicQuestions->count() }} Soal</span>
                                <svg :class="expandedTopic === '{{ $topicName }}' ? 'rotate-180' : ''" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                        <!-- Topic Content (Questions Accordion style) -->
                        <div x-show="expandedTopic === '{{ $topicName }}'" x-transition class="divide-y divide-gray-100 dark:divide-slate-800">
                            @foreach($topicQuestions as $q)
                                <div class="p-6 md:p-8 hover:bg-gray-50/20 dark:hover:bg-slate-800/10 transition-colors">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex gap-4">
                                            <div class="w-9 h-9 bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $q->pertanyaan }}</h4>
                                                <div class="flex flex-wrap items-center gap-3 text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                                    <span>Kelas: {{ $q->kelas }}</span>
                                                    <span>•</span>
                                                    <span>Poin: {{ $q->poin !== null ? $q->poin : 'Tanpa Nilai' }}</span>
                                                    <span>•</span>
                                                    <span>Tenggat: {{ $q->tenggat_tanggal ? \Carbon\Carbon::parse($q->tenggat_tanggal)->translatedFormat('d M Y') : 'Tanpa Tenggat' }} {{ $q->tenggat_waktu ? \Carbon\Carbon::parse($q->tenggat_waktu)->format('H:i') : '' }}</span>
                                                    <span>•</span>
                                                    <span class="text-amber-600 bg-amber-50 dark:bg-amber-950/40 px-2.5 py-0.5 rounded-full">{{ $q->tipe === 'multiple_choice' ? 'Pilihan Ganda' : 'Jawaban Singkat' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1 shrink-0">
                                            <!-- Edit Button Trigger -->
                                            <button type="button" @click="startEdit({
                                                id: {{ $q->id }},
                                                pertanyaan: {{ json_encode($q->pertanyaan) }},
                                                petunjuk: {{ json_encode($q->petunjuk ?? '') }},
                                                tipe: '{{ $q->tipe }}',
                                                opsi: {{ $q->opsi ? json_encode($q->opsi) : 'null' }},
                                                poin: {{ $q->poin !== null ? $q->poin : 'null' }},
                                                tenggat_tanggal: '{{ $q->tenggat_tanggal ?? '' }}',
                                                tenggat_waktu: '{{ $q->tenggat_waktu ?? '' }}',
                                                topik: {{ json_encode($q->topik ?? '') }},
                                                bisa_melihat_rekap: {{ $q->bisa_melihat_rekap ? 'true' : 'false' }},
                                                bisa_memperbaiki: {{ $q->bisa_memperbaiki ? 'true' : 'false' }},
                                                kelas: {{ json_encode($q->kelas ?? '') }}
                                            })" class="p-2 text-slate-400 hover:text-amber-500 rounded-xl hover:bg-gray-150 dark:hover:bg-slate-800 transition-colors" title="Edit Soal">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </button>

                                            <!-- Delete Button Trigger -->
                                            <form action="{{ route('dosen.buat-soal.delete', $q->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 rounded-xl hover:bg-gray-150 dark:hover:bg-slate-800 transition-colors" title="Hapus Soal">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-900 border border-gray-150 dark:border-slate-800 rounded-[2rem] p-10 text-center text-slate-400">
                        Belum ada soal pre-test terdaftar. Silakan buat baru!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
