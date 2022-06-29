<header class="header background-main-color">
    <div class="<?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?> background-main-color">
        <a id="logo" href="/"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a>
        <a id="menu-icon">&#9776;</a>
        <nav class="navbar">
            <ul class="menu">
                <li><a class="active" href="#">Home</a></li>
                <?php foreach ($categories as $categorie):?>
                    <li><a href="<?= $categorie->page()->getSlug() ?>"><?= $categorie->getTitle() ?></a></li>
                <?php endforeach;?>
                <?php foreach ($pages as $page):?>
                    <li><a href="<?= $page->getSlug() ?>"><?= $page->getTitle() ?></a></li>
                <?php endforeach;?>
                <li><a href="#">Contact</a></li>
                <li> </li>
                <?php if(isset($_SESSION['Auth']->lastname) && $_SESSION['Auth']->firstname): ?>
                    <li><a href="dashboard"><?= $_SESSION['Auth']->lastname . " " . $_SESSION['Auth']->firstname ?></a></li>
                <?php else: ?>
                    <li><a href="login">Login</a></li>
                    <li><a> | </a></li>
                    <li><a href="register">Sign in</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>