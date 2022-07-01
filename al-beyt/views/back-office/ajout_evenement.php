<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;

$title = "Ajouter un évènement";
require_once('../include/header.php');
require_once('../include/sidebar.php');
$controllerEvenement = new EvenementController();

if(!empty($_POST['valider']))
{
    $registerEvent = $controllerEvenement->registerEvent
    (
        $_POST['titre'],
        $_POST['image_en_avant'],
        $_POST['legende_en_avant'],
        $_POST['ordre_image_en_avant'],
        $_POST['adresse'],
        $_POST['date'],
        $_POST['heure'],
        $_POST['description'],
        $_POST['image2'],
        $_POST['legende2'],
        $_POST['ordre_image2'],
        [ 
            $_POST['artiste1'],
            $_POST['artiste2'],
            $_POST['artiste3'],
            $_POST['artiste4'],
            $_POST['artiste5'],
            $_POST['artiste6'],
            $_POST['artiste7'],
            $_POST['artiste8'],
            $_POST['artiste9'],
            $_POST['artiste10'],
            $_POST['artiste11'],
            $_POST['artiste12'],
            $_POST['artiste13'],
            $_POST['artiste14'],
            $_POST['artiste15']
        ]
    );
    }

?>
<section>
    <h1>Ajouter un nouvel évènement</h1>
    <form action="" method="post">
        <article>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" placeholder="">
        </article>
        <article>
            <label for="image_en_avant">Affiche:</label>
            <input type="file" name="image_en_avant" placeholder="">
            <input type="hidden" name="ordre_image_en_avant" value="1">
        </article>
        <article>
            <label for="legende_en_avant"> Légende associée à l'affiche:</label>
            <input type="text" name="legende_en_avant" placeholder="">
        </article>
        <article>
            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" placeholder="">
        </article>
        <article>
            <label for="date">Date:</label>
            <input type="date" name="date" placeholder="">
        </article>
        <article>
            <label for="heure">Heure de début:</label>
            <input type="text" name="heure" placeholder="">
        </article>
            <?php
                //données de test pour fct d'affichage
                $artists = [
                    [
                        "nom" => "Robert",
                        "id" => "1",
                    ],
                    [
                        "nom" => "Albert",
                        "id" => "2",
                    ],
                    [
                        "nom" => "Antoinr",
                        "id" => "6",
                    ],
                    [
                        "nom" => "Oui",
                        "id" => "8",
                    ],
                    [
                        "nom" => "Non",
                        "id" => "99",
                    ],
                ];

                echo $printSelectForArtists = Affichage::printSelectForArtists($artists);
            ?>
        <article>
            <label for="description">Description de l'évènement:</label>
            <textarea name="description" placeholder=""> </textarea>
        </article>
        <article>
            <label for="image2">Image complémentaire:</label>
            <input type="file" name="image2">
            <input type="hidden" name="ordre_image2" value="2">
        </article>
        <article>
            <label for="legende2">Légende complémentaire</label>
            <input type="text" name="legende2">
            <input type="hidden" name="ordre_legende2" value="2">
        </article>

        <input type="submit" name="valider" value="submit">
    </form>
</section>