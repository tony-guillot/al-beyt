<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
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
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../front/index.php" target="_blank">Accueil</a></li>
                <li><a href="../front/artistes.php" target="_blank">Artistes</a></li>
                        <ul>
                            <?php foreach ($domaines as $domaine)
                            { ?>
                                <li>
                                    <a href="../front/artistes.php?id=<?=$domaine['id']?>" target="_blank"><?= $domaine['nom'] ?></a>
                                </li>

                    <?php } ?>
                        </ul>
                <li><a href="../front/evenements.php" target="_blank">Evènements</a></li>
                    <ul>
                        <?php for($y = date('Y'); $y >= 2021; $y--)
                        { ?>
                            <li>
                                <a href="../front/evenements.php?year=<?= $y ?>" target="_blank"><?= $y ?></a>
                            </li>
                 <?php } ?>
                    </ul>
                <li><a href="../front/articles.php" target="_blank">Actualité</a></li> 
                    <ul>
                        <?php for($y = date('Y'); $y >= 2022; $y--)
                            { ?>
                                <li>
                                    <a href="../front/articles.php?year=<?= $y ?>" target="_blank"><?=$y ?></a>
                                </li>
                    <?php } ?>
                    </ul>
                <li><a href="../front/presentation.php" target="_blank">A propos</a></li>    
            </ul>
        </nav>
    </header>