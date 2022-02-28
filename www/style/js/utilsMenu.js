$(document).ready(function(){

    $(".button-menu").mouseover(function (){

        let isAlt = $(".alt-on")[0];
        if ($(isAlt) != undefined){
            if ($(isAlt) == $(this)) {
                die;
            }else {
                $(isAlt).removeClass("alt-on");
                //$(".bubble-alt")[0].remove();
            }
        }
        let alt = $('<div></div>');
        alt.attr('class', 'bubble-alt');
        alt.append('<label>'+ $(this).data("alt") +'</label>');
        $(this).addClass("alt-on");
        $(this).append(alt);

    })
});



