<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= config("Custom")->appName ?> | Laporan <?= $title ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminlte') ?>/dist/css/adminlte.min.css">
    <style type='text/css'>
        @page {
            size: auto;
        }
    </style>

    <script type='text/javascript'>
        window.print();
    </script>
</head>

<body>

<div class="text-center">
    <b>
        <h1>LAPORAN <?= strtoupper($title) ?></h1>
        <?php
        if($type == "date"){
            ?>
            <h2>DARI TANGGAL <?= date("d-m-Y",strtotime($begin_date)) ?> SAMPAI TANGGAL <?= date("d-m-Y",strtotime($end_date)) ?></h2>
            <?php
        }elseif($type == "month"){
            ?>
            <h2>PADA BULAN <?= strtoupper(config("Custom")->months[$month]) ?> TAHUN <?= $year ?></h2>
            <?php
        }elseif($type == "year"){
            ?>
            <h2>PADA TAHUN <?= $year ?></h2>
            <?php
        }
        ?>
        <h3><?= strtoupper(config("Custom")->companyName) ?></h3>
        <h4><?= strtoupper(config("Custom")->companyAddress) ?></h2>
        <h4><?= config("Custom")->companyMail ?> | <?= config("Custom")->companyPhone ?> | <?= config("Custom")->companyMobile ?></h2>        
    </b>
</div>
<hr>
<table class="table table-striped table-bordered">
    <thead>
        <tr class='text-center'>
            <th>No</th>
            <th>Item</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        $inTotal = 0;
        ?>
        <tr>
            <td colspan="3"><b>Pemasukkan</b></td>
        </tr>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Penjualan</td>
            <td class='text-right'>Rp. <?= number_format($totalSales,0,",",".") ?></td>
            <?php $inTotal += $totalSales; ?>
        </tr>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Transaksi Pemasukkan</td>
            <td class='text-right'>Rp. <?= number_format($totalIns,0,",",".") ?></td>
            <?php $inTotal += $totalIns; ?>
        </tr>
        <tr>
            <td colspan="3"><b>Pengeluaran</b></td>
        </tr>
        <?php
        $no = 0;
        $outTotal = 0;
        ?>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Pembelian</td>
            <td class='text-right'>Rp. <?= number_format($totalBuys,0,",",".") ?></td>
            <?php $outTotal += $totalBuys; ?>
        </tr>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Transaksi Pengeluaran</td>
            <td class='text-right'>Rp. <?= number_format($totalOuts,0,",",".") ?></td>
            <?php $outTotal += $totalOuts; ?>
        </tr>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Kerugian Produksi (Hasil Gagal)</td>
            <td class='text-right'>Rp. <?= number_format($totalFaileds,0,",",".") ?></td>
            <?php $outTotal += $totalFaileds; ?>
        </tr>
        <tr>
            <td class='text-center'><?= $no+=1 ?></td>
            <td>Pembiayaan Produksi</td>
            <td class='text-right'>Rp. <?= number_format($totalCosts,0,",",".") ?></td>
            <?php $outTotal += $totalCosts; ?>
        </tr>
    </tbody>
    <?php
    $allTotal = $inTotal - $outTotal;
    ?>
    <tfoot>
        <tr>
            <th class='text-right' colspan="2">Total Pemasukkan</th>
            <th class='text-right'>Rp. <?= number_format($inTotal,0,",",".") ?></th>
        </tr>
        <tr>
            <th class='text-right' colspan="2">Total Pengeluaran</th>
            <th class='text-right'>Rp. <?= number_format($outTotal,0,",",".") ?></th>
        </tr>
        <tr>
            <th class='text-right' colspan="2">Total Keseluruhan (Saldo)</th>
            <th class='text-right'>Rp. <?= number_format($allTotal,0,",",".") ?></th>
        </tr>
    </tfoot>
</table>
<br><br>
<table width="100%">
    <tr>
        <td width="70%"></td>
        <td>
            <?= config("Custom")->companyAreaLetter ?>, <?= date("d-m-Y") ?>
            <br><br><br><br><br>
            <b><u><?= config("Login")->adminName ?></u></b>
        </td>
    </tr>
</table>

</body>
</html>