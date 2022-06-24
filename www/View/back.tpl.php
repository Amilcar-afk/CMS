<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
        <title>Template de back</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="ceci est la description de ma page">
        <?php  $this->includePartial('design-variables') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link id="container-favicon" rel="shortcut icon" href="<?= (isset($favicon[0]))? $favicon[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <link rel="stylesheet" type="text/css" href="../style/dist/css/main.css" />
        
        <script type="text/javascript" src="../style/js/utilsMenu.js"></script>
        <script type="text/javascript" src="../style/js/wysiwyg.js"></script>
        <script type="text/javascript" src="../style/js/animations.js"></script>
        <script type="text/javascript" src="../style/js/pages.js"></script>
        <script type="text/javascript" src="../style/js/addCode.js"></script>
        <script type="text/javascript" src="../style/js/options.js"></script>
        <script type="text/javascript" src="../style/js/categorie.js"></script>
        <script type="text/javascript" src="../style/js/database.js"></script>
        <script type="text/javascript" src="../style/js/reseauxSoc.js"></script>
    </head>
    <div class="background-container-back-office">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <body class="body-back-office">
        <header>
            <nav>
                <ul>
                    <li><a id="back-office-logo" href="#"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></a></li>
                    <li><a href="/dashboard" class="button-menu" data-alt="Dashboard"><span class="material-icons-round">leaderboard</span></a></li>
                    <li><a href="/pages" class="button-menu" data-alt="Sitemap"><span class="material-icons-round">map</span></a></li>
                    <li><a href="/conversations" class="button-menu" data-alt="Communication"><span class="material-icons-round">forum</span></a></li>
                    <li><a href="/settings/style" class="button-menu" data-alt="Settings"><span class="material-icons-round">settings</span></a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php include $this->view.".view.php";?>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
        <script async src="../style/js/calendar.js"></script>
        <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
        <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
        <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js'></script>
        <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/af.min.js'></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
        <script type="text/javascript" src="../js/ajax/httpRequest.js"></script>
        <script type="text/javascript" src="../js/ajax/user-manager.js"></script>
        <script type="text/javascript" src="../js/modal.js"></script>
        <script type="text/javascript" src="../js/ajax/searchBar.js"></script>
    </body>
</html>