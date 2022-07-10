<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">NEWSLETTER</h1>
        </div>
        <section class="collapse-parent">
            <div id="newsletters-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">MY NEWSLETTERS</h1>
                    <p></p>
                </header>

                <!--Add newsletter-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-newsletter">
                        New newsletter
                    </button>
                    <div id="new-newsletters-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="newsletter-manager-container">
                    </div>
                </article>

                <!--Draft-->
                <article>
                    <header class="main-nav-choice" data-wc-target="draft-newsletters-elements">
                        <h2>Draft</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="draft-newsletters-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="newsletter-manager-container" style="opacity: 1">

                        <table class="table">
                            <tbody>
                            <?php foreach ($newsletters as $newsletter):?>
                                <?php if ($newsletter->getStatus() == 'Draft'): ?>
                                    <tr class="table-line">
                                        <td>
                                            <h4><?= ucfirst($newsletter->getTitle()) ?></h4>
                                            <label class="sticker"><?= $newsletter->getDateUpdate() ?></label>
                                        </td>
                                        <td>
                                            <a href="newsletterloader/<?= $newsletter->getId() ?>" target="_blank" class="cta-button"><span class="material-icons-round">open_in_new</span></a>
                                            <a href="newsletter/build/<?= $newsletter->getId() ?>" class="cta-button"><span class="material-icons-round">mode</span></a>
                                            <button class="cta-button cta-button-a" data-a-target="container-setting-newsletter-<?=$newsletter->getId() ?>"><span class="material-icons-round">build</span></button>
                                            <button class="cta-button cta-button-a cta-button-delete-newsletter" data-newsletter-id="<?= $newsletter->getId() ?>"><span class="material-icons-round">delete</span></button>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

                <!--Public-->
                <article>
                    <header class="main-nav-choice selected" data-wc-target="public-newsletters-elements">
                        <h2>Public</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="public-newsletters-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="newsletter-manager-container" style="opacity: 1">
                        <table class="table">
                            <tbody>
                            <?php foreach ($newsletters as $newsletter):?>
                                <?php if ($newsletter->getStatus() == 'Public'): ?>
                                    <tr class="table-line">
                                        <td>
                                            <h4><?= ucfirst($newsletter->getTitle()) ?></h4>
                                            <label class="sticker sticker--slug"><?= $newsletter->getDateRelease() ?></label>
                                        </td>
                                        <td>
                                            <a href="newsletterloader/<?= $newsletter->getId() ?>" target="_blank" class="cta-button"><span class="material-icons-round">open_in_new</span></a>
                                            <button class="cta-button cta-button-a" data-a-target="container-setting-newsletter-<?=$newsletter->getId() ?>"><span class="material-icons-round">build</span></button>
                                            <button class="cta-button cta-button-a cta-button-delete-newsletter" data-newsletter-id="<?= $newsletter->getId() ?>"><span class="material-icons-round">delete</span></button>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

                <?php if (!isset($newsletters[0])):?>
                    <p class="title title--small">No newsletter</p>
                <?php endif;?>
            </div>
        </section>
    </section>

    <?php foreach ($newsletters as $newsletter):?>
        <!-- update newsletter form -->
        <section id="container-setting-newsletter-<?=$newsletter->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-newsletter-<?=$newsletter->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-newsletter-<?=$newsletter->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($newsletter->getTitle()) ?></h1>
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $newsletter->getFormNewNewsletter()) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add newsletter form -->
    <section id="container-new-newsletter" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-newsletter" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-newsletter"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW NEWSLETTER</h1>
                </header>

                <!--Titles-->
                <article>
                    <?php  $this->includePartial("form", $newsletterEmpty->getFormNewNewsletter()) ?>
                </article>

            </div>

        </section>
    </section>

</section>
