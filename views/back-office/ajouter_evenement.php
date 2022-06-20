<?php
$title = "Ajouter un évènement";
require_once('../include/header.php');
require_once('../../library/Affichage.php');
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
        <article>
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
        </article>
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

        <input type="submit" name="Valider" value="submit">
    </form>
</section>