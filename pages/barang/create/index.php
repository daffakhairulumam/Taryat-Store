<?php

include('function/view-query.php');

$CodeBarang = genereteCodeBarang();
$categoryOptions = getCategory(null);

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Mobil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=barang">Barang</a></li>
                <li class="breadcrumb-item active">Tambah Barang</li>
            </ol>
        </nav>
    </div><!--end page title-->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_GET['alert']) && $_GET['alert'] == 'gagal') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Gagal!</h4>
                                <p>Data gagal ditambahkan.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'gagal_ekstensi') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Gagal!</h4>
                                <p>Ekstensi gambar harus PNG, JPG, JPEG.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }

                        if (isset($_GET['alert']) && $_GET['alert'] == 'gagal_ukuran') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <h4 class="alert-heading">Gagal!</h4>
                                <p>Ukuran gambar terlalu besar.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }
                        ?>
                        <h5 class="card-title">Tambah Barang</h5>

                        <form action="logic/barang/save.php" method="post" class="" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Kode Barang</label>
                                <input type="text" name="kode_barang" placeholder="Input Kode Barang" class="form-control" value="<?= $CodeBarang ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" placeholder="Input Nama Barang" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Kategori</label>
                                <select name="kode_kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php
                                    foreach ($categoryOptions as $category) { ?>
                                        <option value="<?= $category['kode_kategori']; ?>"><?= $category['nama_kategori']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Stock</label>
                                <input type="text" name="stock" placeholder="Input Stock" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Harga</label>
                                <input type="text" name="harga" placeholder="Input Harga" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <hr>

                            <div class="text-end">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>