<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?=ucfirst($page->getTitle())?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php  $this->includePartial('design-variables') ?>
        <meta name="description" content="<?=$page->getDescription()?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link href="../style/dist/css/main.css" rel="stylesheet" />
        <script type="text/javascript" src="../style/js/utilsMenu.js"></script>
        <script type="text/javascript" src="../style/js/animations.js"></script>
        <link id="container-favicon" rel="shortcut icon" href="<?= (isset($favicon[0]))? $favicon[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
        <?php if(isset($metaData['src'][0])): ?>
            <?php foreach ($metaData['src'] as $src):?>
                <?php if($src['type'] == 'css'): ?>
                <link rel="stylesheet" type="text/css" href="<?= $src['path'] ?>" />
                <?php elseif($src['type'] == 'js'): ?>
                    <script type="text/javascript" src="<?= $src['path'] ?>"></script>
                <?php endif; ?>
            <?php endforeach;?>
        <?php endif; ?>
        <?= (isset($headCode) && $headCode != ' ')? $headCode :''; ?>
    </head>
    <body class="body background-background-color">
        <main>
        <?php
            include $this->view.".view.php";
        ?>
        </main>
    </body>
    <?= (isset($footerCode) && $footerCode != ' ')? $footerCode :''; ?>
</html>