<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Laporan
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Laporan
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Laporan</li>
<?= $this->endSection() ?>

<?php
function reportForm($action){
    ?>
<div class="row mb-2">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Berdasar Tanggal</h5>
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url("report/".$action.'/print') ?>" target="_blank">
                    <input type="hidden" name="type" value="date">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class='form-control' name="begin_date" required>
                    </div>
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class='form-control' name="end_date" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">
                            <i class='fa fa-print'></i>
                            Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Berdasar Bulan</h5>
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url("report/".$action.'/print') ?>" target="_blank">
                    <input type="hidden" name="type" value="month">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="month" class='form-control'>
                            <?php
                            for($m=1;$m<=12;$m++){
                                ?>
                            <option value="<?= $m ?>"><?= config("Custom")->months[$m] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="year" class="form-control">
                            <?php
                            for($y=2000;$y<=date("Y")+100;$y++){
                                ?>
                            <option value="<?= $y ?>" <?= ($y == date("Y") ? "selected" : "") ?>><?= $y ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">
                            <i class='fa fa-print'></i>
                            Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Berdasar Tahun</h5>
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url("report/".$action.'/print') ?>" target="_blank">
                    <input type="hidden" name="type" value="year">                    
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="year" class="form-control">
                            <?php
                            for($y=2000;$y<=date("Y")+100;$y++){
                                ?>
                            <option value="<?= $y ?>" <?= ($y == date("Y") ? "selected" : "") ?>><?= $y ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">
                            <i class='fa fa-print'></i>
                            Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php
}
?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="tabReport" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="buyTab" data-toggle="pill" href="#buyTabContent" role="tab">Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="saleTab" data-toggle="pill" href="#saleTabContent" role="tab">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="transactionTab" data-toggle="pill" href="#transactionTabContent" role="tab">Transaksi Kas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="productionTab" data-toggle="pill" href="#productionTabContent" role="tab">Produksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="useTab" data-toggle="pill" href="#useTabContent" role="tab">Penggunaan Bahan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="costTab" data-toggle="pill" href="#costTabContent" role="tab">Pembiayaan Produksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="summaryTab" data-toggle="pill" href="#summaryTabContent" role="tab">Laba Rugi</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tabReportContent">
                    <div class="tab-pane fade show active" id="buyTabContent" role="tabpanel">
                        <?= reportForm("buy") ?>
                    </div>
                    <div class="tab-pane fade" id="saleTabContent" role="tabpanel">
                        <?= reportForm("sale") ?>
                    </div>
                    <div class="tab-pane fade" id="transactionTabContent" role="tabpanel">
                        <?= reportForm("transaction") ?>
                    </div>
                    <div class="tab-pane fade" id="productionTabContent" role="tabpanel">
                        <?= reportForm("production") ?>
                    </div>
                    <div class="tab-pane fade" id="useTabContent" role="tabpanel">
                        <?= reportForm("use") ?>
                    </div>
                    <div class="tab-pane fade" id="costTabContent" role="tabpanel">
                        <?= reportForm("cost") ?>
                    </div>
                    <div class="tab-pane fade" id="summaryTabContent" role="tabpanel">
                        <?= reportForm("summary") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<?= $this->endSection() ?>