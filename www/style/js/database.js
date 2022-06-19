$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-database", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/settings/database",
            type:"POST",
            data:
                {
                    host_name:$(this).parent().find('[name=host_name]').val(),
                    password:$(this).parent().find('[name=password]').val(),
                    port:$(this).parent().find('[name=port]').val(),
                },
            success:function(answer)
            {
                alertMessage('Page created!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});