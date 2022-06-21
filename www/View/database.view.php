<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SETTINGS</h1>
            <nav>
                <a href="/settings/user-manager" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="user-manager-container"><span class="material-icons-round">supervisor_account</span>User manager</a>
                <a href="/settings/style" class="cta-button cta-button--menu main-nav-choice" data-wc-target="style-container"><span class="material-icons-round">brush</span>Style</a>
                <a href="/settings/database" class="cta-button cta-button--menu main-nav-choice" data-wc-target="database-container"><span class="material-icons-round">cloud</span>Config</a>
                <a href="/settings/media-library" class="cta-button cta-button--menu main-nav-choice" data-wc-target="media-library-container"><span class="material-icons-round">video_library</span>Media library</a>
            </nav>
        </div>
        <article>
                    <header class="main-nav-choice" data-wc-target="main-images-elements">
                        <h2>Data Base</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="main-images-elements" class="container-main-content container-main-content--menu-content collapse row" data-group-collapse="style-manager-container">
                    <section class="collapse-parent">
            <div id="user-manager-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">DATA BASE</h1>
                </header>
                <article>
                    <?php if(empty($config)):  ?>
                    <?php $this->includePartial("form", $database->dataBaseForm())  ?>
                    <?php else:  ?>
                    <?php $this->includePartial("form", $config)  ?>
                    <?php endif?>
                </article>
            </div>
        </section>
       

                    </div>
                </article>

                <article>
                    <header class="main-nav-choice" data-wc-target="main-images-elements">
                        <h2>SMTP</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="main-images-elements" class="container-main-content container-main-content--menu-content collapse row" data-group-collapse="style-manager-container">
                    <section class="collapse-parent">
            <div id="user-manager-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">DATA BASE</h1>
                </header>
                <article>
                    <?php if(empty($config)):  ?>
                    <?php $this->includePartial("form", $database->dataBaseForm())  ?>
                    <?php else:  ?>
                    <?php $this->includePartial("form", $config)  ?>
                    <?php endif?>
                </article>
            </div>
        </section>
       

                    </div>
                </article>
        

    </section>
</section>
