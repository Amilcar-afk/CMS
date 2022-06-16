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
                alertMessage('Color image!');

                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    // convert image file to base64 string
                    if (type == 'logo') {
                        $($('#back-office-logo').find('img')[0]).attr('src', reader.result);
                    }else {
                        $('#container-favicon').attr('href', reader.result);
                    }
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

});

