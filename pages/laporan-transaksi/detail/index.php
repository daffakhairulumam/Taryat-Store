<?php
include('function/view-query.php');

$id_transaksi = $_GET['id_transaksi'];
$data = getTransaksi($id_transaksi);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Detail Transaksi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Detail Transaksi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detail Transaksi</h5>

            <div class="text-end mb-3">
              <a href="logic/detail-laporan/pdf.php?id_transaksi=<?= $id_transaksi ?>" target="_blank">
                <button type="button" class="btn btn-primary">
                  Cetak PDF
                </button>
              </a>
            </div>

            <!-- Table with stripped rows -->
            <table id="table-detail">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Transaksi</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Nama Kategori</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data as $key => $value) { ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['id_transaksi'] ?></td>
                    <td><?= $value['kode_barang'] ?></td>
                    <td><?= $value['nama_barang'] ?></td>
                    <td><?= $value['nama_kategori'] ?></td>
                    <td><?= $value['harga'] ?></td>
                    <td><?= $value['qty'] ?></td>
                    <td><?= $value['total'] ?></td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <div class="text-end mt-3">
              <a href="index.php?page=laporan-transaksi">
                <button type="button" class="btn btn-secondary">
                  Kembali
                </button>
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
<!-- End #main -->
<script>
  $(document).ready(function() {
    $('#table-detail').DataTable();
  })
</script>