<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo">
                <a href="/">
                    <img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo">
                </a>
            </figure>
            <h1 class="title title--main-color">Log In</h1>
        </header>
        <?php if(!isset($error_loginFrom)):  ?>
            <?php $this->includePartial("form", $user->getFormLogin()) ?>
        <?php elseif(isset($error_loginFrom)):  ?>
            <?php $this->includePartial("form", $error_loginFrom) ?>
        <?php endif  ?>
    </section>
</main>