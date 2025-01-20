<?php
include('function/view-query.php');

$data = getTransaksi();

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Laporan Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Transaksi</h5>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date" id="min" name="min" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" id="max" name="max" class="form-control">
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table id="table-transaksi">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Id Transaksi</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['id_transaksi'] ?></td>
                                        <td><?= $value['total'] ?></td>
                                        <td><?= $value['tanggal_transaksi'] ?></td>
                                        <td>
                                            <a href="index.php?page=laporan-transaksi/detail&id_transaksi=<?= $value['id_transaksi'] ?>">
                                                <button type="button" class="btn btn-primary" title="">
                                                    <i class="bi bi-eye"></i>
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
        // Inisialisasi DataTable
        var table = $('#table-transaksi').DataTable();

        // Filter rentang tanggal
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min').val();
                var max = $('#max').val();
                // Index kolom tanggal (sesuaikan dengan struktur tabel Anda)
                var dateColumn = data[3];

                if (min === '' && max === '') return true;

                // Konversi string tanggal ke format yang bisa dibandingkan
                var date = new Date(dateColumn);
                var minDate = new Date(min);
                var maxDate = new Date(max);

                if (min && max) {
                    return date >= minDate && date <= maxDate;
                } else if (min) {
                    return date >= minDate;
                } else if (max) {
                    return date <= maxDate;
                }
                return true;
            }
        );

        // Event listener untuk perubahan input tanggal
        $('#min, #max').on('change', function() {
            table.draw();
        });
    });
</script>