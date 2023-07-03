<script>
    function deleteData(kode, nama, level) {
        if (level > 1) {
            alert('Anda tidak mempunyai akses ini')
        } else {
            $('#deleteDataLabel').text('Hapus Data ' + nama + ' ?')
            $('#kode_del').val(kode)
            $('#deleteData').modal('show')
        }
    }

    function editData(kode, nama, harga_beli, harga_jual, level) {
        if (level > 1) {
            alert('Anda tidak mempunyai akses ini')
        } else {
            $('#editDataLabel').text('Ubah Data ' + nama + ' ?')
            $('#kode_edit').val(kode)
            $('#nama_edit').val(nama)
            $('#harga_beli_edit').val(harga_beli)
            $('#harga_jual_edit').val(harga_jual)
            $('#editData').modal('show')
        }
    }
</script>