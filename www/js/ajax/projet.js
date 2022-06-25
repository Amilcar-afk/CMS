$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-projet", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/project/compose",
            type:"POST",
            data:
                {
                    id:$(this).parent().find('[name=id]').val(),
                    title:$(this).parent().find('[name=title]').val(),
                    user:$(this).parent().find('[name=user]').val()
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Project created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-projet", function () {
        var projetContainer = $(this);
        $.ajax({
            url:"/project/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-projet-id')
                },
            success:function()
            {
                $(projetContainer).parent().parent().remove();
                alertMessage('Project deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
