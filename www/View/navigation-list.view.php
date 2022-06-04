<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">SITE MAP</h1>
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
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-navigation">
                        New navigation
                    </button>
                    <div id="new-navigations-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="navigation-manager-container">
                    </div>
                </article>

                <article>
                    <div id="navigations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="navigation-manager-container" style="opacity: 1">
                        <table>
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
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $navigation->getFormNewCategorie()) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add navigations form -->
    <section id="container-new-navigation" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-navigation" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-navigation"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW NAVIGATION</h1>
                </header>

                <article>
                    <?php  $this->includePartial("form", $navigation->getFormNewCategorie()) ?>
                </article>

            </div>

        </section>
    </section>

</section>