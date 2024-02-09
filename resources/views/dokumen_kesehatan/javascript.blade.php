<script type="text/javascript">
    $(() => {
        HELPER.api = {
            generateDoc: BASE_URL + 'datakesehatan/initTable',
        };
        HELPER.createCombo({
            el: ['anggota_id'],
            valueField: 'anggota_id',
            // grouped: true,
            displayField: 'anggota_nama',
            // displayField2: 'unit_latihan_nama',
            placeholder: '-Pilih Anggota-',
            url: HELPER.api.comboAnggota,
            csrf: $('meta[name="csrf-token"]').attr('content'),
            type: "POST"
        });
    });

    function generateDoc() {
        var formData = new FormData(document.getElementById("form-dokumen"));

        $.ajax({
            type: "POST",
            url: HELPER.api.generateDoc,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
        });
    }

    function clear() {
        // $('#form-dokumen')[0].reset();
        $('#form-dokumen').trigger("reset");
    }
</script>
