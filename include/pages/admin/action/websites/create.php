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

    <script>
        tinymce.init({
            selector: 'textarea#tiny',
            height: 500,
            menubar: false,
            plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'template'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | insertfile image | ' +
            'bullist numlist outdent indent | removeformat | template code',
            image_advtab: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {

                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
                };

                input.click();
            },
            templates: [
                { 
                    title: 'New Table', 
                    description: 'creates a new table', 
                    content: `<div class="mceTmpl">
                                <table width="98%%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th scope="col">Column1</th>
                                        <th scope="col">Column2</th>
                                    </tr>
                                    <tr>
                                        <td>Value1</td>
                                        <td>Value2</td>
                                    </tr>
                                </table>
                            </div>`
                },
                { 
                    title: 'Starting my story', 
                    description: 'A cure for writers block', 
                    content: 'Once upon a time...' },
                { 
                    title: 'New list with dates', 
                    description: 'New List with dates', 
                    content: `<div class="mceTmpl">
                                <span class="cdate">cdate</span><br>
                                <span class="mdate">mdate</span>
                                <h2>My List</h2>
                                <ul>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>`
                }
            ],
        });
    </script>
</body>
</html>