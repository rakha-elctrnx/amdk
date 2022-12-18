<?= $this->extend("template") ?>

<?= $this->section("tab_title") ?>
Transaksi Arus Kas
<?= $this->endSection() ?>

<?= $this->section("title") ?>
Transaksi Arus Kas
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Transaksi Arus Kas</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Transaksi Arus Kas</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="<?= base_url('transaction/add') ?>" class='nav-link bg-primary rounded-pill'>
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
                            <th class='text-center'>Tanggal</th>
                            <th class='text-center'>Keterangan</th>
                            <th class='text-center'>Jenis</th>
                            <th class='text-center'>Admin</th>
                            <th class='text-center'>Nominal</th>
                            <th class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($transactions as $transaction){
                            $no++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $no ?></td>
                                <td class='text-right'><?= date("d-m-Y",strtotime($transaction->date)) ?></td>
                                <td><?= $transaction->details ?></td>
                                <td>
                                    <?= ($transaction->debit == NULL) ? "Pengeluaran" : "Pemasukkan" ?>
                                </td>
                                <td>
                                <?php
                                $admin = $db->table("administrators");
                                $admin->where("id", $transaction->admin_id);
                                $admin = $admin->get();
                                $admin = $admin->getFirstRow();

                                echo $admin->name;
                                ?>
                                </td>
                                <td class='text-right'>
                                    Rp. <?= ($transaction->debit == NULL) ? number_format($transaction->credit,0,",",".") : number_format($transaction->debit,0,",",".") ?>
                                </td>
                                <td class='text-center'>
                                    <a href="<?= base_url('transaction/'.$transaction->id.'/edit') ?>" class='btn btn-xs btn-success rounded-pill' title="Edit">
                                        <i class='fa fa-edit'></i>
                                    </a>
                                    <a href="<?= base_url('transaction/'.$transaction->id.'/delete') ?>" class='btn btn-xs btn-danger rounded-pill' title="Hapus" onclick="return confirm('Yakin hapus <?= $transaction->details ?>.?')">
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