$(document).ready(function(){
    const fontSizeSet = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 16, 20, 22, 24, 26, 28, 32, 34, 36, 38, 40, 42, 46, 48, 50, 64];
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

        $('p, h1, h2, h3, h4, h5, h6').each(function() {
            $(this).removeAttr('contenteditable');
            $(this).removeClass("module--on");
        });

        $(this).find('p, h1, h2, h3, h4, h5, h6').each(function() {
            $(this).attr('contenteditable', 'true');
            $(this).addClass("module--on");
        });
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
            '                            <span class="material-icons-round">'+getModuleAlign($(this))+'</span>\n' +
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
            if ($($(this).parent().parent().parent()).toggleClass("col-offset-" + offset)){
                $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
            }
            offset--;
            printActionToolBar(this, offset);
            $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
        }
    })
    //offset more component
    $(document).on( "click", ".cta-button-offset-more", function () {
        let offset = getModuleOffset(this);
        if (offset < 11) {
            if ($($(this).parent().parent().parent()).toggleClass("col-offset-" + offset)){
                $($(this).parent().parent().parent()).toggleClass("col-offset-" + offset);
            }
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
            if ($($(this).parent().parent().parent()).hasClass("col-" + size)){
                $($(this).parent().parent().parent()).toggleClass("col-" + size);
            }
            size--;
            printActionToolBar(this, size);
            $($(this).parent().parent().parent()).toggleClass("col-" + size);
        }
    })
    //resize more component
    $(document).on( "click", ".cta-button-resize-more", function () {
        let size = getModuleSize(this);
        if (size < 12) {
            if ($($(this).parent().parent().parent()).hasClass("col-" + size)){
                $($(this).parent().parent().parent()).toggleClass("col-" + size);
            }
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
    $(document).on( "click", ".cta-button-bold", function () {
        document.execCommand('bold', false);
    })

    //font-color component
    $(document).on( "click", ".cta-button-font-color", function () {
        cleanEditToolBar(this);
        let moduleBackgroundColor = "";
        let selected = '';
        if (moduleBackgroundColor == "unset"){
            selected = "selected";
        }
        var $ctaUnsetColor = $( '<button class="cta-button cta-button--icon cta-button-font-color-update '+selected+'"><span class="material-icons-round">block</span></button>' );
        $(this).parent().append($ctaUnsetColor);
        selected = '';
        if (moduleBackgroundColor == "background-main-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaMainColor = $( '<button class="cta-button cta-button--icon cta-button-font-color-update cta-button--editor-color '+selected+'"><span class="background-main-color"></span></button>' );
        $(this).parent().append($ctaMainColor);
        selected = '';
        if (moduleBackgroundColor == "background-second-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaSecondColor = $( '<button class="cta-button cta-button--icon cta-button-font-color-update cta-button--editor-color '+selected+'"><span class="background-second-color"></span></button>' );
        $(this).parent().append($ctaSecondColor);
        selected = '';
        if (moduleBackgroundColor == "background-third-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaThirdColor = $( '<button class="cta-button cta-button--icon cta-button-font-color-update cta-button--editor-color '+selected+'"><span class="background-third-color"></span></button>' );
        $(this).parent().append($ctaThirdColor);

        var $ctaCustomColor = $( '<button class="cta-button cta-button--icon cta-button-font-color-update cta-button--editor-color cta-button--editor-color--custom"><span></span></button>' );
        $(this).parent().append($ctaCustomColor);
        document.execCommand('underlined', false, null);
    })

    //background-color menu component
    $(document).on( "click", ".cta-button-background-color", function () {
        cleanEditToolBar(this);
        let moduleBackgroundColor = getModuleBackgroundColor();
        let selected = '';
        if (moduleBackgroundColor == "unset"){
            selected = "selected";
        }
        var $ctaUnsetColor = $( '<button class="cta-button cta-button--icon cta-button-background-color-update '+selected+'"><span class="material-icons-round">block</span></button>' );
        $(this).parent().append($ctaUnsetColor);
        selected = '';
        if (moduleBackgroundColor == "background-main-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaMainColor = $( '<button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color '+selected+'"><span class="background-main-color"></span></button>' );
        $(this).parent().append($ctaMainColor);
        selected = '';
        if (moduleBackgroundColor == "background-second-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaSecondColor = $( '<button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color '+selected+'"><span class="background-second-color"></span></button>' );
        $(this).parent().append($ctaSecondColor);
        selected = '';
        if (moduleBackgroundColor == "background-third-color"){
            selected = "cta-button--editor-color--selected";
        }
        var $ctaThirdColor = $( '<button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color '+selected+'"><span class="background-third-color"></span></button>' );
        $(this).parent().append($ctaThirdColor);

        var $ctaCustomColor = $( '<button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color cta-button--editor-color--custom"><span></span></button>' );
        $(this).parent().append($ctaCustomColor);
    })
    //background color component
    $(document).on( "click", ".cta-button-background-color-update", function () {
        $(this).parent().parent().parent().removeClass('background-main-color');
        $(this).parent().parent().parent().removeClass('background-second-color');
        $(this).parent().parent().parent().removeClass('background-third-color');
        //$(this).parent().parent().parent().style("background-color", "");
        if ($(this).hasClass("cta-button--editor-color--custom")){
            var $newComponent = $( "<input value='' />" );
            $(this).append($newComponent);
            $newComponent.spectrum({
                type: "flat",
                showPalette: false
            });
        }else {
            $(this).parent().parent().parent().addClass($(this).find('span').attr("class"));
        }
    })

    //font-size component
    $(document).on( "click", ".cta-button-font-size", function () {
        cleanEditToolBar(this);
        var $ctaLessFontSize = $( '<button class="cta-button cta-button--icon cta-button-font-size-less"><span class="material-icons-round">chevron_left</span></button>' );
        $(this).parent().append($ctaLessFontSize);
        var $printFontSize = $( '<div class="cta-button bold action-print">'+getModuleFontSize(this)+'</div>' );
        $(this).parent().append($printFontSize);
        var $ctaMoreFontSize = $( '<button class="cta-button cta-button--icon cta-button-font-size-more"><span class="material-icons-round">chevron_right</span></button>' );
        $(this).parent().append($ctaMoreFontSize);
    })
    //font-size less component
    $(document).on("click", ".cta-button-font-size-less", function () {
        let fontSize = getModuleFontSize(this);
        if (fontSize > 1) {
            if ($($(this).parent().parent().parent().children(":last")).hasClass("fs-" + fontSize)){
                $($(this).parent().parent().parent().children(":last")).toggleClass("fs-" + fontSize);
            }
            fontSize = fontSizeSet.indexOf(fontSize)
            fontSize--;
            fontSize = fontSizeSet[fontSize];
            printActionToolBar(this, fontSize);
            $($(this).parent().parent().parent().children(":last")).addClass("fs-" + fontSize);
        }
    })
    //font-size more component
    $(document).on( "click", ".cta-button-font-size-more", function () {
        let fontSize = getModuleFontSize(this);
        if (fontSize < 65) {
            if ($($(this).parent().parent().parent().children(":last")).hasClass("fs-" + fontSize)){
                $($(this).parent().parent().parent().children(":last")).toggleClass("fs-" + fontSize);
            }
            fontSize = fontSizeSet.indexOf(fontSize)
            fontSize++;
            fontSize = fontSizeSet[fontSize];
            printActionToolBar(this, fontSize);
            $($(this).parent().parent().parent().children(":last")).addClass("fs-" + fontSize);
        }
    })

    //align component
    $(document).on( "click", ".cta-button-align", function () {
        var module = $($(this).parent().parent().parent().find(":last"));
        if ($(module).hasClass('text-center')){
            $(this).html('<span class="material-icons-round">format_align_right</span>');
            $(module).toggleClass('text-center');
            $(module).toggleClass('text-right');
        }else if ($(module).hasClass('text-right')){
            $(this).html('<span class="material-icons-round">format_align_justify</span>');
            $(module).toggleClass('text-right');
            $(module).toggleClass('text-justify');
        }else if ($(module).hasClass('text-justify')){
            $(this).html('<span class="material-icons-round">format_align_left</span>');
            $(module).toggleClass('text-justify');
            $(module).toggleClass('text-left');
        }else{
            $(this).html('<span class="material-icons-round">format_align_center</span>');
            if ($(module).hasClass('text-left')){
                $(module).toggleClass('text-left');
            }
            $(module).toggleClass('text-center');
        }
    })

    //undo
    $(document).on( "click", ".cta-button-undo", function () {
        document.execCommand('undo',false,'')
    })
    //redo
    $(document).on( "click", ".cta-button-redo", function () {
        document.execCommand('redo',false,'')
    })

    //insert-link component
    $(".cta-button-insert-link").click(function () {
        document.execCommand('underlined', false, null);
    })

    //add component
    $(".module-list").click(function () {
        var $newComponent = $( "<article class='module'>"+$(this).html()+"</article>" );
        $newComponent.addClass($(this).attr("class"));
        $newComponent.removeClass('module-list');
        $newComponent.addClass('col-6');
        $($newComponent.find('.module--hover')[0]).remove();
        $("#editable-module").parent().after($newComponent);
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

        $('p, h1, h2, h3, h4, h5, h6').each(function() {
            $(this).removeAttr('contenteditable');
            $(this).removeClass("module--on");
        });
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
    var moduldeContent = $(btn).parent().parent().parent().children(":last");

    if ($(moduldeContent).hasClass('fs-1')){
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
    }else if ($(moduldeContent).hasClass('fs-16')){
        return 16;
    }else if ($(moduldeContent).hasClass('fs-20')){
        return 20;
    }else if ($(moduldeContent).hasClass('fs-22')){
        return 22;
    }else if ($(moduldeContent).hasClass('fs-24')){
        return 24;
    }else if ($(moduldeContent).hasClass('fs-26')){
        return 26;
    }else if ($(moduldeContent).hasClass('fs-28')){
        return 28;
    }else if ($(moduldeContent).hasClass('fs-32')){
        return 32;
    }else if ($(moduldeContent).hasClass('fs-34')){
        return 34;
    }else if ($(moduldeContent).hasClass('fs-36')){
        return 36;
    }else if ($(moduldeContent).hasClass('fs-38')){
        return 38;
    }else if ($(moduldeContent).hasClass('fs-40')){
        return 40;
    }else if ($(moduldeContent).hasClass('fs-42')){
        return 42;
    }else if ($(moduldeContent).hasClass('fs-44')){
        return 44;
    }else if ($(moduldeContent).hasClass('fs-46')){
        return 46;
    }else if ($(moduldeContent).hasClass('fs-48')){
        return 48;
    }else if ($(moduldeContent).hasClass('fs-50')){
        return 50;
    }else if ($(moduldeContent).hasClass('fs-64')){
        return 64;
    }else {
        return 14;
    }
}
function getModuleBackgroundColor(btn){
    var module = $(btn).parent().parent().parent();

    if ($(module).hasClass('background-main-color')){
        return 'background-main-color';
    }else if ($(module).hasClass('background-second-color')){
        return 'background-second-color';
    }else if ($(module).hasClass('background-third-color')){
        return 'background-third-color';
    }else {
        return 'unset';
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
    var module = $($(btn).find(":last"));
    if ($(module).hasClass('text-center')){
        return 'format_align_center';
    }else if ($(module).hasClass('text-right')){
        return 'format_align_right';
    }else if ($(module).hasClass('text-justify')){
        return 'format_align_justify'
    }else{
        return 'format_align_left';
    }
}