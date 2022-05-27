$(document).ready(function(){

    //    editor.document.designMode = "on";

    $(".cta--button-toolbar-editor").click(function (){
        $("#container-main-content--component-list").toggleClass("a-zoom-out");
        $("#container-main-content--component-list").toggleClass("a-zoom-in");
    })

    $(".module").click(function () {
        getAnimateOneAtTime(this, 'module');
    })

    $(".cta-button-a").click(function () {
        getAnimate(this);
    })

    //delete component
    $(".cta-button-delete-module").click(function () {
        $(this).parent().parent().parent().remove();
    })

    //bold component
    $(".cta-button-bold").click(function () {
        editor.document.execCommand('bold', false, null);
    })

    //underlined component
    $(".cta-button-underlined").click(function () {
        editor.document.execCommand('underlined', false, null);
    })

    //strikethrough component
    $(".cta-button-strikethrough").click(function () {
        editor.document.execCommand('strikethrough', false, null);
    })

    //add component
    $(".module-list").click(function () {
        var $newComponent = $( "<article class='module'>"+$(this).html()+"</article>" );
        $newComponent.addClass($(this).attr("class"));
        $newComponent.removeClass('module-list');

        $(".module .a-zoom-in").each(function(){
            $(this).parent().parent().append($newComponent);
        });

        $("#cta-button-close-list-component").click();

    })
});
