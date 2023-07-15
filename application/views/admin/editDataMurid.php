<?php

$data = json_decode(json_encode($pageInfo), True);

$m = $data['mDetail'];
$kelasInfo = $data['kelasInfo'];
?>

<div class="container-fluid">

    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-2 text-dark"><?= $data['title'] ?></h3>
        </div>
        <hr>

    </div>

    <div class="container">
        <form action="<?= base_url('Admin/updateMurid') ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $m['nama'] ?>" required>
                                <input type="hidden" id="id" name="id" value="<?= $m['id'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="nik">Nik</label>
                                <input type="text" id="nik" name="nik" class="form-control" value="<?= $m['nik'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="<?= $m['nik'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <br>
                    <img src="<?php echo base_url('assets/img/user/') . $m['gambar'] ?>" alt="profile" width="220" class="ms-5">
                </div>
            </div>
            <hr>

            <div class="row" style="width: 80%;">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?= $m['tempat_lahir'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?= $m['tgl_lahir'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="usia">Usia</label>
                        <input type="text" id="usia" name="usia" class="form-control" value="<?= $m['usia'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="negara">Negara</label>
                        <input type="text" id="negara" name="negara" class="form-control" value="<?= $m['negara'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $m['alamat'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?= $m['no_telp'] ?>" required>
                    </div>
                </div>
                <!-- Kelas -->
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select">
                            <?php foreach ($kelasInfo as $kls) { ?>
                                <option value=" <?= $kls['id'] ?>" <?= $m['kelas_id'] == $kls['id'] ? 'selected' : '' ?>>
                                    <?= $kls['kode'] . ' - ' . $kls['kelompok'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1" <?= $m['status'] == 1 ? 'selected' : '' ?>>
                                Aktif
                            </option>
                            <option value="0" <?= $m['status'] == 0 ? 'selected' : '' ?>>
                                Tidak Aktif
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="tgl_dibuat">Tanggal Daftar</label>
                        <input type="date" id="tgl_dibuat" name="tgl_dibuat" class="form-control" value="<?= $m['tgl_dibuat'] ?>" readonly>
                    </div>
                </div>
                <div class="col">
                    <button class="btn btn-success px-4 mt-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
</div>
</div>