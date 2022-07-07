<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;

$title = "Ajouter un évènement";
require_once('../include/header.php');
require_once('../include/sidebar.php');
$controllerEvenement = new EvenementController();
$controllerArtiste = new ArtisteController();

if(!empty($_POST['valider']))
{
    $id_event = $controllerEvenement->registerEvent
    (
        $_POST['titre'],
        $_FILES['image_en_avant'],
        $_POST['legende_en_avant'],
        $_POST['ordre_image_en_avant'],
        $_POST['adresse'],
        $_POST['date'],
        $_POST['heure'],
        $_POST['description'],
        $_FILES['image2'],
        $_POST['legende2'],
        $_POST['ordre_image2'],
        [ 
            $_POST['id_artiste1'],
            $_POST['id_artiste2'],
            $_POST['id_artiste3'],
            $_POST['id_artiste4'],
            $_POST['id_artiste5'],
            $_POST['id_artiste6'],
            $_POST['id_artiste7'],
            $_POST['id_artiste8'],
            $_POST['id_artiste9'],
            $_POST['id_artiste10'],
            $_POST['id_artiste11'],
            $_POST['id_artiste12'],
            $_POST['id_artiste13'],
            $_POST['id_artiste14'],
            $_POST['id_artiste15']
        ]
    );
    echo '<pre>';
    var_dump($controllerEvenement->displayEventById($id_event));
    echo '</pre>';
    }

?>
<section>
    <h1>Ajouter un nouvel évènement</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <article>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" value="<?= $_POST['titre'] ?? "" ?>" placeholder="">
        </article>
        <article>
            <label for="image_en_avant">Affiche:</label>
            <input type="file" name="image_en_avant" placeholder="">
            <input type="hidden" name="ordre_image_en_avant" value="1">
        </article>
        <article>
            <label for="legende_en_avant"> Légende associée à l'affiche:</label>
            <input type="text" name="legende_en_avant" value="<?= $_POST['legende_en_avant'] ?? "" ?>" placeholder="">
        </article>
        <article>
            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" value="<?= $_POST['adresse'] ?? "" ?>" placeholder="">
        </article>
        <article>
            <label for="date">Date:</label>
            <input type="date" name="date" placeholder="">
        </article>
        <article>
            <label for="heure">Heure de début:</label>
            <input type="text" value="<?= $_POST['heure'] ?? "" ?>" name="heure" placeholder="">
        </article>

            <?php 
                $artists = $controllerArtiste->displayAllArtists();
                echo $printSelectForArtists = Affichage::printSelectForArtists($artists);
            ?>

        <article>
            <label for="description">Description de l'évènement:</label>
            <textarea name="description" placeholder=""><?= $_POST['description'] ?? "" ?></textarea>
        </article>
        <article>
            <label for="image2">Image complémentaire:</label>
            <input type="file" name="image2">
            <input type="hidden" name="ordre_image2" value="2">
        </article>
        <article>
            <label for="legende2">Légende complémentaire</label>
            <input type="text" value="<?= $_POST['legende2'] ?? "" ?>" name="legende2">
            <input type="hidden" name="ordre_legende2" value="2">
        </article>

        <input type="submit" name="valider" value="submit">
    </form>
</section>