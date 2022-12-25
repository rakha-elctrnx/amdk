<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Pembelian Bahan (Baku/Produksi)
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Pembelian Bahan (Baku/Produksi)
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Pembelian Bahan (Baku/Produksi)</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Pembelian Bahan (Baku/Produksi)</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('buy/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>No.Pembelian</th>
                            <th class='text-center'>Referensi Faktur</th>
                            <th class='text-center'>Pemasok</th>
                            <th class='text-center'>Tanggal</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($buys as $buy){
                            $no++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td class='text-right'><?= $buy->number ?></td>
                                <td class='text-right'><?= $buy->invoice_reference ?></td>
                                <td>
                                    <?php
                                    $supplier = $db->table("suppliers");
                                    $supplier->select("name");
                                    $supplier->where("id", $buy->supplier_id);
                                    $supplier = $supplier->get();
                                    $supplier = $supplier->getFirstRow();
                                    echo $supplier->name;
                                    ?>
                                </td>
                                <td class='text-right'><?= date("d-m-Y",strtotime($buy->date)) ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('buy/'.$buy->id.'/manage') ?>" class='btn btn-xs btn-success rounded-pill' title="Kelola">
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