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
                    <input data-fieldname="Name" data-rules="required,max:32" type="text" name="name" placeholder="Name *">
                </div>

                <div class="form__group">
                    <input data-fieldname="Title" data-rules="required,max:32" type="text" name="title" placeholder="Title *">
                </div>

                <div class="form__group">
                    <textarea data-fieldname="Description" data-rules="required,max:2048" name="description" id="" cols="30" rows="10" placeholder="Description *"></textarea>
                </div>

                <div class="mt-3">
                    <label for="isdefault"><small><strong>Main Website</strong></small></label><br>
                    <input class="form__switch" name="is_default" id="isdefault" type="checkbox">
                </div>
                
                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="content" placeholder="Content *">
                        
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>

                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="header_info" placeholder="Header Info *">
                        <div class="container">
                            <div class="d-grid grid-xs-cols-2 grid-cols-1 gap-x-20 gap-y-10">
                                <article class="banner">
                                    <div class="banner__image">
                                        <img src="https://mr0s.com/images/top_banner_left.png">
                                    </div>
                                    <div class="banner__overlay flex-column">
                                        <span class="banner_summary1_0">나에게 딱 맞는 사이트 추천 문의</span>
                                        <span class="banner_summary2_0">텔래그램 : mrzero1</span>
                                    </div>
                                </article>
                                <article class="banner">
                                    <div class="banner__image">
                                        <img src="https://mr0s.com/images/top_banner_right.png">
                                    </div>
                                    <div class="banner__overlay flex-column">
                                        <span class="banner_summary1_1">먹튀제로 사이트 추천은</span>
                                        <span class="banner_summary2_1">미스터제로</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>
                
                <div class="mt-3">
                    <textarea class="form__group" id="tiny" name="footer_info" placeholder="Footer Info *">
                        <strong>[미스터제로] - 미스터제로는 먹튀가 절대 발생하지 않는 먹튀제로의 온라인카지노, 토토사이트만을 추천해드리고 있습니다. 안전한 카지노와 토토는 미스터제로와 함께 하십시요.</strong>
                    </textarea>
                    <strong><em><small>Toggle Fullscreen for a better experience</small></em></strong>
                </div>

                <div class="form__group">
                    <input data-fieldname="Border Color" data-rules="max:10" type="text" name="border_color" placeholder="Border Color">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>
                <div class="form__group">
                    <input data-fieldname="Border Color (onHover)" data-rules="max:10" type="text" name="border_color_hover" placeholder="Border Color (onHover)">
                </div>
                <strong><em><small>Use HEX values: #000000</small></em></strong>

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