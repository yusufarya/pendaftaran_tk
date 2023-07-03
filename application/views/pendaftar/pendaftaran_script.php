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
        const imgInp = document.getElementById('uploadedfile')
        const previewImg = document.getElementsByClassName('previewImg')

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                previewImg.src = URL.createObjectURL(file)
                console.log(previewImg)
            }
        }
    }
</script>