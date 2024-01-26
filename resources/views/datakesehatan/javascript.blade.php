<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableDatakesehatan: BASE_URL + 'datakesehatan/initTable',
            storeDatakesehatan: BASE_URL + 'datakesehatan/storeData',
            deleteDatakesehatan: BASE_URL + 'datakesehatan/deleteData',
            showDatakesehatan: BASE_URL + 'datakesehatan/showData',
            comboUnitLatihan: BASE_URL + 'datakesehatan/comboUnitLatihan',
            comboAnggota: BASE_URL + 'datakesehatan/comboAnggota',
        };
        HELPER.createCombo({
			el: ['data_kesehatan_unit_latihan_id'],
			valueField: 'unit_latihan_id',
			// grouped: true,
			displayField: 'unit_latihan_nama',
			// displayField2: 'unit_latihan_nama',
			placeholder: '-Pilih Unit-',
			url: HELPER.api.comboUnitLatihan,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        HELPER.createCombo({
			el: ['data_kesehatan_anggota_id'],
			valueField: 'anggota_id',
			// grouped: true,
			displayField: 'anggota_nama',
			// displayField2: 'unit_latihan_nama',
			placeholder: '-Pilih Anggota-',
			url: HELPER.api.comboAnggota,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        // HELPER.createCombo({
		// 	el: ['datakesehatan_unit_latihan_id_detail'],
		// 	valueField: 'unit_latihan_id',
		// 	grouped: true,
		// 	displayField: 'unit_latihan_kode',
		// 	displayField2: 'unit_latihan_nama',
		// 	displayField2: 'unit_latihan_nama',
		// 	placeholder: '-Pilih Unit-',
		// 	url: HELPER.api.comboUnitLatihan,
        //     csrf: $('meta[name="csrf-token"]').attr('content'),
		// 	type: "POST"
		// });
        init();
    });

    init = async () => {
		await initTable();
		await HELPER.unblock(100);
	}

    toggleCustomDropdown = (event) => {
        // console.log(event);
        var dropdownMenu = $(event).next('.custom-dropdown-menu');
        $('.custom-dropdown-menu').not(dropdownMenu).removeClass('show'); // Menutup dropdown-menu lainnya
        dropdownMenu.toggleClass('show');
        // Memeriksa apakah event memiliki metode stopPropagation sebelum digunakan
        if (event.stopPropagation) {
            event.stopPropagation();
        } else if (event.cancelBubble !== undefined) {
            // Jika stopPropagation tidak tersedia, gunakan cara alternatif
            event.cancelBubble = true;
        }
    }

    closeCustomDropdowns = (event) => {
        if (!$('.custom-dropdown').is(event.target) && $('.custom-dropdown-menu').has(event.target).length === 0) {
            $('.custom-dropdown-menu').removeClass('show');
        }
    }

    initTable = () => {
        $('#tableDatakesehatan').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableDatakesehatan,
            columns: [
                { data: 'data_kesehatan_pengambilan_tanggal'},
                { data: 'anggota_nama'},
                { data: 'anggota_email'},
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']],
        });
    }

    onRefresh = () => {
        $('#tableDatakesehatan').DataTable().destroy(); 
        initTable();
    }

    onBack = () => {
        $('#detail_card').slideDown().hide();
        $('#panel-main').show();
        $('#tableDatakesehatan').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formDatakesehatan"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeDatakesehatan,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddDatakesehatan').modal('hide');
                                $('#tableDatakesehatan').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddDatakesehatan').hide();
                                HELPER.showMessage({
                                    success: false,
                                    message: response.message,
                                    title: 'False'
                                });
                            }
                        },
                        complete: (response) => {
                            HELPER.unblock(500);
                        }
                    });
                }
            }
        })
    }

    onEdit = (id, nama, form) => {
        HELPER.block();
        $.ajax({
            url: HELPER.api.showDatakesehatan,
            type: 'POST',
            data: {
                datakesehatan_id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success == true) {
                    HELPER.populateForm($('[id="' + form + '"]'), response.data);
                    // if (form == 'formDatakesehatan') {
                    //     $('#modalAddDatakesehatan').modal('show');
                    // } else {
                        $('#panel-main').slideUp();
                        $('#detail_card').show();
                        $('#backName').text(response.data.datakesehatan_nama);
                    // }
                } else {
                    HELPER.showMessage({
                        success: false,
                        message: response.message,
                        title: 'False'
                    });
                }
            },
            complete: (response) => {
                HELPER.unblock(500);
            }
        });
    }

    onDelete = (id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteDatakesehatan,
                        type: 'POST',
                        data: {
                            datakesehatan_id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddDatakesehatan').modal('hide');
                                $('#tableDatakesehatan').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddDatakesehatan').hide();
                                HELPER.showMessage({
                                    success: false,
                                    message: response.message,
                                    title: 'False'
                                });
                            }
                        },
                        complete: (response) => {
                            HELPER.unblock(500);
                        }
                    });
                }
            }
        })
    }

    $('#data_kesehatan_jenis_periksa1').change(function() {
        var selectedOption = $(this).val();
        
        if (selectedOption === "tanda vital") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="systol_awal" name="systol_awal" class="form-control form-control-solid" required placeholder="Systol Awal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="dyastol_awal" name="dyastol_awal" class="form-control form-control-solid" required placeholder="Dyastol Awal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="dnm_awal" name="dnm_awal" class="form-control form-control-solid" required placeholder="DNM Awal" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="systol_pasca" name="systol_pasca" class="form-control form-control-solid" required placeholder="Systol Pasca Latihan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="dyastol_pasca" name="dyastol_pasca" class="form-control form-control-solid" required placeholder="Dyastol Pasca Latihan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="dnm_pasca" name="dnm_pasca" class="form-control form-control-solid" required placeholder="DNM Pasca Latihan" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else if (selectedOption === "komponen fisik") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Tinggi Badan  <span class="text-danger">*</span></label>
                            <input type="number" id="tinggi_badan" name="tinggi_badan" class="form-control form-control-solid" required placeholder="Tinggi Badan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Dada  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_dada" name="lingkar_dada" class="form-control form-control-solid" required placeholder="Lingkar Dada" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Pinggul  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_pinggul" name="lingkar_pinggul" class="form-control form-control-solid" required placeholder="Lingkar Pinggul" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Berat Badan  <span class="text-danger">*</span></label>
                            <input type="number" id="berat_badan" name="berat_badan" class="form-control form-control-solid" required placeholder="Berat Badan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Pinggang  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_pinggang" name="lingkar_pinggang" class="form-control form-control-solid" required placeholder="Lingkar Pinggang" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Leher  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_leher" name="lingkar_leher" class="form-control form-control-solid" required placeholder="Lingkar Leher" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else if (selectedOption === "kebugaran jasmani") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kiri Mata Tutup  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_left_matatutup" name="balancing_left_matatutup" class="form-control form-control-solid" required placeholder="Keseimbangan Kiri Mata Tutup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kanan Mata Tutup  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_right_matatutup" name="balancing_right_matatutup" class="form-control form-control-solid" required placeholder="Keseimbangan Kanan Mata Tutup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kiri Jinjit  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_left_jinjit" name="balancing_left_jinjit" class="form-control form-control-solid" required placeholder="Keseimbangan Kiri Jinjit" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kanan Jinjit  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_right_jinjit" name="balancing_right_jinjit" class="form-control form-control-solid" required placeholder="Keseimbangan Kanan Jinjit" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai 2 Kaki  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_2legs" name="sit_reach_2legs" class="form-control form-control-solid" required placeholder="Duduk Capai 2 Kaki" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai Kaki Kiri  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_leftstraight" name="sit_reach_leftstraight" class="form-control form-control-solid" required placeholder="Duduk Capai Kaki Kiri" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai Kaki Kanan  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_rightstraight" name="sit_reach_rightstraight" class="form-control form-control-solid" required placeholder="Duduk Capai Kaki Kanan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Backrise  <span class="text-danger">*</span></label>
                            <input type="number" id="backrise" name="backrise" class="form-control form-control-solid" required placeholder="Backrise" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Aility Heks Left  <span class="text-danger">*</span></label>
                            <input type="number" id="agility_heks_left" name="agility_heks_left" class="form-control form-control-solid" required placeholder="Aility Heks Left" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Agility Heks Right  <span class="text-danger">*</span></label>
                            <input type="number" id="agility_heks_right" name="agility_heks_right" class="form-control form-control-solid" required placeholder="Agility Heks Right" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Pushup  <span class="text-danger">*</span></label>
                            <input type="number" id="pushup" name="pushup" class="form-control form-control-solid" required placeholder="Pushup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Situp  <span class="text-danger">*</span></label>
                            <input type="number" id="situp" name="situp" class="form-control form-control-solid" required placeholder="Situp" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lompat Vertikal  <span class="text-danger">*</span></label>
                            <input type="number" id="vertical_jump" name="vertical_jump" class="form-control form-control-solid" required placeholder="Lompat Vertikal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Pullup  <span class="text-danger">*</span></label>
                            <input type="number" id="pullup" name="pullup" class="form-control form-control-solid" required placeholder="Pullup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Shuttle Run  <span class="text-danger">*</span></label>
                            <input type="number" id="shuttle_run" name="shuttle_run" class="form-control form-control-solid" required placeholder="Shuttle Run" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lari 60 Meter  <span class="text-danger">*</span></label>
                            <input type="number" id="run_60meter" name="run_60meter" class="form-control form-control-solid" required placeholder="Lari 60 Meter" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else if (selectedOption === "gula darah") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Gula Darah  <span class="text-danger">*</span></label>
                            <input type="number" id="gula_darah" name="gula_darah" class="form-control form-control-solid" required placeholder="Gula Darah" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else if (selectedOption === "asam urat") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Asam Urat  <span class="text-danger">*</span></label>
                            <input type="number" id="asam_urat" name="asam_urat" class="form-control form-control-solid" required placeholder="Asam Urat" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else if (selectedOption === "kolestrol") {
            $('#formPeriksa').html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">kolestrol  <span class="text-danger">*</span></label>
                            <input type="number" id="kolestrol" name="kolestrol" class="form-control form-control-solid" required placeholder="kolestrol" />
                        </div>
                    </div>
                </div>
            `;
            $('#formPeriksa').append(html);
        } else {
          console.log('tidak ok');
        }
    });

    let selectedValues = [];

    addPeriksa = () => {
        const index = $('#formPlace select').length + 1;
        const counter = index + 1;

        const selectedValue = $(`#data_kesehatan_jenis_periksa${index}`).val();
        selectedValues.push(selectedValue);

        var html = `
            <hr />
            <div class="fv-row mb-2">
                <label for="" class="form-label mb-1" style="font-size: 15px">Jenis Pemeriksaan <span class="text-danger">*</span></label>
                <select id="data_kesehatan_jenis_periksa${counter}" name="data_kesehatan_jenis_periksa${counter}" class="custom-select form-control form-control-solid">
                    <option selected disabled>Pilih Jenis Pemeriksaan</option>
                    <option value="tanda vital" id="test" ${selectedValue === 'tanda vital' ? 'style="display:none;"' : ''}>Tanda Vital</option>
                    <option value="gula darah" ${selectedValue === 'gula darah' ? 'style="display:none;"' : ''}>Gulda Darah</option>
                    <option value="kolestrol" ${selectedValue === 'kolestrol' ? 'style="display:none;"' : ''}>Kolestrol</option>
                    <option value="komponen fisik" ${selectedValue === 'komponen fisik' ? 'style="display:none;"' : ''}>Komponen Fisik</option>
                    <option value="kebugaran jasmani" ${selectedValue === 'kebugaran jasmani' ? 'style="display:none;"' : ''}>Kebugaran Jasmani</option>
                    <option value="asam urat" ${selectedValue === 'asam urat' ? 'style="display:none;"' : ''}>Asam Urat</option>
                </select>
            </div>
        `;
        $(`#formPlace`).append(html);
        var addFormPlace = `
            <div id="formPeriksa${counter}"><div>
        `;
        $('#formPlace').append(addFormPlace);

        // Sembunyikan opsi yang sudah dipilih sebelumnya
        $(`#data_kesehatan_jenis_periksa${counter} option`).each(function() {
            if (selectedValues.includes($(this).val())) {
                $(this).hide();
            }
        });
    }

    // Event delegation for dynamic elements
    $(document).on('change', '[id^="data_kesehatan_jenis_periksa"]', function() {
        const index = $(this).attr('id').match(/\d+/)[0];
        var selectedOption = $(this).val();
        console.log(`Selected option for index ${index}: ${selectedOption}`);
        if (selectedOption === "tanda vital") {
            $(`#formPeriksa${index}`).html('');
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="systol_awal" name="systol_awal" class="form-control form-control-solid" required placeholder="Systol Awal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="dyastol_awal" name="dyastol_awal" class="form-control form-control-solid" required placeholder="Dyastol Awal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Awal  <span class="text-danger">*</span></label>
                            <input type="number" id="dnm_awal" name="dnm_awal" class="form-control form-control-solid" required placeholder="DNM Awal" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="systol_pasca" name="systol_pasca" class="form-control form-control-solid" required placeholder="Systol Pasca Latihan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="dyastol_pasca" name="dyastol_pasca" class="form-control form-control-solid" required placeholder="Dyastol Pasca Latihan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Pasca Latihan  <span class="text-danger">*</span></label>
                            <input type="number" id="dnm_pasca" name="dnm_pasca" class="form-control form-control-solid" required placeholder="DNM Pasca Latihan" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else if (selectedOption === "komponen fisik") {
            $(`#formPeriksa${index}`).html('');
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Tinggi Badan  <span class="text-danger">*</span></label>
                            <input type="number" id="tinggi_badan" name="tinggi_badan" class="form-control form-control-solid" required placeholder="Tinggi Badan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Dada  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_dada" name="lingkar_dada" class="form-control form-control-solid" required placeholder="Lingkar Dada" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Pinggul  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_pinggul" name="lingkar_pinggul" class="form-control form-control-solid" required placeholder="Lingkar Pinggul" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Berat Badan  <span class="text-danger">*</span></label>
                            <input type="number" id="berat_badan" name="berat_badan" class="form-control form-control-solid" required placeholder="Berat Badan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Pinggang  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_pinggang" name="lingkar_pinggang" class="form-control form-control-solid" required placeholder="Lingkar Pinggang" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lingkar Leher  <span class="text-danger">*</span></label>
                            <input type="number" id="lingkar_leher" name="lingkar_leher" class="form-control form-control-solid" required placeholder="Lingkar Leher" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else if (selectedOption === "kebugaran jasmani") {
            var html = `
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kiri Mata Tutup  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_left_matatutup" name="balancing_left_matatutup" class="form-control form-control-solid" required placeholder="Keseimbangan Kiri Mata Tutup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kanan Mata Tutup  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_right_mata tutup" name="balancing_right_mata tutup" class="form-control form-control-solid" required placeholder="Keseimbangan Kanan Mata Tutup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kiri Jinjit  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_left_jinjit" name="balancing_left_jinjit" class="form-control form-control-solid" required placeholder="Keseimbangan Kiri Jinjit" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Keseimbangan Kanan Jinjit  <span class="text-danger">*</span></label>
                            <input type="number" id="balancing_right_jinjit" name="balancing_right_jinjit" class="form-control form-control-solid" required placeholder="Keseimbangan Kanan Jinjit" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai 2 Kaki  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_2legs" name="sit_reach_2legs" class="form-control form-control-solid" required placeholder="Duduk Capai 2 Kaki" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai Kaki Kiri  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_Leftstraight" name="sit_reach_Leftstraight" class="form-control form-control-solid" required placeholder="Duduk Capai Kaki Kiri" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Duduk Capai Kaki Kanan  <span class="text-danger">*</span></label>
                            <input type="number" id="sit_reach_rightstraight" name="sit_reach_rightstraight" class="form-control form-control-solid" required placeholder="Duduk Capai Kaki Kanan" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Backrise  <span class="text-danger">*</span></label>
                            <input type="number" id="backrise" name="backrise" class="form-control form-control-solid" required placeholder="Backrise" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Aility Heks Left  <span class="text-danger">*</span></label>
                            <input type="number" id="agility_Heks_left" name="agility_Heks_left" class="form-control form-control-solid" required placeholder="Aility Heks Left" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Agility Heks Right  <span class="text-danger">*</span></label>
                            <input type="number" id="agility_Heks_right" name="agility_Heks_right" class="form-control form-control-solid" required placeholder="Agility Heks Right" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Pushup  <span class="text-danger">*</span></label>
                            <input type="number" id="pushup" name="pushup" class="form-control form-control-solid" required placeholder="Pushup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Situp  <span class="text-danger">*</span></label>
                            <input type="number" id="situp" name="situp" class="form-control form-control-solid" required placeholder="Situp" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lompat Vertikal  <span class="text-danger">*</span></label>
                            <input type="number" id="vertical_jump" name="vertical_jump" class="form-control form-control-solid" required placeholder="Lompat Vertikal" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Pullup  <span class="text-danger">*</span></label>
                            <input type="number" id="pullup" name="pullup" class="form-control form-control-solid" required placeholder="Pullup" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Shuttle Run  <span class="text-danger">*</span></label>
                            <input type="number" id="shuttle_run" name="shuttle_run" class="form-control form-control-solid" required placeholder="Shuttle Run" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Lari 60 Meter  <span class="text-danger">*</span></label>
                            <input type="number" id="run_60meter" name="run_60meter" class="form-control form-control-solid" required placeholder="Lari 60 Meter" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else if (selectedOption === "gula darah") {
            $(`#formPeriksa${index}`).html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Gula Darah  <span class="text-danger">*</span></label>
                            <input type="number" id="gula_darah" name="gula_darah" class="form-control form-control-solid" required placeholder="Gula Darah" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else if (selectedOption === "asam urat") {
            $(`#formPeriksa${index}`).html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">Asam Urat  <span class="text-danger">*</span></label>
                            <input type="number" id="asam_urat" name="asam_urat" class="form-control form-control-solid" required placeholder="Asam Urat" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else if (selectedOption === "kolestrol") {
            $(`#formPeriksa${index}`).html('');
            var html = `
                <div class="row">
                    <div class="col-12">
                        <div class="fv-row mb-2">
                            <label for="" class="form-label mb-1" style="font-size: 15px">kolestrol  <span class="text-danger">*</span></label>
                            <input type="number" id="kolestrol" name="kolestrol" class="form-control form-control-solid" required placeholder="kolestrol" />
                        </div>
                    </div>
                </div>
            `;
            $(`#formPeriksa${index}`).append(html);
        } else {
          console.log('tidak ok');
        }
    });
</script>

