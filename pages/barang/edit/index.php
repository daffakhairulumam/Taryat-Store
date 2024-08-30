<?php

include('function/view-query.php');

$id = $_GET['id'];
$response = getBarang($id);
$categoryOptions = getCategory(null);
$data = mysqli_fetch_assoc($response);

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Barang</a></li>
                <li class="breadcrumb-item active">Edit Barang</li>
            </ol>
        </nav>
    </div><!--end page title-->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Barang</h5>

                        <form action="logic/barang/update.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <input type="hidden" name="id" value="<?= $id ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Kode Barang</label>
                                <input type="text" name="kode_barang" placeholder="Input Kode Barang" class="form-control" value="<?= $data['kode_barang'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" placeholder="Input Nama Barang" class="form-control" value="<?= $data['nama_barang'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Kategori</label>
                                <select name="kode_kategori" class="form-select">
                                    <option value="<?= $data['kode_kategori']; ?>"><?= $data['nama_kategori']; ?></option>
                                    <?php foreach ($categoryOptions as $option) { ?>
                                        <option value="<?= $option['kode_kategori']; ?>"><?= $option['nama_kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Stock</label>
                                <input type="text" name="stock" placeholder="Input Stock" class="form-control" value="<?= $data['stock'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Harga</label>
                                <input type="text" name="harga" placeholder="Input Harga" class="form-control" value="<?= $data['harga'] ?>">
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