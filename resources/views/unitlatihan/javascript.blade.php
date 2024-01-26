<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableUnitLatihan: BASE_URL + 'unit_latihan/initTable',
            storeUnitLatihan: BASE_URL + 'unit_latihan/storeData',
            deleteUnitLatihan: BASE_URL + 'unit_latihan/deleteData',
        };
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
        $('#tableUnitLatihan').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableUnitLatihan,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Menampilkan nomor urut pada setiap baris
                    }
                },
                { data: 'unit_latihan_kode'},
                { data: 'unit_latihan_nama'},
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[1, 'asc']]
        });
        $('.dropdown-toggle').dropdown();
    }

    onRefresh = () => {
        $('#tableUnitLatihan').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formUnit"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeUnitLatihan,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            console.log(response);
                            if (response.success == true) {
                                $('#modalAddUl').modal('hide');
                                $('#tableUnitLatihan').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUl').hide();
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

    onEdit = (id, nama) => {
        $('#modalAddUl').modal('show');
        $('#unit_latihan_id').val(id);
        $('#unit_name').val(nama);
    }

    onDelete = (id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteUnitLatihan,
                        type: 'POST',
                        data: {
                            unit_latihan_id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            console.log(response);
                            if (response.success == true) {
                                $('#modalAddUl').modal('hide');
                                $('#tableUnitLatihan').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUl').hide();
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

    // initTable = () => {
    //     var test = 'test';
        // HELPER.block();
        // $.ajax({
        //     url: HELPER.api.tableUnitLatihan,
        //     type: 'POST',
        //     data: {
        //         laporan_id: test,
        //     },
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     success: (response) => {
        //         console.log(response);
        //         $('#test').text(response.test);
        //         HELPER.showMessage({
        //             success: true,
        //             message: 'Successfully save data !',
        //             title: 'Success'
        //         });
        //     },
        //     complete: (response) => {
        //         HELPER.unblock(500);
        //     }
        // });
    // }
</script>



