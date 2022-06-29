<header class="header background-main-color">

    <div class="<?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?> background-main-color">
        <a id="logo" href="#"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a>
        <a id="menu-icon">&#9776;</a>
        <nav class="navbar">
            <ul class="menu">
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Work</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>