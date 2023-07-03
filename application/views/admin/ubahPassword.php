<?php
$data = json_decode(json_encode($pageInfo), True);
$dataAdm = $data['me'];
$level_ = $data['me']['jabatan_id']; 
?>

<!-- Begin Page Content -->
<div class="container-fluid"> 
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Kata Sandi</h1>
        
    </div>
    <div class="row">
        <div class="col-lg-8"><br>
            <form action="<?php echo base_url('settingpassword'); ?>" method="post">
                <div class="form-group px-2">
                    <input type="hidden" id="nama" name="nama" class="form-control" value="<?php echo $dataAdm['nama'] ?>">
                    <label for="current_password" class="text-dark">Sandi saat ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-control">
                    <?= form_error('current_password', '<small class="text-danger pl-2">', ' </small>'); ?>
                </div>
                <div class="form-group px-2">
                    <label for="new_password1" class="text-dark">Kata sandi baru</label>
                    <input type="password" id="new_password1" name="new_password1" class="form-control">
                    <?= form_error('new_password1', '<small class="text-danger pl-2">', ' </small>'); ?>
                </div>
                <div class="form-group px-2">
                    <label for="new_password2" class="text-dark">Ulangi kata sandi</label>
                    <input type="password" id="new_password2" name="new_password2" class="form-control">
                    <?= form_error('new_password2', '<small class="text-danger pl-2">', ' </small>'); ?>
                </div>
        
                <div class="form-group px-2">
                    <button type="button" onclick="ubahPassword()" class="btn btn-info form-control">
                        Simpan
                    </button>
                </div>
            </form>
            <br><br><br>
        </div>

    </div>
</div><hr>

<script>
    function ubahPassword() {
        var url = "<?php echo base_url('Login_admin/cekUbahPassword') ?>";
        var nama = $('#nama').val();
        var currpass = $('#current_password').val();
        var newpass1 = $('#new_password1').val();
        // var newpass2 = $('#new_password2').val();
        // console.log(currpass)
        // console.log(newpass1)
        bootbox.confirm("Yakin ingin merubah password ?", function(next) {
            if (next) {
                // alert('ok')
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: url,
                    data: {
                        current_password: currpass,
                        new_password1: newpass1
                    },
                    success: function(status) {
                        // console.log(status)
                        setTimeout(function() {
                            bootbox.alert('<b class="text-primary">✔️ Password berhasil diubah</b>', function() {
                                window.location.reload();
                            })
                        }, 1100)
                    },
                    error: function() {
                        setTimeout(function() {
                            // window.location.reload();
                        }, 1000)
                    }
                })
            } else {

            }

        })
    }
</script>