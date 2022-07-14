<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo">
                <a href="/">
                    <img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo">
                </a>
            </figure>
            <h1 class="title title--main-color">Information</h1>
        </header>
        <section class="p-5" style="background-color: var(--background-color); border-radius: 0px 0px var(--radius, 20px) var(--radius, 20px);">
            <div class="mt-3 mb-5">
                <p><?= $message ?></p>
            </div>
            <div>
                <a class="cta-button cta-button--submit" href="/"> Home </a>
            </div>
        </section>
    </section>
</main>