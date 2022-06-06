$(function() {

    /*=====================*\
            ONLOAD
    \*=====================*/

    /*=====================*\
        END OF ONLOAD
    \*=====================*/


    

    /*=====================*\
            DROPDOWN
    \*=====================*/

    //HIDE ELEMENT ON CLICK OUTSIDE    
    $(document).on('click', function(){
        $(".dropdown").removeClass('active');
        $(".dropdown").parent().removeClass('active');
    });
    //DROPDOWN
    $(".dropdown").parent().on('click', function (e) {
        $(this).siblings().find('.dropdown').removeClass('active');
        $(this).siblings().find('.dropdown').parent().removeClass('active');
        e.stopPropagation();
        $(this).toggleClass('active');
        $(this).find('.dropdown').toggleClass('active');
    });

    /*=====================*\
        END OF DROPDOWN
    \*=====================*/





    
    /*=====================*\
              MENU
    \*=====================*/

    //TOGGLE MENU BURGER
    $(".menu-btn__burger").on('click', function (){
        let target = $(this).data('target');
        $(this).toggleClass('open');
        $(target).toggleClass('open');
    });

    /*=====================*\
           END OF MENU
    \*=====================*/





    /*=====================*\
              FORMS
    \*=====================*/
    
    //TOGGLE PASSWORD HIDE/SHOW
    $(document).on('click', '.form__toggle-password', function (){
        let type = $(this).prev().attr('type');
        $(this).toggleClass('icon-eye icon-eye-off');
        if(type == 'password'){
            $(this).prev().prop("type", "text");
            return;
        }
        $(this).prev().prop("type", "password");
    });
    //ON SUBMIT FORM VALIDATION
    $(document).on('submit', '.form--validate', function (e){
        let errors = validateForm($(this));
        if(errors.length == 0)
            return;
        e.preventDefault();
        renderErrors($(this), errors);
    })
    
    
    //DISPLAY ERRORS
    function renderErrors(el, errors){
        el.find('.form__group--error').removeClass('form__group--error').next().remove();
        errors.map(function (error) {
            let parent = el.find(`[name=${error.name}]`).parent();
            if(!parent.hasClass('form__group--error')){
                parent.addClass('form__group--error');
                parent.after(`<small class="form__error">${error.message}</small>`);
            }
        })
    }
    //FORM VALIDATION
    function validateForm(form){
        var errors = [];
        
        //FIND ALL INPUT WITH ATTRIBUTE [data-rules]
        form.find('[data-rules]').each(function () {
            let el = $(this);
            let name = el.attr('name');
            let fieldname = el.data('fieldname');
            let rules = el.data('rules').split(',');
            rules.map(function (rule){
                switch(rule){
                    case 'required':
                        if(isEmpty(el.val()))
                            errors.push({name: name,message: `${fieldname} is required`})
                        if(el.val() == 'check' && !el.is(":checked"))
                            errors.push({name: name,message: `Please accept ${fieldname} to continue`})
                        break;
                    case 'confirm':
                        let pass = $(el.data('confirm'));
                        if(el.val() != pass.val())
                            errors.push({name: name,message: `${fieldname} does not match`})
                        break;
                    default:
                        if(rule.split(':').length != 2)
                            break;
                        let newrule = rule.split(':');
                        if(el.val().length > newrule[1] && newrule[0] == 'max')
                            errors.push({name: name,message: `${fieldname} must not be more than ${newrule[1]} characters`})
                        if(el.val().length < newrule[1] && newrule[0] == 'min')
                            errors.push({name: name,message: `${fieldname} must not be less than ${newrule[1]} characters`})
                        break;
                }
            });
        });

        return errors;
    }
    //CHECK IF INPUT IS EMPTY
    function isEmpty(str){
        return (!str || str.length === 0 );
    }

    /*=====================*\
          END OF FORMS
    \*=====================*/


    




    /*=====================*\
            MODAL
    \*=====================*/

    //REMOVE/CLOSE MODAL
    $(document).on('click', ".modal__close", function(){
        removeModal()
    });
    //TOGGLE MODAL
    $(document).on('click', "[data-toggle]", function (){
        $to_toggle = $(this).data('toggle');
        var captcha = $(this).data('captcha');
        var table = $(this).data('table');

        if($to_toggle == 'modal'){
            if($('#modal').length)
                removeModal(false)

            $target = $(this).data('target');
            
            $.ajax({
                url: `/include/pages/user/components/modal/${$target}.php`,
                type: 'POST',
                data: {
                    captcha: captcha,
                    table: table
                },
                success: function(html){
                    $('body .content').append(html);
                    $('body,html').addClass('disable');
                    renderCaptcha();

                }
            })
        }
    });

    //REMOVE MODAL
    function removeModal(remove = true){
        $('#modal').remove()
        if(remove)
            $('body,html').removeClass('disable');
    }

    /*=====================*\
        END OF MODAL
    \*=====================*/








    /*=====================*\
            CONFIRM
    \*=====================*/

    $(document).on('submit','[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });




    /*=====================*\
          END OF CONFIRM
    \*=====================*/




    /*=====================*\
            TINYMCE
    \*=====================*/

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
        'alignleft aligncenter alignright alignjustify | link insertfile image | ' +
        'bullist numlist outdent indent | removeformat | template code preview fullscreen',
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
        content_css : "/assets/css/admin.css",
        templates: [
            { 
                title: 'Container', 
                description: 'This is to add padding to your content', 
                content: `<div class="container"><p>Content here...</p></div>`
            },
        ],
    });


    /*=====================*\
        END OF TINYMCE
    \*=====================*/

});