<script>
    $(function() {
        var curYear = <?= json_encode(date('Y')) ?>;

        $('#tgl_lahir').on('change', () => {

            var tgl_lahir = $('#tgl_lahir').val()
            tgl_lahir = tgl_lahir.substr(0, 4)

            var usia = parseFloat(curYear) - parseFloat(tgl_lahir)
            $('#usia').val(usia)
        })
    })

    var checkRegister = <?= json_encode($checkRegister) ?>;
    var cekGambar = <?= json_encode($user['gambar']) ?>;
    //uploader event
    if (checkRegister > 0 && cekGambar == '') { 
        $('#uploadedfile').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('.previewImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('.previewImg').attr('src', '/assets/default.jpg');
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#save_file").click(function(event) {

            let file_akta = $('#file_akta').val()
            let file_kk = $('#file_kk').val()
            if (file_akta != '' && file_kk != '') {
                event.preventDefault();
                var form_data = new FormData($('#form_upload_file')[0]);
                console.log(form_data)
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Pendaftar/save_file'); ?>",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                    if (res) {
                            bootbox.alert('<b style="color: blue">File Berhasil Disimpan.</b>')
                            setTimeout( () => {
                                window.location.href = '<?= base_url('pendaftar') ?>';
                            }, 800)
                        }
                    }
                }); 
            } else if (file_akta == '') {
                bootbox.alert('<b style="color: red">File Akta Kelahiran masih kosong</b>')
            } else if (file_kk == '') {
                bootbox.alert('<b style="color: red">File Kartu Keluarga masih kosong</b>')
            }
        });  
    });
</script>