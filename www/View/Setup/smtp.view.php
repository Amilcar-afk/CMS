<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Email - Smtp</h1>
        </header>
        <?php if(empty($config)):  ?>
            <?php $this->includePartial("form", $configuration->smtpForm())  ?>
        <?php else:  ?>
            <?php $this->includePartial("form", $config)  ?>
        <?php endif?>
    </section>
</main>