<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/back-office.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
    integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
     integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <title> <?='Back-office | '.$title?> </title>
</head>
<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;

$domaines = $controller->displayAllDomains()

?>

<script>
    $(document).ready(function(){
        $('.dropdown-trigger').dropdown({
            hover : true});
    });
</script>
<body>
    <header>

        <nav>
            <div class="nav-wrapper">
                <ul>
                    <li><a href="../front/index.php" target="_blank">Accueil</a></li>
                    <li><a class="dropdown-trigger" href="../front/artistes.php" target="_blank" data-target="domaines">Artistes<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a class="dropdown-trigger" href="../front/evenements.php" target="_blank" data-target="eventYears">Evènements</a></li>
                    <li><a class="dropdown-trigger" href="../front/articles.php" target="_blank" data-target="articleYears">Actualité</a></li>
                    <li><a href="../front/presentation.php" target="_blank">A propos</a></li>
                </ul>
            </div>
        </nav>

        <ul id="domaines" class="dropdown-content">
            <?php foreach ($domaines as $domaine) { ?>
                <li>
                    <a href="../front/artistes.php?id=<?= $domaine['id'] ?>"
                       target="_blank"><?= $domaine['nom'] ?></a>
                </li>
            <?php } ?>
        </ul>
        <ul id="eventYears" class="dropdown-content">
            <?php for ($y = date('Y'); $y >= 2021; $y--) { ?>
                <li>
                    <a href="../front/evenements.php?year=<?= $y ?>" target="_blank"><?= $y ?></a>
                </li>
            <?php } ?>
        </ul>
        <ul id="articleYears" class="dropdown-content">
            <?php for ($y = date('Y'); $y >= 2022; $y--) { ?>
                <li>
                    <a href="../front/articles.php?year=<?= $y ?>" target="_blank"><?= $y ?></a>
                </li>
            <?php } ?>
        </ul>

    </header>
