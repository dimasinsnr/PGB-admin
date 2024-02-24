<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Kesehatan</title>
    <style>

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

        <div id="komponen-datadiri" class="break-after text-left">
            <h4>1. Komponen Data Diri</h4>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td class="w-25">No. Anggota</td>
                    <td class="w-75"> {{ isset($anggota['anggota_id']) ? $anggota['anggota_id'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Unit Latihan</td>
                    <td> {{ isset($anggota['unit_latihan_nama']) ? $anggota['unit_latihan_nama'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Mulai Latihan</td>
                    <td> {{ isset($anggota['anggota_tanggal_mulai']) ? $anggota['anggota_tanggal_mulai'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><b> {{ isset($anggota['anggota_nama']) ? $anggota['anggota_nama'] : '-' }} </b></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td> {{ $anggota['anggota_jenis_kelamin'] == '1' ? 'Laki-laki' : 'Perempuan' }} </td>
                </tr>
                <tr>
                    <td>Tempat, Tgl. Lahir</td>
                    <td> {{ isset($anggota['anggota_tempat_lahir']) ? $anggota['anggota_tempat_lahir'] : '-' }},
                        {{ isset($anggota['anggota_tgl_lahir']) ? $anggota['anggota_tgl_lahir'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td> {{ isset($anggota['anggota_jenis_pekerjaan']) ? $anggota['anggota_jenis_pekerjaan'] : '-' }} </td>
                </tr>
                <tr>
                    <td>No. Tanda Pengenal</td>
                    <td> {{ isset($anggota['anggota_no_identitas']) ? $anggota['anggota_no_identitas'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td> {{ isset($anggota['anggota_alamat']) ? $anggota['anggota_alamat'] : '-' }} </td>
                </tr>
                <tr>
                    <td>No Hp</td>
                    <td> {{ isset($anggota['anggota_no_hp']) ? $anggota['anggota_no_hp'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Gol. Darah</td>
                    <td> {{ isset($anggota['anggota_gol_darah']) ? $anggota['anggota_gol_darah'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Obat obatan dikonsumsi</td>
                    <td> {{ isset($anggota['anggota_obat']) ? $anggota['anggota_obat'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Alergi obat/ makanan</td>
                    <td> {{ isset($anggota['anggota_catatan_alergi']) ? $anggota['anggota_catatan_alergi'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Keluhan kesehatan</td>
                    <td> {{ isset($anggota['anggota_keluhan']) ? $anggota['anggota_keluhan'] : '-' }} </td>
                </tr>
                <tr>
                    <td>Riwayat sakit dan operasi</td>
                    <td> {{ isset($anggota['anggota_riwayat_sakit']) ? $anggota['anggota_riwayat_sakit'] : '-' }} </td>
                </tr>
            </table>
        </div>

        <div id="komponen-fisik" class="break-after text-left">
            <h4>2. Komponen Fisik</h4>

            <h5>a. Tinggi, berat, pinggang, pinggul, leher (kg, cm)</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Tinggi</td>
                    <td>Berat</td>
                    <td>Pinggang</td>
                    <td>Pinggul</td>
                    <td>Leher</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['tinggi_badan']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['tinggi_badan'] }} </td>
                            <td> {{ $item['berat_badan'] }} </td>
                            <td> {{ $item['lingkar_pinggang'] }} </td>
                            <td> {{ $item['lingkar_pinggul'] }} </td>
                            <td> {{ $item['lingkar_leher'] }} </td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <h5>b. Tingkat Obesitas berdasar IMT</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Index Massa Tubuh</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['index_massa_tubuh']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['index_massa_tubuh'] }} </td>
                            <td> - </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <h5>c. Obesitas berdasar Rasio Tinggi dan pinggang</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Ratio tinggi pinggang</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                </tr>

                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['ob_ratio_tinggi_pinggang']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['ob_ratio_tinggi_pinggang'] }} </td>
                            <td> - </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <h5>d. Obesitas berdasar rasio pinggang dan pinggul</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Ratio pinggang Pinggul</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['ob_ratio_pinggang_pinggul']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['ob_ratio_pinggang_pinggul'] }} </td>
                            <td> - </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <h5>e. Persentase lemak di tubuh</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Persen lemak tubuh</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['persen_lemak_tubuh']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['persen_lemak_tubuh'] }} </td>
                            <td> - </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <h5>f. Tingkat metabolisme basal</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Tingkat metabolisme basal </td>
                    <td>Kategori</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['tingkat_metabolisme_basal']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['tingkat_metabolisme_basal'] }} </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <span>Catatan: Cek Komponen fisik perlu 6 bulan sekali, atau lebih sering lagi </span>
        </div>

        <div id="komponen-vital" class="break-after text-left">
            <h4>3. Komponen Tanda Vital</h4>

            <h5>a. Tekanan Darah dan denyut nadi per menit</h5>
            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td></td>
                    <td>Sebelum Latihan</td>
                    <td colspan="2"></td>
                    <td>Sesudah Latihan</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>Systole </td>
                    <td>Dyastole</td>
                    <td>DNM</td>
                    <td>Systole</td>
                    <td>Dyastole</td>
                    <td>DNM</td>
                    <td>Keterangan</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['systole_awal']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['systole_awal'] }} </td>
                            <td> {{ $item['dystole_awal'] }} </td>
                            <td> {{ $item['dnm_awal'] }} </td>
                            <td> {{ $item['systole_pasca'] }} </td>
                            <td> {{ $item['dystole_pasca'] }} </td>
                            <td> {{ $item['dnm_pasca'] }} </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <span>Catatan: -</span>
        </div>

        <div id="komponen-penunjang" class="break-after text-left">
            <h4>4. Komponen Penunjang</h4>

            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Gula Darah</td>
                    <td>Asam Urat</td>
                    <td>Kolestrol</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['gula_darah']) && isset($item['asam_urat']) && isset($item['kolestrol']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['gula_darah'] }} </td>
                            <td> {{ $item['asam_urat'] }} </td>
                            <td> {{ $item['kolestrol'] }} </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <span>Catatan: -</span>
        </div>

        {{-- <div id="komponen-kebugaran" class="break-after text-left">
            <h4>4. Komponen Penunjang</h4>

            <table cellspacing="0" border="1" class="w-100">
                <tr>
                    <td>Tanggal</td>
                    <td>Gula Darah</td>
                    <td>Asam Urat</td>
                    <td>Kolestrol</td>
                </tr>
                @foreach ($data as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    @if (isset($item['gula_darah']) && isset($item['asam_urat']) && isset($item['kolestrol']))
                        <tr>
                            <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                            <td> {{ $item['gula_darah'] }} </td>
                            <td> {{ $item['asam_urat'] }} </td>
                            <td> {{ $item['kolestrol'] }} </td>
                            <td> - </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <span>Catatan: -</span>
        </div> --}}
    </div>
</body>

</html>
