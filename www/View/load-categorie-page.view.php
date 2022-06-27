<header class="header">
    <a id="logo" href="#"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a>
    <nav>
        <ul>
            <li><a href="/dashboard" class="button-menu"><span class="material-icons-round">leaderboard</span></a></li>
            <li><a href="/pages" class="button-menu"><span class="material-icons-round">map</span></a></li>
            <li><a href="/conversations" class="button-menu"><span class="material-icons-round">forum</span></a></li>
            <li><a href="/settings/style" class="button-menu"><span class="material-icons-round">settings</span></a></li>
        </ul>
    </nav>
</header>
<div class="row">

    <h1><?= $categorie->getTitle() ?></h1>
    <section class="row col-12">
        <?php foreach ($categorie->pages() as $page):?>
            <article class="col-4">
                <a href="/<?= $page->getSlug() ?>">
                    <?= $page->getTitle() ?>
                </a>
            </article>
        <?php endforeach;?>
    </section>
</div>
<footer class="footer">
    <p>Super</p>
    <nav>
        <ul>
            <?php foreach ($reseauxSocs as $reseauxSoc):?>
                <li><a href="<?= $reseauxSoc->getPath() ?>" target="_blank" class="button-menu"><img src="../style/images/<?= $reseauxSoc->getType() ?>.png"></a></li>
            <?php endforeach;?>
        </ul>
    </nav>
</footer>
