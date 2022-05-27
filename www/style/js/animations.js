function getAnimate(target) {
    if ($("#" + $(target).data('a-target')) != null) {
        if ($("#" + $(target).data('a-target')).hasClass("a-zoom-out-end")) {
            $("#" + $(target).data('a-target')).removeClass("a-zoom-out-end");
            $("#" + $(target).data('a-target')).addClass("a-zoom-in");
        } else if ($("#" + $(target).data('a-target')).hasClass("a-zoom-in")) {
            $("#" + $(target).data('a-target')).removeClass("a-zoom-in");
            $("#" + $(target).data('a-target')).addClass("a-zoom-out");
            delay(299).then(() => callZoomOutEnd($("#" + $(target).data('a-target'))));
        }
    }
}

function getAnimateOneAtTime(target, classTarget) {
    if ($("#" + $(target).data('a-target')) != null) {

        if ($("."+ classTarget + " .a-zoom-in")[0] != null) {
            $("."+ classTarget + " .a-zoom-in")[0].data('a-target').removeClass("a-zoom-in");
            $("."+ classTarget + " .a-zoom-in")[0].data('a-target').addClass("a-zoom-out");
            delay(299).then(() => callZoomOutEnd($("."+ classTarget, "a-zoom-in")[0].data('a-target')));
        }

        if ($("#" + $(target).data('a-target')).hasClass("a-zoom-out-end")) {
            $("#" + $(target).data('a-target')).removeClass("a-zoom-out-end");
            $("#" + $(target).data('a-target')).addClass("a-zoom-in");
        }
    }
}

function callZoomOutEnd(target){
    $(target).removeClass("a-zoom-out");
    $(target).addClass("a-zoom-out-end");
}