<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableAnggota: BASE_URL + 'anggota/initTable',
            storeAnggota: BASE_URL + 'anggota/storeData',
            deleteAnggota: BASE_URL + 'anggota/deleteData',
            showAnggota: BASE_URL + 'anggota/showData',
            comboUnitLatihan: BASE_URL + 'anggota/comboUnitLatihan',
        };
        HELPER.createCombo({
			el: ['anggota_unit_latihan_id'],
			valueField: 'unit_latihan_id',
			grouped: true,
			displayField: 'unit_latihan_kode',
			displayField2: 'unit_latihan_nama',
			displayField2: 'unit_latihan_nama',
			placeholder: '-Pilih Unit-',
			url: HELPER.api.comboUnitLatihan,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        HELPER.createCombo({
			el: ['anggota_unit_latihan_id_detail'],
			valueField: 'unit_latihan_id',
			grouped: true,
			displayField: 'unit_latihan_kode',
			displayField2: 'unit_latihan_nama',
			displayField2: 'unit_latihan_nama',
			placeholder: '-Pilih Unit-',
			url: HELPER.api.comboUnitLatihan,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        $('#anggota_alamat').on('focus', function() {
            // Tampilkan badge
            $('#charCountAlamat').show();
        });

        // Ketika textarea kehilangan fokus
        $('#anggota_alamat').on('blur', function() {
            // Sembunyikan badge
            $('#charCountAlamat').hide();
        });

        $('#anggota_alamat').on('input', function() {
            var charCount = $(this).val().length;
            var maxLength = $(this).attr('maxlength');
            $('#charCountAlamat').text(charCount + '/' + maxLength);
        });

        $('#anggota_catatan_alergi').on('focus', function() {
            // Tampilkan badge
            $('#charCountAlergi').show();
        });

        // Ketika textarea kehilangan fokus
        $('#anggota_catatan_alergi').on('blur', function() {
            // Sembunyikan badge
            $('#charCountAlergi').hide();
        });

        $('#anggota_catatan_alergi').on('input', function() {
            var charCount = $(this).val().length;
            var maxLength = $(this).attr('maxlength');
            $('#charCountAlergi').text(charCount + '/' + maxLength);
        });

        $('#anggota_riwayat_sakit').on('focus', function() {
            // Tampilkan badge
            $('#charCountRiwayat').show();
        });

        // Ketika textarea kehilangan fokus
        $('#anggota_riwayat_sakit').on('blur', function() {
            // Sembunyikan badge
            $('#charCountRiwayat').hide();
        });

        $('#anggota_riwayat_sakit').on('input', function() {
            var charCount = $(this).val().length;
            var maxLength = $(this).attr('maxlength');
            $('#charCountRiwayat').text(charCount + '/' + maxLength);
        });
        init();
        
        $('#inputFile').change(function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                $('#photoPreview').css('background-image', `url(${event.target.result})`);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        // Event saat tombol Cancel/X ditekan
        $('.cancel').click(function() {
            // Atur ulang gambar default di elemen photoPreview
            $('#photoPreview').css('background-image', 'url({{ asset('img/blank.png') }})');
            // Reset input file
            $('#inputFile').val('');
        });
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
        $('#tableAnggota').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableAnggota,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Menampilkan nomor urut pada setiap baris
                    }
                },
                { data: 'unit_latihan_nama'},
                { 
                    data: null,
                    render: function (data) {
                        return `<strong>${data.anggota_nama}</strong><br>${data.anggota_email}`;
                    }
                },
                { 
                    data: null,
                    render: function (data) {
                        // return `<strong>${data.anggota_tempat_lahir}</strong><br>${data.anggota_tgl_lahir}`;
                        return `<strong>${data.anggota_tempat_lahir}</strong><br>${moment(data.anggota_tgl_lahir).format('DD MMMM YYYY')}`;
                    }
                },
                { data: 'anggota_usia'},
                {
                    data: 'anggota_jenis_kelamin',
                    render: function (data) {
                        return data === 1 ? 'Laki-laki' : 'Perempuan';
                    }
                },
                { data: 'anggota_alamat'},
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[1, 'asc']],
        });
    }

    onCreate = () => {
        $('#formAnggota').find('input[type=text], input[type=email], input[type=checkbox], input[type=date], input[type=number], select, textarea').val('');
    }

    onRefresh = () => {
        $('#tableAnggota').DataTable().destroy(); 
        initTable();
    }

    onBack = () => {
        $('#detail_card').slideDown().hide();
        $('#panel-main').show();
        $('#tableAnggota').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formAnggota"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeAnggota,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddAnggota').modal('hide');
                                $('#tableAnggota').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
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
            }
        })
    }

    onEdit = (id, nama, form) => {
        HELPER.block();
        $.ajax({
            url: HELPER.api.showAnggota,
            type: 'POST',
            data: {
                anggota_id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success == true) {
                    HELPER.populateForm($('[id="' + form + '"]'), response.data);
                    var newImageUrl = BASE_URL + 'img/' + response.data.anggota_foto;
                    $('#downloadLink').attr('href', newImageUrl);
                    // var downloadUrl = '{{ asset("img/") }}' + response.data.anggota_foto;
                    // $('#downloadLink').attr('href', newImageUrl);

                    if (form == 'formAnggota') {
                        $('#photoPreview').css('background-image', 'url(' + newImageUrl + ')');
                        $('#modalAddAnggota').modal('show');
                    } else {
                        $('#photoPreviewDetail').css('background-image', 'url(' + newImageUrl + ')');
                        $('#panel-main').slideUp();
                        $('#detail_card').show();
                        $('#backName').text(response.data.anggota_nama);
                    }
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
                        url: HELPER.api.deleteAnggota,
                        type: 'POST',
                        data: {
                            anggota_id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddAnggota').modal('hide');
                                $('#tableAnggota').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddAnggota').hide();
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
</script>



