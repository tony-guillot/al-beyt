<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/front.css">
    <title> <?='Al-Beyt | '.$title?> </title>
</head>
<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;

$domaines = $controller->displayAllDomains()
   
?>
<body>
    <header>
        <h1 class='al-beyt'>AL-BEYT</h1>    
    </header>
        <nav>
            <ul>
                <li class="active"><a class="link-header" href="index.php">Accueil</a></li>

                <li class="active"><a class="link-header" href="artistes.php">Artistes</a>

                    <div class="sub-menu-1">
                        <ul>
                            <?php foreach ($domaines as $domaine)
                            { ?>
                                <li>
                                    <a class="link-header" href="artistes.php?id=<?=$domaine['id']?>"><?= $domaine['nom']?></a>
                                </li>

                    <?php } ?>
                        </ul>
                    </div>  
                </li>      
                <li class="active"><a class="link-header" href="evenements.php">Evènements</a>
                    <div class="sub-menu-1">
                        <ul>
                        <?php for($y = date('Y'); $y >= 2021; $y--)
                        { ?>
                            <li>
                                <a class="link-header" href="evenements.php?year=<?= $y ?>"><?= $y ?></a>
                            </li>
                         <?php } ?>
                        </ul>
                    </div>
                </li>      
                <li class="active"><a class="link-header" href="articles.php">Actualité</a>
                    <div class="sub-menu-1">
                        <ul>
                            <?php for($y = date('Y'); $y >= 2022; $y--)
                                { ?>
                                    <li>
                                        <a class="link-header" href="articles.php?year=<?= $y ?>"><?=$y ?></a>
                                    </li>
                        <?php } ?>
                        </ul>
                    </div>
                </li>     
                <li class="active"><a class="link-header" href="presentation.php">A propos</a></li>    
            </ul>
        </nav>
   