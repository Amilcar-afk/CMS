<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SITEMAP</h1>
            <nav>
                <a href="pages" class="cta-button cta-button--menu main-nav-choice" data-wc-target="pages-container"><span class="material-icons-round">view_quilt</span>My pages</a>
                <a href="navigations" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="navigations-container"><span class="material-icons-round">dynamic_feed</span>Navigations</a>
                <a href="categories" class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">tag</span>Categories</a>
                <a href="add-code" class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">code</span>Add code</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="navigations-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">NAVIGATIONS</h1>
                </header>

                <!--Add navigation-->
                <article>
                    <!--<button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-navigation">
                        New navigation
                    </button>-->
                    <div id="new-navigations-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="navigation-manager-container">
                    </div>
                </article>

                <article>
                    <div id="navigations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="navigation-manager-container" style="opacity: 1">
                        <table class="table">
                            <tbody>
                            <?php foreach ($navigations as $navigation):?>
                                <tr class="table-line">
                                    <td>
                                        <h4><?= ucfirst($navigation->getTitle()) ?></h4>
                                    </td>
                                    <td>
                                        <button class="cta-button cta-button-a" data-a-target="container-setting-navigation-<?=$navigation->getId() ?>"><span class="material-icons-round">build</span></button>
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

    <?php foreach ($navigations as $navigation):?>
        <!-- update navigations form -->
        <section id="container-setting-navigation-<?=$navigation->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-navigation-<?=$navigation->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-navigation-<?=$navigation->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($navigation->getTitle()) ?></h1>
                        <p>Choose the category and the page you want to add to this navigation.</p>
                    </header>

                    <!--Colors-->
                    <article class="container-main-content--quit-settings">
                        <header class="main-nav-choice selected" data-wc-target="colors-list-elements-<?=$navigation->getId() ?>">
                            <h2>Colors</h2>
                            <span class="material-icons-round">more_horiz</span>
                        </header>
                        <div id="colors-list-elements-<?=$navigation->getId() ?>" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="addable-elements-container-<?=$navigation->getId() ?>" style="opacity: 1">

                            <div class="container-main-content--menu-content" data-parent="<?=$navigation->getId() ?>">
                                <header class="main-nav-choice">
                                    <h2>Background color</h2>
                                </header>
                                <section class="section-config-blocks center-left elements-in" data-parent="<?=$navigation->getId() ?>">
                                    <nav class="editable-module--tool-bar" data-option-type="backgroundColor" style="position: unset">
                                        <button data-option-value="unset" class="cta-button cta-button--icon cta-button-background-color-update <?= ($navigation->getBackgroundColor() != null && $navigation->getBackgroundColor() == 'unset')?'cta-button--editor-color--selected':'' ?>"><span class="material-icons-round">block</span></button>
                                        <button data-option-value="main-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBackgroundColor() != null && $navigation->getBackgroundColor() == 'main-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-main-color"></span></button>
                                        <button data-option-value="second-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBackgroundColor() != null && $navigation->getBackgroundColor() == 'second-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-second-color"></span></button>
                                        <button data-option-value="third-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBackgroundColor() != null && $navigation->getBackgroundColor() == 'third-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-third-color"></span></button>
                                        <button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color cta-button--editor-color--custom"><input class="background-color-picker background-color-picker-input" value="<?= ($navigation->getBackgroundColor() != null && $navigation->getBackgroundColor() != 'unset' && $navigation->getBackgroundColor() != 'main-color' && $navigation->getBackgroundColor() != 'second-color' && $navigation->getBackgroundColor() != 'third-color')? $navigation->getBackgroundColor() :'' ?>"></button>
                                    </nav>
                                </section>
                            </div>

                            <div class="container-main-content--menu-content" data-parent="<?=$navigation->getId() ?>">
                                <header class="main-nav-choice">
                                    <h2>Text buttons color</h2>
                                </header>
                                <section class="section-config-blocks center-left elements-in" data-parent="<?=$navigation->getId() ?>">
                                    <nav class="editable-module--tool-bar" data-option-type="btnTextColor" style="position: unset">
                                        <button data-option-value="unset" class="cta-button cta-button--icon cta-button-background-color-update <?= ($navigation->getBtnTextColor() != null && $navigation->getBtnTextColor() == 'unset')?'cta-button--editor-color--selected':'' ?>"><span class="material-icons-round">block</span></button>
                                        <button data-option-value="main-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBtnTextColor() != null && $navigation->getBtnTextColor() == 'main-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-main-color"></span></button>
                                        <button data-option-value="second-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBtnTextColor() != null && $navigation->getBtnTextColor() == 'second-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-second-color"></span></button>
                                        <button data-option-value="third-color" class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color <?= ($navigation->getBtnTextColor() != null && $navigation->getBtnTextColor() == 'third-color')?'cta-button--editor-color--selected':'' ?>"><span class="background-third-color"></span></button>
                                        <button class="cta-button cta-button--icon cta-button-background-color-update cta-button--editor-color cta-button--editor-color--custom"><input class="background-color-picker background-color-picker-input" value="<?= ($navigation->getBtnTextColor() != null && $navigation->getBtnTextColor() != 'unset' && $navigation->getBtnTextColor() != 'main-color' && $navigation->getBtnTextColor() != 'second-color' && $navigation->getBtnTextColor() != 'third-color')? $navigation->getBtnTextColor() :'' ?>"></button>
                                    </nav>
                                </section>
                            </div>

                        </div>
                    </article>

                    <!--Categories-->
                    <article>
                        <header class="main-nav-choice selected" data-wc-target="categorie-list-elements-<?=$navigation->getId() ?>">
                            <h2>Categories</h2>
                            <span class="material-icons-round">more_horiz</span>
                        </header>
                        <div id="categorie-list-elements-<?=$navigation->getId() ?>" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="addable-elements-container-<?=$navigation->getId() ?>" style="opacity: 1">

                            <div class="center-left" data-parent="<?=$navigation->getId() ?>">
                                <section class="center-left elements-in">
                                    <?php foreach ($navigation->categories() as $categorie):?>
                                        <?php if ($categorie->getType() == 'tag'):?>
                                            <label class="sticker sticker--cta sticker--cta--selected cta-button-delete-navigation-categorie" data-target="<?= $categorie->getId() ?>"><span class="material-icons-round">tag</span><?= $categorie->getTitle()?></label>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </section>
                                <section class="center-left elements-out">
                                    <?php foreach ($navigation->categoriesNot() as $categorie):?>
                                        <?php if ($categorie->getType() == 'tag'):?>
                                            <label class="sticker sticker--cta cta-button-compose-navigation-categorie" data-target="<?= $categorie->getId() ?>"><span class="material-icons-round">tag</span><?= $categorie->getTitle()?></label>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </section>
                            </div>

                        </div>
                    </article>

                    <!--Pages-->
                    <article>
                        <header class="main-nav-choice" data-wc-target="page-list-elements-<?=$navigation->getId() ?>">
                            <h2>Pages</h2>
                            <span class="material-icons-round">more_horiz</span>
                        </header>
                        <div id="page-list-elements-<?=$navigation->getId() ?>" class="container-main-content container-main-content--list collapse row" data-group-collapse="addable-elements-container-<?=$navigation->getId() ?>">

                            <div class="center-left" data-parent="<?=$navigation->getId() ?>">
                                <section class="center-left elements-in">
                                    <?php foreach ($navigation->pages() as $page):?>
                                        <?php if ($page->getStatus() != 'Tag'):?>
                                            <button class="sticker sticker--cta sticker--cta--selected cta-button-delete-navigation-page" data-target="<?= $page->getId() ?>">/<?= $page->getTitle()?></button>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </section>
                                <section class="center-left elements-out">
                                    <?php foreach ($navigation->pagesNot() as $page):?>
                                        <?php if ($page->getStatus() != 'Tag'):?>
                                            <button class="sticker sticker--cta cta-button-compose-navigation-page" data-target="<?= $page->getId() ?>">/<?= $page->getTitle()?></button>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </section>
                            </div>

                        </div>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add navigations form -->
    <!--<section id="container-new-navigation" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-navigation" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-navigation"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW NAVIGATION</h1>
                </header>

                <article>
                    <?php /* //$this->includePartial("form", $navigation->getFormNewCategorie()) */?>
                </article>

            </div>

        </section>
    </section>-->

</section>
