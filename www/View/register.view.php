<main>
    <section class="container-main-content container-main-content--setup" >
        <header>
            <figure id="back-office-logo"><img src="/style/images/logo_myfolio.png" alt="logo"></figure>
            <h1 class="title title--main-color">Log In</h1>
        </header>

        <?php if(!isset($error_from)):  ?>
            <?php $this->includePartial("form", $user->getFormRegister()) ?>
        <?php elseif(isset($error_from)):  ?>
            <?php $this->includePartial("form", $error_from) ?>
        <?php endif  ?>

        

    </section>
</main>

