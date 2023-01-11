<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Kelola Produksi
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Kelola Produksi
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('production') ?>">Produksi</a></li>
<li class="breadcrumb-item active"><?= $production->number ?></li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelola Data Produksi (<?= $production->number ?>)</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("production/edit") ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="production_id" value="<?= $production->id ?>">
                                <?php if ($production->finish_date != NULL) : ?>
                                    <input type="hidden" name="product_id" value="<?= $production->product_id ?>">
                                <?php endif; ?>
                                <label>Produk</label>
                                <select class="form-control" name="product" <?= ($production->finish_date != NULL) ? 'disabled' : '' ?>>
                                    <?php if (!$production->finish_date != NULL) : ?>
                                        <?php foreach ($products as $product) : ?>
                                            <option value="<?= $product->id ?>" <?= ($product->id == $production->product_id) ? 'selected' : '' ?>><?= $product->name ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="<?= $production->id ?>"><?= $production->snapshot_product_name ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Target</label>
                                <input type="number" name='targets' value='<?= $production->targets  ?>' class='form-control' placeholder="Target jumlah Produksi" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Mulai Produksi</label>
                                <input type="date" name='production_date' value='<?= $production->production_date  ?>' class='form-control' required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estimasi Selesai Produksi</label>
                                <input type="date" value='<?= $production->estimation_date  ?>' name='estimation_date' class='form-control' required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" name="notes" placeholder="Catatan" <?= ($production->finish_date != NULL) ? 'readonly' : "" ?>><?= ($production->notes != NULL) ? nl2br($production->notes) : "" ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        Isi kolom di bawah ini hanya ketika produksi selesai.
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Selesai Produksi</label>
                                <input type="date" id="finish-date" onchange="changeDateFinish()" value='<?= $production->finish_date ?>' <?= ($production->finish_date != NULL) ? 'readonly' : "" ?> name='finish_date' class='form-control'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jumlah Produksi Berhasil</label>
                                <input type="number" name='achieveds' class='form-control' value='<?= $production->achieveds ?>' placeholder="Total Produksi Yang Berhasil" <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jumlah Produksi Gagal</label>
                                <input type="number" name='faileds' value='<?= $production->faileds ?>' class='form-control' placeholder="Total Produksi Yang Gagal" <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-save'></i>
                                    Simpan Produksi
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class='form-group'>
                                <a href="<?= base_url('production/' . $production->id . '/delete') ?>" class='btn btn-block btn-danger rounded-pill'>
                                    <i class='fa fa-trash'></i>
                                    Hapus Produksi
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class='form-group'>
                                <a href="<?= base_url('production') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data Produksi
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card">
                <nav>
                    <?php
                    if ($session->getFlashdata('active')) {
                        if ($session->getFlashdata('active') === "biaya") {
                            $header_tab1 = "";
                            $header_tab2 = "active";
                        } else {
                            $header_tab1 = "active";
                            $header_tab2 = "";
                        }
                    } else {
                        $header_tab1 = "active";
                        $header_tab2 = "";
                    }
                    ?>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link <?= $header_tab1 ?>" data-toggle="pill" href="#nav-bahan" type="button" role="tab" aria-selected="true">Bahan</button>
                        <button class="nav-link <?= $header_tab2 ?>" data-toggle="pill" href="#nav-biaya" type="button" role="tab" aria-selected="false">Biaya</button>
                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <?php
                    if ($session->getFlashdata('active')) {
                        if ($session->getFlashdata('active') === "bahan") {
                            $class_siswa_tab = "tab-pane fade active show";
                        } else {
                            $class_siswa_tab = "tab-pane fade";
                        }
                    } else {
                        $class_siswa_tab = "tab-pane fade active show";
                    }
                    ?>
                    <div class="<?= $class_siswa_tab ?>" id="nav-bahan" role="tabpanel">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Bahan Yang Dipakai</h3>
                                    </div>
                                    <div class="card-body" id="container-buy-items">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Bahan</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Kts</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $grandTotal = 0;
                                                foreach ($ingredients as $ingredient) {
                                                ?>
                                                    <tr>
                                                        <form action="<?= base_url("production/ingredient/edit") ?>" method="post">
                                                            <td class='text-center'>
                                                                <input type="hidden" name="production_id" value="<?= $production->id ?>">
                                                                <input type="hidden" name="ingredient_id" value="<?= $ingredient->id ?>">
                                                                <input type="hidden" name="material_id" value="<?= $ingredient->material_id ?>">

                                                                <input type="text" name="material_name" class="form-control" value="<?= $ingredient->snapshot_material_name ?>" readonly>
                                                            </td>
                                                            <td class='text-center'>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="number" class="form-control text-right" name='price' value="<?= $ingredient->snapshot_material_price ?>" placeholder="Harga" min="1" readonly required>
                                                                </div>
                                                            </td>
                                                            <td class='text-center'>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control text-right" name='quantity' value="<?= $ingredient->quantity ?>" placeholder="Kuantitas" min="1" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><?= $ingredient->snapshot_material_unit ?></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class='text-right' width="15%">
                                                                <?php
                                                                $thisTotal = ($ingredient->snapshot_material_price * $ingredient->quantity);
                                                                $grandTotal += $thisTotal;
                                                                ?>
                                                                Rp. <?= number_format($thisTotal, 0, ",", ".") ?>
                                                            </td>
                                                            <td class='text-center' width="15%">
                                                                <button type="submit" class="btn btn-success" title="Simpan">
                                                                    <i class='fa fa-save'></i>
                                                                </button>
                                                                <a onclick="return confirm('Yakin hapus <?= $ingredient->snapshot_material_name ?>.?')" href="<?= base_url("production/" . $production->id . "/ingredient/" . $ingredient->id . "/delete") ?>" class='btn btn-danger'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <form action="<?= base_url("production/ingredient/add") ?>" method="post">
                                                        <td class='text-center'>
                                                            <input type="hidden" name="production_id" value="<?= $production->id ?>">
                                                            <select name="material" class='form-control' id="materialSelect" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                                <option value="">--Pilih Bahan--</option>
                                                                <?php
                                                                foreach ($materials as $material) {
                                                                    $exist = $db->table("ingredients");
                                                                    $exist->where("material_id", $material->id);
                                                                    $exist->where("production_id", $production->id);
                                                                    $exist = $exist->get();
                                                                    $exist = $exist->getResultObject();

                                                                    if ($exist == NULL) :
                                                                ?>
                                                                        <option value="<?= $material->id ?>"><?= $material->name ?> (Rp. <?= number_format($material->price,0,",",".") ?>/<?= $material->unit ?>)</option>
                                                                <?php
                                                                    endif;
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td class='text-center'>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Rp.</span>
                                                                </div>
                                                                <input type="text" class="form-control text-right" name='price' value="auto" readonly min="1" required>
                                                            </div>
                                                        </td>
                                                        <td class='text-center'>
                                                            <input type="number" class="form-control text-right" name='quantity' placeholder="Kuantitas" min="1" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                        </td>
                                                        <td class='text-right'>
                                                        </td>
                                                        <td class='text-center'>
                                                            <button type="submit" class="btn btn-primary" title="Tambah">
                                                                <i class='fa fa-plus'></i>
                                                            </button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class='text-right' colspan="3">Total</th>
                                                    <th class='text-right'>Rp. <?= number_format($grandTotal, 0, ",", ".") ?></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    if ($session->getFlashdata('active')) {
                        if ($session->getFlashdata('active') === "biaya") {
                            $class_kelompok_kelas_tab = "tab-pane fade active show";
                        } else {
                            $class_kelompok_kelas_tab = "tab-pane fade";
                        }
                    } else {
                        $class_kelompok_kelas_tab = "tab-pane fade";
                    }
                    ?>
                    <div class="<?= $class_kelompok_kelas_tab ?>" id="nav-biaya" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Biaya Yang Dikeluarkan</h3>
                                    </div>
                                    <div class="card-body" id="container-buy-items">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Biaya</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $totalCost = 0; ?>
                                                <?php foreach($costs as $cost) : ?>
                                                    <tr>
                                                        <form action="<?= base_url("production/cost/edit") ?>" method="post">
                                                            <td class='text-center'>
                                                                <input type="hidden" name="production_id" value="<?= $production->id ?>">
                                                                <input type="hidden" name="cost_id" value="<?= $cost->id ?>">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="number" class="form-control text-right" name='price' value="<?= $cost->price ?>" placeholder="Harga" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                                </div>
                                                            </td>
                                                            <td class='text-center'>
                                                                <input type="date" class="form-control text-right" name='date' value="<?= $cost->date ?>" placeholder="Tanggal" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                            </td>
                                                            <td class='text-center'>
                                                                <input type="text" class="form-control text-left" name='details' value="<?= $cost->details ?>" placeholder="Keterangan" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                            </td>
                                                            <td class='text-center' width="15%">
                                                                <button type="submit" class="btn btn-success" title="Simpan">
                                                                    <i class='fa fa-save'></i>
                                                                </button>
                                                                <a onclick="return confirm('Yakin hapus data biaya.?')" href="<?= base_url("production/" . $production->id . "/cost/" . $cost->id . "/delete") ?>" class='btn btn-danger'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                <?php $totalCost += $cost->price; ?>
                                                <?php endforeach; ?>
                                                    <tr>
                                                        <form action="<?= base_url("production/cost/add") ?>" method="post">
                                                            <td class='text-center'>
                                                                <input type="hidden" name="production_id" value="<?= $production->id ?>">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="number" class="form-control text-right" name='price' placeholder="Harga" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                                </div>
                                                            </td>
                                                            <td class='text-center'>
                                                                <input type="date" class="form-control text-right" name='date' placeholder="Tanggal" value="<?= date("Y-m-d") ?>" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                            </td>
                                                            <td class='text-center'>
                                                            <input type="text" class="form-control text-left" name='details' placeholder="Keterangan" required <?= ($production->finish_date != NULL) ? "readonly" : "" ?>>
                                                            </td>
                                                            <td class='text-center'>
                                                                <button type="submit" class="btn btn-primary" title="Tambah">
                                                                    <i class='fa fa-plus'></i>
                                                                </button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class='text-right' colspan='2'>Total</th>
                                                    <th class='text-right'>Rp. <?= number_format($totalCost,0,",",".") ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<script>
    function changeDateFinish() {
        if (confirm('Apakah anda yakin.?') == false) {
            $("#finish-date").val('')
        }
    }
</script>

<?= $this->endSection() ?>