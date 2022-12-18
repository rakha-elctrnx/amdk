<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Tambah Bahan (Baku/Produksi)
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Tambah Bahan (Baku/Produksi)
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('material') ?>">Bahan (Baku/Produksi)</a></li>
<li class="breadcrumb-item active">Tambah</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Bahan (Baku/Produksi)</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url("material/edit") ?>" method="post">
                    <input type="hidden" name="id" value="<?= $material->id ?>">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis</label>
                                <select class="form-control" name='type' required>
                                    <?php
                                    for($tNo = 1; $tNo <= count(config("custom")->materialTypes) - 1; $tNo++){

                                        if($tNo == $material->type){
                                            $set = "selected";
                                        }else{
                                            $set = "";
                                        }
                                        ?>
                                        <option value="<?= $tNo ?>" <?= $set ?>><?= config("custom")->materialTypes[$tNo] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Bahan</label>
                                <input type="text" value="<?= $material->name ?>" name='name' class='form-control' placeholder="Nama Bahan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" value="<?= $material->unit ?>" name='unit' class='form-control' placeholder="Satuan" required>
                                <small class='form-text text-muted'>Contoh : Pcs, Liter, Botol</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" value="<?= $material->price ?>" name='price' class='form-control' placeholder="Harga" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Persediaan Saat Ini</label>
                                <input type="number" value="<?= $material->stocks ?>" readonly name='stocks' class='form-control' placeholder="Persediaan Saat Ini" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-pill">
                                    <i class='fa fa-plus'></i>
                                    Simpan bahan (baku/produksi)
                                </button>
                                <br>
                                <a href="<?= base_url('material') ?>" class='btn btn-block btn-info rounded-pill'>
                                    <i class='fa fa-arrow-left'></i>
                                    Kembali ke data bahan (baku/produksi)
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