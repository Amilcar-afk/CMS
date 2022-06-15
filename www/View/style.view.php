<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SETTINGS</h1>
            <nav>
                <a href="/settings/user-manager" class="cta-button cta-button--menu main-nav-choice" data-wc-target="user-manager-container"><span class="material-icons-round">supervisor_account</span>User manager</a>
                <a href="/settings/style" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="style-container"><span class="material-icons-round">brush</span>Style</a>
                <a href="/settings/database" class="cta-button cta-button--menu main-nav-choice" data-wc-target="database-container"><span class="material-icons-round">cloud</span>Database</a>
                <a href="/settings/media-library" class="cta-button cta-button--menu main-nav-choice" data-wc-target="media-library-container"><span class="material-icons-round">video_library</span>Media library</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="style-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">STYLE</h1>
                </header>
                <!--Colors-->
                <article>
                    <header class="main-nav-choice selected" data-wc-target="colors-elements">
                        <h2>Colors</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="colors-elements" class="container-main-content container-main-content--menu-content collapse--open row" data-group-collapse="style-manager-container" style="opacity: 1">
                        <header class="main-nav-choice">
                            <h2>Main colors</h2>
                            <p>Chose the main colors of your site. Your can have only one and nuances or completly different ones. The more important is to keep it esthetical.</p>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span class="
                                main_color
                                input-block cta-button--mains-color--custom" 
                                <?= ($main_color &&  $main_color->getId()) ? 'id="'.$main_color->getId().'"':'id=""'?>
                                <?= ($main_color && $main_color->getValue()) != null?   'style="background-color:'.$main_color->getValue(). '"':'style="background-color:#396075"'  ?>
                                ></span>
                                <label>Main color</label>
                            </article>
                            <article>
                                <span class="second_color main input-block cta-button--mains-color--custom" 
                                <?= ($second_color && $second_color->getId()) != null? 'id="'.$second_color->getId().'"':'id=""'?>
                                <?= ($second_color && $second_color->getValue()) != null?   'style="background-color:'.$second_color->getValue(). '"':'style="background-color:#396075"'  ?>
                                ></span>
                                <label>Seconde color</label>
                            </article>
                            <article>
                                <span class="third_color input-block cta-button--mains-color--custom" 
                                <?= ($third_color && $third_color->getId()) != null? 'id="'.$third_color->getId().'"':'id=""'?>
                                <?= ($third_color && $third_color->getValue()) != null?   'style="background-color:'.$third_color->getValue(). '"':'style="background-color:#9DDCFF"'  ?>
                                ></span>
                                <label>Third color</label>
                            </article>
                        </section>

                        <header class="main-nav-choice">
                            <h2>Other colors</h2>
                            <p>The background color is the most of the time white or black if your are a dark mode fan. You always can be creative.</p>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span class="background_color input-block cta-button--mains-color--custom"
                                <?= ($background_color && $background_color->getId()) != null? 'id="'.$background_color->getId().'"':'id=""'?>
                                <?= ($background_color && $background_color->getValue()) != null?   'style="background-color:'.$background_color->getValue(). '"':'style="background-color:#9DDCFF"'  ?>
                                ></span>
                                <label>Background color</label>
                            </article>
                        </section>
                    </div>
                </article>

                <!--Main images-->
                <article>
                    <header class="main-nav-choice" data-wc-target="main-images-elements">
                        <h2>Main images</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="main-images-elements" class="container-main-content container-main-content--menu-content collapse row" data-group-collapse="style-manager-container">

                        <header class="main-nav-choice">
                            <h2>Logos</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span class="input-block ">
                                    <img src="">
                                    <input type="file" name="main_logo" class="main_logo ">
                                </span>
                                <label>Main logo</label>
                            </article>
                            <article>
                                    <span class="input-block ">
                                        <img src="">
                                        <input type="file" name="main_favicon"  class="main_favicon">
                                    </span>
                                <label>Favicon</label>
                            </article>
                        </section>

                    </div>
                </article>

                <!--Fonts-->
                <article>
                    <header class="main-nav-choice" data-wc-target="fonts-elements">
                        <h2>Fonts</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="fonts-elements" class="container-main-content container-main-content--menu-content collapse row" data-group-collapse="style-manager-container">
                        <header class="main-nav-choice">
                            <h2>My fonts</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span class="input-block">
                                    <span class="material-icons-round">add</span>
                                </span>
                                <label>Add font</label>
                            </article>
                            <article>
                                <span class="input-block">
                                    aA
                                </span>
                                <label>Racing Sans One</label>
                            </article>
                            <article>
                                <span class="input-block">
                                    aA
                                </span>
                                <label>Roboto</label>
                            </article>
                        </section>

                        <header class="main-nav-choice">
                            <h2>My default fonts</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span class="input-block">
                                    aA
                                </span>
                                <label>Roboto</label>
                            </article>
                        </section>

                    </div>
                </article>

                <!--Design-->
                <article>
                    <header class="main-nav-choice" data-wc-target="design-elements">
                        <h2>Design</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="design-elements" class="container-main-content container-main-content--menu-content collapse row" data-group-collapse="style-manager-container">

                        <header class="main-nav-choice">
                            <h2>Border radius</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span data-type="radius" data-value="radius" class="radius <?= ($radius->getValue() != null && $radius->getValue() == "radius")?   'selected':''  ?> input-block main_border compose-option">
                                    <div></div>
                                </span>
                                <label>Radius</label>
                            </article>
                            <article>
                                <span data-type="radius" data-value="right_angle" class="right_angle <?= ($radius->getValue() != null && $radius->getValue() == "right_angle")?   'selected':''  ?> input-block main_border compose-option">
                                    <div></div>
                                </span>
                                <label>Right angle</label>
                            </article>
                        </section>

                        <header class="main-nav-choice">
                            <h2>Bessels</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span data-type="bessels" data-value="small" class="small input-block compose-option <?= ($bessels->getValue() != null && $bessels->getValue() == "small")?   'selected':''  ?>">
                                    <div></div>
                                </span>
                                <label>Small</label>
                            </article>
                            <article>
                                <span data-type="bessels" data-value="medium_classic" class="medium_classic input-block compose-option <?= ($bessels->getValue() != null && $bessels->getValue() == "medium_classic")?   'selected':''  ?>">
                                    <div></div>
                                </span>
                                <label>Medium - classic</label>
                            </article>
                            <article>
                                <span data-type="bessels" data-value="big" class="big input-block compose-option <?= ($bessels->getValue() != null && $bessels->getValue() == "big")?   'selected':''  ?>">
                                    <div></div>
                                </span>
                                <label>Big</label>
                            </article>
                        </section>
                    </div>
                </article>
            </div>
        </section>
    </section>
</section>
