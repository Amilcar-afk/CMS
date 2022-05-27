<section id="back-office-container">
    <header class="content-header">
        <nav>
            <button class="cta-button cta-button--icon"><span class="material-icons-round">undo</span></button>
            <button class="cta-button cta-button--icon"><span class="material-icons-round">redo</span></button>
        </nav>
        <div>
            <label>
                <span class="material-icons-round">https</span>
                Public . Home page
            </label>
            <footer>
                published
            </footer>
        </div>
        <div class="burger-menu-container">
            <button class="cta-button cta-button--menu-burger">
                <span class="material-icons-round">menu</span>
            </button>
            <nav>
                <a href="" class="cta-button cta-button--text-icon"><span class="material-icons-round">visibility</span>Preview</a>
                <a href="" class="cta-button cta-button--text-icon"><span class="material-icons-round">save</span>Save</a>
                <a href="" class="cta-button cta-button--text-icon"><span class="material-icons-round">send</span>Published</a>
            </nav>
        </div>
    </header>
    <section class="container-main-content container-main-content--padding" >
        <div class="row" >
            <article class="module" data-a-target="editable-module-1">
                <div id="editable-module-1" class="editable-module a-zoom-out-end">
                    <nav class="editable-module--tool-bar">
                        <button class="cta-button cta-button--icon cta-button-bold">
                            <span class="material-icons-round">format_bold</span>
                        </button>
                        <button class="cta-button cta-button--icon cta-button-underlined">
                            <span class="material-icons-round">format_underlined</span>
                        </button>
                        <button class="cta-button cta-button--icon cta-button-strikethrough">
                            <span class="material-icons-round">format_strikethrough</span>
                        </button>
                        <button class="cta-button cta-button--icon">
                            <span class="material-icons-round">color_lens</span>
                        </button>
                        <button class="cta-button cta-button--icon">
                            <span class="material-icons-round">format_paint</span>
                        </button>
                        <button class="cta-button cta-button--icon cta-button-delete-module">
                            <span class="material-icons-round">delete</span>
                        </button>
                    </nav>
                    <div class="editable-module editable-module--border">

                    </div>
                    <nav class="editable-module--footer-nav">
                       <button class="cta-button cta-button--icon cta-button-a" data-a-target="container-main-content--component-list">
                            <span class="material-icons-round">add</span>
                        </button>
                    </nav>
                </div>
                <h4 class="color-main-color text-center fs-26 bold">Lorem ipsum djijkjolor sit amet consectetur.</h4>
            </article>
        <!--<div class="row">
            <button style="background-color: #ce0a0a" class="cta-button cta--button-a col-6" data-a-target="container-main-content--component-list">
                <span class="material-icons-round">add</span>
            </button>-->

        </div>
    </section>
    <?php include "Partial/component-list.view.php";?>
</section>