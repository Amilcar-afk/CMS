<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Design 1 / 2</h1>
        </header>
        <div id="colors-elements" class="container-main-content container-main-content--menu-content collapse--open row" data-group-collapse="style-manager-container" style="opacity: 1">
            <header class="main-nav-choice">
                <h2>Border radius</h2>
            </header>
            <section class="section-config-blocks">
                <article>
                    <span data-type="radius" data-value="radius" class="radius <?= ((isset($radius) && $radius->getValue() != null && $radius->getValue() == "radius") || (!isset($radius)))?   'selected':''  ?> input-block main_border compose-option">
                        <div></div>
                    </span>
                    <label>Radius</label>
                </article>
                <article>
                    <span data-type="radius" data-value="right_angle" class="right_angle <?= (isset($radius) && $radius->getValue() != null && $radius->getValue() == "right_angle")?   'selected':''  ?> input-block main_border compose-option">
                        <div></div>
                    </span>
                    <label>Right angle</label>
                </article>
            </section>
            <a href="/setup/design/1" class="cta-button cta-button--submit">Next</a>
        </div>
    </section>
</main>