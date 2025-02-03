<?php
include('function/view-query.php');

$data = getBarang();
$idTransaksi = genereteCodeTransaksi();
$keranjang = getKeranjang($idTransaksi);
$kodeBarang = '';
$total = 0;
$idTransaksiPrevous = '';

if (!empty($_GET['id_transaksi'])) {
    $idTransaksiPrevous = $_GET['id_transaksi'];
    $disabledCetak = '';
} else {
    $disabledCetak = 'disabled';
}

foreach ($keranjang as $key => $value) {
    $total += $value['total'];
}

if ($total < 0 || $total == 0) {
    $disabled = 'disabled';
} else {
    $disabled = '';
}

if (isset($_GET['kode_barang'])) {
    $kodeBarang = $_GET['kode_barang'];
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi</h5>

                        <?php if (isset($_GET['alert'])) : ?>
                            <?php if ($_GET['alert'] == 'berhasil_transaksi') : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Berhasil
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php elseif ($_GET['alert'] == 'gagal_transaksi') : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Gagal
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label class="input-group-text">Kode Barang</label>
                                    <input type="text" class="form-control" value="<?= $kodeBarang ?>" readonly>
                                    <button class="btn btn-outline-primary" type="button" title="Pilih Barang" data-bs-toggle="modal" data-bs-target="#modalBarang">
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label class="input-group-text">Id Transaksi</label>
                                    <input type="text" class="form-control" id="id_transaksi" value="<?= $idTransaksi ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="table-barang">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($keranjang)) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                    <?php } else {
                                    foreach ($keranjang as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['kode_barang'] ?></td>
                                            <td><?= $value['nama_barang'] ?></td>
                                            <!-- <td><?= $value['harga'] ?></td> -->
                                            <td>Rp.<?= number_format($value['harga'], 0, ',', '.') ?></td>
                                            <td><?= $value['qty'] ?></td>
                                            <!-- <td><?= $value['total'] ?></td> -->
                                            <td>Rp.<?= number_format($value['total'], 0, ',', '.') ?></td>
                                            <td>
                                                <img src="public/img/product/<?= $value['images'] ?>" width="50px">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="modalQty(<?= $value['id'] ?>)">
                                                    Tambah Qty
                                                </button>
                                                <a href="logic/keranjang/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Keranjang ?');">
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

                        <hr>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <label class="input-group-text">Total</label>
                                    <input type="text" class="form-control" id="total" value="<?= $total ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <label class="input-group-text">Bayar</label>
                                    <input type="text" class="form-control" id="bayar" onkeyup="kembalian()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <label class="input-group-text">Kembalian</label>
                                    <input type="text" class="form-control" id="kembalian" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <button class="btn btn-primary" type="button" onclick="bayar()" <?= $disabled ?>>Bayar</button>
                                </div>
                            </div>
                            <div class="col-lg-2 mt-2">
                                <div class="input-group">
                                    <a href="logic/transaksi/cetak.php?id_transaksi=<?= $idTransaksiPrevous ?>" target="_blank">
                                        <button class="btn btn-primary" type="button" id="cetak-struk" <?= $disabledCetak ?>>Cetak Struk <?= $idTransaksiPrevous ?></button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Barang -->
    <div class="modal fade" id="modalBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered responsive" id="table-pilih-barang">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
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
                                            <a href="logic/keranjang/save.php?id_transaksi=<?= $idTransaksi ?>&kode_barang=<?= $value['kode_barang'] ?>">
                                                <button type="button" class="btn btn-primary">
                                                    Pilih
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Barang -->

    <!-- Modal Qty -->
    <div class="modal fade" id="modalQty" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Qty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="logic/keranjang/update.php" method="POST">
                        <div class="form-group mb-3">
                            <label>Qty</label>
                            <input type="hidden" name="id" id="id">
                            <input type="number" name="qty" id="qty" placeholder="Input Qty" class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Barang -->

    <!-- Modal Bayar -->
    <div class="modal fade" id="modalBayar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="logic/transaksi/save.php" method="POST">
                        <div class="form-group mb-3">
                            <label>Total</label>
                            <input type="hidden" name="id_transaksi" id="id_transaksi2">
                            <input type="hidden" name="total" id="total2">
                            <input type="number" name="bayar" id="bayar2" placeholder="Input Total" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label>Kembalian</label>
                            <input type="number" name="kembalian" id="kembalian2" placeholder="Input Kembalian" class="form-control" readonly>
                        </div>

                        <div class="text-end">
                            <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Bayar -->

</main><!-- End #main -->

<script>
    $(document).ready(function() {
        $('#table-barang').DataTable();
        $('#table-pilih-barang').DataTable();
    })

    function modalQty(id) {
        $('#modalQty').modal('show');
        $('#id').val(id);
    }

    function kembalian() {
        var bayar = $('#bayar').val();
        var total = $('#total').val();

        var kembalian = bayar - total;

        $('#kembalian').val(kembalian);
    }

    function bayar() {
        var bayar = $('#bayar').val();
        var total = $('#total').val();
        var idTransaksi = $('#id_transaksi').val();

        var kembalian = bayar - total;

        if (total < 0) {
            alert('Total Belanja Harus Lebih Besar dari 0');

            return false;
        }

        if (kembalian < 0) {
            alert('Uang Anda Kurang');
        } else {
            $('#modalBayar').modal('show');
            $('#id_transaksi2').val(idTransaksi);
            $('#total2').val(total);
            $('#bayar2').val(bayar);
            $('#kembalian2').val(kembalian);
        }
    }
</script>