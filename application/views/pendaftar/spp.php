<?php
$data = json_decode(json_encode($pageInfo), True);
$dataMe = $data['me'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 m-0 text-black-800 shadow p-2"> <?= $data['title'] ?> </h1>
    </div>

    <!-- Content Row -->
    <div class="row shadow p-3">

        <?php
        for ($i = 1; $i <= 12; $i++) {
            $bulan = sprintf('%02d', $i);
            $SQRY = "SELECT * FROM transaksi WHERE nik = '" . $dataMe['nik'] . "' AND kode_spp = '" . $bulan . "' ";
            $checkBayarSpp = $this->db->query($SQRY)->row_array();
            // pre($checkBayarSpp);
        ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body px-4">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-3">
                                <div class="text-lg font-weight-bold text-dark text-uppercase mb-1">
                                    <?= getNamaBulan($i) ?>
                                </div>
                                <div class="mt-3 mb-0 font-weight-bold text-gray-800">
                                    <?= $checkBayarSpp ? '<i style="color: salmon;"> L U N A S &nbsp; - &nbsp; ' . date('d-m-Y', strtotime($checkBayarSpp['tanggal'])) . '</i>' : '-0' ?>
                                </div>
                                <a href="<?= base_url('paySpp/') . sprintf('%02d', $i) ?>" class="text-decoration-none text-primary" style="font-size:13px;">
                                    Pembayaran
                                </a>
                            </div>
                            <div class="col-auto me-3">
                                <i class="fas fa-file text-success fa-2x "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

</div>
<!-- /.container-fluid -->