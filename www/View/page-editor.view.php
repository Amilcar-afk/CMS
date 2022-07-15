<section id="back-office-container">
    <header class="content-header">
        <nav>
            <button class="cta-button cta-button--icon cta-button-undo"><span class="material-icons-round">undo</span></button>
            <button class="cta-button cta-button--icon cta-button-redo"><span class="material-icons-round">redo</span></button>
        </nav>
        <div>
            <label>
                <?php if ( $page->getStatus() == 'Tag'): ?>
                    Categorie template
                <?php else:?>
                    <?php if ( $page->getStatus() == 'Draft'): ?>
                        <span class="material-icons-round">https</span>
                    <?php else:?>
                        <span class="material-icons-round">lock_open</span>
                    <?php endif;?>
                    <?=$page->getStatus()?>
                <?php endif;?>
                .
                <?=ucfirst($page->getTitle())?>
            </label>
            <footer>
                /<?php if ( empty($page->getSlug())): ?>
                    Home
                <?php endif;?><?=$page->getSlug()?>
            </footer>
        </div>
        <div class="burger-menu-container">
            <button class="cta-button cta-button--menu-burger">
                <span class="material-icons-round">menu</span>
            </button>
            <nav>
                <button class="cta-button cta-button--text-icon cta-button-save" data-page-status="<?= $page->getStatus() ?>" data-page-id="<?=$page->getId()?>"><span class="material-icons-round">save</span>Save</button>
                <?php if ( $page->getStatus() != 'Tag' && $page->getStatus() != 'Public'): ?>
                    <button class="cta-button cta-button--text-icon cta-button--text-icon cta-button-save" data-page-status="Public" data-page-id="<?=$page->getId()?>"><span class="material-icons-round">send</span>Published</button>
                <?php endif;?>
            </nav>
        </div>
    </header>
    <section id="container-editor" class="container-main-content container-main-content--padding" >
        <div class="row <?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?>">
            <?php if( $page->getContent() == null ):?>
                <article class="module col-6 col-offset-1">
                    <h4 class="color-main-color text-center fs-26 bold col-12">Lorem ipsum dolor sit amet consectetur.</h4>
                </article>
            <?php endif;?>
            <?=$page->getContent()?>
        </div>
    </section>
    <?php include "Partial/component-list.view.php";?>
</section>