$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-subscriber", function () {
        $.ajax({
            url:"/newsletter/subscibe",
            type:"POST",
            data:
                {
                    email:$(this).parent().find('[name=subscriberEmail]').val()
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
