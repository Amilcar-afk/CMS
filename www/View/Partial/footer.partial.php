<footer class="footer <?= (isset($backgroundColor) && !preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? $backgroundColor :'' ?> <?= (isset($radius[0]) && $radius[0]->getValue() == 'right_angle' )? '' : 'footer--radius' ?>"
    <?= (isset($backgroundColor) && preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? "style='background-color:".$backgroundColor."'" :'' ?>>
    <div class="<?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?> row <?= (isset($backgroundColor) && !preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? $backgroundColor :'' ?>" <?= (isset($backgroundColor) && preg_match('/^#[a-f0-9]{6}$/i', $backgroundColor)) ? "style='background-color:".$backgroundColor."'" :'' ?>>
        <nav class="col-12 nav-rs">
            <ul>
                <?php foreach ($reseauxSocs as $reseauxSoc):?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="<?= $reseauxSoc->getPath() ?>" target="_blank" class="button-menu"><img src="../style/images/<?= $reseauxSoc->getType() ?>.png"></a></li>
                <?php endforeach;?>
            </ul>
        </nav>
        <nav class="col-12 navbar">
            <ul class="menu">
                <?php foreach ($categories as $categorie):?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="<?= $categorie->page()->getSlug() ?>"><?= $categorie->getTitle() ?></a></li>
                <?php endforeach;?>
                <?php foreach ($pages as $page):?>
                    <li><a class="<?= (isset($btnTextColor) && !preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? $btnTextColor :'' ?>" <?= (isset($btnTextColor) && preg_match('/^#[a-f0-9]{6}$/i', $btnTextColor)) ? "style='color:".$btnTextColor."'" :'' ?> href="<?= $page->getSlug() ?>"><?= $page->getTitle() ?></a></li>
                <?php endforeach;?>
            </ul>
        </nav>
    </div>
</footer>