<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;
$controller = New EvenementController;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $event = $controller->displayEventById($id);
    // var_dump($event);
}



$imagesEvent = $controller->displayImagesByEventId($id);
echo '<pre>';
var_dump($imagesEvent);
echo '</pre>';
// un form pour la table evenement titre, description , adresse , date, heure , 
// un form pour la table image_evenement image_en_avant, legende_en_avant, image2, legende2 
//
//
//
//

?>
<main>
    <section>
        <h1>Modifier l'évènement</h1>   
        <section>
            <h2> Informations de l'évènement:</h2>
            <form action="" method="post" >
                <article>
                    <div>
                        <label for="titre">Titre:</label>
                        <input type="text" name="titre" value="<?= $event['titre']?>">
                    </div>
                    <div>
                        <label for="adresse">Adresse:</label>
                        <input type="text" name="adresse" value="<?= $event['adresse'] ?>">
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="date" name="date" value="<?= $event['date_evenement'] ?>" >
                    </div>
                    <div>
                        <label for="heure">Heure de début:</label>
                        <input type="text" value="<?= $event['heure'] ?>" name="heure">
                    </div>
                </article>
                <article>
                    <div>
                        <label for="description">Description de l'évènement:</label>
                        <textarea name="description"><?= $event['description'] ?></textarea>
                    </div>
                </article> 
                <article>
                    <input type="submit" name="valider" value="sauvegarder">
                </article>
            </form>
        </section>
        <section>
            <h2> Images de l'évènement:</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <article>
                    <article>
                        <div>
                            <label for="image_en_avant">Affiche:</label></br>
                            <img src="<?= $imagesEvent[0]['chemin']?>" alt=""> </br>
                        </div>  
                        <div>
                            <label for="legende_en_avant"> Légende:</label>
                            <input type="text" name="legende_en_avant" value="<?= $imagesEvent[0]['legende']?>" placeholder="">
                        </div>
                    </article>
                    <article>
                        <div>
                            <input type="file" name="image_en_avant" placeholder="">
                            <input type="hidden" name="ordre_image_en_avant" value="1">
                        </div>
                    </article>
                </article>
                <article>
                    <article>
                        <div>
                            <label for="image2">Image complémentaire:</label> </br>
                            <img src="<?= $imagesEvent[1]['chemin'] ?? ""?>" alt=""> </br>
                        </div>
                        <div>
                            <label for="legende2">Légende complémentaire</label>
                            <input type="text" value="<?= $imagesEvent[1]['legende'] ?? "" ?>" name="legende2">
                            <input type="hidden" name="ordre_legende2" value="2">
                        </div>
                    </article>
                    <article>
                        <div>
                            <input type="file" name="image2">
                            <input type="hidden" name="ordre_image2" value="2">
                        </div>
                    </article>
                </article>
                <article>
                    <input type="submit" name="image" value="Sauvegarder">
                </article>
            </form>
        </section>
    </section>
</main>