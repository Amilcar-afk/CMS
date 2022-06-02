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

        let neededBtns = [];
        var module = $(this).children(":first");
        /*var classList = $(module).attr('class').split(/\s+/);
        $.each(classList, function(index, item) {
            if (item === 'someClass') {
                if ('^col-'.test(item)){

                }else if ('^col-offset-'.test(item)){

                }else if ('^text-'.test(item)){

                }else if ('^fs-'.test(item)){

                }
            }
        });*/

        $(this).attr('data-a-target', 'editable-module');

        var $editorToolBar = '<div id="editable-module" class="editable-module a-zoom-out-end">\n' +
            '                    <nav class="editable-module--tool-bar">\n' +
            '                        <button class="cta-button cta-button--icon cta-button-resize">\n' +
            '                            <span class="material-icons-round">transform</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-tab">\n' +
            '                            <span class="material-icons-round">keyboard_tab</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-wrap">\n' +
            '                            <span class="material-icons-round">keyboard_return</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-bold">\n' +
            '                            <span class="material-icons-round">format_bold</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-underlined">\n' +
            '                            <span class="material-icons-round">format_underlined</span>\n' +
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
            '                        <button class="cta-button cta-button--icon cta-button-align">\n' +
            '                            <span class="material-icons-round">format_align_left</span>\n' +
            '                        </button>\n' +
            '                        <button class="cta-button cta-button--icon cta-button-insert-link">\n' +
            '                            <span class="material-icons-round">insert_link</span>\n' +
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
                || $($($elements)[i]).hasClass('cta-button-tab')
                || $($($elements)[i]).hasClass('cta-button-font-color')
                || $($($elements)[i]).hasClass('cta-button-background-color')
                || $($($elements)[i]).hasClass('cta-button-align')
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

    //wrap menu component* new line after
    $(document).on( "click", ".cta-button-wrap", function () {
        $($(this).parent().parent().parent()).before('<div class="module col-12"></div>');
    })

    //tab menu component* offset
    $(document).on( "click", ".cta-button-tab", function () {
        cleanEditToolBar(this);
        var $ctaLessOffset = $( '<button class="cta-button cta-button--icon cta-button-offset-less"><span class="material-icons-round">chevron_left</span></button>' );
        $(this).parent().append($ctaLessOffset);
        var $printOffset = $( '<div class="cta-button bold action-print">'+getModuleOffset(this)+'</div>' );
        $(this).parent().append($printOffset);
        var $ctaMoreOffset = $( '<button class="cta-button cta-button--icon cta-button-offset-more"><span class="material-icons-round">chevron_right</span></button>' );
        $(this).parent().append($ctaMoreOffset)
    })
    //offset less component
    $(document).on("click", ".cta-button-offset-less", function () {
        let offset = getModuleOffset(this);
        if (offset > 0) {
            $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
            offset--;
            printActionToolBar(this, offset);
            $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
        }
    })
    //offset more component
    $(document).on( "click", ".cta-button-offset-more", function () {
        let offset = getModuleOffset(this);
        if (offset < 11) {
            $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
            offset++;
            printActionToolBar(this, offset);
            $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
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

    //font-color component
    $(".cta-button-font-color").click(function () {
        editor.document.execCommand('underlined', false, null);
    })

    //background-color component
    $(".cta-button-background-color").click(function () {
        editor.document.execCommand('underlined', false, null);
    })

    //font-size component
    $(".cta-button-font-size").click(function () {
        getModu
        editor.document.execCommand('underlined', false, null);
    })

    //align component
    $(document).on( "click", ".cta-button-align", function () {
        if ($(moduldeContent).hasClass('text-center')){
            return 'text-center';
        }else if ($(moduldeContent).hasClass('text-right')){
            return 'text-right';
        }else if ($(moduldeContent).hasClass('text-justify')){
            return 'text-justify';
        }else{
            return 'text-left';
        }
    })

    //insert-link component
    $(".cta-button-insert-link").click(function () {
        editor.document.execCommand('underlined', false, null);
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

        if ($("#editable-module") && $($('.module[data-a-target="editable-module"]')[0]) != $(this)){
            $($('.module[data-a-target="editable-module"]')[0]).removeAttr('data-a-target');
            $("#editable-module").remove();
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
            $($($elements)[i]).hide();
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

function getModuleOffset(btn){
    var module = $(btn).parent().parent().parent();

    if ($(module).hasClass('col-offset-1')){
        return 1;
    }else if ($(module).hasClass('col-offset-2')){
        return 2;
    }else if ($(module).hasClass('col-offset-3')){
        return 3;
    }else if ($(module).hasClass('col-offset-4')){
        return 4;
    }else if ($(module).hasClass('col-offset-5')){
        return 5;
    }else if ($(module).hasClass('col-offset-6')){
        return 6;
    }else if ($(module).hasClass('col-offset-7')){
        return 7;
    }else if ($(module).hasClass('col-offset-8')){
        return 8;
    }else if ($(module).hasClass('col-offset-9')){
        return 9;
    }else if ($(module).hasClass('col-offset-10')){
        return 10;
    }else if ($(module).hasClass('col-offset-11')){
        return 11;
    }else {
        return 0;
    }
}

function getModuleFontSize(btn){
    var moduldeContent = $($($(btn).parent().parent().parent()).children()[1]);

    if ($(module).hasClass('fs-1')){
        return 1;
    }else if ($(moduldeContent).hasClass('fs-2')){
        return 2;
    }else if ($(moduldeContent).hasClass('fs-3')){
        return 3;
    }else if ($(moduldeContent).hasClass('fs-4')){
        return 4;
    }else if ($(moduldeContent).hasClass('fs-5')){
        return 5;
    }else if ($(moduldeContent).hasClass('fs-6')){
        return 6;
    }else if ($(moduldeContent).hasClass('fs-7')){
        return 7;
    }else if ($(moduldeContent).hasClass('fs-8')){
        return 8;
    }else if ($(moduldeContent).hasClass('fs-9')){
        return 9;
    }else if ($(moduldeContent).hasClass('fs-10')){
        return 10;
    }else if ($(moduldeContent).hasClass('fs-11')){
        return 11;
    }else if ($(moduldeContent).hasClass('fs-12')){
        return 12;
    }else if ($(moduldeContent).hasClass('fs-13')){
        return 13;
    }else if ($(moduldeContent).hasClass('fs-15')){
        return 15;
    }else if ($(moduldeContent).hasClass('fs-16')){
        return 16;
    }else if ($(moduldeContent).hasClass('fs-17')){
        return 17;
    }else if ($(moduldeContent).hasClass('fs-18')){
        return 18;
    }else if ($(moduldeContent).hasClass('fs-19')){
        return 19;
    }else if ($(moduldeContent).hasClass('fs-20')){
        return 20;
    }else if ($(moduldeContent).hasClass('fs-21')){
        return 21;
    }else if ($(moduldeContent).hasClass('fs-22')){
        return 22;
    }else if ($(moduldeContent).hasClass('fs-23')){
        return 23;
    }else if ($(moduldeContent).hasClass('fs-24')){
        return 24;
    }else if ($(moduldeContent).hasClass('fs-25')){
        return 25;
    }else if ($(moduldeContent).hasClass('fs-26')){
        return 26;
    }else if ($(moduldeContent).hasClass('fs-27')){
        return 27;
    }else if ($(moduldeContent).hasClass('fs-28')){
        return 28;
    }else if ($(moduldeContent).hasClass('fs-29')){
        return 29;
    }else if ($(moduldeContent).hasClass('fs-30')){
        return 30;
    }else if ($(moduldeContent).hasClass('fs-31')){
        return 31;
    }else if ($(moduldeContent).hasClass('fs-32')){
        return 32;
    }else if ($(moduldeContent).hasClass('fs-33')){
        return 33;
    }else if ($(moduldeContent).hasClass('fs-34')){
        return 34;
    }else if ($(moduldeContent).hasClass('fs-35')){
        return 35;
    }else if ($(moduldeContent).hasClass('fs-36')){
        return 36;
    }else if ($(moduldeContent).hasClass('fs-37')){
        return 37;
    }else if ($(moduldeContent).hasClass('fs-38')){
        return 38;
    }else if ($(moduldeContent).hasClass('fs-39')){
        return 39;
    }else if ($(moduldeContent).hasClass('fs-40')){
        return 40;
    }else if ($(moduldeContent).hasClass('fs-41')){
        return 41;
    }else if ($(moduldeContent).hasClass('fs-42')){
        return 42;
    }else if ($(moduldeContent).hasClass('fs-43')){
        return 43;
    }else if ($(moduldeContent).hasClass('fs-44')){
        return 44;
    }else if ($(moduldeContent).hasClass('fs-45')){
        return 45;
    }else if ($(moduldeContent).hasClass('fs-46')){
        return 46;
    }else if ($(moduldeContent).hasClass('fs-47')){
        return 47;
    }else if ($(moduldeContent).hasClass('fs-48')){
        return 48;
    }else if ($(moduldeContent).hasClass('fs-49')){
        return 49;
    }else if ($(moduldeContent).hasClass('fs-50')){
        return 50;
    }else if ($(moduldeContent).hasClass('fs-51')){
        return 51;
    }else if ($(moduldeContent).hasClass('fs-52')){
        return 52;
    }else if ($(moduldeContent).hasClass('fs-53')){
        return 53;
    }else if ($(moduldeContent).hasClass('fs-54')){
        return 54;
    }else if ($(moduldeContent).hasClass('fs-55')){
        return 55;
    }else if ($(moduldeContent).hasClass('fs-56')){
        return 56;
    }else if ($(moduldeContent).hasClass('fs-57')){
        return 57;
    }else if ($(moduldeContent).hasClass('fs-58')){
        return 58;
    }else if ($(moduldeContent).hasClass('fs-59')){
        return 59;
    }else if ($(moduldeContent).hasClass('fs-60')){
        return 60;
    }else if ($(moduldeContent).hasClass('fs-61')){
        return 61;
    }else if ($(moduldeContent).hasClass('fs-62')){
        return 62;
    }else if ($(moduldeContent).hasClass('fs-63')){
        return 63;
    }else if ($(moduldeContent).hasClass('fs-64')){
        return 64;
    }else {
        return 14;
    }
}

function getModuleBackgroundColor(btn){
    var module = $(btn).parent().parent().parent();

    if ($(module).hasClass('main-color')){
        return 'main-color';
    }else if ($(module).hasClass('main-color-background')){
        return 'main-color-background';
    }else if ($(module).hasClass('second-color-background-default')){
        return 'second-color-background-default';
    }else if ($(module).hasClass('main-color-background-default')){
        return 'main-color-background-default';
    }else {
        return 'none';
    }
}

function getModuleFontWeight(btn){
    var moduldeContent = $($($(btn).parent().parent().parent()).children()[1]);

    if ($(moduldeContent).hasClass('light')){
        return 'light';
    }else if ($(moduldeContent).hasClass('medium')){
        return 'medium';
    }else if ($(moduldeContent).hasClass('bold')){
        return 'bold';
    }else{
        return 'none';
    }
}

function getModuleAlign(btn){
    var moduldeContent = $($($(btn).parent().parent().parent()).children()[1]);

    if ($(moduldeContent).hasClass('text-center')){
        return ['text-center', 'format_align_center'];
    }else if ($(moduldeContent).hasClass('text-right')){
        return ['text-right', 'format_align_right'];
    }else if ($(moduldeContent).hasClass('text-justify')){
        return ['text-justify', 'format_align_justify'];
    }else{
        return ['text-left', 'format_align_left'];
    }
}