$(document).ready(function(){
    //HOVE CARD
    $(".module-list-media").mouseover(function (){
        var hovered = $(".module--hover")[0];
        if ($(hovered) != undefined){
            if ($($(this).find(".module--hover"))[0]) {
                return;
            }else {
                $($(".module--hover")[0]).animate({
                    opacity: '0'
                }, 20);
                $($(".module--hover")[0]).remove();
            }
        }

        let hover = $('<div></div>');
        hover.attr('class', 'module--hover');
        hover.append('<span class=\"material-icons-round\">delete</span>');
        $(this).append(hover);
        $($(".module--hover")[0]).animate({
            opacity: '1'
        });
    })

    $(document).on("click", ".module-list-media", function () {
        var fileContainer = $(this);
        $.ajax({
            url:"/img/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-file-id')
                },
            success:function()
            {
                $(fileContainer).remove();
                alertMessage('File deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
