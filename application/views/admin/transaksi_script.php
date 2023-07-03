<script>
    function deleteTr(kode, sales, level) { 
        if (level < 2) {
            $('.deleteTr').modal('show')
            $('#hapus').html('Yakin ingin menghapus data <b>'+sales + '</b> ?')
            $('#del_kode').val(kode)
        } else {
            bootbox.alert('<b style="color:red;">Anda tidak memiliki akses ini</b>')            
        }
    }

    $('#btnDel').on('click', function() {
        var kode = $('#del_kode').val()  
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Transaksi/deleteTr') ?>",
            data: { kode: kode },
            success: function(res) {
                $('.deleteTr').modal('hide')
                bootbox.alert('1 Data Transaksi berhasil di hapus.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })
</script>