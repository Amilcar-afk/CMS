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
