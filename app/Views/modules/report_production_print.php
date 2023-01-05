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
            <th>Nama Produk</th>
            <th>No. Produksi</th>
            <th>Tanggal Produksi</th>
            <th>Tanggal Selesai Produksi</th>
            <th>Jumlah Target</th>
            <th>Jumlah Tercapai</th>
            <th>Jumlah Gagal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        $allTotal = 0;
        foreach($rows as $row){
            $no++;
            ?>
        <tr>
            <td class='text-center'><?= $no ?></td>
            <td><?= $row->snapshot_product_name ?></td>
            <td class='text-center'><?= $row->number ?></td>
            <td class='text-center'><?= date("d-m-y",strtotime($row->production_date)) ?></td>
            <td class='text-center'><?= date("d-m-y",strtotime($row->finish_date)) ?></td>
            <td class='text-right'><?= $row->targets ?> <?= $row->snapshot_product_unit ?></td>
            <td class='text-right'><?= $row->achieveds ?> <?= $row->snapshot_product_unit ?></td>
            <td class='text-right'><?= $row->faileds ?> <?= $row->snapshot_product_unit ?></td>
        </tr>
            <?php
        }
        ?>
    </tbody>    
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