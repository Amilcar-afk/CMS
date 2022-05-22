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
        <div class="row">
            <button style="background-color: #ce0a0a" class="cta-button cta--button-a col-6" data-a-target="container-main-content--component-list">
                <span class="material-icons-round">add</span>
            </button>
        </div>
    </section>
    <?php include "Partial/component-list.view.php";?>
</section>