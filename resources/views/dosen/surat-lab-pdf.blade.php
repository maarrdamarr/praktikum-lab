<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Penggunaan Lab — {{ $jadwal->nomor_surat }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000;
            padding: 2cm 2.5cm;
            background: #fff;
        }

        /* ─── HEADER ─── */
        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 4px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .kop-logo {
            width: 80px;
            height: 80px;
            border: 2px solid #000;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28pt;
            font-weight: 900;
            color: #b91c1c;
            border-radius: 4px;
        }
        .kop-teks { flex: 1; }
        .kop-universitas {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kop-prodi {
            font-size: 10pt;
            font-weight: bold;
            color: #333;
        }
        .kop-alamat {
            font-size: 8.5pt;
            color: #555;
            margin-top: 3px;
        }

        /* ─── JUDUL ─── */
        .judul-surat {
            text-align: center;
            margin: 20px 0 6px;
        }
        .judul-surat h2 {
            font-size: 14pt;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: underline;
        }
        .nomor-surat {
            text-align: center;
            font-size: 10pt;
            color: #444;
            margin-bottom: 24px;
        }

        /* ─── BODY ─── */
        .pembuka {
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .tabel-detail {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0 24px;
            font-size: 11pt;
        }
        .tabel-detail td {
            padding: 6px 8px;
            vertical-align: top;
        }
        .tabel-detail td:first-child {
            width: 35%;
            font-weight: bold;
        }
        .tabel-detail td:nth-child(2) {
            width: 5%;
            text-align: center;
        }
        .tabel-detail tr:nth-child(odd) td {
            background: #f8f8f8;
        }
        .tabel-detail .highlight-row td {
            background: #fef9c3;
            border-left: 3px solid #ca8a04;
        }

        /* ─── BOX STATUS ─── */
        .status-box {
            border: 2px solid #000;
            border-radius: 4px;
            padding: 12px 16px;
            margin: 16px 0;
            background: #f0fdf4;
        }
        .status-box .label {
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #166534;
            margin-bottom: 4px;
        }
        .status-box .value {
            font-size: 13pt;
            font-weight: 900;
            color: #15803d;
        }

        /* ─── PENUTUP ─── */
        .penutup {
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        /* ─── TANDA TANGAN ─── */
        .ttd-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .ttd-box {
            text-align: center;
            width: 44%;
        }
        .ttd-box .ttd-title {
            font-size: 10pt;
            margin-bottom: 4px;
        }
        .ttd-box .ttd-date {
            font-size: 9pt;
            color: #555;
            margin-bottom: 60px;
        }
        .ttd-box .ttd-name {
            font-weight: bold;
            border-top: 2px solid #000;
            padding-top: 6px;
            font-size: 11pt;
        }
        .ttd-box .ttd-nip {
            font-size: 9pt;
            color: #555;
        }

        /* ─── FOOTER ─── */
        .footer-surat {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 8px;
            font-size: 8pt;
            color: #888;
            text-align: center;
        }

        /* ─── WATERMARK ─── */
        .watermark {
            position: fixed;
            top: 40%;
            left: 10%;
            width: 80%;
            text-align: center;
            font-size: 72pt;
            font-weight: 900;
            color: rgba(185, 28, 28, 0.05);
            transform: rotate(-30deg);
            z-index: -1;
            text-transform: uppercase;
            letter-spacing: 10px;
        }
    </style>
</head>
<body>

    <div class="watermark">PCM LAB</div>

    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <div class="kop-logo">PCM</div>
        <div class="kop-teks">
            <div class="kop-universitas">Universitas / Institut Praktikum</div>
            <div class="kop-prodi">Laboratorium PCM — Pusat Pengujian & Penelitian</div>
            <div class="kop-alamat">Jl. Laboratorium No. 1, Gedung Sains, Lt. 2 | Telp. (021) 000-0000 | lab@pcm.ac.id</div>
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="judul-surat">
        <h2>Surat Izin Penggunaan Laboratorium</h2>
    </div>
    <div class="nomor-surat">Nomor: {{ $jadwal->nomor_surat ?? 'PCM-LAB/'.date('Y/m').'/0001' }}</div>

    {{-- PEMBUKA --}}
    <p class="pembuka">
        Yang bertanda tangan di bawah ini, Kepala Laboratorium PCM, dengan ini memberikan izin penggunaan
        fasilitas laboratorium kepada dosen yang namanya tercantum di bawah ini, untuk melaksanakan kegiatan
        praktikum sesuai dengan jadwal yang telah ditetapkan.
    </p>

    {{-- DETAIL JADWAL --}}
    <table class="tabel-detail">
        <tr>
            <td>Nama Dosen</td>
            <td>:</td>
            <td><strong>{{ $jadwal->dosen ? $jadwal->dosen->name : 'Tidak ditentukan' }}</strong></td>
        </tr>
        <tr>
            <td>Email / NIP</td>
            <td>:</td>
            <td>{{ $jadwal->dosen ? $jadwal->dosen->email : '-' }}</td>
        </tr>
        <tr>
            <td>Mata Kuliah / Modul</td>
            <td>:</td>
            <td>{{ $jadwal->mata_kuliah ?? '-' }} {{ $jadwal->modul ? '— '.$jadwal->modul : '' }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{ $jadwal->kelas ?? '-' }}</td>
        </tr>
        <tr class="highlight-row">
            <td>Hari</td>
            <td>:</td>
            <td><strong>{{ $jadwal->hari }}</strong></td>
        </tr>
        <tr class="highlight-row">
            <td>Waktu Penggunaan</td>
            <td>:</td>
            <td><strong>{{ substr($jadwal->jam_mulai,0,5) }} – {{ substr($jadwal->jam_selesai,0,5) }} WIB</strong></td>
        </tr>
        <tr class="highlight-row">
            <td>Ruangan</td>
            <td>:</td>
            <td><strong>{{ $jadwal->ruangan ? $jadwal->ruangan->nama : 'Belum ditentukan' }}</strong>
                @if($jadwal->ruangan)
                    (Kapasitas: {{ $jadwal->ruangan->kapasitas }} orang)
                @endif
            </td>
        </tr>
        <tr>
            <td>Nomor Surat</td>
            <td>:</td>
            <td>{{ $jadwal->nomor_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Diterbitkan</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</td>
        </tr>
    </table>

    {{-- STATUS --}}
    <div class="status-box">
        <div class="label">✓ Status Izin</div>
        <div class="value">DISETUJUI — Sah untuk digunakan</div>
    </div>

    {{-- PENUTUP --}}
    <p class="penutup">
        Surat izin ini diterbitkan untuk keperluan penggunaan fasilitas laboratorium sebagaimana tercantum di atas.
        Mohon untuk mematuhi tata tertib laboratorium, menjaga kebersihan, serta melaporkan kerusakan alat kepada
        petugas laboratorium. Surat ini berlaku hanya untuk jadwal yang disebutkan dan tidak dapat dipindahtangankan.
    </p>

    {{-- TANDA TANGAN --}}
    <div class="ttd-section">
        <div class="ttd-box">
            <div class="ttd-title">Dosen Pemohon,</div>
            <div class="ttd-date">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</div>
            <div class="ttd-name">{{ $jadwal->dosen ? $jadwal->dosen->name : '___________________' }}</div>
            <div class="ttd-nip">NIP/NIDN: {{ $jadwal->dosen ? ($jadwal->dosen->nip ?? '-') : '-' }}</div>
        </div>
        <div class="ttd-box">
            <div class="ttd-title">Kepala Laboratorium,</div>
            <div class="ttd-date">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</div>
            <div class="ttd-name">Kepala Lab PCM</div>
            <div class="ttd-nip">NIP: —</div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer-surat">
        Dokumen ini diterbitkan secara otomatis oleh Sistem Informasi Laboratorium PCM.
        Surat ini sah tanpa tanda tangan basah jika dicetak dari sistem resmi.
        | {{ $jadwal->nomor_surat }} | Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
    </div>

    {{-- PRINT BUTTON (hidden when printing) --}}
    <div class="no-print" style="position:fixed;bottom:24px;right:24px;display:flex;gap:12px;z-index:999;">
        <button onclick="window.print()" style="padding:12px 24px;background:#b91c1c;color:#fff;border:3px solid #000;border-radius:10px;font-weight:900;font-size:11pt;cursor:pointer;box-shadow:4px 4px 0 #000;font-family:sans-serif;">
            🖨️ Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" style="padding:12px 24px;background:#fff;color:#000;border:3px solid #000;border-radius:10px;font-weight:900;font-size:11pt;cursor:pointer;box-shadow:4px 4px 0 #000;font-family:sans-serif;">
            ✕ Tutup
        </button>
    </div>

    <script>
        // Tambahkan CSS untuk menyembunyikan tombol saat print
        const style = document.createElement('style');
        style.innerHTML = '@media print { .no-print { display: none !important; } body { padding: 1cm !important; } }';
        document.head.appendChild(style);
    </script>

</body>
</html>
