<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=zzz_blog;charset=utf8mb4", "admin", "admin");
} catch (PDOException $exception) {
    var_dump($exception);
    exit;
}

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <!-- Theme tittle -->
    <title>Blog</title>

    <!-- Theme style CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Header Area -->
<header class="main_header_area" id="header">
    <div class="container">
        <div class="header_menu">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/"><img src="images/logo.png" alt=""></a>
                <!-- Small Divice Menu-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar_supported"  aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

                <div class="collapse navbar-collapse navbar_supported">
                    <ul class="navbar-nav">
                        <li><a class="nav-link" href="/">Accueil</a></li>
                        <li><a class="nav-link" href="/admin.php">Administration</a></li>


                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- Header Area -->
