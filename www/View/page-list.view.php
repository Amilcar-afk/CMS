<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">SITE MAP</h1>
            <nav>
                <button class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="pages-container"><span class="material-icons-round">view_quilt</span>My pages</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">dynamic_feed</span>Navigations</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">tag</span>Categories</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">code</span>Add code</button>
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
                                <tr class="table-line">
                                    <td>
                                        <span class="material-icons-round">home</span>
                                        <h4><?= ucfirst($page->getTitle()) ?></h4>
                                        <label class="sticker sticker--slug">/<?= $page->getSlug() ?></label>
                                        <label class="sticker sticker">#tag</label>
                                    </td>
                                    <td>
                                        <a href="pageloader/<?= $page->getSlug() ?>" target="_blank" class="cta-button"><span class="material-icons-round">open_in_new</span></a>
                                        <a href="build/<?= $page->getSlug() ?>" class="cta-button"><span class="material-icons-round">mode</span></a>
                                        <button class="cta-button cta-button-a" data-a-target="container-setting-page-<?=$page->getId() ?>"><span class="material-icons-round">build</span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

                <!--Draft-->
                <article>
                    <header class="main-nav-choice" data-wc-target="draft-pages-elements">
                        <h2>Darft</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="draft-pages-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="page-manager-container">


                    </div>
                </article>

            </div>
            <div id="navigations-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">NAVIGATIONS</h1>
                </header>

                <article>

                </article>
            </div>
            <div id="categories-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">CATEGORIES</h1>
                </header>

                <article>

                </article>
            </div>
            <div id="add-code-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">ADD CODE</h1>
                    <p>You can add some code in the head and in the footer. This can be useful if you want to use for example external trackers for your website.</p>
                </header>

                <article>
                    <div>
                        <div class="input-container">
                            <h2>Header</h2>
                            <textarea class="input" placeholder="<head> add code here... </head>" rows="16"></textarea>
                        </div>
                        <div class="input-container">
                            <h2>Footer</h2>
                            <textarea class="input" placeholder="<footer> add code here... </footer>" rows="16"></textarea>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </section>

    <?php foreach ($pages as $page):?>
        <!-- add page form -->
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