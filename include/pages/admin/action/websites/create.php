<div class="container container--full mb-2">
    <div class="heading d-flex align-items-center">
        <a href="/admin/websites" class="title title--md text-default pr-1"><i class="icon-left-open"></i></a>
        <h1 class="title title--md"><?= ucfirst($action) ?> Website</h1>
    </div>

    <section class="d-block d-md-grid grid-cols-12">
        <div class="col-span-4">
            <form class="form--validate" method="POST" action="/website-request">
                <div class="form__group">
                    <input data-fieldname="Domain" data-rules="required,max:32" type="text" name="domain" placeholder="Domain *">
                </div>
                <div class="form__group">
                    <input data-fieldname="Title" data-rules="required,max:32" type="text" name="title" placeholder="Title *">
                </div>
                <div class="form__group">
                    <textarea data-fieldname="Description" data-rules="required,max:2048" name="description" id="" cols="30" rows="10" placeholder="Description *"></textarea>
                </div>

                
                <div class="mt-3">
                    <textarea data-fieldname="Content" data-rules="required" class="form__group" id="tiny" name="content" placeholder="Content *">
                        
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>

                <div class="mt-3">
                    <button type="submit" class="button button--default">Submit</button>
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