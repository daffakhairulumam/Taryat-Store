<?php

include('function/query.php');

$CodeKategori = genereteCodeKategori();

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=kategori">Kategori</a></li>
                <li class="breadcrumb-item active">Tambah Katagori</li>
            </ol>
        </nav>
    </div><!--end page title-->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Kategori</h5>

                        <form action="logic/kategori/save.php" method="post" class="">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Kode Kategori</label>
                                <input type="text" name="kode_kategori" placeholder="Input Kode Kategori" class="form-control" value="<?= $CodeKategori ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama_kategori" placeholder="Input Nama Kategori" class="form-control">
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