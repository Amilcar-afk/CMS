$(document).ready(function(){

    //ALT BUBBLE
    $(".button-menu").mouseover(function (){

        let isAlt = $(".alt-on")[0];
        if ($(isAlt) != undefined){
            if ($(isAlt) == $(this)) {
                die;
            }else {
                $($(".bubble-alt")[0]).remove();
                $(isAlt).removeClass("alt-on");
            }
        }
        let alt = $('<div></div>');
        alt.attr('class', 'bubble-alt');
        alt.append('<label>'+ $(this).data("alt") +'</label>');
        $(this).addClass("alt-on");
        $(this).append(alt);

    })

    //BURGER MENU
    $(".cta-button--menu-burger").click(function (){
        if ($($(this).parent().find("nav")[0]).hasClass("open")){
            $($(this).parent().find("nav")[0]).animate({
                opacity: '0'
            }, 500);
        }else {
            $($(this).parent().find("nav")[0]).animate({
                opacity: '1'
            }, 500);
        }
        $($(this).parent().find("nav")[0]).toggleClass("open");
    })

    //HOVE CARD
    $(".module").mouseover(function (){

        let hovered = $(".module--hover")[0];
        if ($(hovered) != undefined){
            if ($(hovered) == $(this)) {
                die;
            }else {
                $($(".module--hover")[0]).animate({
                    opacity: '0'
                }, 20);
                $($(".module--hover")[0]).remove();
            }
        }


        let hover = $('<div></div>');
        hover.attr('class', 'module--hover');
        hover.append('<span class=\"material-icons-round\">add</span>');
        $(this).append(hover);
        $($(".module--hover")[0]).animate({
            opacity: '1'
        }, 20);
    })

    //COLLAPSE
    $(".main-nav-choice[data-wc-target]").click(function (){
        if ($("#" + $(this).data('wc-target')).data('group-collapse') != null){
            if($(".collapse--open[data-group-collapse='"+$("#" + $(this).data('wc-target')).data('group-collapse')+"']")[0]){
                callCollapse($("[data-wc-target='"+$(".collapse--open[data-group-collapse='"+$("#" + $(this).data('wc-target')).data('group-collapse')+"']")[0].id+"']")[0]);
                delay(250).then(() => callCollapse(this));
                return;
            }
        }
        callCollapse(this);
    })
});

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}

function callCollapse(btn){
    if ($(btn).hasClass("selected")){
        $("#" + $(btn).data('wc-target')).animate({
            opacity: '0'
        }, 250,function (){
            $("#" + $(btn).data('wc-target')).css({display: 'none'});
        });
    }else {
        $("#" + $(btn).data('wc-target')).css("display", "");
        $("#" + $(btn).data('wc-target')).animate({
            opacity: '1'
        }, 250);
    }
    $(btn).toggleClass("selected");
    $("#" + $(btn).data('wc-target')).toggleClass("collapse");
    $("#" + $(btn).data('wc-target')).toggleClass("collapse--open");
}

