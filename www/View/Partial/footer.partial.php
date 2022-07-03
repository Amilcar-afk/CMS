<footer class="footer background-main-color <?= (isset($radius[0]) && $radius[0]->getValue() == 'right_angle' )? '' : 'footer--radius' ?>">
    <div class="<?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?> row background-main-color">
        <nav class="col-12 nav-rs">
            <ul>
                <?php foreach ($reseauxSocs as $reseauxSoc):?>
                    <li><a href="<?= $reseauxSoc->getPath() ?>" target="_blank" class="button-menu"><img src="../style/images/<?= $reseauxSoc->getType() ?>.png"></a></li>
                <?php endforeach;?>
            </ul>
        </nav>
        <nav class="col-12 navbar">
            <ul class="menu">
                <?php foreach ($categories as $categorie):?>
                    <li><a href="<?= $categorie->page()->getSlug() ?>"><?= $categorie->getTitle() ?></a></li>
                <?php endforeach;?>
                <?php foreach ($pages as $page):?>
                    <li><a href="<?= $page->getSlug() ?>"><?= $page->getTitle() ?></a></li>
                <?php endforeach;?>
            </ul>
        </nav>
    </div>
</footer>