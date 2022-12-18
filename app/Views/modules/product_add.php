<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Tambah Produk
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Tambah Produk
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('product') ?>">Produk</a></li>
<li class="breadcrumb-item active">Tambah</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Produk</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("product/add") ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name='name' class='form-control' placeholder="Nama Produk" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name='unit' class='form-control' placeholder="Satuan" required>
                                <small class='form-text text-muted'>Contoh : Pcs, Liter, Botol</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name='price' class='form-control' placeholder="Harga" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Persediaan Awal (Persediaan Saat Input)</label>
                                <input type="number" name='stocks' class='form-control' placeholder="Persediaan Awal (Persediaan Saat Input)" required>
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
                            for($v = 1; $v <= 3; $v++) :
                            ?>
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
                            <?php
                            endfor;
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
                                    Tambah produk
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

$("#add-variant").click(function(){
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