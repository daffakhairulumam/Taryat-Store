<?php
include('function/view-query.php');

$data = getBarang();

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_GET['alert']) && $_GET['alert'] == 'berhasil') { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Berhasil!</h4>
                                <p>Data berhasil ditambahkan.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'berhasil_update') { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Berhasil!</h4>
                                <p>Data berhasil diupdate.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'gagal_hapus') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Gagal!</h4>
                                <p>Data gagal dihapus.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'berhasil_hapus') { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Berhasil!</h4>
                                <p>Data berhasil dihapus.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }
                        ?>
                        <h5 class="card-title">Barang</h5>

                        <div class="text-end mb-3">
                            <a href="index.php?page=barang/create">
                                <button type="button" class="btn btn-primary">
                                    Tambah
                                </button>
                            </a>
                        </div>

                        <!-- Table with stripped rows -->
                        <table id="table-barang">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stock</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($data)) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                    <?php } else {
                                    foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['kode_barang'] ?></td>
                                            <td><?= $value['nama_barang'] ?></td>
                                            <td><?= $value['nama_kategori'] ?></td>
                                            <td><?= $value['stock'] ?></td>
                                            <td><?= $value['harga'] ?></td>
                                            <td>
                                                <img src="public/img/product/<?= $value['images'] ?>" width="50px">
                                            </td>
                                            <td>
                                                <a href="index.php?page=barang/edit&id=<?= $value['id'] ?>">
                                                    <button type="button" class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </a>
                                                <a href="logic/barang/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Barang ?');">
                                                    <button type="button" class="btn btn-danger">
                                                        Hapus
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    $(document).ready(function() {
        $('#table-barang').DataTable();
    })
</script>