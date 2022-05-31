<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">SITE MAP</h1>
            <nav>
                <a href="pages" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="pages-container"><span class="material-icons-round">view_quilt</span>My pages</a>
                <a href="navigations" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">dynamic_feed</span>Navigations</a>
                <a href="categories" class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">tag</span>Categories</a>
                <a href="add-code" class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">code</span>Add code</a>
            </nav>
        </div>
        <section class="collapse-parent">
            <div id="pages-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">MY PAGES</h1>
                    <p>Here you can modify the sitemap of your website with navigations, the visibility of the different pages as well as their metadatas.</p>
                </header>

                <!--Add page-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-page">
                        New page
                    </button>
                    <div id="new-pages-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="page-manager-container">
                    </div>
                </article>

                <!--Public-->
                <article>
                    <header class="main-nav-choice selected" data-wc-target="public-pages-elements">
                        <h2>Public</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="public-pages-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="page-manager-container" style="opacity: 1">
                        <table>
                            <tbody>
                            <?php foreach ($pages as $page):?>
                                <?php if ($page->getStatus() == 'Public'): ?>
                                    <tr class="table-line">
                                        <td>
                                            <?php if ($page->getSlug() == ""): ?>
                                                <span class="material-icons-round">home</span>
                                            <?php endif;?>
                                            <h4><?= ucfirst($page->getTitle()) ?></h4>
                                            <label class="sticker sticker--slug">/<?= $page->getSlug() ?></label>
                                            <?php foreach ($page->categories() as $categorie):?>
                                                <?php if($categorie->getType() == 'tag'): ?>
                                                    <label class="sticker">#<?= $categorie->getTitle()?></label>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <a href="pageloader/<?= $page->getSlug() ?>" target="_blank" class="cta-button"><span class="material-icons-round">open_in_new</span></a>
                                            <a href="/build/<?= $page->getSlug() ?>" class="cta-button"><span class="material-icons-round">mode</span></a>
                                            <button class="cta-button cta-button-a" data-a-target="container-setting-page-<?=$page->getId() ?>"><span class="material-icons-round">build</span></button>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

                <!--Draft-->
                <article>
                    <header class="main-nav-choice" data-wc-target="draft-pages-elements">
                        <h2>Draft</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="draft-pages-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="page-manager-container">

                        <table>
                            <tbody>
                            <?php foreach ($pages as $page):?>
                                <?php if ($page->getStatus() == 'Draft'): ?>
                                    <tr class="table-line">
                                        <td>
                                            <?php if ($page->getSlug() == ""): ?>
                                                <span class="material-icons-round">home</span>
                                            <?php endif;?>
                                            <h4><?= ucfirst($page->getTitle()) ?></h4>
                                            <label class="sticker sticker--slug">/<?= $page->getSlug() ?></label>
                                            <h4>
                                                <?php foreach ($page->categories() as $categorie):?>
                                                    <?php if($categorie->getType() == 'tag'): ?>
                                                        <label class="sticker">#<?= $categorie->getTitle()?></label>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </h4>
                                        </td>
                                        <td>
                                            <a href="pageloader/<?= $page->getSlug() ?>" target="_blank" class="cta-button"><span class="material-icons-round">open_in_new</span></a>
                                            <a href="/build/<?= $page->getSlug() ?>" class="cta-button"><span class="material-icons-round">mode</span></a>
                                            <button class="cta-button cta-button-a" data-a-target="container-setting-page-<?=$page->getId() ?>"><span class="material-icons-round">build</span></button>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

            </div>
        </section>
    </section>

    <?php foreach ($pages as $page):?>
        <!-- update page form -->
        <section id="container-setting-page-<?=$page->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-page-<?=$page->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-page-<?=$page->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($page->getTitle()) ?></h1>
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $page->getFormNewPage()) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add page form -->
    <section id="container-new-page" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-page" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-page"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW PAGE</h1>
                </header>

                <!--Titles-->
                <article>
                    <?php  $this->includePartial("form", $page->getFormNewPage()) ?>
                </article>

            </div>

        </section>
    </section>

</section>
