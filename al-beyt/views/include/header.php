<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> <?='Al-Beyt | '.$title?> </title>
    <meta name="dеѕсrірtіоn" content=" Nous sommes le collectif Al-Beyt. Al-Beyt met en avant la culture syrienne
                                       et arabophone à travers des évènements culturels et festifs organisés bénévolement.
                                       Informez-vous sur nos évènements, découvrez des artistes fabuleux.ses
                                       et tenez-vous au courant de nos actualités!" >

    <link rel="al-beyt" href="al-beyt.com">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!----- Google font Inter ----->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500&display=swap" rel="stylesheet">     
    <!------Google font Merriweather Sans ----->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
     integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <script src="../js/script.js"></script>
    <script src="../js/slider.js"></script>
    <link rel="stylesheet" href="../css/front.css">

</head>
<?php
ini_set('default_charset','utf-8');

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
<body>
    <!-- <header>
        <h1 class='al-beyt taille2' ></h1>
    </header> -->
        <nav class="header">
            <ul>
                <li class="active"><a class="Al-Beyt" href="index.php">AL-BeYT</a></li>

                <li class="active"><a class="link-nav" href="artistes.php">Artistes</a>

                    <div class="sub-menu-1">
                        <ul>
                            <?php foreach ($domaines as $domaine)
                            { ?>
                                <a class="link-nav" href="artistes.php?id=<?=$domaine['id']?>">
                                <li>
                                    <?= $domaine['nom']?>
                                </li>
                                </a>
                            <?php } ?>
                        </ul>
                    </div>  
                </li>      
                <li class="active"><a class="link-nav" href="evenements.php">Evenements</a>
                    <div class="sub-menu-1">
                        <ul>
                            <?php foreach($eventYearFilter as $y) { ?>
                                <a class="link-nav" href="evenements.php?year=<?= $y['year'] ?>">
                                    <li>
                                        <?= $y['year'] ?>
                                    </li>
                                </a>
                             <?php } ?>
                        </ul>
                    </div>
                </li>      
                <li class="active"><a class="link-nav" href="articles.php">ActualitEs</a>
                    <div class="sub-menu-1">
                        <ul>
                            <?php foreach($articleYearFilter as $y) { ?>
                                <a class="link-nav" href="articles.php?year=<?= $y['year'] ?>">
                                    <li>
                                    <?=$y['year'] ?>
                                    </li>
                                </a>
                             <?php } ?>
                        </ul>
                    </div>
                </li>     
                <li class="active"><a class="link-nav" href="presentation.php">A propos</a></li>
            </ul>
        </nav>
   