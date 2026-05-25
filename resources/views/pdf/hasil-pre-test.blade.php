<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Pre-Test - {{ $user->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3, h4, p {
            margin: 0;
            padding: 0;
        }
        .text-blue { color: #1e3a8a; }
        .bg-blue { background-color: #1e3a8a; color: #fff; }
        
        .header-small { font-size: 10px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
        .title-main { font-size: 28px; font-weight: bold; margin: 5px 0; color: #1e3a8a; }
        .subtitle { font-size: 14px; color: #475569; margin-bottom: 20px; border-bottom: 1px solid #cbd5e1; padding-bottom: 15px; }
        
        .meta-info { width: 100%; font-size: 12px; margin-bottom: 30px; border-collapse: collapse; }
        .meta-info td { padding: 8px 10px; border-bottom: 1px solid #e2e8f0; }
        .meta-info td.label { font-weight: bold; color: #0f172a; width: 150px; background-color: #f8fafc; }
        
        .section-title { font-size: 16px; font-weight: bold; color: #0f172a; margin-top: 30px; margin-bottom: 15px; text-transform: uppercase; border-left: 4px solid #3b82f6; padding-left: 10px; }
        
        .score-box { border: 2px solid #cbd5e1; border-radius: 8px; padding: 30px; text-align: center; background-color: #f8fafc; margin-bottom: 30px; }
        .score-title { font-size: 12px; font-weight: bold; color: #64748b; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px; }
        .score-value { font-size: 64px; font-weight: bold; color: #1e3a8a; line-height: 1; }
        
        .badge-status { display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: bold; text-transform: uppercase; margin-top: 15px; }
        .badge-pass { background-color: #d1fae5; color: #059669; border: 1px solid #34d399; }
        .badge-fail { background-color: #fee2e2; color: #dc2626; border: 1px solid #f87171; }
        
        .disclaimer { font-size: 11px; color: #64748b; padding: 15px; background-color: #f1f5f9; border-radius: 6px; margin-top: 40px; }
        .footer { font-size: 10px; color: #94a3b8; text-align: left; margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 15px; }
    </style>
</head>
<body>

    <div class="header-small">Sistem Informasi Manajemen Laboratorium Terpadu</div>
    <div class="title-main">PCM-LAB</div>
    <div class="subtitle">Sertifikat / Bukti Kehadiran & Hasil Pre-Test Praktikum</div>

    <div class="section-title">Informasi Peserta</div>
    <table class="meta-info">
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td class="label">NIM / ID</td>
            <td>{{ $user->nim ?? ($user->phone ?? '-') }}</td>
        </tr>
        <tr>
            <td class="label">Program Studi</td>
            <td>{{ $user->prodi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pelaksanaan</td>
            <td>{{ $date }}</td>
        </tr>
        <tr>
            <td class="label">Mata Kuliah Praktikum</td>
            <td>Modul Dasar - (Otomatis terhubung dari sesi)</td>
        </tr>
    </table>

    <div class="section-title">Hasil Evaluasi</div>
    <div class="score-box">
        <div class="score-title">Nilai Akhir Pre-Test</div>
        <div class="score-value">{{ $score }}</div>
        
        @if($score >= 70)
            <div class="badge-status badge-pass">Lulus Ujian (Tuntas)</div>
        @else
            <div class="badge-status badge-fail">Perlu Perbaikan (Remedial)</div>
        @endif
    </div>

    <div class="disclaimer">
        <strong>Pernyataan Otentikasi Dokumen:</strong><br>
        Dokumen ini diterbitkan secara otomatis oleh sistem PCM-LAB sebagai bukti sah bahwa mahasiswa yang bersangkutan telah menyelesaikan Pre-Test sebelum memulai praktikum di laboratorium. Dokumen ini dapat digunakan sebagai lampiran presensi jika diperlukan.
    </div>

    <div class="footer">
        <table style="width: 100%;">
            <tr>
                <td>PCM-LAB &copy; {{ date('Y') }} - Laboratorium Teknologi</td>
                <td style="text-align: right;">ID Dokumen: PRE-{{ strtoupper(substr(md5($user->id . $date), 0, 8)) }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
