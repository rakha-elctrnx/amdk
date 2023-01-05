<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Kelola Pembelian
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Kelola Pembelian
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('buy') ?>">Pembelian</a></li>
<li class="breadcrumb-item active"><?= $buy->number ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelola Data Pembelian (<?= $buy->number ?>)</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("buy/edit") ?>" method="post">
                    <input type="hidden" name="id" value="<?= $buy->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemasok</label>
                                <select class="form-control" name="supplier">
                                    <?php
                                    foreach ($suppliers as $supplier) {
                                        if ($supplier->id == $buy->supplier_id) {
                                            $sep = "selected";
                                        } else {
                                            $sep = "";
                                        }
                                    ?>
                                        <option value="<?= $supplier->id ?>" <?= $sep ?>><?= $supplier->name ?></option>
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
                                <label>No. Faktur</label>
                                <input type="text" value="<?= $buy->invoice_reference ?>" name='invoice' class='form-control' placeholder="No. Faktur dari Pemasok" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <input type="date" name='date' value="<?= $buy->date ?>" class='form-control' required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan / Keterangan</label>
                                <textarea name="notes" class="form-control" placeholder="Catatan / Keterangan" required><?= nl2br($buy->notes) ?></textarea>
                                <small class='form-text text-muted'>Jika tidak ada maka tulis saja - (strip)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan pembelian
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('buy/' . $buy->id . '/delete') ?>" class='btn btn-block btn-danger rounded-pill'>
                                    <i class='fa fa-trash'></i>
                                    Hapus pembelian
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('buy/' . $buy->id . '/print') ?>" target="_blank" class='btn btn-block btn-primary rounded-pill'>
                                    <i class='fa fa-file'></i>
                                    Cetak nota pembelian
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <a href="<?= base_url('buy') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data pembelian
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
                <h3 class="card-title">Data Bahan Yang Dibeli</h3>
            </div>
            <div class="card-body" id="container-buy-items">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Bahan</th>
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
                                <form action="<?= base_url("buy/item/edit") ?>" method="post">
                                    <td class='text-center'>
                                        <input type="hidden" name="buy" value="<?= $buy->id ?>">
                                        <input type="hidden" name="id" value="<?= $item->id ?>">
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
                                            <input type="number" class="form-control text-right" name='quantity' value="<?= $item->quantity ?>" placeholder="Kuantitas" min="1" required>
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
                                        <a onclick="return confirm('Yakin hapus <?= $item->snapshot_material_name ?>.?')" href="<?= base_url("buy/" . $buy->id . "/item/" . $item->id . "/delete") ?>" class='btn btn-danger'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <form action="<?= base_url("buy/item/add") ?>" method="post">
                                <td class='text-center'>
                                    <input type="hidden" name="buy" value="<?= $buy->id ?>">
                                    <select name="material" class='form-control' id="materialSelect" required>
                                        <option value="">--Pilih Bahan--</option>
                                        <?php
                                        foreach ($materials as $material) {
                                            $exist = $db->table("buy_items");
                                            $exist->where("material_id", $material->id);
                                            $exist->where("buy_id", $buy->id);
                                            $exist = $exist->get();
                                            $exist = $exist->getResultObject();

                                            if ($exist == NULL) :
                                        ?>
                                                <option value="<?= $material->id ?>"><?= $material->name ?></option>
                                        <?php
                                            endif;
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class='text-center'>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control text-right" name='price' value="0" placeholder="Harga" min="1" required>
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
                                    <!-- <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control text-right" name='total' value="0" placeholder="Total" readonly required>
                                    </div> -->
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
    // $("#materialSelect").change(function(){
    //     let valPrice = $("option:selected",this).attr("price")
    //     let valQuantity = $("#quantityField").val()
    //     let valDiscount = $("#discountField").val()
    //     let total = (valPrice * valQuantity) - ((valPrice * valQuantity) * valDiscount / 100);

    //     $("#priceField").val(valPrice)
    //     $("#totalField").val(total)
    // })

    // $("#priceField").change(function(){
    //     let valPrice = $(this).val()
    //     let valQuantity = $("#quantityField").val()
    //     let valDiscount = $("#discountField").val()
    //     let total = (valPrice * valQuantity) - ((valPrice * valQuantity) * valDiscount / 100);

    //     $("#totalField").val(total)
    // })

    // $("#quantityField").change(function(){
    //     let valPrice = $("#priceField").val()
    //     let valQuantity = $(this).val()
    //     let valDiscount = $("#discountField").val()
    //     let total = (valPrice * valQuantity) - ((valPrice * valQuantity) * valDiscount / 100);

    //     $("#totalField").val(total)
    // })

    // $("#discountField").change(function(){
    //     let valPrice = $("#priceField").val()
    //     let valQuantity = $("#quantityField").val()
    //     let valDiscount = $(this).val()
    //     let total = (valPrice * valQuantity) - ((valPrice * valQuantity) * valDiscount / 100);

    //     $("#totalField").val(total)
    // })
</script>

<?= $this->endSection() ?>