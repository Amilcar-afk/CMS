<?= $page->header()?>
<div class="row <?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?>">
    <?=$page->getContent()?>
</div>
<?= $page->footer()?>

