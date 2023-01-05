<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Profil
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Profil
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Profil</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profil Pengguna</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("profile/edit") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <h3><?= $administrator->name ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <h3><?= $administrator->username ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        Perubahan Password
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name='password' class='form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>' value="<?= (old('password')); ?>" placeholder="Password" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name='confirm_password' class='form-control  <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : ''; ?>' value="<?= (old('confirm_password')); ?>" placeholder="Konfirmasi Password" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('confirm_password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Ubah Password
                                </button>
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