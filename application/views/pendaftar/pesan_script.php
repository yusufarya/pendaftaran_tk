<script>
    $('#resetPesanan').on('click', () => {
        $('select[name=kategori]').val("")
        $('textarea[name=produkDetail]').val("")
        $('input[name=qty]').val("")
    })

    $('#kirimPesanan').click(function() {
        var kategori = $('#kategori').val()
        var tanggal = $('#tanggal').val()
        var produkDetail = $('#produkDetail').val()
        var qty = $('#qty').val()
        bootbox.confirm('Anda yakin ingin memesan ?', function(res) {
            if (res) {
                // do action //
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "<?= base_url('Pesanan/submitPesanan') ?>",
                    data: {
                        kategori: kategori,
                        tanggal: tanggal,
                        keterangan: produkDetail,
                        qty: qty
                    },
                    success: function(resData) {
                        // window.location.href = "<?= base_url('pesanan_saya') ?>"
                        window.open("<?= base_url('pesanan_saya') ?>")
                    }
                })
            }
        })
    })

    $('#qty').keypress(function(event) {

        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault(); //stop character from entering input
        }

    });
</script>