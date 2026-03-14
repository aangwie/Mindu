<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Psikotest - {{ $user->full_name }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #334155;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(226, 232, 240, 0.4);
            z-index: -1000;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            max-height: 60px;
            margin-bottom: 10px;
        }
        .developer-info {
            font-size: 12px;
            color: #64748b;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
            margin-top: 30px;
            margin-bottom: 15px;
            border-left: 4px solid #3b82f6;
            padding-left: 10px;
        }
        .student-info {
            width: 100%;
            margin-bottom: 30px;
        }
        .student-info td {
            padding: 5px 0;
        }
        .student-info .label {
            font-weight: bold;
            width: 150px;
        }
        .recommendation-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .recommendation-value {
            font-size: 32px;
            font-weight: 900;
            color: #1d4ed8;
            margin: 10px 0;
        }
        .scores-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .scores-table th, .scores-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }
        .scores-table th {
            background-color: #f1f5f9;
        }
        .footer {
            margin-top: 50px;
            font-size: 10px;
            text-align: center;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="watermark">Trusted</div>

    <div class="header">
        @if($logo)
            <img src="{{ $logo }}" class="logo">
        @endif
        <div class="developer-info">
            <strong>{{ config('app.name') }}</strong><br>
            {{ $address }}
        </div>
    </div>

    <div class="section-title">Data Diri Siswa</div>
    <table class="student-info">
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>: {{ $user->full_name }}</td>
        </tr>
        <tr>
            <td class="label">NISN</td>
            <td>: {{ $user->nisn }}</td>
        </tr>
        <tr>
            <td class="label">Sekolah Saat Ini</td>
            <td>: {{ $user->current_school }}</td>
        </tr>
        <tr>
            <td class="label">TTL</td>
            <td>: {{ $user->pob }}, {{ \Carbon\Carbon::parse($user->dob)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td>: {{ $user->address }}</td>
        </tr>
    </table>

    <div class="section-title">Hasil Analisis RIASEC</div>
    <table class="scores-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Skor</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Realistic</td>
                <td>{{ $result->score_r }}</td>
                <td>Praktis, Fisik, Alat</td>
            </tr>
            <tr>
                <td>Investigative</td>
                <td>{{ $result->score_i }}</td>
                <td>Pemikir, Analitis, Ide</td>
            </tr>
            <tr>
                <td>Artistic</td>
                <td>{{ $result->score_a }}</td>
                <td>Kreatif, Bebas, Ekspresif</td>
            </tr>
            <tr>
                <td>Social</td>
                <td>{{ $result->score_s }}</td>
                <td>Penolong, Sabar, Mengajar</td>
            </tr>
            <tr>
                <td>Enterprising</td>
                <td>{{ $result->score_e }}</td>
                <td>Pemimpin, Persuasif, Bisnis</td>
            </tr>
            <tr>
                <td>Conventional</td>
                <td>{{ $result->score_c }}</td>
                <td>Terencana, Data, Aturan</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Rekomendasi Akhir</div>
    <div class="recommendation-box">
        <div style="font-size: 14px; color: #64748b;">Berdasarkan tes kepribadian, Anda direkomendasikan masuk:</div>
        <div class="recommendation-value">{{ $result->recommendation }}</div>
        <div style="text-align: left; font-size: 13px; color: #475569; margin-top: 15px;">
            <strong>Alasan:</strong><br>
            {{ $result->final_reasoning }}
        </div>
    </div>

    <div class="footer">
        Dokumen ini diterbitkan secara otomatis oleh sistem Mindu dan dinyatakan sah secara digital.<br>
        Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>
