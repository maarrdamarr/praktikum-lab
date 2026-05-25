<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panduan Import Mahasiswa</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            margin: 20px;
            font-size: 11pt;
            line-height: 1.5;
        }
        .header {
            border-bottom: 3px solid #0f172a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            color: #0f172a;
            margin: 0;
        }
        .subtitle {
            font-size: 10pt;
            color: #64748b;
            margin: 5px 0 0 0;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            border-left: 4px solid #f43f5e;
            padding-left: 8px;
            margin: 20px 0 10px 0;
            color: #0f172a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f1f5f9;
            font-weight: bold;
            color: #0f172a;
            font-size: 10pt;
        }
        td {
            font-size: 9.5pt;
        }
        .required {
            color: #ef4444;
            font-weight: bold;
        }
        .optional {
            color: #64748b;
            font-style: italic;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            background-color: #e2e8f0;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
        }
        .alert-box {
            background-color: #fffbeb;
            border: 2px solid #f59e0b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-title {
            font-weight: bold;
            color: #b45309;
            margin-bottom: 5px;
            font-size: 10pt;
            text-transform: uppercase;
        }
        .alert-content {
            font-size: 9pt;
            color: #78350f;
        }
    </style>
</head>
<body>

    <div class="header">
        <p class="subtitle">Panduan Format Pengisian Data</p>
        <h1 class="title">Template Import Akun Mahasiswa</h1>
    </div>

    <div class="alert-box">
        <div class="alert-title">⚠️ PERHATIAN SEBELUM MENGUNGGAH</div>
        <div class="alert-content">
            Pastikan file Excel Anda menggunakan format ekstensi <strong>.xlsx</strong>, <strong>.xls</strong>, atau <strong>.csv</strong>. Baris pertama data Anda wajib berupa header kolom seperti yang tercantum pada tabel di bawah ini. Jangan mengubah urutan kolom ataupun menghapus baris header pertama.
        </div>
    </div>

    <div class="section-title">Struktur Kolom Excel</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Kolom</th>
                <th style="width: 15%;">Tipe Data</th>
                <th style="width: 15%;">Keterangan</th>
                <th style="width: 40%;">Aturan &amp; Batasan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><strong>Nama</strong></td>
                <td><span class="required">Wajib</span></td>
                <td>Nama Lengkap</td>
                <td>Berupa teks bebas (contoh: <code>Ahmad Fauzi</code>). Maksimal 255 karakter.</td>
            </tr>
            <tr>
                <td>2</td>
                <td><strong>NIM</strong></td>
                <td><span class="required">Wajib</span></td>
                <td>Nomor Induk</td>
                <td>Harus unik dan belum terdaftar. Digunakan sebagai <strong>username</strong> dan password default saat pertama kali login.</td>
            </tr>
            <tr>
                <td>3</td>
                <td><strong>Email</strong></td>
                <td><span class="required">Wajib</span></td>
                <td>Email Institusi</td>
                <td>Harus berupa format email valid dan unik (contoh: <code>ahmad@univ.ac.id</code>).</td>
            </tr>
            <tr>
                <td>4</td>
                <td><strong>Program Studi</strong></td>
                <td><span class="optional">Opsional</span></td>
                <td>Nama Prodi</td>
                <td>
                    Wajib diisi sesuai dengan pilihan prodi yang valid:
                    <br><span class="badge">Teknik Informatika</span>
                    <br><span class="badge">Sistem Informasi</span>
                    <br><span class="badge">Pendidikan Teknologi Informasi</span>
                    <br>(Default apabila dikosongkan: <em>Teknik Informatika</em>).
                </td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Contoh Pengisian Baris</div>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ahmad Fauzi</td>
                <td>20210001</td>
                <td>ahmad.fauzi@univ.ac.id</td>
                <td>Teknik Informatika</td>
            </tr>
            <tr>
                <td>Citra Lestari</td>
                <td>20210002</td>
                <td>citra.lestari@univ.ac.id</td>
                <td>Sistem Informasi</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Catatan Tambahan</div>
    <ul style="font-size: 9.5pt; padding-left: 20px;">
        <li>Sistem akan mendeteksi baris duplikat. Jika terdapat NIM atau Email yang sudah ada di database, baris tersebut akan dilewati (skip) secara otomatis dan sistem akan memberi tahu total akun yang dilewati.</li>
        <li>Setelah berhasil diimport, mahasiswa dapat login menggunakan <strong>NIM</strong> sebagai email/username dan password default mereka.</li>
    </ul>

</body>
</html>
