$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-newsletter", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/newsletter/compose",
            type:"POST",
            data:
                {
                    id:$(this).parent().find('[name=id]').val(),
                    title:$(this).parent().find('[name=title]').val()
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Newsletter created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-newsletter", function () {
        var pageContainer = $(this);
        $.ajax({
            url:"/newsletter/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-newsletter-id')
                },
            success:function()
            {
                $(pageContainer).parent().parent().remove();
                alertMessage('Newsletter deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
