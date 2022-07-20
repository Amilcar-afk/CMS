$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-step", function () {

        let formContainer = $(this).parent();
        $.ajax({
            url:"/step/compose/",
            type:"POST",
            data:
                {
                    id:$(this).parent().parent().find('[name=id]').val(),
                    project:$(this).parent().children(0)[0].parentElement.getAttribute('data-project-id'),
                    title:$(this).parent().parent().find('[name=title]').val(),
                    description:$(this).parent().parent().find('[name=description]').val()

                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Step created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-step", function () {
        var projetContainer = $(this);
        $.ajax({
            url:"/step/delete",
            type:"POST",
            data:
                {
                    id:$(this)[0].getAttribute('data-project-id')
                },
            success:function()
            {
                $(projetContainer).parent().parent().parent().remove();
                alertMessage('Step deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});