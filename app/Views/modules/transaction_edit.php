<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Edit Transaksi Arus Kas
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Edit Transaksi Arus Kas
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('transaction') ?>">Transaksi Arus Kas</a></li>
<li class="breadcrumb-item active"><?= $transaction->details ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Transaksi Arus Kas</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("transaction/edit") ?>" method="post">
                    <input type="hidden" name="id" value="<?= $transaction->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="1" id="checkType1" <?= ($transaction->debit != NULL) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="checkType1">Pemasukkan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="2" id="checkType2" <?= ($transaction->credit != NULL) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="checkType2">Pengeluaran</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Keterangan Transaksi</label>
                                <input type="text" name='details' value="<?= $transaction->details ?>" class='form-control' placeholder="Keterangan Transaksi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="date" name='date' class='form-control' value="<?= $transaction->date ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal Transaksi</label>
                                <input type="number" name='nominal' value="<?= ($transaction->debit == NULL) ? $transaction->credit : $transaction->debit ?>" class='form-control' placeholder="Nominal Transaksi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan Transaksi Arus Kas
                                </button>
                                <br>
                                <a href="<?= base_url('transaction') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data Transaksi Arus Kas
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