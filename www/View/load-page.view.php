<?php if(isset($background[0]) && $background[0]->getValue() == 'yes' ): ?>
    <div class="background-container-back-office background-container-back-office--go">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
<?php endif; ?>
<?= $page->header()?>
<div class="row <?= (isset($bessels[0]) && $bessels[0]->getValue() != null )? $bessels[0]->getValue() : 'body-medium' ?>"><?=$page->getContent()?></div>
<?= $page->footer()?>

