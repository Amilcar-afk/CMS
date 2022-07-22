$(document).ready(function(){

    $(document).on("click", ".cta-button-user-update-class", function () {
        $('.composeUser_class').hide()
        $('.composeUpdate_class').show()
    })

    $(document).on("click", ".cta-button-user-compose-class", function () {
        $('.composeUser_class').show()
        $('.composeUpdate_class').hide()
    })


    $(document).on("click", ".cta-button-compose-user", function () {
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

    $(document).on("click", ".cta-button-update-profile", function () {

        var updateformContainer = $(this).parent();

        $.ajax({
            url:"/user/profile-update",
            type:"POST",
            data:
                {
                    currentPassword:$(this).parent().find('[name=currentPassword]').val(),
                    newPassword:$(this).parent().find('[name=newPassword]').val(),
                    newpasswordConfirm:$(this).parent().find('[name=newpasswordConfirm]').val(),
                    firstname:$(this).parent().find('[name=firstname]').val(),
                    lastname:$(this).parent().find('[name=lastname]').val()

                },
            success:function(answer)
            {
                if (answer == '1'){
                    alertMessage('User Updated!');
                    $('#cta-button-close-container-my-profile').click()
                }else{
                    $(updateformContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })





})