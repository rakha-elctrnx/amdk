<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item active">Dashboard</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= count($products) ?></h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="fa fa-boxes"></i>
            </div>
            <a href="<?= base_url("product") ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= count($suppliers) ?></h3>
                <p>Pemasok</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="<?= base_url("supplier") ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= count($customers) ?></h3>
                <p>Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?= base_url("customer") ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <!-- small box -->
        <div class="small-box bg-white">           
            <div class="inner">
                <b>Data Penjualan Terbaru</b>
                <hr>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class='text-center'>No.Penjualan</th>
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
                                <td class='text-center'><?= $sale->number ?></td>                                
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
            <a href="<?= base_url("sale") ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-6">
        <!-- small box -->
        <div class="small-box bg-white">           
            <div class="inner">
                <b>Data Produksi Terbaru</b>
                <hr>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class='text-center'>No. Produksi</th>
                            <th class='text-center'>Tanggal</th>
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
                                <td class='text-center'><?= $production->number ?></td>
                                <td class='text-right'><?= date("d-m-Y", strtotime($production->production_date)) ?></td>
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
            <a href="<?= base_url("production") ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>