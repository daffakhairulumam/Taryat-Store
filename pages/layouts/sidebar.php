<?php
if ($page == 'dashboard') {
  $classDashboard = 'nav-link active';
} else {
  $classDashboard = 'nav-link collapsed';
}
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="<?php echo $classDashboard ?>" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="master-nav" class="nav-content collapse <?php if ($page == 'users' || $page == 'kategori' || $page == 'barang') echo 'show' ?>" data-bs-parent="#sidebar-nav">
        <li>
          <a href="index.php?page=kategori" class="<?php if ($page == 'kategori') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Kategori</span>
          </a>
        </li>
        <li>
          <a href="index.php?page=barang" class="<?php if ($page == 'barang') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Barang</span>
          </a>
        </li>
      </ul>
    </li><!-- End Master Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#transaksi-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-pc-display-horizontal"></i><span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="transaksi-nav" class="nav-content collapse <?php if ($page == 'transaksi' || $page == 'laporan-transaksi') echo 'show' ?>" data-bs-parent="#sidebar-nav">
        <!-- <li>
          <a href="index.php?page=transaksi" class="<?php if ($page == 'transaksi') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Barang</span>
          </a>
        </li> -->
        <li>
          <a href="index.php?page=transaksi" class="<?php if ($page == 'transaksi') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Transaksi Barang</span>
          </a>
        </li>
        <li>
          <a href="index.php?page=laporan-transaksi" class="<?php if ($page == 'laporan-transaksi') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Laporan Transaksi</span>
          </a>
        </li>
      </ul>
    </li><!-- End Master Nav -->

  </ul>

</aside><!-- End Sidebar-->