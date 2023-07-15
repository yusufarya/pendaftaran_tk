<script>
    function detailPayment(idDaftar, nik, nama) {

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('getPaymentRegister') ?>",
            data: {
                nik: nik
            },
            async: false,
            success: (data) => {

                if (data.status == 'success') {
                    $('#detailRegister').modal('show')
                    let dataTr = data.dataTrans
                    let total_biaya = data.total_biaya

                    $('table #id_trans').text(dataTr['nomor'])
                    $('table #tanggal').text(dataTr['tanggal'])
                    $('table #metode_bayar').text(dataTr['pembayaran'])
                    $('table #harga').text(total_biaya)
                    $('#img_trns').attr('src', '<?= base_url('assets/img/pembayaran/') ?>' + dataTr['gambar']);

                    $('#accPayment').click(function() {
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: "<?= base_url('Admin/accPayment') ?>",
                            data: {
                                idPendaftar: idDaftar,
                                total_biaya: data.biaya,
                                nomorTr: dataTr['nomor']
                            },
                            async: false,
                            success: (result) => {
                                if (result) {

                                    $('#detailRegister').modal('hide')
                                    bootbox.alert('<b style="color: blue;">Pembayaran Telah Diterima</br>')
                                    setTimeout(() => {
                                        window.location.reload()
                                    }, 800)
                                } else {
                                    bootbox.alert('<b style="color: red;">Proses Gagal. Hubungi Administrator</br>')
                                }
                            }
                        })
                    })
                } else {
                    bootbox.alert('<b style="color:red;">' + nama + ' Belum Melakukan Pembayaran</br>')
                }
            }
        })
    }
</script>