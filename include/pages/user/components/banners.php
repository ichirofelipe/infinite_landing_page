<article class="banner">
    <h4><?= $banner['banners_title'] ?></h4>

    <div class="banner__image">
        <img src="/upload/images/<?= $banner['banners_image'] ?>" alt="<?= $banner['banners_title'] ?>">
    </div>

    <div class="description py-2">
        <?= htmlspecialchars_decode($banner['banners_description_1']) ?>
    </div>

    <div class="banner__overlay flex-column">
        <?= htmlspecialchars_decode($banner['banners_description_2']) ?>
    </div>
</article>