<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3498eb;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home_sales') ?>">
        <div class="sidebar-brand-icon">
            <i class="bi bi-house-door-fill"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><sup>TK </sup> AMALIA </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $data['active'] == 'Home' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('home') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home Murid</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Pendaftaran
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Daftar' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('daftar') ?>">
            <i class="fas fa-fw fa-file" aria-hidden="true"></i>
            <span>Pendaftaran</span>
        </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Pembayaran' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('daftar_ulang') ?>">
            <i class="fas fa-fw fa-dollar-sign" aria-hidden="true"></i>
            <span>Pembayaran</span>
        </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Transaksi' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('transaksi_saya') ?>">
            <i class="fas fa-fw fa-cart-plus" aria-hidden="true"></i>
            <span>Transaksi Saya</span>
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