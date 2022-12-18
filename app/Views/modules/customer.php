<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Pelanggan
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Pelanggan
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Pelanggan</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Pelanggan</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('customer/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>Alamat</th>
                            <th class='text-center'>Hp/WA</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($customers as $customer){
                            $no++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td><?= $customer->name ?></td>
                                <td><?= $customer->address ?></td>
                                <td class='text-right'><?= $customer->mobile ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('customer/'.$customer->id.'/edit') ?>" class='btn btn-xs btn-success rounded-pill' title="Edit">
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a href="<?= base_url('customer/'.$customer->id.'/delete') ?>" class='btn btn-xs btn-danger rounded-pill' title="Hapus" onclick="return confirm('Yakin hapus <?= $customer->name ?>.?')">
                                        <i class='fa fa-trash'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>