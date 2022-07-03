<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Main images</h1>
        </header>
        <div id="colors-elements" class="container-main-content container-main-content--menu-content collapse--open row" data-group-collapse="style-manager-container" style="opacity: 1">
            <header class="main-nav-choice">
                <h2>Main colors</h2>
                <p>Chose the main colors of your site. Your can have only one and nuances or completly different ones. The more important is to keep it esthetical.</p>
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
            <a href="/setup/design/1" class="cta-button cta-button--submit">Next</a>
        </div>
    </section>
</main>