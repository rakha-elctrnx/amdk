<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Kelola Penjualan
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Kelola Penjualan
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('sale') ?>">Penjualan</a></li>
<li class="breadcrumb-item active"><?= $sale->number ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelola Data Penjualan (<?= $sale->number ?>)</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("sale/edit") ?>" method="post">
                    <input type="hidden" name="id" value="<?= $sale->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pelanggan</label>
                                <select class="form-control" name="customer">
                                    <?php
                                    foreach ($customers as $customer) {
                                        if ($customer->id == $sale->customer_id) {
                                            $set = "selected";
                                        } else {
                                            $set = "";
                                        }
                                    ?>
                                        <option value="<?= $customer->id ?>" <?= $set ?>><?= $customer->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dibayar</label>
                                <input type="number" value="<?= $sale->paid ?>" name='paid' class='form-control' placeholder="Dibayar dari Pelanggan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Penjualan</label>
                                <input type="date" name='date' value="<?= $sale->date ?>" class='form-control' required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan / Keterangan</label>
                                <textarea name="notes" class="form-control" placeholder="Catatan / Keterangan" required><?= nl2br($sale->notes) ?></textarea>
                                <small class='form-text text-muted'>Jika tidak ada maka tulis saja - (strip)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan Penjualan
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('sale/' . $sale->id . '/delete') ?>" class='btn btn-block btn-danger rounded-pill'>
                                    <i class='fa fa-trash'></i>
                                    Hapus Penjualan
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('sale/' . $sale->id . '/print') ?>" target="_blank" class='btn btn-block btn-primary rounded-pill'>
                                    <i class='fa fa-file'></i>
                                    Cetak nota Penjualan
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('sale') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data Penjualan
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Produk Yang Dijual</h3>
            </div>
            <div class="card-body" id="container-sale-items">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Kts</th>
                            <th class="text-center">Diskon</th>
                            <th class="text-center">Total</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        foreach ($items as $item) {
                        ?>
                            <tr>
                                <form action="<?= base_url("sale/item/edit") ?>" method="post">
                                    <td class='text-center'>
                                        <input type="hidden" name="sale" value="<?= $sale->id ?>">
                                        <input type="hidden" name="id" value="<?= $item->id ?>">
                                        <input type="hidden" name="quantity_before" value="<?= $item->quantity_before ?>">
                                        <input type="hidden" name="quantity_old" value="<?= $item->quantity ?>">
                                        <input type="hidden" name="material" value="<?= $item->material_id ?>">
                                        <input type="text" name="material_name" class="form-control" value="<?= $item->snapshot_material_name ?>" readonly>
                                    </td>
                                    <td class='text-center'>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control text-right" name='price' value="<?= $item->price ?>" placeholder="Harga" min="1" required>
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <div class="input-group">
                                            <input type="number" class="form-control text-right" name='quantity' value="<?= $item->quantity ?>" placeholder="Kuantitas" min="0" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><?= $item->snapshot_material_unit ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <div class="input-group">
                                            <input type="number" class="form-control text-right" name='discount' value="<?= $item->discount ?>" placeholder="Diskon" min="0" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='text-right' width="15%">
                                        <?php
                                        $thisTotal = ($item->price * $item->quantity) - (($item->price * $item->quantity) * $item->discount / 100);
                                        $grandTotal += $thisTotal;
                                        ?>
                                        Rp. <?= number_format($thisTotal, 0, ",", ".") ?>
                                    </td>
                                    <td class='text-center' width="15%">
                                        <button type="submit" class="btn btn-success" title="Simpan">
                                            <i class='fa fa-save'></i>
                                        </button>
                                        <a onclick="return confirm('Yakin hapus <?= $item->snapshot_material_name ?>.?')" href="<?= base_url("sale/" . $sale->id . "/item/" . $item->id . "/delete") ?>" class='btn btn-danger'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <form action="<?= base_url("sale/item/add") ?>" method="psot">
                                <td class='text-left'>
                                    <input type="hidden" name="sale" value="<?= $sale->id ?>">
                                    <select name="product_id" class='form-control select2bs4' style="width: 100%;" id="product_id" required>
                                        <?php foreach ($products as $product) : ?>

                                            <?php
                                            $exist_product = $db->table("sale_items");
                                            $exist_product->where("product_id", $product->id);
                                            $exist_product->where("sale_id", $sale->id);
                                            $exist_product = $exist_product->get();
                                            $exist_product = $exist_product->getResultObject();

                                            if ($exist_product == NULL) :
                                            ?>
                                                <!-- <input type="hidden" value="<?= $product->id ?>" name="product_id"> -->
                                                <option value="<?= $product->id ?>"><?= $product->name; ?> (Satuan Default : <?= $product->unit; ?>)</option>
                                            <?php
                                            endif;
                                            ?>


                                            <?php
                                            $variants = $db->table("product_variants");
                                            $variants->where("product_id", $product->id);
                                            $variants = $variants->get();
                                            $variants = $variants->getResultObject();
                                            ?>

                                            <?php foreach ($variants as $variant) : ?>
                                                <?php
                                                $exist_product_variant = $db->table("sale_items");
                                                $exist_product_variant->where("product_variant_id", $variant->id);
                                                $exist_product_variant->where("sale_id", $sale->id);
                                                $exist_product_variant = $exist_product_variant->get();
                                                $exist_product_variant = $exist_product_variant->getResultObject();

                                                if ($exist_product_variant == NULL) :
                                                ?>
                                                    <!-- <input type="hidden" value="<?= $variant->id ?>" name="product_variant_id"> -->
                                                    <option value="<?= $variant->id ?>"><?= $product->name; ?> (Satuan Lainya : <?= $variant->unit; ?>)</option>
                                                <?php
                                                endif;
                                                ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td class='text-center'>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input readonly type="number" class="form-control text-right" name='price' value="0" placeholder="Harga" min="1" required>
                                    </div>
                                </td>
                                <td class='text-center'>
                                    <input type="number" class="form-control text-right" name='quantity' value="1" placeholder="Kuantitas" min="1" required>
                                </td>
                                <td class='text-center'>
                                    <div class="input-group">
                                        <input type="number" class="form-control text-right" name='discount' value="0" placeholder="Diskon" min="0" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td class='text-right'>
                                    -
                                </td>
                                <td class='text-center'>
                                    <button type="submit" class="btn btn-primary" title="Tambah">
                                        <i class='fa fa-plus'></i>
                                    </button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class='text-right' colspan="4">Total</th>
                            <th class='text-right'>Rp. <?= number_format($grandTotal, 0, ",", ".") ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section("script") ?>

<script type="text/javascript">

</script>

<?= $this->endSection() ?>