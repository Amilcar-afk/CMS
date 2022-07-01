$(document).ready(function(){
    $(document).on("click", ".cta-button--submit", function () {
        var since = $("#SincePerPage").val();
        var to = $("#toPerPage").val();
        alert(since + to);

        $.post("../../Controller/Statistics.class.php",{
            since: since,
            to: to
        },
        function(data,status){

        })
    })

});