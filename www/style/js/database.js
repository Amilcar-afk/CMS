$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-database", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/settings/database/compose",
            type:"POST",
            data:
                {
                    host_name:$(this).parent().find('[name=host_name]').val(),
                    password:$(this).parent().find('[name=password]').val(),
                    port:$(this).parent().find('[name=port]').val(),
                    db_name:$(this).parent().find('[name=db_name]').val(),

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


// ajout 