<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;
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
// echo '<pre>';
// var_dump($controllerEvenement->displayEventById($id_event));
// echo '</pre>';
}

$title = 'Ajout evenement';
require_once('../include/headerBo.php');
?>
<?php require_once('../include/sidebar.php');?>
<script>
    $(document).ready(function(){
    $('select').formSelect();
  });
</script>
<main class="container">
    <section>
    </section>
    <section class="row formulaire">
        <h1 class="col s12">Ajouter un nouvel évènement</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <section class="col s6">
                <h2>Informations de l'évènement</h2>
                <article>
                    <div>
                        <label for="titre">Titre:</label>
                        <input type="text" name="titre" value="<?= $_POST['titre'] ?? "" ?>" >
                    </div>
                    <div>
                        <label for="adresse">Adresse:</label>
                        <input type="text" name="adresse" value="<?= $_POST['adresse'] ?? "" ?>" placeholder="17 Rue du Baubourg, 75012 Paris">
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="date" name="date" value="<?= $_POST['date'] ?? "" ?>">
                    </div>
                    <div>
                        <label for="heure">Heure de début:</label>
                        <input type="text" value="<?= $_POST['heure'] ?? "" ?>" name="heure" placeholder="20h30">
                    </div>
                </article>
                <article>
                    <label for="description">Description de l'évènement:</label>
                    <textarea class="materialize-textarea" style="height: 100px;border: 0.5px solid gray" name="description" ><?= $_POST['description'] ?? "" ?></textarea>
                </article>
            </section>
            <section class="col s6">
                <h2>Choisissez les images</h2>
                <article>
                    <div>
                        <label for="image_en_avant">Affiche de l'evenement:</label>
                        <input type="file" name="image_en_avant">
                        <input type="hidden" name="ordre_image_en_avant" value="1">
                    </div>
                    <div>
                        <label for="legende_en_avant"> Légende associée à l'affiche:</label>
                        <input type="text" name="legende_en_avant" value="<?= $_POST['legende_en_avant'] ?? "" ?>" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                    </div>
                </article>
                <article>
                    <div>
                        <label for="image2">Image complémentaire:</label>
                        <input type="file" name="image2">
                        <input type="hidden" name="ordre_image2" value="2">
                    </div>
                    <div>
                        <label for="legende2">Légende complémentaire:</label>
                        <input type="text" value="<?= $_POST['legende2'] ?? "" ?>" name="legende2" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                    </div>
                </article>
            </section>
            <section class="col s12 input-field ">
                <h2>Choisissez les artistes</h2>
                <article>
                    <?php
                        $selected = isset($_POST['valider']) ? [$_POST['id_artiste1'],
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
                                $_POST['id_artiste15']] : [];
                        $artists = $controllerArtiste->displayAllArtists();
                        echo $printSelectForArtists = Affichage::printSelectForArtists($artists,$selected);
                    ?>
                </article>
            </section>
            <button class="btn waves-effect btn-large waves-light col s12" type="submit" name="valider" value="1">Ajouter un évènement
                <i class="material-icons right">date_range</i>
            </button>
           <!--  <input class="col s12" type="submit" name="valider" value="Ajouter un évènement"> -->
        </form>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>