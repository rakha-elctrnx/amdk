<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Penjualan Produk
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Penjualan Produk
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Penjualan Produk</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Penjualan Produk</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('sale/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>No.Penjualan</th>
                            <th class='text-center'>Pelanggan</th>
                            <th class='text-center'>Tanggal</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($sales as $sale) {
                            $no++;
                        ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td class='text-center'><?= $sale->number ?></td>
                                <td>
                                    <?php
                                    $customer = $db->table("customers");
                                    $customer->select("name");
                                    $customer->where("id", $sale->customer_id);
                                    $customer = $customer->get();
                                    $customer = $customer->getFirstRow();
                                    echo $customer->name;
                                    ?>
                                </td>
                                <td class='text-right'><?= date("d-m-Y", strtotime($sale->date)) ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('sale/' . $sale->id . '/manage') ?>" class='btn btn-xs btn-success rounded-pill' title="Kelola">
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