<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableUser: BASE_URL + 'user/initTable',
            storeUser: BASE_URL + 'user/storeData',
            deleteUser: BASE_URL + 'user/deleteData',
            showUser: BASE_URL + 'user/showData',
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
        $('#tableUser').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableUser,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Menampilkan nomor urut pada setiap baris
                    }
                },
                { data: 'name'},
                { data: 'email'},
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[1, 'asc']],
        });
    }

    onCreate = () => {
        $('#id').val('');
        $('#name').val('');
        $('#last_name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#formInputPass').show();
    }

    onRefresh = () => {
        $('#tableUser').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formUser"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeUser,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddUser').modal('hide');
                                $('#tableUser').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUser').hide();
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
            url: HELPER.api.showUser,
            type: 'POST',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success == true) {
                    $('#id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#last_name').val(response.data.last_name);
                    $('#email').val(response.data.email);
                    $('#exampleModalLongTitle').text('Edit User');
                    $('#formInputPass').hide();
                    $('#modalAddUser').modal('show');
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
                        url: HELPER.api.deleteUser,
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddUser').modal('hide');
                                $('#tableUser').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUser').hide();
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