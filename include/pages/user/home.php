<?php
$title = ucfirst($site_details['websites_title']??$params['page_title']??'Home');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="mobile-web-app-capable" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>

        <meta property="title" content="<?= $title ?>">
        <meta property="og:url" content="<?= $url??$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
        <meta property="og:description" content="<?= $site_details['websites_description'] ?>">

        <link rel="stylesheet" href="/assets/css/app.css?v=<?=date('YmHdis')?>">
        <script src="/assets/js/jquery.js"></script>

    </head>

    <body class="d-flex flex-column justify-between">
        <div class="content">
            <header class="mb-2">
                <h1 class="logo"><?= $site_details['websites_name'] ?></h1>
            </header>
            <?= htmlspecialchars_decode($site_details['websites_header_info']); ?>
            <?= htmlspecialchars_decode($site_details['websites_content']); ?>
            
            <div class="container mt-2">
                <div class="d-grid grid-md-cols-3 grid-xs-cols-2 grid-cols-1 grid-xs-cols-2 gap-x-20 gap-y-10">
                    <?php foreach($site_banners as $banner){ ?>
                        <?php includeWithVariables(dirname(__FILE__).'/components/banners.php',
                            array(
                                'banner' => $banner,
                            )
                        ) ?>
                    <?php } ?>
                </div>
            </div>

            
        </div>
        <footer class="pb-2">
            <section class="container">
                <div class="text-center">
                    <?= htmlspecialchars_decode($site_details['websites_footer_info']); ?>
                    <p class="m-0 copy">Copyright © <?= $title ?> <?= date("Y"); ?></p>
                </div>
            </section>
        </footer>

        <script src="/assets/js/app.js"></script>
    </body>
</html>