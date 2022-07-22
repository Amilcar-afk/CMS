<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Design 2 / 2</h1>
        </header>
        <div id="colors-elements" class="container-main-content container-main-content--menu-content collapse--open row" data-group-collapse="style-manager-container" style="opacity: 1">
            <header class="main-nav-choice">
                <h2>Bessels</h2>
            </header>
            <section class="section-config-blocks">
                <article>
                    <span data-type="bessels" data-value="body-small" class="small input-block compose-option <?= (isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "body-small")?   'selected':''  ?>">
                        <div></div>
                    </span>
                    <label>Small</label>
                </article>
                <article>
                        <span data-type="bessels" data-value="body-medium" class="medium_classic input-block compose-option <?= ((isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "body-medium")) || (!isset($bessels))?   'selected':''  ?>">
                            <div></div>
                        </span>
                    <label>Medium - classic</label>
                </article>
                <article>
                    <span data-type="bessels" data-value="body-big" class="big input-block compose-option <?= (isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "body-big")?   'selected':''  ?>">
                        <div></div>
                    </span>
                    <label>Big</label>
                </article>
            </section>
            <a href="/dashboard" class="cta-button cta-button--submit">Next</a>
        </div>
    </section>
</main>