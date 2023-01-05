<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Buat Pembelian
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Buat Pembelian
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('buy') ?>">Pembelian</a></li>
<li class="breadcrumb-item active">Buat</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Data Pembelian</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("buy/add") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemasok</label>
                                <select class="form-control" name="supplier">
                                    <?php
                                    foreach ($suppliers as $supplier) {
                                    ?>
                                        <option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
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
                                <input type="text" name='invoice' class='form-control' placeholder="No. Faktur dari Pemasok" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <input type="date" name='date' class='form-control' value="<?= date("Y-m-d") ?>" required>
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
                                    Buat pembelian
                                </button>
                                <br>
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

<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>