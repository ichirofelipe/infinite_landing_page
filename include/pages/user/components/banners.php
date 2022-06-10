<article class="banner">
    <h4><?= $banner['banners_title'] ?></h4>

    <div class="banner__image">
        <img src="/upload/images/<?= !empty($banner['banners_image'])?$banner['banners_image']:'banner_default.png' ?>" alt="<?= $banner['banners_title'] ?>">
    </div>

    <div class="description py-2">
        <?= htmlspecialchars_decode($banner['banners_description_1']) ?>
    </div>

    <a href="<?= $banner['banners_url'] ?>" class="banner__overlay flex-column">
        <?= htmlspecialchars_decode($banner['banners_description_2']) ?>
    </a>
</article>