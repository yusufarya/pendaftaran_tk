<?php
$data = json_decode(json_encode($pageInfo), True);
$dataAdm = $data['me'];

$dataBiaya = $this->db->query("SELECT * FROM `biaya_administrasi` ")->row_array();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    </div><hr><br>

    <!-- Content Row -->
    <form action="update_biaya_administrasi" method="post" class="card p-3"> 
        
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="pendaftaran" class="text-dark">Pendaftaram</label>
                    <input type="text" id="pendaftaran" name="pendaftaran" class="form-control" value="<?= ($dataBiaya['pendaftaran']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="seragam" class="text-dark">Seragam</label>
                    <input type="text" id="seragam" name="seragam" class="form-control" value="<?= ($dataBiaya['seragam']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="buku_pembelajaran" class="text-dark">Buku Pembelajaran</label>
                    <input type="text" id="buku_pembelajaran" name="buku_pembelajaran" class="form-control" value="<?= ($dataBiaya['buku_pembelajaran']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="alat_tulis" class="text-dark">Alat - alat Tulis</label>
                    <input type="text" id="alat_tulis" name="alat_tulis" class="form-control" value="<?= ($dataBiaya['alat_tulis']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="tas_sekolah" class="text-dark">Tas Sekolah</label>
                    <input type="text" id="tas_sekolah" name="tas_sekolah" class="form-control" value="<?= ($dataBiaya['tas_sekolah']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="spp_pertama" class="text-dark">SPP Pertama</label>
                    <input type="text" id="spp_pertama" name="spp_pertama" class="form-control" value="<?= ($dataBiaya['spp_pertama']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="porseni_asuransi" class="text-dark">Porseni & Asuransi</label>
                    <input type="text" id="porseni_asuransi" name="porseni_asuransi" class="form-control" value="<?= ($dataBiaya['porseni_asuransi']) ?>" > 
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-2">
                <div class="form-group px-2">
                    <label for="potongan" class="text-dark">Potongan</label>
                    <input type="text" id="potongan" name="potongan" class="form-control" value="<?= ($dataBiaya['potongan']) ?>" > 
                </div>
            </div> 

            <div>
                <!-- <button type="button" style="float: right; margin-right: 10px;" class="btn btn-success">Edit Data</button> -->
                <button type="submit" style="float: right; margin-right: 10px;" class="btn btn-info">Simpan Data</button>
            </div>
        </div> 
    </form>

</div>
</div>
</div>
<!-- /.container-fluid -->