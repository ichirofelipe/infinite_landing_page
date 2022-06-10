<?php 

if(isset($params['id']) && $params['id']){
    $id = $params['id'];
    $website = findQuery($id, 'websites');

    if(!$website){
        include_once('include/pages/admin/404.php');
        closeConn();
        exit;
    }
}

?>
<div class="container container--full mb-2">
    <div class="heading d-flex align-items-center">
        <a href="/admin/websites" class="title title--md text-default pr-1"><i class="icon-left-open"></i></a>
        <h1 class="title title--md"><?= ucfirst($action) ?> Website</h1>
    </div>

    <section class="d-block d-md-grid grid-cols-12">
        <div class="col-span-4">
            <form class="form--validate" method="POST" action="/website-request">
                <div class="form__group">
                    <input data-fieldname="Domain" data-rules="required,max:32" type="text" name="domain" placeholder="Domain *" value="<?= $website['websites_domain']??'' ?>" disabled>
                </div>

                <div class="form__group">
                    <input data-fieldname="Name" data-rules="required,max:32" type="text" name="name" placeholder="Name *" value="<?= $website['websites_name']??'' ?>">
                </div>

                <div class="form__group">
                    <input data-fieldname="Title" data-rules="required,max:32" type="text" name="title" placeholder="Title *" value="<?= $website['websites_title']??'' ?>">
                </div>

                <div class="form__group">
                    <textarea data-fieldname="Description" data-rules="required,max:2048" name="description" id="" cols="30" rows="10" placeholder="Description *"><?= $website['websites_description']??'' ?></textarea>
                </div>

                <div class="mt-3">
                    <label for="is_default"><small><strong>Main Website</strong></small></label><br>
                    <input class="form__switch" name="is_default" id="is_default" type="checkbox"
                        <?= 
                        isset($website['websites_is_default'])?
                        ($website['websites_is_default']=='y'?
                            'checked':'')
                        :'' 
                        ?>
                    >
                </div>

                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="content" placeholder="Content *">
                        <?= $website['websites_content']??'' ?>
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>

                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="header_info" placeholder="Header Info *">
                        <?= $website['websites_header_info']??'' ?>
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>
                
                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="footer_info" placeholder="Footer Info *">
                        <?= $website['websites_footer_info']??'' ?>
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>

                <div class="form__group">
                    <input data-fieldname="Border Color" data-rules="max:10" type="text" name="border_color" placeholder="Border Color" value="<?= $website['websites_border_color']??'' ?>">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>
                <div class="form__group">
                    <input data-fieldname="Border Color (onHover)" data-rules="max:10" type="text" name="border_color_hover" placeholder="Border Color (onHover)" value="<?= $website['websites_border_color_hover']??'' ?>">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>

                <div class="mt-3">
                    <button type="submit" name="update" value="<?= $website['websites_id']??'' ?>" class="button button--default">Submit</button>
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