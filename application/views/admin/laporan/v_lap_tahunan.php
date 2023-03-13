<div class="col-12">
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe">Laporan Penjualan Tahunan</i> 
                    <small class="float-right">Tahun: <?= $tahun ?></small>
                </h4>
            </div>
            <!-- /.col -->
        </div>

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Informasi</th>
                            <th>Penerima</th>
                            <th>No Order</th>
                            <th>Expedisi</th>
                            <th>Tanggal</th>
                            <th>Haraga Barang</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1;
                        $grand_total = 0;
                         foreach ($laporan as $key => $value) {
                            $grand_total = $grand_total + $value->grand_total; ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php
                                $details = $this->db
                                    ->join('tbl_barang', 'tbl_barang.id_barang=tbl_rinci_transaksi.id_barang')
                                    ->get_where('tbl_rinci_transaksi', ['no_order' => $value->no_order])->result_array();
                                // var_dump($details);
                                ?>
                                <td>
                                    <?php foreach ($details as $d) : ?>
                                        <p>Barang : <?= $d['nama_barang'] ?></p>
                                        <p>Jumlah : <?= $d['qty'] ?></p>
                                        <p>Ukuran : <?= $d['ukuran'] ?></p>
                                        <hr>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    Nama Penerima : <?= $value->nama_penerima ?><br>
                                    Nomer Handphone : <?= $value->hp_penerima ?><br>
                                    Alamat : <?= $value->alamat ?> <br>
                                    Kota : <?= $value->kota ?> <br>
                                    Provinsi : <?= $value->provinsi ?> <br>
                                </td>
                                <td><?= $value->no_order ?></td>
                                <td>
                                    <b><?= $value->expedisi ?></b><br>
                                    Paket : <?= $value->paket ?><br>
                                    Ongkir : Rp. <?= number_format($value->ongkir, 0) ?>
                                </td>
                                <td><?= $value->tgl_order ?></td>
                                <td>Rp. <?= number_format($value->grand_total, 0) ?></td>
                                <td><b>Rp.<?= number_format($value->total_bayar, 0) ?></b></td>
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
                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->