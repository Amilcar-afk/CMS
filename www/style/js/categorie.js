$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-categorie", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/categorie/compose",
            type:"POST",
            data:
                {
                    id:$(this).parent().find('[name=id]').val(),
                    title:$(this).parent().find('[name=title]').val(),
                    navigation:$(this).parent().find('[name=navigation]').val()
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Categorie created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});

$(document).ready(function(){
    $(document).on("click", ".cta-button-delete-categorie", function () {
        $.ajax({
            url:"/categorie/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-page-id')
                },
            success:function(answer)
            {
                alertMessage(answer);
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
