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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-6 border-b-[3px] border-slate-900 dark:border-white">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-400 border-[3px] border-slate-900 dark:border-white rounded-xl flex items-center justify-center text-slate-900 shadow-[2px_2px_0px_#000]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-black uppercase tracking-tight text-slate-900 dark:text-white" x-text="editMode ? 'Edit Soal Pre-Test' : 'Kelola Soal Pre-Test'">Kelola Soal Pre-Test</h1>
                </div>
                <p class="text-sm text-slate-650 dark:text-slate-350 max-w-xl font-bold">Platform penyusunan soal ujian pre-test berbasis modul praktikum dengan sistem input terpadu.</p>
            </div>

            <!-- Tab Buttons in Banner -->
            <div class="flex bg-gray-150 dark:bg-slate-800 p-1 border-[3px] border-slate-900 dark:border-white rounded-xl shrink-0">
                <button @click="activeTab = 'create'" :class="activeTab === 'create' ? 'bg-amber-450 text-slate-900 border-2 border-slate-900 dark:border-white shadow-[2px_2px_0px_#000]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'" class="px-5 py-2.5 rounded-lg text-xs font-black uppercase tracking-wider transition-all">
                    Buat Soal Baru
                </button>
                <button @click="activeTab = 'bank'" :class="activeTab === 'bank' ? 'bg-amber-450 text-slate-900 border-2 border-slate-900 dark:border-white shadow-[2px_2px_0px_#000]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'" class="px-5 py-2.5 rounded-lg text-xs font-black uppercase tracking-wider transition-all">
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
                <div class="p-8 md:p-10 neu-card space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b-[3px] border-slate-900 dark:border-white pb-5">
                        <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider" x-text="editMode ? 'Edit Detail Soal' : 'Identifikasi Soal'">Identifikasi Soal</h3>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-black text-slate-500 dark:text-slate-450 uppercase tracking-widest mr-2">Tipe Jawaban:</span>
                            <div class="inline-flex p-1 bg-gray-150 dark:bg-slate-800 border-2 border-slate-900 dark:border-white rounded-xl">
                                <button type="button" @click="questionType = 'short_answer'" :class="questionType === 'short_answer' ? 'bg-amber-400 text-slate-900 border-2 border-slate-900 dark:border-white shadow-[1px_1px_0px_#000]' : 'text-slate-500 dark:text-slate-400'" class="px-3.5 py-1.5 rounded-lg text-xs font-black transition-all">Singkat</button>
                                <button type="button" @click="questionType = 'multiple_choice'" :class="questionType === 'multiple_choice' ? 'bg-amber-400 text-slate-900 border-2 border-slate-900 dark:border-white shadow-[1px_1px_0px_#000]' : 'text-slate-500 dark:text-slate-400'" class="px-3.5 py-1.5 rounded-lg text-xs font-black transition-all">Pilihan Ganda</button>
                            </div>
                        </div>
                    </div>

                    <!-- Question Input -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Deskripsi Pertanyaan</label>
                        <input type="text" x-model="title" name="pertanyaan" required placeholder="Tuliskan butir soal disini..."
                               class="w-full neu-input px-6 py-4 text-sm font-black">
                    </div>

                    <!-- Instructions / Editor Panel -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Petunjuk Tambahan / Langkah Pengerjaan</label>
                        <textarea x-model="instructions" name="petunjuk" rows="4" placeholder="Tuliskan arahan langkah pengerjaan opsional bagi praktikan..."
                                  class="w-full neu-input px-6 py-4 text-sm font-black"></textarea>
                    </div>

                    <!-- Dynamic Options based on Question Type -->
                    <div class="pt-6 border-t-[3px] border-slate-900 dark:border-white">
                        <!-- Short Answer Mode -->
                        <div x-show="questionType === 'short_answer'" x-transition class="flex items-center gap-3 p-5 bg-amber-100 dark:bg-amber-950 border-[3px] border-dashed border-slate-900 dark:border-white rounded-xl shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                            <div class="w-8 h-8 rounded-lg border-2 border-slate-900 dark:border-white bg-amber-400 flex items-center justify-center text-slate-900 shrink-0 shadow-[1px_1px_0px_#000]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            </div>
                            <span class="text-xs text-slate-900 dark:text-amber-400 font-black uppercase tracking-wider">Praktikan akan menginputkan jawaban teks pendek secara langsung</span>
                        </div>

                        <!-- Multiple Choice Mode -->
                        <div x-show="questionType === 'multiple_choice'" x-transition class="space-y-4">
                            <span class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest block ml-1">Pilihan Alternatif Jawaban</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="(opt, idx) in options" :key="idx">
                                    <div class="flex items-center gap-3 bg-white dark:bg-slate-900 p-3 rounded-xl border-[3px] border-slate-900 dark:border-white group shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all">
                                        <div class="w-6 h-6 rounded-md border-2 border-slate-900 dark:border-white bg-amber-400 flex items-center justify-center text-slate-900 text-[10px] font-black shrink-0">
                                            <span x-text="String.fromCharCode(65 + idx)"></span>
                                        </div>
                                        <input type="text" x-model="options[idx]" :placeholder="'Opsi ' + String.fromCharCode(65 + idx)"
                                               class="flex-1 bg-transparent border-none p-0 text-sm font-black outline-none focus:ring-0 text-slate-900 dark:text-white">
                                        <button type="button" @click="removeOption(idx)" class="p-1 text-slate-500 hover:text-rose-600 transition-colors opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <button type="button" @click="addOption" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white px-4 py-2 rounded-lg bg-amber-400 hover:bg-amber-500 shadow-[2px_2px_0px_#000] transition-all cursor-pointer">
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
                <div class="p-8 neu-card space-y-6">
                    <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider border-b-[3px] border-slate-900 dark:border-white pb-4">Konfigurasi Target</h3>

                    <!-- Target Modul -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Mata Kuliah / Modul</label>
                        <select x-model="selectedClass" class="w-full neu-input px-5 py-3 text-xs font-black text-slate-900 dark:text-white">
                            <option>Kimia Dasar I - Modul 01</option>
                            <option>Kimia Dasar I - Modul 02</option>
                            <option>Kimia Dasar I - Modul 03</option>
                        </select>
                    </div>

                    <!-- Poin / Points -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Poin Nilai</label>
                            <label class="inline-flex items-center gap-1.5 text-[11px] font-black text-slate-650 dark:text-slate-400 cursor-pointer">
                                <input type="checkbox" x-model="isUngraded" class="w-3.5 h-3.5 text-amber-500 border-2 border-slate-900 dark:border-white rounded focus:ring-amber-500 bg-white dark:bg-slate-800">
                                Tanpa Nilai
                            </label>
                        </div>
                        <input type="number" x-model="points" :disabled="isUngraded" 
                               class="w-full neu-input px-5 py-3 text-xs font-black text-slate-900 dark:text-white disabled:opacity-50 disabled:cursor-not-allowed">
                    </div>

                    <!-- Due Date -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Batas Pengumpulan (Tenggat)</label>
                        <div class="grid grid-cols-1 gap-2">
                            <input type="date" x-model="dueDate" class="w-full neu-input px-4 py-2.5 text-xs font-black">
                            <input type="time" x-model="dueTime" class="w-full neu-input px-4 py-2.5 text-xs font-black">
                        </div>
                    </div>

                    <!-- Topic / Grouping -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">Kategori Topik</label>
                        <select x-model="topic" class="w-full neu-input px-5 py-3 text-xs font-black text-slate-900 dark:text-white">
                            <option value="Tidak ada topik">Tidak ada kategori</option>
                            <option value="Modul 01">Modul 01</option>
                            <option value="Modul 02">Modul 02</option>
                            <option value="Modul 03">Modul 03</option>
                        </select>
                    </div>

                    <!-- Custom Toggles Permissions -->
                    <div class="pt-4 border-t-[3px] border-slate-900 dark:border-white space-y-3">
                        <label class="inline-flex items-start gap-2.5 text-xs font-bold text-slate-650 dark:text-slate-400 cursor-pointer">
                            <input type="checkbox" x-model="canReply" class="mt-0.5 w-4 h-4 text-amber-500 border-2 border-slate-900 dark:border-white rounded focus:ring-amber-500 bg-white dark:bg-slate-800">
                            <span>Siswa dapat melihat rekap tanggapan</span>
                        </label>
                        <br>
                        <label class="inline-flex items-start gap-2.5 text-xs font-bold text-slate-650 dark:text-slate-400 cursor-pointer">
                            <input type="checkbox" x-model="canEdit" class="mt-0.5 w-4 h-4 text-amber-500 border-2 border-slate-900 dark:border-white rounded focus:ring-amber-500 bg-white dark:bg-slate-800">
                            <span>Siswa dapat memperbaiki berkas jawaban</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2">
                    <button type="button" onclick="document.getElementById('question-submit-form').submit()" class="w-full py-3 bg-amber-400 text-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl text-xs font-black uppercase tracking-wider neu-btn">
                        <span x-text="editMode ? 'Simpan Perubahan' : 'Terbitkan Pre-Test'">Terbitkan Pre-Test</span>
                    </button>
                    <template x-if="editMode">
                        <button type="button" @click="resetForm()" class="w-full py-2.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[3px] border-slate-900 dark:border-white rounded-xl text-xs font-black uppercase tracking-wider shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_#000] transition-all">
                            Batal Edit
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Bank / Classwork View Tab -->
        <div x-show="activeTab === 'bank'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-8 neu-card gap-4">
                <div class="space-y-1">
                    <h2 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider">Bank Soal Terdaftar</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-bold">Manajemen seluruh bank soal pre-test praktikum aktif berdasarkan topik.</p>
                </div>
                <button @click="resetForm(); activeTab = 'create';" class="px-6 py-3 bg-amber-450 text-slate-900 border-[3px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-widest rounded-xl transition-all neu-btn">
                    + Tambah Baru
                </button>
            </div>

            <!-- Excel Import/Export Panel (Neobrutalist Card) -->
            <div class="p-8 neu-card bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg border-2 border-slate-900 dark:border-white bg-blue-400 flex items-center justify-center text-slate-900 text-sm font-black">
                                📊
                            </div>
                            <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Unggah & Unduh Bank Soal (Excel/CSV)</h3>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold max-w-xl">
                            Kelola bank soal dalam jumlah besar sekaligus menggunakan file Excel (.xlsx, .xls) atau CSV. Gunakan berkas template kami sebagai format acuan pengisian data soal.
                        </p>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
                        <!-- Export Button -->
                        <a href="{{ route('dosen.buat-soal.export') }}" class="px-5 py-3 bg-blue-400 text-slate-900 border-[2.5px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-wider rounded-lg shadow-[2.5px_2.5px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3.5px_3.5px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all flex items-center gap-2">
                            <span>📥 Export Excel</span>
                        </a>
                        
                        <!-- Download Template Button -->
                        <a href="{{ route('dosen.buat-soal.export', ['template' => 1]) }}" class="px-5 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-[2.5px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-wider rounded-lg shadow-[2.5px_2.5px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3.5px_3.5px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all flex items-center gap-2">
                            <span>📄 Unduh Template</span>
                        </a>

                        <!-- Import Form -->
                        <form action="{{ route('dosen.buat-soal.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2 flex-1 lg:flex-none">
                            @csrf
                            <input type="file" name="file_soal" required class="hidden" id="excel-file-input" onchange="this.form.submit()">
                            <button type="button" onclick="document.getElementById('excel-file-input').click()" class="px-5 py-3 bg-amber-450 text-slate-900 border-[2.5px] border-slate-900 dark:border-white text-xs font-black uppercase tracking-wider rounded-lg shadow-[2.5px_2.5px_0px_#000] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[3.5px_3.5px_0px_#000] active:translate-x-[1px] active:translate-y-[1px] active:shadow-[1px_1px_0px_#000] transition-all flex items-center gap-2 cursor-pointer">
                                <span>📤 Unggah Excel</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List of Topics & Questions (PCM Style Accordion) -->
            <div class="space-y-4">
                @php
                    $groupedQuestions = $questions->groupBy(function($item) {
                        return $item->topik ?: 'Tidak ada kategori';
                    });
                @endphp

                @forelse($groupedQuestions as $topicName => $topicQuestions)
                    <div class="neu-card overflow-hidden">
                        <!-- Topic Header -->
                        <div @click="expandedTopic = (expandedTopic === '{{ $topicName }}' ? '' : '{{ $topicName }}')" class="flex justify-between items-center px-8 py-5 bg-gray-50 dark:bg-slate-800 cursor-pointer border-b-[3px] border-slate-900 dark:border-white">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl border-2 border-slate-900 dark:border-white bg-amber-450 flex items-center justify-center shrink-0 shadow-[1px_1px_0px_#000]">
                                    <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <span class="text-sm font-black uppercase tracking-wider text-slate-900 dark:text-white">{{ $topicName }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black bg-amber-450 text-slate-900 border-2 border-slate-900 dark:border-white px-3 py-1 rounded-full uppercase tracking-wider shadow-[2px_2px_0px_#000]">{{ $topicQuestions->count() }} Soal</span>
                                <svg :class="expandedTopic === '{{ $topicName }}' ? 'rotate-180' : ''" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                        <!-- Topic Content (Questions Accordion style) -->
                        <div x-show="expandedTopic === '{{ $topicName }}'" x-transition class="divide-y-[3px] divide-slate-900 dark:divide-white">
                            @foreach($topicQuestions as $q)
                                <div class="p-6 md:p-8 hover:bg-gray-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex gap-4">
                                            <div class="w-9 h-9 bg-amber-450 border-2 border-slate-900 dark:border-white text-slate-900 rounded-full flex items-center justify-center shrink-0 shadow-[1px_1px_0px_#000]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wide">{{ $q->pertanyaan }}</h4>
                                                <div class="flex flex-wrap items-center gap-3 text-[10px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-wider">
                                                    <span>Kelas: {{ $q->kelas }}</span>
                                                    <span>•</span>
                                                    <span>Poin: {{ $q->poin !== null ? $q->poin : 'Tanpa Nilai' }}</span>
                                                    <span>•</span>
                                                    <span>Tenggat: {{ $q->tenggat_tanggal ? \Carbon\Carbon::parse($q->tenggat_tanggal)->translatedFormat('d M Y') : 'Tanpa Tenggat' }} {{ $q->tenggat_waktu ? \Carbon\Carbon::parse($q->tenggat_waktu)->format('H:i') : '' }}</span>
                                                    <span>•</span>
                                                    <span class="text-slate-900 bg-amber-450 border-2 border-slate-900 dark:border-white px-2.5 py-0.5 rounded-full">{{ $q->tipe === 'multiple_choice' ? 'Pilihan Ganda' : 'Jawaban Singkat' }}</span>
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
                                            })" class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-white dark:bg-slate-800 hover:bg-amber-450 hover:text-slate-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all" title="Edit Soal">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </button>

                                            <!-- Delete Button Trigger -->
                                            <form action="{{ route('dosen.buat-soal.delete', $q->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-900 dark:text-white border-2 border-slate-900 dark:border-white rounded-lg bg-white dark:bg-slate-800 hover:bg-rose-450 hover:text-slate-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] transition-all" title="Hapus Soal">
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
                    <div class="p-10 text-center text-slate-500 font-bold bg-white dark:bg-slate-900 border-[3px] border-slate-900 dark:border-white rounded-xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                        Belum ada soal pre-test terdaftar. Silakan buat baru!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
