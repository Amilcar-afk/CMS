$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-step", function () {

        let formContainer = $(this).parent().children(0);
        let title = $(this).parent().parent().find('[name=title]');
        console.log(formContainer);
        $.ajax({
            url:"/step/compose/",
            type:"POST",
            data:
                {
                    id:formContainer[0].parentElement.parentElement.parentElement.parentElement.getAttribute('id').split('-')[3],
                    project:formContainer[0].parentElement.getAttribute('data-project-id'),
                    title:title[0].value,
                    description:formContainer[0][formContainer[0].length - 1].value

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
                $(projetContainer).parent().parent().remove();
                alertMessage('Step deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});