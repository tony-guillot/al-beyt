<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
     integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"
    />
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
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="artistes.php">Artistes</a></li>
                        <ul>
                            <?php foreach ($domaines as $domaine)
                            { ?>
                                <li>
                                    <a href="artistes.php?id=<?=$domaine['id']?>"><?= $domaine['nom']?></a>
                                </li>

                    <?php } ?>
                        </ul>
                <li><a href="evenements.php">Evènements</a></li>
                    <ul>
                        <?php for($y = date('Y'); $y >= 2021; $y--)
                        { ?>
                            <li>
                                <a href="evenements.php?year=<?= $y ?>"><?= $y ?></a>
                            </li>
                 <?php } ?>
                    </ul>
                <li><a href="articles.php">Actualité</a></li> 
                    <ul>
                        <?php for($y = date('Y'); $y >= 2022; $y--)
                            { ?>
                                <li>
                                    <a href="articles.php?year=<?= $y ?>"><?=$y ?></a>
                                </li>
                    <?php } ?>
                    </ul>
                <li><a href="presentation.php">A propos</a></li>    
            </ul>
        </nav>
    </header>