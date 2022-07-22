<?php if(isset($background[0]) && $background[0]->getValue() == 'yes' ): ?>
    <div class="background-container-back-office background-container-back-office--go">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
<?php endif; ?>
<?= $page->header()?>
<div class="row <?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?>"">
    <h1><?= $categorie->getTitle() ?></h1>
    <section class="row col-12">
        <?php foreach ($categorie->pages() as $page):?>
            <article class="col-4 item">
                <a href="/<?= $page->getSlug() ?>">
                    <?= $page->getTitle() ?>
                    <p>
                        <?= $page->getDescription() ?>
                    </p>
                    <label>See more</label>
                </a>
            </article>
        <?php endforeach;?>
    </section>
</div>
<?= $page->footer()?>
