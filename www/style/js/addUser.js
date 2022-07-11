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

                if (answer == '1'){
                    alertMessage('User created!');
                    $('#cta-button-close-container-new-user').click()
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