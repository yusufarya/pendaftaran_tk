<?php
$data = json_decode(json_encode($pageInfo), True);
$user = $data['me'];

$register = $this->db->get_where('pendaftar', ['murid_id' => $user['id']]);
$checkRegister = $register->num_rows();
$dataDaftar = $register->row_array();

$cekLampiran = $this->db->get_where('lampiran_murid', ['nik' => $user['nik'], 'akta_kelahiran <>' => '', 'kartu_keluarga <>' => '' ])->row_array(); 
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-black-800 shadow py-2">Form <?= $data['title'] ?> </h1>
    </div>

    <?php if ($checkRegister > 0) {
        if (!$user['gambar']) { ?>
            <?php echo form_open_multipart('pendaftar/do_upload_img'); ?>
            <div class="col-md-10 card roounded p-3 mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/user/default.jpg') ?>" class="card-img-top previewImg" alt="profileImage">
                        <div class="card-body">
                            <h5 class="card-title">Upload Foto</h5>
                            <input class="form-control form-control-sm" id="uploadedfile" name="fotoDiri" type="file">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="height: 87%;"></div>
                        <button type="submit" class="btn btn-primary py-1">Simpan</button>
                    </div>
                </div>
            </div>
        <?php
        } else if ($cekLampiran == '') { ?>
            <div class="col-md-10 card roounded p-3 mb-3">
                <strong class="px-3 py-2 mt-2 rounded" style="background-color: salmon; text-align: center">
                    Upload Lampiran
                </strong> 
                <form id="form_upload_file" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col mx-1 mt-3">
                            <div class="mb-3">
                                <label for="file_akta" class="form-label">Upload Akta Kelahiran </label>
                                <input class="form-control" type="file" id="file_akta" name="file_akta">
                                <small style="color: red;">Format file jpg | jpeg | png</small>
                            </div>
                            <div class="mb-3">
                                <label for="file_kk" class="form-label">Upload Kartu Keluarga </label>
                                <input class="form-control" type="file" id="file_kk" name="file_kk">
                                <small style="color: red;">Format file jpg | jpeg | png</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row m-1 my-4"> 
                        <button type="button" id="save_file" class="btn btn-info text-dark text-dark"> Simpan File </button> 
                    </div>
                </form>
            </div>
        <?php
        } else if ($user['gambar'] != '' && $dataDaftar['status_bayar'] == 0) { ?>
            <div class="col-md-10">
            <br>
                <div class="row p-3 bg-white rounded">
                    <div class="mb-3 row m-2 my-4">
                        <h6 class="m-0 mb-3 alert alert-warning">Biodata anda telah disimpan, silahkan lakukan pembayaran</h6> <br>
                        <a href="<?= base_url('payment-re-registration') ?>" class="text-decoration-none mt-3 btn btn-info text-dark text-dark"> <i class="bi bi-cash-coin"></i> Lanjutkan Pembayaran <i class="bi bi-cash-coin"></i></a> 
                    </div>
                </div>
            </div> <br><br><br><br><br><br><br><br>
        <?php
        }
        ?>

    <?php } else { ?>
        <!-- Content Row -->
        <div class="col-md-10 card rounded p-3 mb-3">
            <form action="<?= base_url('pendaftar/daftar_murid') ?>" method="POST">
                <!-- IDENTITAS -->
                <strong class="row bg-warning px-2 mx-3 mt-2">Identitas</strong>
                <div class=" mb-3 row m-2">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="jenis_kel" class="col-sm-3 col-form-label">Jenis Kelamin <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <select name="jenis_kel" id="jenis_kel" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki" <?= $user['jenis_kel'] ==  'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $user['jenis_kel'] ==  'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="nik" class="col-sm-3 col-form-label">NIK <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" id="nik" class="form-control" maxlength="16" value="<?= $user['nik'] ?>" required>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>

                <div class=" mb-3 row m-2">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat / Tgl. Lahir <i style="color: red;">*</i></label>
                    <div class="col-sm-5">
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $user['tempat_lahir'] ?>">
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Tambahkan alamat..."><?= $user['alamat'] ?></textarea>
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="negara" class="col-sm-3 col-form-label">Kewarganegaraan <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="negara" id="negara" class="form-control" value="<?= $user['negara'] ?>">
                    </div>
                </div>
                <hr>
                <div class=" mb-3 row m-2">
                    <label for="tinggal_dengan" class="col-sm-3 col-form-label">Tinggal Bersama <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="tinggal_dengan" id="tinggal_dengan" class="form-control" placeholder="Orang tua / Saudara / dll" value="<?= $user['tinggal_bersama'] ?>">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="anak_ke" class="col-sm-3 col-form-label">Anak Ke <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="anak_ke" id="anak_ke" class="form-control" value="<?= $user['anak_ke'] ?>">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="usia" class="col-sm-3 col-form-label">Usia <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="usia" id="usia" class="form-control" value="<?= $user['usia'] ?>">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="no_telp" class="col-sm-3 col-form-label">No. Telp <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $user['no_telp'] ?>">
                    </div>
                </div>
                <!-- DATA WALI -->
                <strong class="row bg-warning px-2 mx-3 mt-4">Data Wali</strong>
                <div class=" mb-3 row m-2">
                    <label for="nama_w" class="col-sm-3 col-form-label">Nama Lengkap <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_w" name="nama_w" value="">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="jenis_kel_w" class="col-sm-3 col-form-label">Jenis Kelamin <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <select name="jenis_kel_w" id="jenis_kel_w" class="form-select">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="nik_w" class="col-sm-3 col-form-label ">NIK <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="nik_w" id="nik_w" class="form-control" maxlength="16">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="tempat_lahir_w" class="col-sm-3 col-form-label">Tempat / Tgl. Lahir <i style="color: red;">*</i></label>
                    <div class="col-sm-5">
                        <input type="text" name="tempat_lahir_w" id="tempat_lahir_w" class="form-control" value="<?= $user['tempat_lahir'] ?>">
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_lahir_w" name="tgl_lahir_w" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="alamat_w" class="col-sm-3 col-form-label">Alamat Lengkap <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="alamat_w" name="alamat_w" placeholder="Tambahkan alamat..."></textarea>
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="negara_w" class="col-sm-3 col-form-label">Kewarganegaraan <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="negara_w" id="negara_w" class="form-control">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="no_telp_w" class="col-sm-3 col-form-label">No. Telp Wali <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="no_telp_w" id="no_telp_w" class="form-control" value="">
                    </div>
                </div>
                <div class=" mb-3 row m-2">
                    <label for="email_w" class="col-sm-3 col-form-label">Email <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" name="email_w" id="email_w" class="form-control" placeholder="nama@gmail.com">
                    </div>
                </div>
                <div class="mb-3 row mr-2" style="float: right;">
                    <footer>
                        <button type="button" id="resetPesanan" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" id="daftar" class="btn btn-primary">Lanjutkan</button>
                    </footer>
                </div>
            </form>
        </div>
    <?php } ?>
</div>

<!-- /.container-fluid -->