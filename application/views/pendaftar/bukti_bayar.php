<?php
$data = json_decode(json_encode($pageInfo), True);
$user = $data['me'];

$register = $this->db->get_where('pendaftar', ['murid_id' => $user['id']]);
$checkRegister = $register->num_rows();
$dataDaftar = $register->row_array();

$qry_byr = $this->db->get_where('transaksi', ['nik' => $user['nik']]); 
$nl_trs = $qry_byr->row_array();

$metode_bayar = $data['metode_bayar'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-black-800 shadow py-2">Form <?= $data['title'] ?> </h1>
    </div>

    <?php if ($user['gambar'] != '' && $dataDaftar['status_bayar'] == 0) { ?>
        <div class="col-md-10 card roounded p-3 mb-3">
            <form action="<?= base_url('send_trx') ?>" method="POST" enctype="multipart/form-data">
                <strong class="row alert alert-danger px-3 mx-3 mt-2">Kirimkan Bukti Pembayaran Daftar Ulang</strong>
                <div class=" mb-3 row m-2 mt-4">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required readonly>
                        <input type="hidden" class="form-control" id="murid_id" name="murid_id" value="<?= $user['id'] ?> ">
                    </div>
                </div>
                <div class=" mb-3 row m-2 mt-4">
                    <label for="nama" class="col-sm-3 col-form-label">No. Transaksi <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nl_trs['nomor'] ?>" required readonly>
                    </div>
                </div>
                <div class=" mb-3 row m-2 mt-4">
                    <label for="bukti_bayar" class="col-sm-3 col-form-label">Bukti Pembayaran <i style="color: red;">*</i></label>
                    <div class="col-sm-9">
                        <input class="form-control" id="uploadedbayar" name="buktiBayar" type="file">
                    </div>
                </div>
                <div class="mb-3 row mr-2 mt-4" style="float: right !important;">
                    <footer>
                        <button type="submit" id="kirimBukti" class="btn btn-primary">kirim</button>
                    </footer>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
    <br>
    <hr>
</div>

<!-- /.container-fluid -->