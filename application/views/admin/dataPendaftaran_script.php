<script>
    function detailPayment(nik) {
        $('#detailRegister').modal('show')

        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?= base_url('getPaymentRegister') ?>",
            data : {nik : nik},
            async: false,
            success : (data) => {
                console.log(data)

                $('table #id_trans').text(data['nomor'])
                $('table #tgl').text(data['tanggal']) 
                $('table #img_trns').attr('src', '<?= base_url('assets/img/pembayaran/') ?>'+data['tanggal']);
            }
        })
    }
</script>