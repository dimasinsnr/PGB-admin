<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Kesehatan</title>
    <style>
        .border {
            border: 1px solid black;
        }
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-justify {
            text-align: justify;
        }

        .break-after {
            page-break-after: always;
        }

        .break-before {
            page-break-before: always;
        }

        .break-before-right {
            page-break-before: right;
        }

        .break-before-left {
            page-break-before: left;
        }

        .mt-25px {
            margin-top: 25px;
        }

        .mt-20px {
            margin-top: 20px;
        }

        .mt-15px {
            margin-top: 15px;
        }

        .mt-10px {
            margin-top: 10px;
        }

        .mt-100px {
            margin-top: 350px;
        }

        .mt-5px {
            margin-top: 5px;
        }

        .mb-25px {
            margin-bottom: 25px;
        }

        .mb-20px {
            margin-bottom: 20px;
        }

        .mb-15px {
            margin-bottom: 15px;
        }

        .mb-10px {
            margin-bottom: 10px;
        }

        .mb-5px {
            margin-bottom: 5px;
        }

        .mr-25px {
            margin-right: 25px;
        }

        .mr-20px {
            margin-right: 20px;
        }

        .mr-15px {
            margin-right: 15px;
        }

        .mr-10px {
            margin-right: 10px;
        }

        .mr-5px {
            margin-right: 5px;
        }

        .ml-25px {
            margin-left: 25px;
        }

        .ml-20px {
            margin-left: 20px;
        }

        .ml-15px {
            margin-left: 15px;
        }

        .ml-10px {
            margin-left: 10px;
        }

        .ml-5px {
            margin-left: 5px;
        }

        .mx-25px {
            margin-inline: 25px;
        }

        .mx-20px {
            margin-inline: 20px;
        }

        .mx-15px {
            margin-inline: 15px;
        }

        .mx-10px {
            margin-inline: 10px;
        }

        .mx-5px {
            margin-inline: 5px;
        }

        .my-25px {
            margin-block: 25px;
        }

        .my-20px {
            margin-block: 20px;
        }

        .my-15px {
            margin-block: 15px;
        }

        .my-10px {
            margin-block: 10px;
        }

        .my-5px {
            margin-block: 5px;
        }

        .w-100 {
            width: 100%;
        }

        .w-75 {
            width: 75%;
        }

        .w-50 {
            width: 50%;
        }

        .w-25 {
            width: 25%;
        }

        .h-100 {
            height: 100%;
        }

        .h-75 {
            height: 75%;
        }

        .h-50 {
            height: 50%;
        }

        .h-25 {
            height: 25%;
        }

        table tr td {
            padding: 5px;
        }
    </style>
</head>

<body style="margin-inline: 15px">
    <div class="w-100">
        <div class="text-center">
            <img src="{{ public_path() . '/img/logo_pgb.png' }}" width="100px" alt="Logo PGB">
            <h3 class="text-center">PERGURUAN SILAT PERSATUAN GERAK BADAN (PGB) BANGAU PUTIH</h2>
                <h4 class="text-center">CABANG DAERAH ISTIMEWA YOGYAKARTA</h4>
        </div>
        <div class="text-center">
            <p class="text-justify mx-25px">
                Sudah selama 3 tahun ini, PGB Bangau Putih cabang DIY melakukan uji coba untuk mengembangkan
                indikator sehat secara umum, dengan tujuan 1) memastikan bahwa tingkat latihan berlangsung
                cukup dan aman; 2) supaya tingkat perkembangan kesehatan tiap murid dapat diketahui secara
                reguler; 3) bahan dasar evaluasi diri tiap murid. Terdapat 5 komponen pemeriksaan yang dijalankan
                yakni: 1) data diri dan riwayat kesehatan; 2) fisik; 3) tanda vital; 4) penunjang; 5) kebugaran tubuh.
                Tes ini cukup praktis, sederhana, tidak memerlukan waktu lama, murah dan dilakukan secara
                reguler, sehingga dapat diamati perubahannya.
            </p>
        </div>
        <div class="text-center mt-25px">
            <h4><b>Hasil Pengukuran Tes Kesehatan</b></h4>
            <span>Tanggal: {{ $tanggal['from'] }} - {{ $tanggal['to'] }} </span>
        </div>

        {!! $table !!}
    </div>
</body>

</html>
