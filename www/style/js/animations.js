$(document).ready(function(){

    $(".cta--button-a").click(function (){
        if ($("#" + $(this).data('a-target')) != null)
        {
            if ($("#" + $(this).data('a-target')).hasClass("a-zoom-out-end"))
            {
                $("#" + $(this).data('a-target')).removeClass("a-zoom-out-end");
                $("#" + $(this).data('a-target')).addClass("a-zoom-in");
            }
            else if ($("#" + $(this).data('a-target')).hasClass("a-zoom-in"))
            {
                $("#" + $(this).data('a-target')).removeClass("a-zoom-in");
                $("#" + $(this).data('a-target')).addClass("a-zoom-out");
                delay(299).then(() => callZoomOutEnd($("#" + $(this).data('a-target'))));
            }
        }
    })

});

function callZoomOutEnd(target){
    $(target).removeClass("a-zoom-out");
    $(target).addClass("a-zoom-out-end");
}