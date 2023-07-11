<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background : #3498eb; border-radius: 8px;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="bi bi-house-door-fill"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><sup>TK</sup>AMALIA </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $data['active'] == 'Dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pendaftaran
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Pendaftaran' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('registrationList') ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Data Pendaftaran</span>
        </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Murid' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('student') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Murid</span>
        </a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?php echo $data['active'] == 'payment' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#trbl" aria-expanded="true" aria-controls="trbl">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Pembayaran</span>
        </a>
        <div id="trbl" class="collapse <?php echo $data['active'] == 'payment' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if ($this->uri->segment(1) == "administrativeCost") {
                                            echo "active";
                                        } ?>" href="<?= base_url('administrativeCost') ?>">Biaya Administrasi</a>
                <a class="collapse-item <?php if ($this->uri->segment(1) == "reRegistrationPayment") {
                                            echo "active";
                                        } ?>" href="<?= base_url('reRegistrationPayment') ?>">Pembayaran Pendaftaran</a>
                <a class="collapse-item <?php if ($this->uri->segment(1) == "sppPayment") {
                                            echo "active";
                                        } ?>" href="<?= base_url('sppPayment') ?>">Pembayaran Spp</a>
                <!-- <div class="collapse-divider"></div> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?php echo $data['active'] == 'Laporan' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse <?php echo $data['active'] == 'Laporan' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $data['title'] == 'Laporan Transaksi' ? 'active' : '' ?>" href="<?= base_url('laporan/transaksi') ?>">Laporan Transaksi</a>
                <a class="collapse-item <?= $data['title'] == 'Laporan Penilaian' ? 'active' : '' ?>" href="<?= base_url('laporan/penilaian') ?>">Laporan Penilaian Sales</a>
                <!-- <div class="collapse-divider"></div> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Password' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/ubahPassword') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Ubah Kata Sandi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->