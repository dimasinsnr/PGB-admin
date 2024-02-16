<script type="text/javascript">
    $(() => {
        console.log("init")
        HELPER.api = {
            comboAnggota: BASE_URL + 'datakesehatan/comboAnggota',
            generateDoc: BASE_URL + 'dokumen_kesehatan/generate-doc',
        };
        HELPER.createCombo({
            el: ['anggota_id'],
            valueField: 'anggota_id',
            displayField: 'anggota_nama',
            placeholder: '-Pilih Anggota-',
            url: HELPER.api.comboAnggota,
            csrf: $('meta[name="csrf-token"]').attr('content'),
            type: "POST"
        });
    });

    function generateDoc() {
        var formData = new FormData(document.getElementById("form-dokumen"));

        $.ajax({
            url: HELPER.api.generateDoc,
            type: "POST",
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
