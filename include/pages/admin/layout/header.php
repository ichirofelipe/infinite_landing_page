<?php
$active = '';
if(isset($_GET['active_page']) && $_GET['active_page'])
    $active = clean_input($_GET['active_page']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="mobile-web-app-capable" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin ILP</title>

        <link rel="stylesheet" href="/assets/css/admin.css?v=<?=date('YmHdis')?>">
        <script src="/assets/js/jquery.js"></script>

    </head>

    <body class="d-flex <?= ($admin?'flex-column':'align-items-center') ?> justify-between bg-dimwhite">
        <?php if($admin) {?>
        <div class="content d-flex flex-column flex-1">
            <?php include 'nav.php'; ?>

            <div class="d-flex flex-1">
                <div id="sidemenu" class="pt-1">
                    <?php include 'sidenav.php' ?>
                </div>
                <div class="flex-1">
            <?php } ?>

                