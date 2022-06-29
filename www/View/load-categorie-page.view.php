<?= $page->header()?>
<div class="row <?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?>"">
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
<?= $page->footer()?>
