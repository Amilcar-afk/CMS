<footer class="footer background-main-color">
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
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Work</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</footer>