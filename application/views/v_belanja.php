<div class="card card-solid"  style=" margin-bottom:500px;" >
<!-- <div class="row" style="margin-top: 100px; margin-bottom:400px; "> -->
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-sm-12">
                <?php

                if ($this->session->flashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-check"></i> ';
                    echo $this->session->flashdata('pesan');
                    echo '</h5> </div>';
                }

                ?>
            </div>
            <div class="col-sm-12">
                <?php echo form_open('belanja/update'); ?>

                <table cellpadding="6" cellspacing="1" style="width:100%">
                
                    <tr>
                        <th width="85px">Gambar</th>
                        <th width="85px">QTY</th>
                        <th width="85px">Ukuran</th>
                        <th>Nama Barang</th>
                        <th style="text-align:right">Harga</th>
                        <th style="text-align:right">Sub Total</th>
                        <th style="text-align:center">Berat</th>
                        <th class="text-center">Action</th>
                    </tr>

                    <?php $i = 1; ?>

                    <?php
                    $tot_berat = 0;
                    foreach ($this->cart->contents() as $items) {
                        $barang     = $this->m_home->detail_barang($items['product_id']);
                        $berat      = $items['qty'] * $barang->berat;
                        $tot_berat  = $tot_berat + $berat;
                    ?>

                        <tr>
                            <td>
                                <div class="product-image-thumb active"><img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" alt="Product Image"></div>
                            </td>
                            <td>
                                <?php echo form_input(array(
                                    'name'      => $i . '[qty]',
                                    'value'     => $items['qty'],
                                    'maxlength' => '3',
                                    'min'       => '0',
                                    'size'      => '5',
                                    'type'      => 'number',
                                    'class'     => 'form-control'
                                )); ?>
                            </td>
                            <td>
                                <?php echo $items['ukuran']  ?>
                            </td>
                            <td>
                                <?php echo $items['name']; ?>
                            </td>
                            <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                            <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                            <td class="text-center"><?= $berat ?> Gr</td>
                            <td class="text-center">
                                <a href="<?= base_url('belanja/delete/' . $items['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php $i++; ?>

                    <?php } ?>
                <table style="width:50%">
                    <tr>
                        <td class="left"><h4 style="font-weight: bold">Total : </h4></td>
                        <td class="left"><h4 style="font-weight: bold"> <?php echo $this->cart->format_number($this->cart->total()); ?></h4></td>
                    </tr>
                    <tr>
                        <td class="left"><h4 style="font-weight: bold" >Total Berat : </h4></td>
                        <td class="left"><h4 style="font-weight: bold"> <?= $tot_berat ?>Gr</h4></td>
                    </tr>
                </table>
                </table>

                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Update Chart</button>
                <a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger btn-flat"><i class="fa fa-recycle"></i> Clear Cart</a>
                <a href="<?= base_url('belanja/cekout') ?>" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Check Out</a>

                <?php echo form_close() ?>
                
                <br>
            </div>
        </div>
    </div>
</div>