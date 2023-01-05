<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Buat Produksi
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Buat Produksi
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('buy') ?>">Produksi</a></li>
<li class="breadcrumb-item active">Buat</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Data Produksi</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("production/add") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Produk</label>
                                <select class="form-control" name="product">
                                    <?php
                                    foreach ($products as $product) {
                                    ?>
                                        <option value="<?= $product->id ?>"><?= $product->name ?></option>
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
                                <label>Tanggal Mulai Produksi</label>
                                <input type="date" name='production_date' value="<?= date('Y-m-d'); ?>" class='form-control' required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estimasi Selesai Produksi</label>
                                <input type="date" name='estimation_date' value="<?= date('Y-m-d',strtotime("+ 1 days")); ?>" class='form-control' required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Target</label>
                                <input type="number" name='targets' class='form-control' placeholder="Target jumlah Produksi" required>
                            </div>
                        </div>                        
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" name="notes" placeholder="Catatan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Buat produksi
                                </button>
                                <br>
                                <a href="<?= base_url('production') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data produksi
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

<?= $this->endSection() ?>