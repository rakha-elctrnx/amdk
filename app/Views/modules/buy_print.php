<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= config("Custom")->appName ?> | <?= $this->renderSection("tab_title") ?></title>

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

    <table class='table table-bordered'>
        <tbody>
            <tr>
                <td class='text-center'>
                    <h2>INVOICE</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class='table table-bordered'>
        <tbody>
            <tr>
                <td>
                    <?= config("Custom")->companyAddress ?>
                    <br>
                    <?= config("Custom")->companyMail ?>
                    <br>
                    <?= config("Custom")->companyPhone ?>
                    <br>
                    <?= config("Custom")->companyMobile ?>
                </td>
                <td width="50%">
                    <b><?= $buy->name ?></b>
                    <br>
                    <?= $buy->address ?>
                    <br>
                    <?= $buy->email ?>
                    <br>
                    <?= $buy->phone ?>
                    <br>
                    <?= $buy->mobile ?>
                </td>
                <td class='text-center align-middle'>
                    <b style='font-size:25'><?= $buy->number ?></b>
                    <br>
                    <b style='font-size:25'><?= $buy->invoice_reference ?></b>
                    <br>
                    <?= date("d-m-Y", strtotime($buy->date)) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style='text-align:left'>Bahan</th>
                <th style="text-align: center;">Harga</th>
                <th style='text-align:center'>Kuantitas</th>
                <th>Diskon (%)</th>
                <th style='text-align:right'>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; ?>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td style='text-align:left'>
                        <?= $item->snapshot_material_name ?>
                    </td>
                    <td style="text-align: center;"> Rp. <?= number_format($item->price, 0, ",", ".") ?></td>
                    <td style="text-align: center;"> <?= $item->quantity; ?> <?= $item->snapshot_material_unit; ?></td>
                    <td style="text-align: center;"><?= $item->discount; ?> %</td>
                    <td style="text-align: right;">
                        <?php
                        $thisTotal = ($item->price * $item->quantity) - (($item->price * $item->quantity) * $item->discount / 100);
                        $grandTotal += $thisTotal;
                        ?>
                        Rp. <?= number_format($thisTotal, 0, ",", ".") ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th style='text-align:right' colspan="4">Total</th>
                <th style='text-align:right'>Rp. <?= number_format($grandTotal, 0, ",", ".") ?></th>
            </tr>
        </tfoot>
    </table>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td width="60%">
                    <b>Catatan :</b>
                    <br>
                    <?= nl2br($buy->notes) ?>
                </td>
                <td class='text-center'>
                    <?= date("d-m-Y") ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>(..............................................)</u>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>