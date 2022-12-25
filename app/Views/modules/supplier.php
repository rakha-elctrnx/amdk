<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Pemasok
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Pemasok
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Pemasok</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Pemasok</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('supplier/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>Telp</th>
                            <th class='text-center'>Hp/WA</th>
                            <th class='text-center'>E-mail</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($suppliers as $supplier){
                            $no++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td><?= $supplier->name ?></td>
                                <td><?= nl2br($supplier->address) ?></td>
                                <td class='text-right'><?= $supplier->phone ?></td>
                                <td class='text-right'><?= $supplier->mobile ?></td>
                                <td><?= $supplier->email ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('supplier/'.$supplier->id.'/edit') ?>" class='btn btn-xs btn-success rounded-pill' title="Edit">
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a href="<?= base_url('supplier/'.$supplier->id.'/delete') ?>" class='btn btn-xs btn-danger rounded-pill' title="Hapus" onclick="return confirm('Yakin hapus <?= $supplier->name ?>.?')">
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