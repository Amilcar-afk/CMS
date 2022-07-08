$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-database", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/settings/database/compose",
            type:"POST",
            data:
                {
                    DBHOST:$(this).parent().find('[name=DBHOST]').val(),
                    DBPWD:$(this).parent().find('[name=DBPWD]').val(),
                    DBPORT:$(this).parent().find('[name=DBPORT]').val(),
                    DBNAME:$(this).parent().find('[name=DBNAME]').val(),
                    DBUSER:$(this).parent().find('[name=DBUSER]').val(),
                },
            success:function(answer)
            {
                alertMessage('Data updated!');
                let pathname = window.location.pathname;
                if (pathname == "/setup/database"){
                    window.location.href = "/setup/smtp";
                }
              
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    });

    $(document).on("click", ".cta-button-compose-smtp", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/settings/database/compose",
            type:"POST",
            data:
                {
                    DBUSER:$(this).parent().find('[name=DBUSER]').val(),
                    MAILPWD:$(this).parent().find('[name=MAILPWD]').val(),
                    SMTP_HOST:$(this).parent().find('[name=SMTP_HOST]').val(),
                    SMTP_PORT:$(this).parent().find('[name=SMTP_PORT]').val(),

                    MAILADDR:$(this).parent().find('[name=MAILADDR]').val(),
                    SMTP_SECURE:$(this).parent().find('[name=SMTP_SECURE]').val(),
                    SMTP_USERNAME:$(this).parent().find('[name=SMTP_USERNAME]').val(),
                    SMTP_PASSWORD:$(this).parent().find('[name=SMTP_PASSWORD]').val(),

                },
            success:function(answer)
            {
                alertMessage('Data updated!');
                let pathname = window.location.pathname;
                if (pathname == "/setup/smtp"){
                    window.location.href = "/setup/main-colors";
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});


// ajout 