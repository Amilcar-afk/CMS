<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SITEMAP</h1>
            <nav>

                <a href="pages" class="cta-button cta-button--menu main-nav-choice" data-wc-target="pages-container"><span class="material-icons-round">view_quilt</span>My pages</a>
                <a href="navigations" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">dynamic_feed</span>Navigations</a>
                <a href="categories" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="categories-container"><span class="material-icons-round">tag</span>Categories</a>
                <a href="add-code" class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">code</span>Add code</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="categories-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">CATEGORIES</h1>
                </header>

                <!--Add categorie-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-categorie">
                        New categorie
                    </button>
                    <div id="new-categories-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="categorie-manager-container">
                    </div>
                </article>

                <article>
                    <div id="categories-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="categorie-manager-container" style="opacity: 1">
                        <table>
                            <tbody>
                            <?php foreach ($categories as $categorie):?>
                                <tr class="table-line">
                                    <td>
                                        <h4><?= ucfirst($categorie->getTitle()) ?></h4>
                                        <?php foreach ($categorie->navigations() as $nav):?>
                                            <?php if ($nav->getType() == "nav"):?>
                                                <label class="sticker">#<?= $nav->getTitle()?></label>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <button class="cta-button cta-button-a" data-a-target="container-setting-categorie-<?=$categorie->getId() ?>"><span class="material-icons-round">build</span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

            </div>

        </section>
    </section>

    <?php foreach ($categories as $categorie):?>
        <!-- update categorie form -->
        <section id="container-setting-categorie-<?=$categorie->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-categorie-<?=$categorie->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-categorie-<?=$categorie->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($categorie->getTitle()) ?></h1>
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $categorie->getFormNewCategorie()) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add categorie form -->
    <section id="container-new-categorie" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-categorie" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-categorie"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW CATEGORIE</h1>
                </header>

                <article>
                    <?php  $this->includePartial("form", $categorie->getFormNewCategorie()) ?>
                </article>
            </div>
        </section>
    </section>
</section>
