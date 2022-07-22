<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?= $metaData['title'] ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $metaData['description'] ?>">
        <?php  $this->includePartial('design-variables') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link id="container-favicon" rel="shortcut icon" href="<?= (isset($favicon[0]))? $favicon[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/style/dist/css/main.css" />
        <script type="text/javascript" src="/style/js/utilsMenu.js"></script>
        <script type="text/javascript" src="/style/js/addUser.js"></script>
        <script type="text/javascript" src="/style/js/animations.js"></script>
        <?php if(isset($metaData['src'][0])): ?>
            <?php foreach ($metaData['src'] as $src):?>
                <?php if($src['type'] == 'css'): ?>
                    <link rel="stylesheet" type="text/css" href="<?= $src['path'] ?>" />
                <?php elseif($src['type'] == 'js'): ?>
                    <script type="text/javascript" src="<?= $src['path'] ?>"></script>
                <?php endif; ?>
            <?php endforeach;?>
        <?php endif; ?>
    </head>
    <body class="body-back-office">
        <div class="background-container-back-office">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <header>
            <nav>
                <ul>
                    <li><a id="back-office-logo" href="/"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a></li>
                    <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>
                        <li><a href="/dashboard" class="button-menu" data-alt="Dashboard"><span class="material-icons-round">leaderboard</span></a></li>
                        <li><a href="/pages" class="button-menu" data-alt="Sitemap"><span class="material-icons-round">map</span></a></li>
                    <?php endif;?>
                    <li><a href="/conversations" class="button-menu" data-alt="Communication"><span class="material-icons-round">forum</span></a></li>

                    <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>
                        <li><a href="/settings/style" class="button-menu" data-alt="Settings"><span class="material-icons-round">settings</span></a></li>
                    <?php else:?>
                        <li><a href="/settings/user-manager" class="button-menu" data-alt="Settings"><span class="material-icons-round">settings</span></a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </header>
        <main>
            <?php include $this->view.".view.php";?>
        </main>
    </body>
</html>
