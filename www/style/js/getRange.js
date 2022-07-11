$(document).ready(function(){
    $(document).on("click", ".cta-button--range", function () {
        let perWeekDate = "";
        if ($(this).attr('id') == "SincePerWeek"){
            perWeekDate = $('#SincePerWeek').attr('data-before');
        }else if($(this).attr('id') == "toPerWeek"){
            perWeekDate = $('#toPerWeek').attr('data-next');
        }else {
            perWeekDate = $('#currentPerWeek').attr('data-current');
        }

        console.log($('#currentPerWeek').attr('data-current'));
        console.log($('#toPerDevice').attr('data-next'));
        console.log($('#SincePerDevice').attr('data-before'));

        $.ajax({
            url:"/dashboard",
            type:"POST",
            data:
                {
                    sincePerPage:$('#SincePerPage').val(),
                    toPerPage:$('#toPerPage').val(),

                    sincePerCountry:$('#SincePerCountry').val(),
                    toPerCountry:$('#toPerCountry').val(),

                    sincePerDevice:$('#SincePerDevice').val(),
                    toPerDevice:$('#toPerDevice').val(),

                    perWeekDate:perWeekDate,

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



