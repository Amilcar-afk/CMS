$(document).ready(function(){
    $(document).on("click", ".cta-button--submit", function () {
        var formContainer = $(this).parent();
        $.ajax({
            url:"../../Controller/Statistics.class.php",
            type:"POST",
            data:
                {
                    since: $(this).parent().find('#SincePerPage]').val(),
                    to: $(this).parent().find('#toPerPages').val()
                },
                success: function(answer){
                    console.log(answer);
                    alert(answer);
                    //or if the data is JSON
                    var jdata = jQuery.parseJSON(answer);
                },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

});