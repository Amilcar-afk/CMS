// $(document).ready(function(){
//     $(document).on("click", ".cta-button--submit", function () {

//         var since = $("#SincePerPage").val();
//         var to = $("#toPerPage").val();
//         alert(since + " " + to);

//         $.post("../../Controller/Statistics.class.php",{
//             since: since,
//             to: to
//         },
//         function(data,status){

//         })
//     })

// });
$(document).ready(function(){
    $(document).on("click", ".cta-button--range", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"/dashboard",
            type:"POST",
            data:
                {
                    sincePerPage:$(this).parent().find('[name=SincePerPage]').val(),
                    toPerPage:$(this).parent().find('[name=toPerPage]').val(),

                    sincePerCountry:$(this).parent().find('[name=SincePerCountry]').val(),
                    toPerCountry:$(this).parent().find('[name=toPerCountry]').val(),

                    sincePerDevice:$(this).parent().find('[name=SincePerDevice]').val(),
                    toPerDevice:$(this).parent().find('[name=toPerDevice]').val(),

                    range: true
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
})