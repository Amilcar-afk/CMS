$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-categorie", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/user/compose",
            type:"POST",
            data:
                {
                    email:$(this).parent().find('[name=email]').val(),
                    password:$(this).parent().find('[name=password]').val(),
                    passwordConfirm:$(this).parent().find('[name=passwordConfirm]').val(),
                    firstname:$(this).parent().find('[name=firstname]').val(),
                    lastname:$(this).parent().find('[name=lastname]').val()

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

})