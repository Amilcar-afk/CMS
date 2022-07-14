<header class="header <?= (isset($backgroundColor) && !preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? $backgroundColor :'' ?> <?= (isset($radius[0]) && $radius[0]->getValue() == 'right_angle' )? '' : 'header--radius' ?>"
    <?= (isset($backgroundColor) && preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? "style='background-color:".$backgroundColor."'" :'' ?>>
    <div class="body-go  <?= (isset($backgroundColor) && !preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? $backgroundColor :'' ?>" <?= (isset($backgroundColor) && preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? "style='background-color:".$backgroundColor."'" :'' ?>>
        <a id="logo" href="/"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a>
        <a id="menu-icon" class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?>>&#9776;</a>
        <nav class="navbar">
            <ul class="menu">
                <?php foreach ($categories as $categorie):?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="<?= $categorie->page()->getSlug() ?>"><?= $categorie->getTitle() ?></a></li>
                <?php endforeach;?>
                <?php foreach ($pages as $page):?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="<?= $page->getSlug() ?>"><?= $page->getTitle() ?></a></li>
                <?php endforeach;?>
                <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="/conversations">Contact</a></li>
                <li> </li>
                <?php if(isset($_SESSION['Auth']->lastname) && $_SESSION['Auth']->firstname): ?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="/<?= (isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin')?'dashboard':'conversation' ?>"><?= $_SESSION['Auth']->lastname . " " . $_SESSION['Auth']->firstname ?></a></li>
                <?php else: ?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="/login">Login</a></li>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> > | </a></li>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="/register">Sign up</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>