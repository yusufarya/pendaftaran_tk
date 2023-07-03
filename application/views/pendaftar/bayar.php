<?php
$data = json_decode(json_encode($pageInfo), True);
$user = $data['me'];
$register = $this->db->select('dt.*, tr.metode_bayar, tr.nomor AS no_transaksi, tr.gambar')
    ->from('pendaftar dt')
    ->join('murid AS m', 'm.id=dt.murid_id')
    ->join('transaksi AS tr', 'tr.nik=m.nik')
    ->get()->row_array();
// pre($register);

$idByr = $register['metode_bayar'];

$metode_bayar = $data['metode_bayar'];

$getRekening = $this->db->get_where('metode_pembayaran', ['id' => $idByr])->row_array();
$namaBank = $getRekening['nama'];
$noRek = $getRekening['no_rek'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-black-800 shadow py-2">Form <?= $data['title'] ?> </h1>
    </div>

    <?php if ($register['gambar'] == '') { ?>
        <div class="col-md-10 card roounded p-3 mb-3" style="height: 450px;">
            <h6 class="ml-4">Pembayaran Daftar Ulang</h6>
            <hr>
            <div class="row mx-4">
                <span class="p-0">Kode Pembayaran</span>
                <span class="badge badge-success py-3" style="font-size: 25px;"><?= $noRek ?></span>
                <table class="table">
                    <tr>
                        <th>Nama Bank</th>
                        <td><?= $namaBank ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. 200,000.00</td>
                    </tr>
                    <tr>
                        <th>Nomor Transaksi</th>
                        <td><?= $register['no_transaksi'] ?></td>
                    </tr>
                </table>
                <p class="bg-warning">Noted: Lakukan pembayaran sebelum 6 jam kedepan.</p>
            </div>
            <div class="row mx-3 mt-5">
                <small style="text-align: right;">
                    <a href="<?= base_url('buktiPembayaran') ?>">Kirim Bukti Pembayaran</a>
                    Jika sudah melakukan pembayaran
                </small>
            </div>

        </div>
    <?php } else { ?>
        <div class="col-md-10 card roounded p-3 mb-3" style="height: 450px;">
            <span>Pembayaran Sedang Diproses.</span>
        </div>
    <?php } ?>

    <br>
    <hr>
</div>

<!-- /.container-fluid -->