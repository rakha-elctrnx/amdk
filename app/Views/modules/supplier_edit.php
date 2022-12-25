<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Edit Pemasok
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Edit Pemasok
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('supplier') ?>">Pemasok</a></li>
<li class="breadcrumb-item active"><?= $supplier->name ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Pemasok</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <b>Peringatan!</b>
                    <br>
                    Merubah data pemasok akan mempengaruhi seluruh data pembelian yang terkait dengan pemasok ini.
                </div>
                <form action="<?= base_url("supplier/edit") ?>" method="post">
                    <input type='hidden' name='id' value="<?= $supplier->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name='name' value="<?= $supplier->name ?>" class='form-control' placeholder="Nama Pemasok" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="text" name='phone' value="<?= $supplier->phone ?>" class='form-control' placeholder="No. Telpon">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hp/WA</label>
                                <input type="text" name='mobile' value="<?= $supplier->mobile ?>" class='form-control' placeholder="No.Hp/WA" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name='email' value="<?= $supplier->email ?>" class='form-control' placeholder="Alamat E-mail">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" name="address" placeholder="Alamat Pemasok" required><?= nl2br($supplier->address) ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan pemasok
                                </button>
                                <br>
                                <a href="<?= base_url('supplier') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data pemasok
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