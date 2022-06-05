<section id="back-office-container">
    <header class="content-header">
        <nav>
            <button class="cta-button cta-button--icon cta-button-undo"><span class="material-icons-round">undo</span></button>
            <button class="cta-button cta-button--icon cta-button-redo"><span class="material-icons-round">redo</span></button>
        </nav>
        <div>
            <label>
                <span class="material-icons-round">https</span>
                <?=$page->getStatus()?> . <?=ucfirst($page->getTitle())?>
            </label>
            <footer>
                <?php if ( empty($page->getSlug())): ?>
                    Home
                <?php endif;?>
                <?=$page->getSlug()?>
            </footer>
        </div>
        <div class="burger-menu-container">
            <button class="cta-button cta-button--menu-burger">
                <span class="material-icons-round">menu</span>
            </button>
            <nav>
                <a href="/pageloader/<?= $page->getSlug() ?>" class="cta-button cta-button--text-icon"><span class="material-icons-round">visibility</span>Preview</a>
                <a href="" class="cta-button cta-button--text-icon cta-button-save" data-page-id="<?=$page->getId()?>"><span class="material-icons-round">save</span>Save</a>
                <a href="" class="cta-button cta-button--text-icon"><span class="material-icons-round">send</span>Published</a>
            </nav>
        </div>
    </header>
    <section id="container-editor" class="container-main-content container-main-content--padding" >
        <div class="row">
            <article class="module col-6 col-offset-1">

                <h4 class="color-main-color text-center fs-26 bold col-12">Lorem ipsum dolor sit amet consectetur.</h4>
            </article>
            <?=$page->getContent()?>
        </div>
    </section>
    <?php include "Partial/component-list.view.php";?>
</section>