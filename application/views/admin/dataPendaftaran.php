<?php
$data = json_decode(json_encode($pageInfo), True);
$level_ = $data['me']['level_id'];
$order = $data['order'];
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="height: 100vh;">

    <!-- Page Heading -->
    <form action="<?php echo base_url('registrationList') ?>" method="post">
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
                            <option value="nama" <?= $order == 'nama' ? 'selected' : '' ?>>Nama</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Content Row -->
    <div class="row mt-2 mx-0">

        <table class="table table-sm table-hover table-bordered">
            <thead>
                <tr style="text-transform: uppercase; font-size: 13px; background: #ececec;">
                    <th style="width: 7%;">Id</th>
                    <th>Nama</th>
                    <th style="text-align:left;">Nik</th>
                    <th style="text-align:left;">Alamat</th>
                    <th style="width:110px; text-align:left;">Tanggal</th>
                    <th style="width:120px; text-align: center;">Kelas</th>
                    <th style="width:8s0px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['dataDetail'] as $key => $val) {
                ?>
                    <tr style="font-size: 13.5px;">
                        <td><?= $val['id'] ?></td>
                        <td>
                            <a class="text-decoration-none" href="<?= base_url('detailMurid/') . $val['murid_id'] ?>"><?= $val['nama_murid'] ?></a>
                        </td>
                        <td><?= $val['nik'] ?></td>
                        <td><?= $val['alamat'] ?></td>
                        <td><?= date('m-d-Y', strtotime($val['tanggal'])); ?></td>
                        <td style="text-align: center;">
                            <?= $val['status_bayar'] == 1 ? '
                            <a href="' . base_url('manageClass/') . $val['id'] . '" class="text-success bg-white">Pembagian Kelas</a> 

                            ' : '
                            ' ?>
                        </td>
                        <td style="text-align: center;">
                            <!-- <a href="<?= base_url('Transaksi/editTransaksi/') . $val['id'] ?>" class="text-info bg-white"><i class="bi bi-check2-circle"></i> ACC</a> -->

                            <a href="#" onclick="detailPayment(`<?= $val['id'] ?>`,`<?= $val['nik'] ?>`,`<?= $val['nama_murid'] ?>`)" class="text-info bg-white"><i class="bi bi-info"></i> Detail</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="detailRegister" tabindex="-1" aria-labelledby="detailRegisterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailRegisterLabel">Detail Pendaftaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <table class="table table-sm table-striped">
                            <tr>
                                <th>ID TRANSAKSI</th>
                                <td id="id_trans"></td>
                            </tr>
                            <tr>
                                <th>TANGGAL</th>
                                <td id="tanggal"></td>
                            </tr>
                            <tr>
                                <th>METODE PEMBAYARAN</th>
                                <td id="metode_bayar"></td>
                            </tr>
                            <tr>
                                <th>HARGA</th>
                                <td id="harga"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <img src="" alt="bukti_transaksi" id="img_trns">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="accPayment">ACC</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>