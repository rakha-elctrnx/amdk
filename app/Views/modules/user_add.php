<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Tambah Pengguna
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Tambah Pengguna
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Pengguna</a></li>
<li class="breadcrumb-item active">Tambah</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Pengguna</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("user/add") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name='username' class='form-control' placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name='name' class='form-control' placeholder="Nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name='password' class='form-control' placeholder="Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name='confirm_password' class='form-control' placeholder="Konfirmasi Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Tambah Pengguna
                                </button>
                                <br>
                                <a href="<?= base_url('user') ?>" class='btn btn-block btn-info rounded-pill'>
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