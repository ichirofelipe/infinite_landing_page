<?php 

if(isset($params['id']) && $params['id']){
    $id = $params['id'];
    $banner = findQuery($id, 'banners');
}

$websites = selectQuery('websites', 'websites_id,websites_domain');

?>
<div class="container container--full mb-2">
    <div class="heading d-flex align-items-center">
        <a href="/admin/banners" class="title title--md text-default pr-1"><i class="icon-left-open"></i></a>
        <h1 class="title title--md"><?= ucfirst($action) ?> Banner</h1>
    </div>

    <section class="d-block d-md-grid grid-cols-12">
        <div class="col-span-4">
        <form class="form--validate" method="POST" action="/banner-request" enctype="multipart/form-data">
                <div class="form__group">
                    <input data-fieldname="Title" data-rules="required,max:32" type="text" name="title" placeholder="Title *" value="<?= $banner['banners_title'] ?>">
                </div>
                <div class="form__group">
                    <input data-fieldname="Url" data-rules="required,max:256" type="text" name="url" placeholder="Url *" value="<?= $banner['banners_url'] ?>">
                </div>

                <div class="form__group">
                    <select name="website_id" data-fieldname="Website" data-rules="required">
                        <?php foreach($websites as $website){?>
                            <option value="<?= $website['websites_id'] ?>" <?= $website['websites_id']==$banner['banners_website_id']?'selected':'' ?>><?= $website['websites_domain'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form__group">
                    <input data-fieldname="Image" data-rules="image" type="file" name="image" placeholder="Image *">
                </div>
                <strong><em><small>Recommended size: 340 x 340px</small></em></strong>

                <div class="form__group">
                    <textarea data-fieldname="Description 1" data-rules="required,max:2048" name="description_1" id="" cols="30" rows="10" placeholder="Description 1 *"><?= $banner['banners_description_1'] ?></textarea>
                </div>
                <div class="form__group">
                    <textarea data-fieldname="Description 2" data-rules="required,max:2048" name="description_2" id="" cols="30" rows="10" placeholder="Description 2 *"><?= $banner['banners_description_2'] ?></textarea>
                </div>

                <div class="form__group">
                    <input data-fieldname="Border Color" data-rules="max:10" type="text" name="border_color" placeholder="Border Color" value="<?= $banner['banners_border_color'] ?>">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>
                <div class="form__group">
                    <input data-fieldname="Border Color (onHover)" data-rules="max:10" type="text" name="border_color_hover" placeholder="Border Color (onHover)" value="<?= $banner['banners_border_color_hover'] ?>">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>

                <div class="mt-3">
                    <button type="submit" name="update" value="<?= $banner['banners_id'] ?>" class="button button--default">Submit</button>
                </div>
            </form>
        </div>
    </section>
    
</div>
<?php if($admin){ ?>
            </div>
        </div>
    </div>
    <footer class="bg-bluegray--1 py-2">
        <section class="container container--full">
            <div class="text-right">
                <p class="color-white m-0">Copyright © Admin ILP <?= date("Y"); ?></p>
            </div>
        </section>
    </footer>
<?php } ?>

    <script src="/assets/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/admin.js?v=<?=date('YmHdis')?>"></script>
</body>
</html>