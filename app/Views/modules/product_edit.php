<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Edit Produk
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Edit Produk
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('product') ?>">Produk</a></li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Produk</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('product/' . $product->id . '/edit') ?>" method="post">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name='name' value="<?= $product->name ?>" class='form-control' placeholder="Nama Produk" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name='unit' value="<?= $product->unit ?>" class='form-control' placeholder="Satuan" required>
                                <small class='form-text text-muted'>Contoh : Pcs, Liter, Botol</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name='price' value="<?= $product->price ?>" class='form-control' placeholder="Harga" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Persediaan Awal (Persediaan Saat Input)</label>
                                <input type="number" name='stocks' value="<?= $product->stocks ?>" disabled class='form-control' placeholder="Persediaan Awal (Persediaan Saat Input)" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <b>Data Varian</b>
                            <br><br>
                            <div class="alert alert-info">
                                <b>Informasi</b>
                                <br>
                                Varian merupakan bentuk satuan yang lain dari produk ini.
                                <br>
                                Contoh, apabila produk air minum kemasan yang satuannya adalah cup dan memiliki varian di kardus maka bisa ditambahkan di sini.
                            </div>
                            <div id="variant-container">
                                <?php
                                foreach ($product_variants as $product_variant) :
                                ?>
                                    <input type="hidden" name="variant_id[]" value="<?= $product_variant->id ?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" name='variant_unit_edit[]' value="<?= $product_variant->unit ?>" class='form-control' required placeholder="Satuan">
                                                <small class='form-text text-muted'>Contoh : Box, Kardus, Paket</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="number" name='variant_price_edit[]' value="<?= $product_variant->price ?>" class='form-control' required placeholder="Harga">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah produk</label>
                                                <input type="number" name='quantity_included_edit[]' value="<?= $product_variant->quantity_included ?>" required class='form-control' placeholder="Jumlah produk yang termasuk ke dalam varian">
                                                <small class='form-text text-muted'>Contoh : 1 Kardus = 24 Cup, maka isi kolom ini dengan <b>24</b></small>
                                            </div>
                                        </div>
                                        <div class="col-md-1 text-center my-auto">
                                            <div class="form-group">
                                                <a onclick="return confirm('Yakin hapus varian <?= $product_variant->unit ?>.?')" href="<?= base_url("product/" . $product->id . "/variant/" . $product_variant->id . "/delete") ?>" class='btn btn-danger'>
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="button" id="add-variant" class='btn btn-primary rounded-pill'>
                                            <i class='fa fa-plus'></i>
                                            Tambah Varian
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Ubah Product
                                </button>
                                <br>
                                <a href="<?= base_url('product') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data produk
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

<?= $this->endSection() ?>

<?= $this->section("script") ?>

<script type="text/javascript">
    $("#add-variant").click(function() {
        $("#variant-container").append(`
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name='variant_unit[]' class='form-control' placeholder="Satuan">
                <small class='form-text text-muted'>Contoh : Box, Kardus, Paket</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name='variant_price[]' class='form-control' placeholder="Harga">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Jumlah produk</label>
                <input type="number" name='quantity_included[]' class='form-control' placeholder="Jumlah produk yang termasuk ke dalam varian">
                <small class='form-text text-muted'>Contoh : 1 Kardus = 24 Cup, maka isi kolom ini dengan <b>24</b></small>
            </div>
        </div>
    </div>
    `)
    })
</script>

<?= $this->endSection() ?>