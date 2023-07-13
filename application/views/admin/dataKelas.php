<?php
$data = json_decode(json_encode($pageInfo), True);
$level_ = $data['me']['level_id'];
$order = $data['order'];

$dataKelasA = $this->db->get_where('kelas', ['kode' => 'A'])->result_array();
$dataKelasB = $this->db->get_where('kelas', ['kode' => 'B'])->result_array();
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="height: 100vh;">

    <!-- Page Heading -->
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-1 text-dark"><?= $data['title'] ?></h3>
        </div>
        <hr>
    </div>

    <!-- Content Row -->
    <div class="row mt-2 mx-0">
        <div class="col">
            <h1>Kelas A &nbsp; &nbsp;
                <button class="btn btn-sm btn-danger" type="button" onclick="addClassGroup('A')">
                    <b>+</b> Kelompok Kelas
                </button>
            </h1>
            <hr>
            <?php foreach ($dataKelasA as $rowA) { ?>
                <div class="card">
                    <div class="card-body">
                        <a href="" class="text-dark text-decoration-none">
                            ⚫ <b><?= $rowA['kelompok'] ?></b>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col">
            <h1>Kelas B &nbsp; &nbsp;
                <button class="btn btn-sm btn-warning" type="button" onclick="addClassGroup('B')">
                    <b>+</b> Kelompok Kelas
                </button>
            </h1>
            <hr>
            <?php foreach ($dataKelasB as $rowB) { ?>
                <div class="card">
                    <div class="card-body">
                        <a href="" class="text-dark text-decoration-none">
                            ⚫ <b><?= $rowB['kelompok'] ?></b>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKelasLabel">Tambah Kelompok Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Admin/addClassGroup') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Kelompok Kelas</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama">
                            <input type="hidden" id="kode" name="kode">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>