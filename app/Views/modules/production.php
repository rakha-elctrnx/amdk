<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Produksi
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Produksi
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active"> Produksi</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Produksi</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('production/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>No. Produksi</th>
                            <th class='text-center'>Produk</th>
                            <th class='text-center'>Tanggal Produksi</th>
                            <th class='text-center'>Target</th>
                            <th class='text-center'>Hasil</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($productions as $production) {
                            $no++;
                        ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td class='text-center'><?= $production->number ?></td>
                                <td class='text-center'><?= $production->snapshot_product_name ?></td>
                                <td class='text-right'><?= date("d-m-Y", strtotime($production->production_date)) ?></td>
                                <td class='text-right'><?= $production->targets ?></td>
                                <td class='text-right'><?= $production->achieveds ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('production/' . $production->id . '/manage') ?>" class='btn btn-xs btn-success rounded-pill' title="Kelola">
                                        <i class='fa fa-cog'></i>
                                    </a>
                                </td>
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