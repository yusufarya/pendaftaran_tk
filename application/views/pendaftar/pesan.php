<?php
$data = json_decode(json_encode($pageInfo), True);
$dataAdm = $data['me'];
$kategori = $data['kategori'];

// $dataB = "SELECT SUM(qty) AS TOTALQTY, SUM(harga) AS TOTALHARGA, SUM(qty*harga) AS JUMLAH FROM transaksi ";
$dataTr = 0;

// $this->db->select('*');
// $this->db->from('transaksi');
// $this->db->order_by('kode', 'DESC');
// $this->db->limit(3);
// $dataAll = [];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class=" d-sm-flex align-items-center justify-content-between mb-4 ml-2">
        <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?> Sekarang</h1>
    </div>

    <!-- Content Row -->
    <form action="" method="POST" class="mx-2" style="border: 1px solid #eaeaea;">
        <div class="row p-3">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Pesanan</label>
                    <input type="text" class="form-control" id="kode" name="kode" placeholder="PO/XXXX-XX/XXX" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori Jasa</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="">Pilih Jasa</option>
                        <?php foreach ($kategori as $k) { ?>
                            <option value="<?= $k['id'] ?> "><?= $k['nama'] ?></option>
                        <?php } ?>
                        <option value="lain">Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pesanan</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
                </div>
            </div>
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="produk" class="form-label">Keterangan</label>
                    <textarea type="text" class="form-control" id="produkDetail" name="produkDetail" placeholder="Tambahkan perincian lainnya..."></textarea>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="qty" name="qty" placeholder="0" required autocomplete="off">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="0" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="0" readonly>
                </div>
            </div>
            <div class="col-md-9">
                <footer style="float: right;">
                    <button type="button" id="resetPesanan" class="btn btn-secondary">Reset Pesanan</button>
                    <button type="button" id="kirimPesanan" class="btn btn-outline-info">Kirim Pesanan</button>
                </footer>
            </div>
        </div>
    </form>
</div>
</div>
<!-- /.container-fluid -->