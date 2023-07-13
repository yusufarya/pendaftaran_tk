<script>
    function updateKelas(id) {
        let kelas = $('#kelas').val()

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/updateKelasMurid') ?>",
            data: {
                kelas: kelas,
                murid_id: id
            },
            success: () => {
                window.location.href = "<?= base_url('student') ?>";
            }
        })
    }
</script>