<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Main colors</h1>
        </header>
        <div id="colors-elements" class="container-main-content container-main-content--menu-content collapse--open row" data-group-collapse="style-manager-container" style="opacity: 1">
            <header class="main-nav-choice">
                <h2>Main colors</h2>
                <p>Chose the main colors of your site. Your can have only one and nuances or completly different ones. The more important is to keep it esthetical.</p>
            </header>
            <section class="section-config-blocks">
                <article>
                                <span class="input-block cta-button--mains-color--custom color-picker color-picker--setting"
                                <?= (isset($main_color) && $main_color->getValue()) != null?   'style="background-color:'.$main_color->getValue(). '"':'style="background-color:#396075"'  ?>
                                >
                                    <input type="hidden" class="color-picker--input" data-type="main_color" value="<?= (isset($main_color) && $main_color->getValue()) != null? $main_color->getValue() : '#396075'?>">
                                </span>
                    <label>Main color</label>
                </article>
                <article>
                                <span class="input-block cta-button--mains-color--custom color-picker color-picker--setting"
                                <?= (isset($second_color) && $second_color->getValue()) != null?   'style="background-color:'.$second_color->getValue(). '"':'style="background-color:#396075"'  ?>
                                >
                                    <input type="hidden" class="color-picker--input" data-type="second_color" value="<?= (isset($second_color) && $second_color->getValue()) != null? $second_color->getValue() : '#396075'?>">
                                </span>
                    <label>Seconde color</label>
                </article>
                <article>
                                <span class="input-block cta-button--mains-color--custom color-picker color-picker--setting"
                                <?= (isset($third_color) && $third_color->getValue()) != null?   'style="background-color:'.$third_color->getValue(). '"':'style="background-color:#9DDCFF"'  ?>
                                >
                                    <input type="hidden" class="color-picker--input" data-type="third_color" value="<?= (isset($third_color) && $third_color->getValue()) != null? $third_color->getValue() : '#9DDCFF'?>">
                                </span>
                    <label>Third color</label>
                </article>
            </section>

            <header class="main-nav-choice">
                <h2>Other colors</h2>
                <p>The background color is the most of the time white or black if your are a dark mode fan. You always can be creative.</p>
            </header>
            <section class="section-config-blocks">
                <article>
                                <span class="input-block cta-button--mains-color--custom color-picker color-picker--setting"
                                <?= (isset($background_color) && $background_color->getValue()) != null?   'style="background-color:'.$background_color->getValue(). '"':'style="background-color:#F1F1F1"'  ?>
                                >
                                    <input type="hidden" class="color-picker--input" data-type="background_color" value="<?= (isset($background_color) && $background_color->getValue()) != null? $background_color->getValue() : '#F1F1F1'?>">
                                </span>
                    <label>Background color</label>
                </article>
                <article>
                                <span class="input-block cta-button--mains-color--custom color-picker color-picker--setting"
                                <?= (isset($text_color) && $text_color->getValue()) != null?   'style="background-color:'.$text_color->getValue(). '"':'style="background-color:black"'  ?>
                                >
                                    <input type="hidden" class="color-picker--input" data-type="text_color" value="<?= (isset($text_color) && $text_color->getValue()) != null? $text_color->getValue() : 'black'?>">
                                </span>
                    <label>Text color</label>
                </article>
            </section>
            <a href="/setup/main-images" class="cta-button cta-button--submit">Next</a>
        </div>
    </section>
</main>