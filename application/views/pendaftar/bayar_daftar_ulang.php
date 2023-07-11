<?php
$data = json_decode(json_encode($pageInfo), True);
$user = $data['me'];

$register = $this->db->get_where('pendaftar', ['murid_id' => $user['id']]);
$checkRegister = $register->num_rows();
$dataDaftar = $register->row_array();

$metode_bayar = $data['metode_bayar'];

$QRYB = "SELECT *,
        pendaftaran+seragam+buku_pembelajaran+alat_tulis+tas_sekolah+spp_pertama+porseni_asuransi AS jumlah, 
        pendaftaran+seragam+buku_pembelajaran+alat_tulis+tas_sekolah+spp_pertama+porseni_asuransi-potongan AS total_biaya
        FROM biaya_administrasi";
$biaya_detail = $this->db->query($QRYB)->row_array();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-black-800 shadow py-2">Form <?= $data['title'] ?> </h1>
    </div>

    <?php if ($checkRegister > 0) {
        if (!$user['gambar']) { ?>
            <!-- Belum Upload Foto Diri -->
        <?php
        } else if ($user['gambar'] != '' && $dataDaftar['status_bayar'] == 0) { ?>
            <div class="col-md-10 card roounded p-3 mb-3">
                <form action="<?= base_url('pembayaran') ?>" method="POST">
                    <strong class="row px-3 py-2 m-2 rounded" style="background-color: salmon;">
                        Lanjutkan Pembayaran Daftar Ulang
                    </strong>
                    <div class=" mb-3 row m-2 mt-4">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap <i style="color: red;">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required readonly>
                            <input type="hidden" class="form-control" id="murid_id" name="murid_id" value="<?= $user['id'] ?> ">
                            <input type="hidden" class="form-control" id="nik" name="nik" value="<?= $user['nik'] ?> ">
                        </div>
                    </div>
                    <div class=" mb-3 row m-2">
                        <label for="metode_bayar" class="col-sm-3 col-form-label">Metode Pembayaran <i style="color: red;">*</i></label>
                        <div class="col-sm-9">
                            <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                <option value="">Pilih Pembayaran</option>
                                <?php foreach ($metode_bayar as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] . " - " . $row['no_rek'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class=" mb-3 row m-2">
                        <label for="label" class="col-sm-3 col-form-label">&nbsp;</label>
                        <div class="col-sm-9">
                            <table class="table table-sm">
                                <tr>
                                    <td>1. Pendaftaran</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['pendaftaran']) ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td>2. Seragam (5 stel)</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['seragam']) ?>
                                        </tr>
                                <tr>
                                    <td>3. Buku Pembelajaran</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['buku_pembelajaran']) ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td>4. Alat - alat tulis</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['alat_tulis'] ) ?>
                                        </tr>
                                <tr>
                                    <td>5. Tas Sekolah</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['tas_sekolah']) ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td>6. SPP Pertama</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['spp_pertama']) ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td>7. Porseni & Asuransi</td>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['porseni_asuransi']) ?>
                                        </td>
                                </tr>
                                <tr style="border-top: 2px solid #000;">
                                    <th><i>Jumlah</i></th>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['jumlah']) ?>
                                        </tr>
                                <tr>
                                    <th><i>Potongan</i></th>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">-
                                        <?= number_format($biaya_detail['potongan']) ?>
                                        </tr>
                                <tr style="border-top: 2px solid #000;">
                                    <th><i>Total Bayar</i></th>
                                    <td style="text-align: right;">Rp.</td>
                                    <td style="text-align: right; width: 20%;">
                                        <?= number_format($biaya_detail['total_biaya']) ?>
                                        </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3 row mr-2" style="float: right !important;">
                        <footer>
                            <button type="submit" id="daftar" class="btn btn-primary">Lanjutkan</button>
                        </footer>
                    </div>
                </form>
            </div>
        <?php
        } else if ($dataDaftar['status_bayar'] == 1) { ?>
            <h1>Anda Telah Melakukan Pembayaran Pendaftaran</h1>
        <?php
        }
        ?>

    <?php } else { ?>
        <!-- Belum Daftar -->
    <?php } ?>
</div>

<!-- /.container-fluid -->