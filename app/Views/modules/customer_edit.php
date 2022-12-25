<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Edit Pelanggan
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Edit Pelanggan
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('customer') ?>">Pelanggan</a></li>
<li class="breadcrumb-item active"><?= $customer->name ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Pelanggan</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <b>Peringatan!</b>
                    <br>
                    Merubah data pelanggan akan mempengaruhi seluruh data penjualan yang terkait dengan pelanggan ini.
                </div>
                <form action="<?= base_url("customer/edit") ?>" method="post">
                    <input type='hidden' name='id' value="<?= $customer->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name='name' value="<?= $customer->name ?>" class='form-control' placeholder="Nama Pelanggan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hp/WA</label>
                                <input type="text" name='mobile' value="<?= $customer->mobile ?>" class='form-control' placeholder="No.Hp/WA" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" name="address" placeholder="Alamat Pelanggan" required><?= nl2br($customer->address) ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan pelanggan
                                </button>
                                <br>
                                <a href="<?= base_url('customer') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data pelanggan
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