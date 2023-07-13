<?php
$data = json_decode(json_encode($pageInfo), True);
$level_ = $data['me']['level_id'];
$order = $data['order'];

$dataDetail = $data['dataDetail'];
// pre($dataDetail);
$usia = $dataDetail['usia'];
if ($usia > 5) {
    $dataKelas = $this->db->get_where('kelas', ['kode' => 'B'])->result_array();
} else {
    $dataKelas = $this->db->get_where('kelas', ['kode' => 'A'])->result_array();
}
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
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>
                        <?= $dataDetail['nama_murid'] ?>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        <?= $dataDetail['jenis_kel'] ?>
                    </td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>
                        <?= $dataDetail['usia'] ?> Tahun
                    </td>
                </tr>
            </table>
            <div>
                <label for="kelas">Kelompok Kelas</label>
                <select name="kelas" id="kelas" class="form-select">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($dataKelas as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?= $dataDetail['kelas_id'] == $row['id'] ? 'selected' : '' ?>>
                            <?= $row['kelompok'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-3">
                <button type="button" onclick="updateKelas(`<?= $dataDetail['murid_id'] ?>`)" class="btn btn-primary"> Simpan</button>
            </div>
        </div>
        <!-- END COLUMN -md-8 -->
    </div>

</div>
<!-- /.container-fluid -->