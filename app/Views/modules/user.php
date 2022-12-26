<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Pengguna
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Pengguna
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Pengguna</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Pengguna</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('user/add') ?>" class='nav-link bg-primary rounded-pill'>
                            <i class='fa fa-plus'></i>
                            Tambah
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table id="datatable1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class='text-center'>No</th>
                            <th class='text-center'>Nama</th>
                            <th class='text-center'>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($administrators as $admin) {
                            $no++;
                        ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td><?= $admin->name ?></td>
                                <td> <?= $admin->username ?> </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>