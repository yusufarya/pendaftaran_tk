<?php
$data = json_decode(json_encode($pageInfo), True);
$level_ = $data['me']['level_id'];
$order = $data['order'];
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="height: 100vh;">

    <!-- Page Heading -->
    <form action="<?php echo base_url('registration') ?>" method="post">
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
                    <th style="width:12%;">Kode</th>
                    <th>Nama</th>
                    <th style="text-align:left;">Nik</th>
                    <th style="width:110px; text-align:left;">Tanggal</th>
                    <th style="width:120px; text-align: center;">Metode Bayar</th>
                    <th style="width:170px; text-align: center;">Bukti Pembayaran</th>
                    <th style="width:80px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['dataDetail'] as $key => $val) {
                ?>
                    <tr style="font-size: 13.5px;">
                        <td><?= $val['nomor'] ?></td>
                        <td>
                            <a class="text-decoration-none" href="<?= base_url('detailMurid/') . $val['murid_id'] ?>"><?= $val['nama_murid'] ?></a>
                        </td>
                        <td><?= $val['nik'] ?></td>
                        <td><?= date('m-d-Y', strtotime($val['tanggal'])); ?></td>
                        <td style="text-align: center;">
                            <?= $val['metode_byr'] ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $val['gambar'] ?>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?= base_url('Payment/paymentDetail/') . $val['nomor'] ?>" class="text-info bg-white"><i class="bi bi-info"></i> Detail</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->