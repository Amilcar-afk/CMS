$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-navigation-page", function () {
        var btn = $(this);
        var pageKey = $(this).attr('data-target');
        $.ajax({
            url:"/navigation/page/compose",
            type:"POST",
            data:
                {
                    page:$(this).attr('data-target'),
                    navigation:$(this).parent().parent().attr('data-parent')
                },
            success:function()
            {
                $($(btn).parent().parent().find(".elements-in")[0]).append("<button class=\"sticker sticker--cta sticker--cta--selected cta-button-delete-navigation-page\" data-target=\""+ pageKey +"\">"+$(btn).html()+"</button>");
                $(btn).remove();
                alertMessage('Navigation updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-navigation-page", function () {
        var btn = $(this);
        var pageKey = $(this).attr('data-target');
        $.ajax({
            url:"/navigation/page/delete",
            type:"POST",
            data:
                {
                    page:$(this).attr('data-target'),
                    navigation:$(this).parent().parent().attr('data-parent')
                },
            success:function()
            {
                $($(btn).parent().parent().find(".elements-out")[0]).append("<button class=\"sticker sticker--cta cta-button-compose-navigation-page\" data-target=\""+ pageKey +"\">"+$(btn).html()+"</button>");
                $(btn).remove();
                alertMessage('Navigation updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-compose-navigation-categorie", function () {
        var btn = $(this);
        var categorieKey = $(this).attr('data-target');
        $.ajax({
            url:"/navigation/categorie/compose",
            type:"POST",
            data:
                {
                    categorie:$(this).attr('data-target'),
                    navigation:$(this).parent().parent().attr('data-parent')
                },
            success:function()
            {
                $($(btn).parent().parent().find(".elements-in")[0]).append("<button class=\"sticker sticker--cta sticker--cta--selected cta-button-delete-navigation-categorie\" data-target=\""+ categorieKey +"\">"+$(btn).html()+"</button>");
                $(btn).remove();
                alertMessage('Navigation updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-navigation-categorie", function () {
        var btn = $(this);
        var categorieKey = $(this).attr('data-target');
        $.ajax({
            url:"/navigation/categorie/delete",
            type:"POST",
            data:
                {
                    categorie:$(this).attr('data-target'),
                    navigation:$(this).parent().parent().attr('data-parent')
                },
            success:function()
            {
                $($(btn).parent().parent().find(".elements-out")[0]).append("<button class=\"sticker sticker--cta cta-button-compose-navigation-categorie\" data-target=\""+ categorieKey +"\">"+$(btn).html()+"</button>");
                $(btn).remove();
                alertMessage('Navigation updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
