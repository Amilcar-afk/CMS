$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-reseaux-soc", function () {
        $.ajax({
            url:"/social-media/compose",
            type:"POST",
            data:
                {
                    type:$(this).parent().find('[name=type]').val(),
                    link:$(this).parent().find('[name=link]').val(),
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Social media created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-reseaux-soc", function () {
        var btn = $(this);
        $.ajax({
            url:"/social-media/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-reseaux-soc-id')
                },
            success:function()
            {
                $("#cta-button-close-container-rs-"+ $(btn).attr('data-reseaux-soc-id')).click();
                $("#container-settings-rs-"+ $(btn).attr('data-reseaux-soc-id')).remove();
                $("#container-rs-"+ $(btn).attr('data-reseaux-soc-id')).remove();
                alertMessage('Social media deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
