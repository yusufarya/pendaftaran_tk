<?php
$data = json_decode(json_encode($pageInfo), True);
$level_ = $data['me']['role_id'];
$order = '';
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="height: 100vh;">

    <!-- Page Heading -->
    <form action="<?php echo base_url('kategoriList') ?>" method="post">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="h4 mb-2 text-dark"><?= $data['title'] ?></h3>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Cari nama..." autocomplete="off" value="<?= $data['searchText'] ?>">
                    <button class="btn btn-outline-primary" type="submit" id="submit">Cari</button>
                    <button class="btn btn-outline-secondary" onclick="resetSearch()"><i class="fa fa-eraser"></i></button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-select" name="orderby" id="orderList">
                            <option value="">Urutkan</option>
                            <option value="id" <?= $order == 'id' ? 'selected' : '' ?>>Id</option>
                            <option value="nama" <?= $order == 'nama' ? 'selected' : '' ?>>Nama Barang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" style="float: right;" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addData">
                    <i class="bi bi-plus"></i> Kategori
                </button>
            </div>
        </div>
    </form>

    <!-- Content Row -->
    <div class="row mt-2 mx-0">

        <table class="table table-sm table-hover table-bordered">
            <thead>
                <tr style="text-transform: uppercase; font-size: 13px; background: #ececec;">
                    <th style="width:5%;">id</th>
                    <th>Nama Barang</th>
                    <th>Keterangan</th>
                    <th style="width:70px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['kategori'] as $key => $val) { ?>
                    <tr style="font-size: 13px;">
                        <td><?= $val['id'] ?></td>
                        <td><?= $val['nama'] ?></td>
                        <td><?= $val['keterangan'] ?></td>
                        <td style="text-align: center;">
                            <a href="#" onclick="editData('<?= $val['id'] ?>','<?= $val['nama'] ?>', '<?= $val['keterangan'] ?>', <?= $level_ ?>)" class="text-warning bg-white"><i class="bi bi-pencil"></i></a> &nbsp;
                            <a href="#" onclick="deleteData('<?= $val['id'] ?>','<?= $val['nama'] ?>', <?= $level_ ?>)" class="text-danger bg-white"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- /.container-fluid -->
<div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addDataLabel">Tambah Data Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('addKategori') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Tambahkan text.."></textarea>
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

<!-- /.container-fluid -->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editDataLabel">Ubah Data Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Master/updateKeterangan') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="hidden" class="form-control" id="id_edit" name="id_edit">
                            <input type="text" class="form-control" id="nama_edit" name="nama_edit" required placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control" id="ket_edit" name="ket_edit" placeholder=""></textarea>
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

<!-- /.container-fluid -->
<div class="modal fade" id="deleteData" tabindex="-1" aria-labelledby="deleteDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteDataLabel">Hapus Data Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Master/deleteKategori') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <small>Pilih ya jika anda ingin menghapus</small>
                            <input type="hidden" class="form-control" id="id_del" name="id_del">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">&nbsp;Ya&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
</div>