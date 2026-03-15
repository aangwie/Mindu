<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Psikotest - {{ $user->full_name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 90px;
            color: rgba(226, 232, 240, 0.3);
            z-index: -1000;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Header — Logo left, App name right */
        .header {
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 15px;
            margin-bottom: 25px;
            overflow: hidden;
        }
        .header-left {
            float: left;
            width: 70%;
        }
        .header-right {
            float: right;
            width: 28%;
            text-align: right;
            padding-top: 5px;
        }
        .logo {
            max-height: 50px;
            margin-bottom: 6px;
            display: block;
        }
        .address-text {
            font-size: 10px;
            color: #64748b;
            line-height: 1.4;
            margin: 0;
        }
        .app-name {
            font-size: 20px;
            font-weight: 900;
            color: #1d4ed8;
        }

        /* Section Title */
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-top: 25px;
            margin-bottom: 12px;
            border-left: 4px solid #3b82f6;
            padding-left: 10px;
        }

        /* Student Info */
        .student-info {
            width: 100%;
            margin-bottom: 25px;
            font-size: 12px;
        }
        .student-info td {
            padding: 4px 0;
            vertical-align: top;
        }
        .student-info .label {
            font-weight: bold;
            width: 140px;
            color: #334155;
        }
        .student-info .value {
            color: #475569;
        }

        /* RIASEC Table */
        .scores-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }
        .scores-table th, .scores-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        .scores-table td.score-cell {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            width: 50px;
        }
        .scores-table td.category-cell {
            font-weight: bold;
            width: 110px;
        }

        /* Per-category header colors */
        .header-r { background-color: #dc2626; color: #ffffff; }
        .header-i { background-color: #2563eb; color: #ffffff; }
        .header-a { background-color: #9333ea; color: #ffffff; }
        .header-s { background-color: #16a34a; color: #ffffff; }
        .header-e { background-color: #ea580c; color: #ffffff; }
        .header-c { background-color: #0891b2; color: #ffffff; }

        .row-r { background-color: #fef2f2; }
        .row-i { background-color: #eff6ff; }
        .row-a { background-color: #faf5ff; }
        .row-s { background-color: #f0fdf4; }
        .row-e { background-color: #fff7ed; }
        .row-c { background-color: #ecfeff; }

        /* Recommendation Box */
        .recommendation-box {
            background-color: #f0f9ff;
            border: 2px solid #3b82f6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }
        .recommendation-value {
            font-size: 22px;
            font-weight: 900;
            color: #1d4ed8;
            margin: 8px 0;
        }
        .recommendation-reason {
            text-align: left;
            font-size: 12px;
            color: #475569;
            margin-top: 12px;
            line-height: 1.6;
        }

        /* Major recommendation table */
        .major-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 12px;
        }
        .major-table th {
            background-color: #1e40af;
            color: #ffffff;
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .major-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            vertical-align: top;
        }
        .major-rank {
            text-align: center;
            font-weight: 900;
            font-size: 14px;
            width: 35px;
        }
        .major-rank-1 { color: #ca8a04; }
        .major-rank-2 { color: #64748b; }
        .major-rank-3 { color: #b45309; }
        .level-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .level-sma { background-color: #dcfce7; color: #16a34a; }
        .level-smk { background-color: #dbeafe; color: #2563eb; }

        /* Footer */
        .footer {
            margin-top: 40px;
            font-size: 9px;
            text-align: center;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="watermark">Mindu</div>

    <!-- Header: Logo top-left, address below logo -->
    <div class="header clearfix">
        <div class="header-left">
            @if($logo)
                <img src="{{ $logo }}" class="logo">
            @else
                <div style="font-size: 22px; font-weight: 900; color: #1d4ed8; margin-bottom: 6px;">{{ config('app.name', 'Mindu') }}</div>
            @endif
            <p class="address-text">{{ $address }}</p>
        </div>
        <div class="header-right">
            <div class="app-name">HASIL PSIKOTEST</div>
            <div style="font-size: 10px; color: #64748b;">{{ now()->format('d F Y') }}</div>
        </div>
    </div>

    <!-- Student Info -->
    <div class="section-title">Data Diri Siswa</div>
    <table class="student-info">
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">: {{ $user->full_name }}</td>
        </tr>
        <tr>
            <td class="label">NISN</td>
            <td class="value">: {{ $user->nisn ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Sekolah Saat Ini</td>
            <td class="value">: {{ $user->current_school ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Asal Sekolah</td>
            <td class="value">: {{ $user->school_origin ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tgl Lahir</td>
            <td class="value">: {{ $user->pob ?? '-' }}, {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="value">: {{ $user->address ?? '-' }}</td>
        </tr>
    </table>

    <!-- RIASEC Scores -->
    <div class="section-title">Hasil Analisis Kepribadian (Holland RIASEC)</div>
    <table class="scores-table">
        <!-- Realistic -->
        <tr>
            <th class="header-r" colspan="3" style="font-size: 13px;">R — Realistic (Realistik)</th>
        </tr>
        <tr class="row-r">
            <td class="category-cell">Realistic</td>
            <td class="score-cell">{{ $result->score_r }}</td>
            <td>Individu yang menyukai aktivitas fisik dan praktis. Cenderung menikmati pekerjaan yang melibatkan alat, mesin, atau kegiatan di luar ruangan. Memiliki kemampuan motorik yang baik dan lebih suka bekerja dengan benda nyata dibandingkan ide abstrak. Contoh karir: Teknisi, Insinyur Mesin, Pilot, Petani, dan Atlet.</td>
        </tr>

        <!-- Investigative -->
        <tr>
            <th class="header-i" colspan="3" style="font-size: 13px;">I — Investigative (Investigatif)</th>
        </tr>
        <tr class="row-i">
            <td class="category-cell">Investigative</td>
            <td class="score-cell">{{ $result->score_i }}</td>
            <td>Individu yang senang menganalisis, meneliti, dan memecahkan masalah. Memiliki rasa ingin tahu tinggi dan menyukai tantangan intelektual. Cenderung berpikir logis, kritis, dan sistematis. Lebih menikmati bekerja secara mandiri dengan data dan teori. Contoh karir: Ilmuwan, Peneliti, Dokter, Programmer, dan Dosen.</td>
        </tr>

        <!-- Artistic -->
        <tr>
            <th class="header-a" colspan="3" style="font-size: 13px;">A — Artistic (Artistik)</th>
        </tr>
        <tr class="row-a">
            <td class="category-cell">Artistic</td>
            <td class="score-cell">{{ $result->score_a }}</td>
            <td>Individu yang kreatif, imajinatif, dan ekspresif. Menyukai kebebasan berekspresi melalui seni, musik, tulisan, atau desain. Cenderung tidak menyukai aturan yang kaku dan lebih suka lingkungan yang fleksibel. Memiliki kepekaan estetika yang tinggi. Contoh karir: Desainer Grafis, Musisi, Penulis, Aktor, dan Arsitektur.</td>
        </tr>

        <!-- Social -->
        <tr>
            <th class="header-s" colspan="3" style="font-size: 13px;">S — Social (Sosial)</th>
        </tr>
        <tr class="row-s">
            <td class="category-cell">Social</td>
            <td class="score-cell">{{ $result->score_s }}</td>
            <td>Individu yang suka membantu, mengajar, dan berinteraksi dengan orang lain. Memiliki empati tinggi dan kemampuan komunikasi yang baik. Menikmati kegiatan yang berhubungan dengan pelayanan, pendidikan, atau kesehatan. Cenderung sabar dan kooperatif. Contoh karir: Guru, Psikolog, Perawat, Konselor, dan Pekerja Sosial.</td>
        </tr>

        <!-- Enterprising -->
        <tr>
            <th class="header-e" colspan="3" style="font-size: 13px;">E — Enterprising (Wirausaha)</th>
        </tr>
        <tr class="row-e">
            <td class="category-cell">Enterprising</td>
            <td class="score-cell">{{ $result->score_e }}</td>
            <td>Individu yang ambisius, percaya diri, dan suka memimpin. Menikmati kegiatan yang melibatkan persuasi, manajemen, dan pengambilan keputusan. Berorientasi pada hasil dan memiliki jiwa kompetitif. Suka mengambil risiko dan memiliki kemampuan berbicara di depan umum. Contoh karir: Manajer, Pengusaha, Politisi, Sales, dan Pengacara.</td>
        </tr>

        <!-- Conventional -->
        <tr>
            <th class="header-c" colspan="3" style="font-size: 13px;">C — Conventional (Konvensional)</th>
        </tr>
        <tr class="row-c">
            <td class="category-cell">Conventional</td>
            <td class="score-cell">{{ $result->score_c }}</td>
            <td>Individu yang terorganisir, teliti, dan menyukai pekerjaan yang terstruktur. Memiliki kemampuan administratif yang baik dan senang bekerja dengan data, angka, dan sistem. Cenderung mengikuti aturan dan prosedur yang jelas. Detail-oriented dan dapat diandalkan. Contoh karir: Akuntan, Sekretaris, Analis Data, Pegawai Bank, dan Administrator.</td>
        </tr>
    </table>

    <!-- Recommended Majors -->
    @if(!empty($recommendationDetails) && count($recommendationDetails) > 0)
    <div class="section-title">3 Jurusan Terbaik untuk Anda</div>
    <table class="major-table">
        <thead>
            <tr>
                <th style="width: 35px; text-align: center;">#</th>
                <th style="width: 60px;">Level</th>
                <th>Jurusan</th>
                <th style="width: 55px; text-align: center;">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recommendationDetails as $detail)
            <tr style="background-color: {{ $detail['rank'] == 1 ? '#fffbeb' : ($detail['rank'] == 2 ? '#f8fafc' : '#fffbeb') }};">
                <td class="major-rank major-rank-{{ $detail['rank'] }}">
                    @if($detail['rank'] == 1) 🥇 @elseif($detail['rank'] == 2) 🥈 @else 🥉 @endif
                </td>
                <td><span class="level-badge level-{{ strtolower($detail['level']) }}">{{ $detail['level'] }}</span></td>
                <td>
                    <strong>{{ $detail['major'] }}</strong><br>
                    <span style="font-size: 11px; color: #64748b;">{{ $detail['description'] }}</span>
                </td>
                <td style="text-align: center; font-weight: bold; color: #1d4ed8;">{{ $detail['match_score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Recommendation -->
    <div class="section-title">Rekomendasi Akhir</div>
    <div class="recommendation-box">
        <div style="font-size: 12px; color: #64748b;">Berdasarkan tes kepribadian Holland RIASEC, Anda direkomendasikan masuk:</div>
        <div class="recommendation-value">{{ $result->recommendation }}</div>
        <div class="recommendation-reason">
            <strong>Alasan:</strong><br>
            {{ $result->final_reasoning }}
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen ini diterbitkan secara otomatis oleh sistem {{ config('app.name', 'Mindu') }} dan dinyatakan sah secara digital.<br>
        Dicetak pada: {{ now()->format('d/m/Y H:i:s') }} WIB
    </div>
</body>
</html>
