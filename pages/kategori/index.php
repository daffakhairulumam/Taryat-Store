<?php

include('function/query.php');

$data = getCategory();

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
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