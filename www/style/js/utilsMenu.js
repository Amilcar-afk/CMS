$(document).ready(function(){

    $('#menu-icon').on('click', function(){
        $('.navbar').toggleClass('expand');
        return false;
    });

    $('ul li a').click(function() {
        $('.navbar').removeClass('expand');
    });

    if ($(".place-menu")){
        let placeMenu = $(".place-menu").text();
        $('[data-alt=' + ucFisrt(placeMenu) + ']').addClass('selected');
    }

    //ALT BUBBLE
    $(".button-menu").mouseover(function (){
        let isAlt = $(".alt-on")[0];
        if ($(isAlt) != undefined){
            if ($(isAlt) == $(this)) {
                return;
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
    $(".button-menu").mouseleave(function (){
        let isAlt = $(".alt-on")[0];
        if ($(isAlt) != undefined) {
            setTimeout(function (){
                $($(".bubble-alt")[0]).remove();
                $($(".bubble-alt")[0]).animate({
                    opacity: '0'
                }, 500);
                $(isAlt).removeClass("alt-on");
            }, 500);
        }
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
    $(".module-list").mouseover(function (){
        var hovered = $(".module--hover")[0];
        if ($(hovered) != undefined){
            if ($($(this).find(".module--hover"))[0]) {
                return;
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
        });
    })

    //SHOW COLOR PICKER
    $(".cta-button--mains-color--custom").each(function() {
        $($(this).find('input')[0]).spectrum({
            type: "color",
            showPalette: false,
            hideAfterPaletteSelect: true,
            showInput: true,
            containerClassName: $(this).attr('data-type'),
            showInitial: true,
            preferredFormat: "hex",
            showAlpha: false,
            appendTo: $(this)
        });
    })

});







//COLLAPSE
$(document).on("click", ".main-nav-choice[data-wc-target]", function (){
    if ($("#" + $(this).data('wc-target')).data('group-collapse') != null){
        if($(".collapse--open[data-group-collapse='"+$("#" + $(this).data('wc-target')).data('group-collapse')+"']")[0]){
            callCollapse($("[data-wc-target='"+$(".collapse--open[data-group-collapse='"+$("#" + $(this).data('wc-target')).data('group-collapse')+"']")[0].id+"']")[0]);
            delay(250).then(() => callCollapse(this));
            return;
        }
    }
    callCollapse(this);
})

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

function ucFisrt(string){
    string = string.toLowerCase();
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function alertMessage(message, action){
    let icon = "<span class=\"material-icons-round\">info</span>";
    if (action == 'warning'){
        icon = "<span class=\"material-icons-round\">warning</span>";
    }

    let alert = $('<div class="alert alert--'+action+'"><p>'+icon+' '+message+'</p></div>');
    $("main").append(alert);

    setTimeout(() => {
        $('.alert').last().remove();
    }, 2000);
}