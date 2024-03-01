<div class="w-100">
    {{-- <div class="text-center">
        <img src="{{ asset('img/logo_pgb.png') }}" width="100px" alt="Logo PGB">
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
    </div> --}}

    <div id="komponen-datadiri" class="break-after mt-3 text-left">
        <h4>1. Komponen Data Diri</h4>
        <table cellspacing="0" border="1" class="w-100">
            <tr>
                <td class="w-25">No. Anggota</td>
                <td class="w-75"> {{ !empty($anggota['anggota_id']) ? $anggota['anggota_id'] : '-' }} </td>
            </tr>
            <tr>
                <td>Unit Latihan</td>
                <td> {{ !empty($anggota['unit_latihan_nama']) ? $anggota['unit_latihan_nama'] : '-' }} </td>
            </tr>
            <tr>
                <td>Mulai Latihan</td>
                <td> {{ !empty($anggota['anggota_tanggal_mulai']) ? $anggota['anggota_tanggal_mulai'] : '-' }} </td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td><b> {{ !empty($anggota['anggota_nama']) ? $anggota['anggota_nama'] : '-' }} </b></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td> {{ $anggota['anggota_jenis_kelamin'] == '1' ? 'Laki-laki' : 'Perempuan' }} </td>
            </tr>
            <tr>
                <td>Tempat, Tgl. Lahir</td>
                <td> {{ !empty($anggota['anggota_tempat_lahir']) ? $anggota['anggota_tempat_lahir'] : '-' }},
                    {{ !empty($anggota['anggota_tgl_lahir']) ? $anggota['anggota_tgl_lahir'] : '-' }} </td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td> {{ !empty($anggota['anggota_jenis_pekerjaan']) ? $anggota['anggota_jenis_pekerjaan'] : '-' }} </td>
            </tr>
            <tr>
                <td>No. Tanda Pengenal</td>
                <td> {{ !empty($anggota['anggota_no_identitas']) ? $anggota['anggota_no_identitas'] : '-' }} </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> {{ !empty($anggota['anggota_alamat']) ? $anggota['anggota_alamat'] : '-' }} </td>
            </tr>
            <tr>
                <td>No Hp</td>
                <td> {{ !empty($anggota['anggota_no_hp']) ? $anggota['anggota_no_hp'] : '-' }} </td>
            </tr>
            <tr>
                <td>Gol. Darah</td>
                <td> {{ !empty($anggota['anggota_gol_darah']) ? $anggota['anggota_gol_darah'] : '-' }} </td>
            </tr>
            <tr>
                <td>Obat obatan dikonsumsi</td>
                <td> {{ !empty($anggota['anggota_obat']) ? $anggota['anggota_obat'] : '-' }} </td>
            </tr>
            <tr>
                <td>Alergi obat/ makanan</td>
                <td> {{ !empty($anggota['anggota_catatan_alergi']) ? $anggota['anggota_catatan_alergi'] : '-' }} </td>
            </tr>
            <tr>
                <td>Keluhan kesehatan</td>
                <td> {{ !empty($anggota['anggota_keluhan']) ? $anggota['anggota_keluhan'] : '-' }} </td>
            </tr>
            <tr>
                <td>Riwayat sakit dan operasi</td>
                <td> {{ !empty($anggota['anggota_riwayat_sakit']) ? $anggota['anggota_riwayat_sakit'] : '-' }} </td>
            </tr>
        </table>
    </div>

    <div id="komponen-fisik" class="break-after mt-3 text-left">
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
                @if (!empty($item['tinggi_badan']))
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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    Berat badan kurang: IMT (< 18,5)
                    Normal: IMT 18,5 ‐ 24,9
                    Gemuk: IMT 25 ‐ 29,9
                    Sangat Gemuk:  IMT (> 30) </td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['indeks_masa_tubuh']))
                    @php
                        $text = "text-danger";
                        if ($item['indeks_masa_tubuh'] < 18.5) {
                            $kategori = 'Berat badan kurang';
                        }

                        else if ($item['indeks_masa_tubuh'] >= 18.5 && $item['indeks_masa_tubuh'] <= 24.9) {
                            $kategori = 'Normal';
                            $text = "text-dark";
                        }

                        else if ($item['indeks_masa_tubuh'] >= 25 && $item['indeks_masa_tubuh'] <= 29.9) {
                            $kategori = 'Gemuk';
                        }

                        else if ($item['indeks_masa_tubuh'] > 30) {
                            $kategori = 'Sangat Gemuk';
                        }

                        else {
                            $kategori = '-';
                        }
                    @endphp
                    <tr>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td class="{{ $text }}"> {{ $item['indeks_masa_tubuh'] }} </td>
                        <td> {{ $kategori }} </td>
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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Normal: (< 0,5)</td>
            </tr>

            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['ob_ratio_tinggi_pinggang']))
                    <tr>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td class="{{ $item['ob_ratio_tinggi_pinggang'] > 0.5 ? 'text-danger' : 'text-dark' }}"> {{ $item['ob_ratio_tinggi_pinggang'] }} </td>
                        <td> {{ $item['ob_ratio_tinggi_pinggang'] > 0.5 ? 'diatas normal' : 'normal' }} </td>
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
                    $normalLimit = $anggota['anggota_jenis_kelamin'] == 1 ? 0.9 : 0.8;
                @endphp
                @if (!empty($item['ob_ratio_pinggang_pinggul']))
                    <tr>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td class="{{ $item['ob_ratio_pinggang_pinggul'] > $normalLimit ? 'text-danger' : 'text-dark' }}" > {{ $item['ob_ratio_pinggang_pinggul'] }} </td>
                        <td> {{ $item['ob_ratio_pinggang_pinggul'] > $normalLimit ? 'diatas normal' : 'normal' }} </td>
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
                    $normalLimit = $anggota['anggota_jenis_kelamin'] == 1 ? 25 : 32;
                @endphp
                @if (!empty($item['persen_lemak_tubuh']))
                    <tr>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td class="{{ $item['persen_lemak_tubuh'] > $normalLimit ? 'text-danger' : 'text-dark' }}"> {{ $item['persen_lemak_tubuh'] }} </td>
                        <td> {{ $item['persen_lemak_tubuh'] > $normalLimit ? 'obesitas' : 'normal' }} </td>
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
                @if (!empty($item['tingkat_metabolisme_basal']))
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

    <div id="komponen-vital" class="break-after mt-3 text-left">
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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Normal Sys: 140, Dya:90</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['systol_awal']))
                    <tr>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td {{ $item['systol_awal'] > 140 ? 'class="text-danger"' : ''}}> {{ $item['systol_awal'] }} </td>
                        <td {{ $item['dyastol_awal'] > 90 ? 'class="text-danger"' : ''}}> {{ $item['dyastol_awal'] }} </td>
                        <td> {{ $item['dnm_awal'] }} </td>
                        <td {{ $item['systol_pasca'] > 140 ? 'class="text-danger"' : ''}} > {{ $item['systol_pasca'] }} </td>
                        <td {{ $item['dyastol_pasca'] > 90 ? 'class="text-danger"' : ''}} > {{ $item['dyastol_pasca'] }} </td>
                        <td> {{ $item['dnm_pasca'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
        </table>
        <span>Catatan: -</span>

        <div class="p3 mt-3" id="chart-vitality-container">
            <div id="ch-vitality-toolbar"></div>
            <div id="ch-vitality" style="height: 500px"></div>
        </div>
    </div>

    <div id="komponen-penunjang" class="break-after mt-3 text-left">
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
                    $acidLimit = $anggota['anggota_jenis_kelamin'] == 1 ? [3, 7.2] : [2, 6];
                @endphp
                @if (!empty($item['gula_darah']) || !empty($item['asam_urat']) || !empty($item['kolestrol']))
                    <tr>
                        <td> {{ !empty($item['data_kesehatan_pengambilan_tanggal']) ? $item['data_kesehatan_pengambilan_tanggal'] : '' }}
                        </td>
                        <td {{ (intval($item['gula_darah']) <= 70 || intval($item['gula_darah']) >= 140) ? 'class="text-danger"' : ''}} > {{ !empty($item['gula_darah']) ? $item['gula_darah'] : '' }} </td>
                        <td {{ (intval($item['asam_urat']) <= $acidLimit[0] || intval($item['asam_urat']) >= $acidLimit[1]) ? 'class="text-danger"' : ''}} > {{ !empty($item['asam_urat']) ? $item['asam_urat'] : '' }} </td>
                        <td {{ (intval($item['kolestrol']) >= 200) ? 'class="text-danger"' : ''}} > {{ !empty($item['kolestrol']) ? $item['kolestrol'] : '' }} </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td>Normal</td>
                <td>70‐140 mg/dL</td>
                <td>P: 2‐6 mg/dL
                    L: 3‐7,2 mg/dL</td>
                <td>< 200mg/dL</td>
            </tr>
        </table>
        <span>Catatan: -</span>
        <div class="mt-3 mt-25px p-3" id="chart-blood-sugar-container">
            <h5 class="text-center">Gula Darah</h5>
            <div class="" id="ch-blood-sugar" style="height: 500px"></div>
        </div>

        <div class="mt-3 mt-100px p-3" id="chart-joint-acidity-container">
            <h5 class="text-center">Asam Urat</h5>
            <div class="" id="ch-joint-acidity" style="height: 500px"></div>
        </div>

        <div class="mt-3 mt-25px p-3" id="chart-cholestrol-container">
            <h5 class="text-center">Kolestrol</h5>
            <div class="" id="ch-cholestrol" style="height: 500px"></div>
        </div>
    </div>

    <div id="komponen-kebugaran" class="break-after mt-3 text-left">
        <h4>5. Komponen Kebugaran</h4>


        <table cellspacing="0" border="1" class="w-100">
            <tr>
                <td colspan="4">
                    <h5>a. Ketahanan Kardiovaskular</h5>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Tanggal</td>
                <td>Kategori</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td colspan="4">Lari Bleep Test</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['shuttle_run']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['shuttle_run'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4">
                    <h5>b. Keseimbangan</h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">Berdiri satu kaki mata tertutup (1 menit)</td>
                <td>Usia 18‐39, L: 10,2; P: 8,5</td>
            </tr>
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['balancing_left_matatutup']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Tumpuan Kiri' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['balancing_left_matatutup'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['balancing_right_matatutup']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Tumpuan Kanan' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['balancing_right_matatutup'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="3">Berdiri satu kaki jinjit (1 menit)</td>
                <td>Usia 20‐39, L/P: 30</td>
            </tr>
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['balancing_left_jinjit']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Tumpuan Kiri' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['balancing_left_jinjit'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['balancing_right_jinjit']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Tumpuan Kanan' : '' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['balancing_right_jinjit'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4">
                    <h5>c. kelenturan Otot</h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">Back Rise</td>
                <td>30cm</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['backrise']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['backrise'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="3">Sit And Reach</td>
                <td>30cm</td>
            </tr>

            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['sit_reach_2legs']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Dua Kaki' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['sit_reach_2legs'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['sit_reach_leftstraight']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Kiri Lurus' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['sit_reach_leftstraight'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['sit_reach_rightstraight']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Kanan Lurus' : '-' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['sit_reach_rightstraight'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4">
                    <h5>d. Kekuatan Otot</h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">Push up (1 menit) </td>
                <td>Usia 20-29, L: 20-29, P:12-22</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['pushup']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['pushup'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="3">Sit up (1 menit) </td>
                <td>Usia 26-35, L: 31-34,P:25-28</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['situp']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['situp'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="3">pullup (1 menit) </td>
                <td>Usia 16-29, L: 5-7, P: 2-4</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['pullup']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['pullup'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="3">Vertical Jump </td>
                <td>Usia 16-29, 41-50, P: 31-40</td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['vertical_jump']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['vertical_jump'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4">
                    <h5>e. Kecepatan Otot</h5>
                </td>
            </tr>
            <tr>
                <td colspan="4">Lari 60 meter </td>
            </tr>
            @foreach ($data as $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['run_60meter']))
                    <tr>
                        <td> - </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['run_60meter'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4">
                    <h5>f. Kelincahan Otot</h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">Heksagon 60 3 putaran </td>
                <td>L: 13,4-15,5; P:15,4-18,5</td>
            </tr>
            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['agility_heks_left']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Putar ke kiri ' : '' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['agility_heks_left'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach

            @php
                $count = -1;
            @endphp
            @foreach ($data as $k => $item)
                @php
                    $item = (array) $item;
                @endphp
                @if (!empty($item['agility_heks_right']))
                    <tr>
                        <td> {{ ++$count == 0 ? 'Putar ke kanan ' : '' }} </td>
                        <td> {{ $item['data_kesehatan_pengambilan_tanggal'] }} </td>
                        <td> {{ $item['agility_heks_right'] }} </td>
                        <td> - </td>
                    </tr>
                @endif
            @endforeach
        </table>
        <span>Catatan: -</span>
    </div>
</div>
