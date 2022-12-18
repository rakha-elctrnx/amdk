<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Produk
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Produk
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Produk</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data Produk</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('product/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>Persediaan</th>
                            <th class='text-center'>Satuan</th>
                            <th class='text-center'>Harga</th>
                            <th class='text-center'>Varian</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($products as $product){
                            $no++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td><?= $product->name ?></td>
                                <td class='text-right'><?= number_format($product->stocks,0,",",".") ?></td>
                                <td><?= $product->unit ?></td>
                                <td class='text-right'>Rp. <?= number_format($product->price,0,",",".") ?></td>
                                <td>
                                    <?php
                                    $variants = $db->table("product_variants");
                                    $variants->where("product_id",$product->id);
                                    $variants->orderBy("id","asc");
                                    $variants = $variants->get();
                                    $variants = $variants->getResultObject();

                                    echo"<ul>";
                                    foreach($variants as $variant){
                                        echo"<li>";
                                        echo $variant->unit." @ ".$variant->quantity_included." ".$product->unit;
                                        echo " - Rp. ".number_format($variant->price,0,",",".");
                                        echo"</li>";
                                    }
                                    echo"</ul>";
                                    ?>
                                </td>
                                <td class='text-center'>
                                    <a href="#" class='btn btn-xs btn-success rounded-pill' title="Edit">
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a href="#" class='btn btn-xs btn-danger rounded-pill' title="Hapus" onclick="return confirm('Yakin hapus <?= $product->name ?>.?')">
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
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>