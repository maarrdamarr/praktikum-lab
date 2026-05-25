<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penggunaan Lab</title>
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
        .text-blue { color: #1e3a8a; } /* Tailwind blue-900 */
        .text-gray { color: #64748b; }
        .text-green { color: #10b981; }
        .bg-blue { background-color: #1e3a8a; color: #fff; }
        .bg-light { background-color: #f8fafc; }
        
        .header-small { font-size: 10px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
        .title-main { font-size: 28px; font-weight: bold; margin: 5px 0; color: #1e3a8a; }
        .subtitle { font-size: 14px; color: #475569; margin-bottom: 20px; border-bottom: 1px solid #cbd5e1; padding-bottom: 15px; }
        
        .meta-info { width: 100%; font-size: 11px; margin-bottom: 30px; }
        .meta-info td { padding-right: 20px; }
        
        .section-title { font-size: 16px; font-weight: bold; color: #0f172a; margin-top: 30px; margin-bottom: 15px; text-transform: uppercase; border-left: 4px solid #3b82f6; padding-left: 10px; }
        
        /* Cards using tables for dompdf compatibility */
        .cards-table { width: 100%; border-collapse: separate; border-spacing: 15px 0; margin-left: -15px; margin-bottom: 30px; }
        .card { border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; background-color: #f8fafc; width: 33%; vertical-align: top; }
        .card-title { font-size: 10px; font-weight: bold; color: #64748b; text-transform: uppercase; margin-bottom: 10px; }
        .card-value { font-size: 24px; font-weight: bold; color: #1e3a8a; margin-bottom: 5px; }
        .card-desc { font-size: 10px; font-weight: bold; color: #10b981; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 12px; }
        table.data-table th { background-color: #1e3a8a; color: white; padding: 10px; text-align: left; font-size: 11px; text-transform: uppercase; }
        table.data-table td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
        table.data-table tr:nth-child(even) td { background-color: #f8fafc; }
        
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .badge-green { background-color: #d1fae5; color: #059669; }
        .badge-blue { background-color: #dbeafe; color: #2563eb; }
        .badge-yellow { background-color: #fef3c7; color: #d97706; }
        
        .footer { font-size: 10px; color: #94a3b8; text-align: left; margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 15px; }
    </style>
</head>
<body>

    <div class="header-small">Sistem Informasi Manajemen Laboratorium Terpadu</div>
    <div class="title-main">PCM-LAB</div>
    <div class="subtitle">Laporan Operasional & Penggunaan Infrastruktur Teknologi</div>

    <table class="meta-info">
        <tr>
            <td><strong>Jenis Dokumen:</strong> Laporan Penggunaan Lab</td>
            <td><strong>Periode:</strong> {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} (Semester Berjalan)</td>
            <td><strong>Klasifikasi:</strong> Internal Akademik</td>
        </tr>
    </table>

    <div class="section-title">1. Ringkasan Eksekutif Operasional</div>
    <table class="cards-table">
        <tr>
            <td class="card">
                <div class="card-title">Total Penggunaan Lab</div>
                <div class="card-value">{{ number_format($totalPenggunaanLab, 0, ',', '.') }} Jam</div>
                <div class="card-desc">&#9650; 15% dari semester lalu</div>
            </td>
            <td class="card">
                <div class="card-title">Rata-Rata Pengguna</div>
                <div class="card-value">{{ number_format($rataPengguna, 0, ',', '.') }} Mhs / Hari</div>
                <div class="card-desc">&#9650; 8% volume harian</div>
            </td>
            <td class="card">
                <div class="card-title">Pengguna Aktif</div>
                <div class="card-value">{{ number_format($penggunaAktif, 0, ',', '.') }} Orang</div>
                <div class="card-desc" style="color: #64748b;">Bulan Berjalan</div>
            </td>
        </tr>
    </table>

    <div class="section-title">2. Tingkat Utilisasi Perangkat</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Kategori Perangkat</th>
                <th>Jumlah Unit Aktif</th>
                <th>Persentase Kapasitas</th>
                <th>Status Beban</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PC Workstation (Lab A & B)</td>
                <td>80 Unit</td>
                <td>78%</td>
                <td><span class="badge badge-green">Optimal</span></td>
            </tr>
            <tr>
                <td>Laptop Lab Mandiri</td>
                <td>45 Unit</td>
                <td>62%</td>
                <td><span class="badge badge-blue">Normal</span></td>
            </tr>
            <tr>
                <td>Server Utama GPGPU</td>
                <td>4 Node</td>
                <td>85%</td>
                <td><span class="badge badge-yellow">Beban Tinggi</span></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">3. Jadwal Pelaksanaan Praktikum Harian</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Waktu / Jam</th>
                <th>Mata Kuliah / Kegiatan</th>
                <th>Lokasi Ruang</th>
                <th>Status Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalHarian as $jadwal)
            <tr>
                <td>{{ $jadwal->jam_mulai_format }} - {{ $jadwal->jam_selesai_format }}</td>
                <td>{{ $jadwal->mata_kuliah ?: 'Praktikum Reguler' }} {{ $jadwal->kelas ? '('.$jadwal->kelas.')' : '' }}</td>
                <td>{{ $jadwal->ruangan->nama ?? 'Belum diset' }}</td>
                <td>
                    @if(strtotime($jadwal->jam_selesai) < time())
                        <span class="badge badge-green">Selesai</span>
                    @else
                        <span class="badge badge-blue">Berjalan</span>
                    @endif
                </td>
            </tr>
            @endforeach
            @if($jadwalHarian->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; font-style: italic;">Belum ada jadwal yang tercatat.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <table style="width: 100%;">
            <tr>
                <td>PCM-LAB &copy; {{ date('Y') }} - Sistem Manajemen Laboratorium Teknologi</td>
                <td style="text-align: right;">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
