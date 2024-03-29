<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Materialize JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
    integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
     integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/back-office.css">
    <title> <?='Back-office | '.$title?> </title>
</head>
<?php

require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Controllers\EvenementController;
use AlBeyt\Controllers\ArticleController;

$controller = new ArtisteController;
$controllerEvent = new EvenementController();
$controArticle = new ArticleController();

$domaines = $controller->displayAllDomains();

$eventYearFilter = $controllerEvent->displayYearFilters();
$articleYearFilter = $controArticle->displayYearFilters();
?>

<script>
    $(document).ready(function(){
        $('.dropdown-trigger').dropdown({
            hover : true});
    });
</script>

<body>
    <header>
        <nav class="purple darken-2">
            <div class="nav-wrapper">
                <!-- sidenav-->
                <a href="#"  class="sidenav-trigger show-on-large" data-target="slide-out">
                    <i class="material-icons">menu</i>
                </a>        
                <!-- link nav princpale-->
                <ul id="link-nav" class="right show-on-med-and-down">
                    <li><a href="../front/index.php" target="_blank">Al-Beyt</a></li>
                    <li><a class="dropdown-trigger" href="../front/artistes.php" target="_blank" data-target="domaines">Artistes<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a class="dropdown-trigger" href="../front/evenements.php" target="_blank" data-target="eventYears">Evènements<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a class="dropdown-trigger" href="../front/articles.php" target="_blank" data-target="articleYears">Actualité<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="../front/presentation.php" target="_blank">A propos</a></li>
                    <a class="right icone-deconnexion" href="deconnexion.php"><i  class="fa-solid fa-right-from-bracket"></i></a>
                </ul>
                
            </div>

            <!--menu dropdown-->

                <ul id="domaines" class="dropdown-content">
                <?php foreach ($domaines as $domaine) { ?>
                    <li>
                        <a href="../front/artistes.php?id=<?= $domaine['id'] ?>"
                        target="_blank"><?= $domaine['nom'] ?></a>
                    </li>
                <?php } ?>
            </ul>
            <ul id="eventYears" class="dropdown-content">
                <?php foreach($eventYearFilter as $y) { ?>
                    <li>
                        <a href="../front/evenements.php?year=<?= $y['year'] ?>" target="_blank"><?= $y['year'] ?></a>
                    </li>
                <?php } ?>
            </ul>
            <ul id="articleYears" class="dropdown-content">
            <?php foreach($articleYearFilter as $y) { ?>
                    <li>
                        <a href="../front/articles.php?year=<?= $y['year'] ?>" target="_blank"><?= $y['year'] ?></a>
                    </li>
                <?php } ?>
            </ul>
            
        </nav>
    </header>

        <script>
       $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.tooltipped').tooltip();
        });
</script>

<section id="error-section" class="valign-wrapper z-depth-3 card-panel">
    <i id="error-icon" class="material-icons"></i>
     <p id="error-text">
     </p>
</section>
