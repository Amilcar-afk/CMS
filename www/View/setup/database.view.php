<main>
    <style>
        :root {
            --main-color: #626262;
            --second-color: #afafaf;
            --third-color: #979797;

            --main-color-rgb: 57,96,117;
            --second-color-rgb: 85,166,211;
            --third-color-rgb: 155,188,255;

            --background-color: #ffffff;
            --text-color: black;

        }
    </style>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
            <h1 class="title title--main-color">Database</h1>
        </header>
        <div>
            <?php if(empty($config)):  ?>
                <?php $this->includePartial("form", $configuration->dataBaseForm())  ?>
            <?php else:  ?>
                <?php $this->includePartial("form", $config)  ?>
            <?php endif?>
        </div>
    </section>
</main>