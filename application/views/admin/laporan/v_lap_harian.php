<div class="col-12">
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Tanggal: <?= $tanggal ?>/<?= $bulan ?>/<?= $tahun ?></small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Informasi Penerima</th>
                            <th>No Order</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        $grand_total = 0;
                        foreach ($laporan as $key => $value) {
                            $tot_harga = $value->harga * $value->qty;
                            $grand_total = $grand_total + $tot_harga;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    Nama Penerima : <?= $value->nama_penerima ?><br>
                                    Nomer Handphone : <?= $value->hp_penerima ?><br>
                                    Alamat : <?= $value->alamat ?> <br>
                                    Kota : <?= $value->kota ?> <br>
                                    Provinsi : <?= $value->provinsi ?> <br>
                                </td>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->nama_barang ?></td>
                                <td>Rp. <?= number_format($value->harga, 0) ?></td>
                                <td><?= $value->qty ?></td>
                                <td>Rp.<?= number_format($tot_harga, 0) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h1> <strong>Grand Total = Rp. <?= number_format($grand_total, 0) ?></strong> </h1>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->