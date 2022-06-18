$(document).ready(function(){

    //colors
    $(".color-picker--input").change(function () {

        $.ajax({
            url:"/option/compose",
            type:"POST",
            data:
                {
                    type: $(this).attr('data-type'),
                    value: $(this).val(),
                },
            success:function(answer)
            {
                $($('style')[0]).replaceWith(answer);
                alertMessage('Color updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })


    //design
    $(".compose-option").click(function () {
        var btn = $(this);
        $.ajax({
            url:"/option/compose",
            type:"POST",
            data:
                {
                    type: $(this).attr('data-type'),
                    value: $(this).attr('data-value'),
                },
            success:function(answer)
            {
                $($(btn).parent().parent().find('.selected')[0]).removeClass('selected');
                $(btn).addClass('selected');
                $($('style')[0]).replaceWith(answer);
                alertMessage('Design updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })


    //logos
    $(".compose-main-image").change(function () {
        let imgContainer = $($(this).parent().find('img')[0]);
        let formData = new FormData();
        let file = $(this)[0].files[0];
        let type = $(this).attr('data-type');
        formData.append('file', file);
        formData.append('type', type);

        $.ajax({
            url: "/option/compose",
            type: "POST",
            contentType: false,
            processData: false,
            data:formData,
            success: function (answer) {
                alertMessage('Image updated!');

                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    // convert image file to base64 string
                    if (type == 'logo') {
                        $($('#back-office-logo').find('img')[0]).attr('src', reader.result);
                    }else {
                        $('#container-favicon').attr('href', reader.result);
                    }
                    $(imgContainer).attr('src', reader.result);
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    //fonts
    $(".compose-font").change(function () {
        let formData = new FormData();
        let file = $(this)[0].files[0];
        let type = $(this).attr('data-type');
        formData.append('file', file);
        formData.append('type', type);

        $.ajax({
            url: "/option/compose",
            type: "POST",
            contentType: false,
            processData: false,
            data:formData,
            success: function (answer) {
                alertMessage('Font added!');

                let $newFont = '<article class="cta-button-a" data-a-target="container-setting-font-' + answer.id +'">\n' +
                    '                                    <span class="input-block" style="font-family: \''+answer.value+'\'">\n' +
                    '                                        aA\n' +
                    '                                    </span>\n' +
                    '                                    <label>'+answer.value+'</label>\n' +
                    '                                </article>'

                let $newFontUpdate = '<section id="container-setting-font-'+answer.id+'" class="container-main-content container-main-content--menu a-zoom-out-end">\n' +
                    '            <button id="cta-button-close-container-setting-font-'+answer.id+'" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-font-'+answer.id+'"><span class="material-icons-round">close</span></button>\n' +
                    '            <div class="menu-container">\n' +
                    '            </div>\n' +
                    '            <section class="collapse-parent">\n' +
                    '                <div id="font-element-container" class="collapse--open" data-group-collapse="fonts-elements-conatiner">\n' +
                    '                    <header>\n' +
                    '                        <h1 class="title title--black">'+answer.value+'</h1>\n' +
                    '                    </header>\n' +
                    '                    <article>\n' +
                    '                        <p class="input-block fs-40" style="font-family: \'<?= $font->getValue()?>\'">\n' +
                    '                             a b c d e f g h i j k l m n o p q r s t u v w x y z\n' +
                    '                        </p>\n' +
                    '                        <br>\n' +
                    '                        <p class="input-block fs-36" style="font-family: \'<?= $font->getValue()?>\'">\n' +
                    '                             0 1 2 3 4 5 6 7 8 9\n' +
                    '                        </p>\n' +
                    '                        <br>\n' +
                    '                        <p class="input-block fs-36" style="font-family: \'<?= $font->getValue()?>\'">\n' +
                    '                            $ € £ ! " \' # % & ( ) * + , - . / : ; < = > ? @ [ \\ ] ^ _ ` { | } ~\n' +
                    '                        </p>\n' +
                    '                    </article>\n' +
                    '                </div>\n' +
                    '            </section>\n' +
                    '        </section>';

                $('#container-list-fonts').append($newFont);
                $('#back-office-container').append($newFontUpdate);
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

});

