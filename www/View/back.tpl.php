<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Template de back</title>
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" type="text/css" href="../style/dist/css/main.css">
</head>
<body class="card--background-main-color">
    <div class="article-card">
        <h1>Administration</h1>
        <div class="row article-card">
            <?php include $this->view.".view.php";?>
        </div>
    </div>
</body>
</html>