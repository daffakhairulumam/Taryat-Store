<?php

include('function/view-query.php');

$data = getCategory();

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
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

                        if (isset($_GET['alert']) && $_GET['alert'] == 'berhasil update') { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Berhasil!</h4>
                                <p>Data berhasil diupdate.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'gagal hapus') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Gagal!</h4>
                                <p>Data gagal dihapus.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'berhasil hapus') { ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Berhasil!</h4>
                                <p>Data berhasil dihapus.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }
                        ?>
                        <h5 class="card-title">Kategori</h5>

                        <div class="text-end mb-3">
                            <a href="index.php?page=kategori/create">
                                <button type="button" class="btn btn-primary">
                                    Tambah
                                </button>
                            </a>
                        </div>

                        <!-- Table with stripped rows -->
                        <table id="table-kategori">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($data)) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php }
                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['kode_kategori'] ?></td>
                                        <td><?= $value['nama_kategori'] ?></td>
                                        <td>
                                            <a href="index.php?page=kategori/edit&id=<?= $value['id'] ?>">
                                                <button type="button" class="btn btn-success">
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="logic/kategori/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Barang ?');">
                                                <button type="button" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
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
        $('#table-kategori').DataTable();
    })
</script>