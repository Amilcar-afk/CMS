$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-page", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/page/compose",
            type:"POST",
            data:
                {
                    id:$(this).parent().find('[name=id]').val(),
                    title:$(this).parent().find('[name=title]').val(),
                    status:$(this).parent().find('[name=status]').val(),
                    slug:$(this).parent().find('[name=slug]').val(),
                    description:$(this).parent().find('[name=description]').val(),
                    categorie:$(this).parent().find('[name=categorie]').val()
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Page created!');
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
    $(document).on("click", ".cta-button-delete-page", function () {
        $.ajax({
            url:"/page/delete",
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
