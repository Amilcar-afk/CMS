$(document).ready(function(){
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

    // $(".main_logo").click(function (e) {
    //     var type = e.currentTarget.classList[0];
    //     $(".main_logo").change(function(){
    //     var path = this.files[0].name;
    //         $.ajax({
    //             url:"/option/compose",
    //             type:"POST",
    //             data:
    //                 {
    //                     type: type,
    //                     path: path,
    //                 },
    //             success:function(answer)
    //             {
    //                 alert('insert success')
    //                 // location.reload();
    //             },
    //             error: function (data, textStatus, errorThrown) {
    //                 alertMessage('Error', 'warning');
    //             }
    //         });
    //     })
    // })

    // $(".main_favicon").click(function (e) {
    //     var type = e.currentTarget.classList[0];
    //     console.log(type)
    //     // $(".main_favicon").change(function(){
    //     //    console.log($(".main_favicon").val())
    //     // })
    // })
});

