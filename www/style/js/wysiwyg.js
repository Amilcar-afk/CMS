$(document).ready(function(){

    //editor.document.designMode = "on";

    //add editor tool bar for model
    $(document).on( "click", ".module", function () {
        if ($(this).attr('data-a-target') == 'editable-module'){
            return;
        }

        if ($("#editable-module") && $($('.module[data-a-target="editable-module"]')[0]) != $(this)){
            $($('.module[data-a-target="editable-module"]')[0]).removeAttr('data-a-target');
            $("#editable-module").remove();
        }
        $(this).attr('data-a-target', 'editable-module');

        var $editorToolBar = '<div id="editable-module" class="editable-module a-zoom-out-end">\n' +
            '                    <nav class="editable-module--tool-bar">\n' +
            '                        <button class="cta-button cta-button--icon cta-button-resize">\n' +
            '                            <span class="material-icons-round">transform</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-bold">\n' +
            '                            <span class="material-icons-round">format_bold</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-underlined">\n' +
            '                            <span class="material-icons-round">format_underlined</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-strikethrough">\n' +
            '                            <span class="material-icons-round">format_strikethrough</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-font-color">\n' +
            '                            <span class="material-icons-round">color_lens</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-background-color">\n' +
            '                            <span class="material-icons-round">format_paint</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-font-size">\n' +
            '                            <span class="material-icons-round">format_size</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-align-left">\n' +
            '                            <span class="material-icons-round">format_align_left</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-insert-link">\n' +
            '                            <span class="material-icons-round">insert_link</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-wrap">\n' +
            '                            <span class="material-icons-round">wrap_text</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-delete-module">\n' +
            '                            <span class="material-icons-round">delete</span>\n' +
            '                        </button>\n' +
            '                    </nav>\n' +
            '                    <div class="editable-module editable-module--border">\n' +
            '                    </div>\n' +
            '                    <nav class="editable-module--footer-nav">\n' +
            '                       <button class="cta-button cta-button--icon cta-button-a" data-a-target="container-main-content--component-list">\n' +
            '                            <span class="material-icons-round">add</span>\n' +
            '                        </button>\n' +
            '                    </nav>\n' +
            '                </div>';

        $(this).prepend($editorToolBar);
    })

    $(document).on( "click", ".cta--button-toolbar-editor", function (){
        $("#container-main-content--component-list").toggleClass("a-zoom-out");
        $("#container-main-content--component-list").toggleClass("a-zoom-in");
    })

    $(document).on( "click", ".module", function () {
        getAnimateOneAtTime(this, 'module');
    })

    $(document).on( "click", ".cta-button-a", function () {
        getAnimate(this);
    })

    $(document).on("click", ".cta-button-back-tool-bar", function () {
        var $elements = $(this).parent().children();

        for (let i = 0; $($elements)[i] ; i++){
            if ( $($($elements)[i]).hasClass('cta-button-bold')
                || $($($elements)[i]).hasClass('cta-button-underlined')
                || $($($elements)[i]).hasClass('cta-button-strikethrough')
                || $($($elements)[i]).hasClass('cta-button-font-color')
                || $($($elements)[i]).hasClass('cta-button-background-color')
                || $($($elements)[i]).hasClass('cta-button-align-left')
                || $($($elements)[i]).hasClass('cta-button-insert-link')
                || $($($elements)[i]).hasClass('cta-button-wrap')
                || $($($elements)[i]).hasClass('cta-button-delete-module')
                || $($($elements)[i]).hasClass('cta-button-font-size')
                || $($($elements)[i]).hasClass('cta-button-resize')
            ){
                if($($($elements)[i]).hasClass('selected')){
                    $($($elements)[i]).removeClass('selected');
                }
                $($($elements)[i]).show();
            }else {
                $($($elements)[i]).remove();
            }
        }
    })

    //resize menu component
    $(document).on( "click", ".cta-button-resize", function () {
        cleanEditToolBar(this);
        var $ctaLessSize = $( '<button class="cta-button cta-button--icon cta-button-resize-less"><span class="material-icons-round">chevron_left</span></button>' );
        $(this).parent().append($ctaLessSize);
        var $printSize = $( '<div class="cta-button bold action-print">'+getModuleSize(this)+'</div>' );
        $(this).parent().append($printSize);
        var $ctaMoreSize = $( '<button class="cta-button cta-button--icon cta-button-resize-more"><span class="material-icons-round">chevron_right</span></button>' );
        $(this).parent().append($ctaMoreSize)
    })

    //resize less component
    $(document).on("click", ".cta-button-resize-less", function () {
        let size = getModuleSize(this);
        if (size > 1) {
            $($(this).parent().parent().parent()).toggleClass("col-" + size);
            size--;
            printActionToolBar(this, size);
            $($(this).parent().parent().parent()).toggleClass("col-" + size);
        }
    })

    //resize more component
    $(document).on( "click", ".cta-button-resize-more", function () {
        let size = getModuleSize(this);
        if (size < 12) {
            $($(this).parent().parent().parent()).toggleClass("col-" + size);
            size++;
            printActionToolBar(this, size);
            $($(this).parent().parent().parent()).toggleClass("col-" + size);
        }
    })

    //delete component
    $(document).on( "click", ".cta-button-delete-module", function () {
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
        $newComponent.addClass('col-6');
        $($newComponent.find('.module--hover')[0]).remove();
        $(".module .a-zoom-in").each(function(){
            $(this).parent().parent().append($newComponent);
        });

        $("#cta-button-close-list-component").click();

    })

    $(".cta-button-save").click(function () {
        if ($(this).attr('data-page-id') == null || $("#container-editor") == undefined){
            return;
        }
        $.ajax({
            url:"/build/save",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-page-id'),
                    content:$("#container-editor").html(),
                },
            success:function()
            {

            }
        });
    })
});


function cleanEditToolBar(elementToKeep){
    $(elementToKeep).addClass("selected");

    var $elements = $(elementToKeep).parent().children('button');

    for (let i = 0; $($elements)[i] ; i++){
        if ( $($($elements)[i]).hasClass("selected")){

        }else {
            $($($elements)[i]).hide();;
        }
    }

    var $back = $( '<button class="cta-button cta-button--icon cta-button-back-tool-bar"><span class="material-icons-round">arrow_back</span></button>' );
    $(elementToKeep).before($back);
}


function printActionToolBar(btn, value) {
    var $elements = $(btn).parent().children('.action-print');
    $($($elements)[0]).html(value);
}



function getModuleSize(btn){
    var module = $(btn).parent().parent().parent();

    if ($(module).hasClass('col-1')){
        return 1;
    }else if ($(module).hasClass('col-2')){
        return 2;
    }else if ($(module).hasClass('col-3')){
        return 3;
    }else if ($(module).hasClass('col-4')){
        return 4;
    }else if ($(module).hasClass('col-5')){
        return 5;
    }else if ($(module).hasClass('col-7')){
        return 7;
    }else if ($(module).hasClass('col-8')){
        return 8;
    }else if ($(module).hasClass('col-9')){
        return 9;
    }else if ($(module).hasClass('col-10')){
        return 10;
    }else if ($(module).hasClass('col-11')){
        return 11;
    }else if ($(module).hasClass('col-12')){
        return 12;
    }else {
        return 6;
    }
}