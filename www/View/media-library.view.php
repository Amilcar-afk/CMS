<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SETTINGS</h1>
            <nav>
                <a href="/settings/user-manager" class="cta-button cta-button--menu main-nav-choice" data-wc-target="user-manager-container"><span class="material-icons-round">supervisor_account</span>User manager</a>
                <a href="/settings/style" class="cta-button cta-button--menu main-nav-choice" data-wc-target="style-container"><span class="material-icons-round">brush</span>Style</a>
                <a href="/settings/configuration" class="cta-button cta-button--menu main-nav-choice" data-wc-target="database-container"><span class="material-icons-round">cloud</span>Configuration</a>
                <a href="/settings/media-library" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="media-library-container"><span class="material-icons-round">video_library</span>Media library</a>
            </nav>
        </div>
        <section class="collapse-parent">
            <div id="media-library-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">MEDIA LIBRARY</h1>
                </header>
                <div id="images-db-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="media-library-manager-container" style="opacity: 1">
                    <div class="col-6">
                        <?php for ($i = 0; $i <= ((count($images) - 1) / 2); $i++): ?>
                            <article class="module-list-media" data-file-id="<?= $images[$i]->getId() ?>">
                                <div class="module col-6" data-media-type="img">
                                    <img class="module" width="100%" src="<?= $images[$i]->getPath() ?>">
                                </div>
                            </article>
                        <?php endfor;?>
                    </div>

                    <div class="col-6 col-md-12 col-sm-12">
                        <?php for ($i; isset($images[$i]); $i++): ?>
                            <article class="module-list-media" data-file-id="<?= $images[$i]->getId() ?>">
                                <div class="module col-6" data-media-type="img">
                                    <img class="module" width="100%" src="<?= $images[$i]->getPath() ?>">
                                </div>
                            </article>
                        <?php endfor;?>
                    </div>
                </div>
                <?php if (!isset($images[0])):?>
                    <p class="title title--small">No image</p>
                <?php endif;?>
             </div>
        </section>
    </section>
</section>
