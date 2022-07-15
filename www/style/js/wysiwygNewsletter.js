$(document).ready(function(){
    //add editor tool bar for model
    $(document).on( "click", ".module", function () {

        if ($(this).attr('data-a-target') == 'editable-module'){
            return;
        }
        if ($("#editable-module") && $($('[data-a-target="editable-module"]')[0]) != $(this)){
            $($('[data-a-target="editable-module"]')[0]).removeAttr('data-a-target');
            $("#editable-module").remove();
        }

        $(this).attr('contenteditable', 'true');
        $(this).addClass("module--on");

        $(this).attr('data-a-target', 'editable-module');

        let neededBtns = [];

        if ($(this).attr('data-module-type') == 'button') {
            neededBtns.push('<button class="cta-button cta-button--icon cta-button-insert-link">\n' +
            '                   <span class="material-icons-round">insert_link</span>\n' +
            '                </button>\n');
        }

        neededBtns.push('<button class="cta-button cta-button--icon cta-button-delete-module">\n' +
            '                 <span class="material-icons-round">delete</span>\n' +
            '            </button>\n');

        var $editorToolBar = '<div id="editable-module" contenteditable="false" class="editable-module a-zoom-out-end">\n' +
            '                    <nav class="editable-module--tool-bar">'+neededBtns.join("")+'</nav>\n' +
            '                    <div class="editable-module editable-module--border">\n' +
            '                    </div>\n' +
            '                    <nav class="editable-module--footer-nav center-left">\n' +
            '                       <button class="cta-button cta-button--icon cta-button-a module-list" data-add-module="title">\n' +
            '                            <span class="material-icons-round">title</span>\n' +
            '                        </button>\n' +
            '                       <button class="cta-button cta-button--icon cta-button-a module-list" data-add-module="text">\n' +
            '                            <span class="material-icons-round">notes</span>\n' +
            '                        </button>\n' +
            '                       <button class="cta-button cta-button--icon cta-button-a module-list" data-add-module="button">\n' +
            '                            <span class="material-icons-round">ads_click</span>\n' +
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
    $(document).on("click", ".cta-button-back-tool-bar", function () {
        var $elements = $(this).parent().children();

        for (let i = 0; $($elements)[i] ; i++){
            if ($($($elements)[i]).hasClass('cta-button-insert-link')
                || $($($elements)[i]).hasClass('cta-button-delete-module')
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

    //delete component
    $(document).on( "click", ".cta-button-delete-module", function () {
        $(this).parent().parent().parent().remove();
    })

    //undo
    $(document).on( "click", ".cta-button-undo", function () {
        document.execCommand('undo',false,'')
    })
    //redo
    $(document).on( "click", ".cta-button-redo", function () {
        document.execCommand('redo',false,'')
    })

    //insert-link menu component
    $(document).on( "click", ".cta-button-insert-link", function () {
        cleanEditToolBar(this);
        let actuelSrc = $($(this).parent().parent().parent()).attr('href');

        var $hrefInput = $( '<input class="input" name="link" type="text" placeholder="https://google.com" value="'+actuelSrc+'">' );
        $(this).parent().append($hrefInput);

        var $ctaButtonSubmitLink = $( '<a style="margin-bottom: unset" href="'+actuelSrc+'" target="_blank" class="cta-button cta-button--icon cta-button-preview-link"><span class="material-icons-round">open_in_new</span></a>' );
        $(this).parent().append($ctaButtonSubmitLink);

        var $ctaButtonSubmitLink = $( '<button class="cta-button cta-button--icon cta-button-compose-link"><span class="material-icons-round">send</span></button>' );
        $(this).parent().append($ctaButtonSubmitLink);
    })
    //link compose component
    $(document).on( "click", ".cta-button-compose-link", function () {
        var module = $($(this).parent().parent().parent());
        let src = $(module).find('[name=link]').val();
        alert(src);
        $($(module).find('cta-button-preview-link')[0]).attr('href', src);

        $(module).attr('href', src);
    })


    //add component
    $(document).on( "click", ".module-list", function () {

        var $newComponent = '';
        if ($(this).attr('data-add-module') == 'title') {
            $newComponent = '<div class="module" data-module-type="title" style="padding:0px;margin-bottom:30px;margin-top:30px;width:100%;font-size:20px;font-weight:bold;line-height:24px;text-align:left;">Title</div>';
        }else if ($(this).attr('data-add-module') == 'text') {
            $newComponent = '<div class="module" data-module-type="text" style="padding:0px;width:100%;font-size:16px;font-weight:400;line-height:24px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo ante non pellentesque egestas. Phasellus elementum, augue vel facilisis blandit, odio odio vestibulum purus, ac venenatis lacus odio non metus. Morbi porttitor elit sem, in auctor massa sollicitudin et. Integer non magna vel nulla molestie viverra nec vel ligula. Sed rhoncus a neque eget laoreet. Ut eu ante eget ex consectetur congue. Maecenas placerat non risus eget tempus. Sed quis risus feugiat, tincidunt turpis in, feugiat dolor. Maecenas venenatis turpis et iaculis dictum.</div>';
        }else if ($(this).attr('data-add-module') == 'button') {
            $newComponent = '<button data-module-type="button" href="<?= $element[\'link\'] ?>" style="width: 100%" class="module cta-button cta-button--submit" target="_blank">Button</button>';
        }
        $("#editable-module").parent().after($newComponent);
        $("#cta-button-close-list-component").click();
    })

    $(".cta-button-save").click(function () {
        if ($(this).attr('data-newsletter-id') == null || $("#container-editor") == undefined){
            return;
        }
        if ($("#editable-module") && $($('.module[data-a-target="editable-module"]')[0]) != $(this)){
            $($('.module[data-a-target="editable-module"]')[0]).removeAttr('data-a-target');
            $("#editable-module").remove();
        }

        let content = [];
        let oneElment =[];
        $("#container-editor").find('.module').each(function () {
            oneElment = [];
            if ($(this).attr('data-module-type') == 'title'){
                content.push({
                    "type": 'title',
                    "content": $(this).html()
                });
            }else if ($(this).attr('data-module-type') == 'text'){
                content.push({
                    "type": 'text',
                    "content": $(this).html()
                });
            }else if ($(this).attr('data-module-type') == 'button'){
                content.push({
                    "type": 'button',
                    "link": $(this).attr('href'),
                    "content": $(this).html()
                });
            }

        })

        content = JSON.stringify(content);

        $.ajax({
            url:"/newsletter/build/save",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-newsletter-id'),
                    content: content,
                    status:$(this).attr('data-status'),
                },
            success:function()
            {
                alertMessage('Newsletter saved!');

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