<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo??"Template du front" ?></title>
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" type="text/css" href="../style/dist/css/main.css">
    <!-- Scripts and styles for datatables -->
    <script type="text/javascript" src='../DataTables/media/js/jquery.js'></script>
    <script type="text/javascript" src="../DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../DataTables/media/css/jquery.dataTables.min.css">
</head>
<body>

<div class="wrapper row">
    <div class="one col-8 col-h-6 ">Un</div>
    <div class="two col-3 col-h-4 col-offset-1">Deux</div>
    <div class="three col-2 col-h-5">Trois</div>
    <div class="four col-3 col-h-10">Quatre</div>
    <div class="five col-2 col-h-12">Cinq</div>
    <div class="six col-4 col-h-5">Six</div>
</div>


<?php include $this->view.".view.php";?>



</body>
</html>