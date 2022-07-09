$(document).ready(function(){
    $.each($('.background-color-picker'), function (index,value) {
        $(value).spectrum({
            type: "color",
            showPalette: false,
            hideAfterPaletteSelect: true,
            showInput: true,
            containerClassName: 'background-color-picker',
            showInitial: true,
            preferredFormat: "hex",
            showAlpha: false,
            appendTo: $(value).parent()
        });
    });

    $(document).on( "click", ".cta-button-background-color-update", function () {

        $.ajax({
            url:"/navigation/option/compose",
            type:"POST",
            data:
                {
                    type:$(this).parent().attr('data-option-type'),
                    value:$(this).attr('data-option-value'),
                    navigation:$(this).parent().parent().attr('data-parent')
                },
            success:function()
            {
                alertMessage('Color updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on( "change", ".background-color-picker-input", function () {

        $.ajax({
            url:"/navigation/option/compose",
            type:"POST",
            data:
                {
                    type:$(this).parent().parent().attr('data-option-type'),
                    value:$(this).val(),
                    navigation:$(this).parent().parent().parent().attr('data-parent')
                },
            success:function()
            {
                alertMessage('Color updated!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

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
