<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Buat Penjualan
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Buat Penjualan
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('sale') ?>">Penjualan</a></li>
<li class="breadcrumb-item active">Buat</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Data Penjualan</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("sale/add") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pelanggan</label>
                                <select class="form-control" name="customer">
                                    <?php
                                    foreach ($customers as $customer) {
                                    ?>
                                        <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
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
                                <label>Tanggal Penjualan</label>
                                <input type="date" name='date' value="<?php echo date("Y-m-d"); ?>" class='form-control' required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan / Keterangan</label>
                                <textarea name="notes" class="form-control" placeholder="Catatan / Keterangan" required></textarea>
                                <small class='form-text text-muted'>Jika tidak ada maka tulis saja - (strip)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Buat Penjualan
                                </button>
                                <br>
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

<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>