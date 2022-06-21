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
                                    <form method="POST" enctype="multipart/form-data">
                                        <input data-type="logo" type="file" class="compose-main-image compose-file">
                                        <img class="logo" src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
                                    </form>
                                </span>
                                <label>Main logo</label>
                            </article>
                            <article>
                                <span class="input-block ">
                                    <form method="POST" enctype="multipart/form-data">
                                        <input data-type="favicon" type="file" class="compose-main-image compose-file">
                                        <img class="favicon" src="<?= (isset($favicon[0]))? $favicon[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
                                    </form>
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
                        <section id="container-list-fonts" class="section-config-blocks">
                            <article>
                                <span class="input-block">
                                    <form method="POST" enctype="multipart/form-data">
                                        <input data-type="font" type="file" class="compose-font compose-file">
                                        <span class="material-icons-round">add</span>
                                    </form>
                                </span>
                                <label>Add font</label>
                            </article>
                            <?php foreach ($fonts as $font):?>
                                <article class="cta-button-a" data-a-target="container-setting-font-<?=$font->getId() ?>">
                                    <span class="input-block" style="font-family: '<?= $font->getValue()?>'">
                                        aA
                                    </span>
                                    <label><?= $font->getValue()?></label>
                                </article>
                            <?php endforeach;?>
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

                        <header class="main-nav-choice">
                            <h2>Bessels</h2>
                        </header>
                        <section class="section-config-blocks">
                            <article>
                                <span data-type="bessels" data-value="body-small" class="small input-block compose-option <?= (isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "small")?   'selected':''  ?>">
                                    <div></div>
                                </span>
                                <label>Small</label>
                            </article>
                            <article>
                                <span data-type="bessels" data-value="body-medium" class="medium_classic input-block compose-option <?= ((isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "medium_classic")) || (!isset($bessels))?   'selected':''  ?>">
                                    <div></div>
                                </span>
                                <label>Medium - classic</label>
                            </article>
                            <article>
                                <span data-type="bessels" data-value="body-big" class="big input-block compose-option <?= (isset($bessels) && $bessels->getValue() != null && $bessels->getValue() == "big")?   'selected':''  ?>">
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

    <?php foreach ($fonts as $font):?>
        <!-- update font form -->
        <section id="container-setting-font-<?=$font->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-font-<?=$font->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-font-<?=$font->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">
            </div>
            <section class="collapse-parent">
                <div id="font-element-container" class="collapse--open" data-group-collapse="fonts-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($font->getValue()) ?></h1>
                    </header>
                    <article>
                        <p class="input-block fs-40" style="font-family: '<?= $font->getValue()?>'">
                             a b c d e f g h i j k l m n o p q r s t u v w x y z
                        </p>
                        <br>
                        <p class="input-block fs-36" style="font-family: '<?= $font->getValue()?>'">
                             0 1 2 3 4 5 6 7 8 9
                        </p>
                        <br>
                        <p class="input-block fs-36" style="font-family: '<?= $font->getValue()?>'">
                            $ € £ ! " ' # % & ( ) * + , - . / : ; < = > ? @ [ \ ] ^ _ ` { | } ~
                        </p>
                    </article>
                </div>
            </section>
        </section>
    <?php endforeach;?>

</section>
