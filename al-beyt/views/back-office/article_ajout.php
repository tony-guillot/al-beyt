<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

use AlBeyt\Controllers\ArticleController;
$controllerArticle = new ArticleController();

if(!empty($_POST['valider']))
{
    $controllerArticle->registerArticle($_POST['titre'], $_POST['auteur'], $_POST['description'], $_FILES['image_en_avant'], $_POST['legende_en_avant'],  $_FILES['image2'],  $_POST['legende2'], $_FILES['image3'],  $_POST['legende3'], $_FILES['image4'],  $_POST['legende4']);

}
$title ="ajout article";
require_once('../include/headerBo.php');
?>
<?php require_once('../include/sidebar.php');?>
<main class="container">
    <section class="row formulaire">
        <section class="col s12">
            <h1>Ajouter un nouvel article</h1>
        </section>
        <section class="col s6">
            <form class='typo' action="" method="post" enctype="multipart/form-data">
                    <h2>Informations de l'article</h2>
                    <article>
                        <label class=" purple-text text-lighten-3" for="titre">Titre:</label>
                        <input type="text" name="titre" value="<?= $_POST['titre'] ?? "" ?>">
                    </article>
                    <article>
                        <label class=" purple-text text-lighten-3" for="auteur">Auteur.ice:</label>
                        <input type="text" name="auteur" value="<?= $_POST['auteur'] ?? "" ?>">
                    </article>
                    <article>
                        <div>
                            <label class=" purple-text text-lighten-3" for="image_en_avant">Image principale:</label>
                            <input type="file" name="image_en_avant" >
                            <input type="hidden" name="ordre_image_en_avant" value="1">
                        </div>
                        <div>
                            <label class=" purple-text text-lighten-3" for="legende_en_avant">Légende :</label>
                            <input type="text" name="legende_en_avant" value="<?= $_POST['legende_en_avant'] ?? "" ?>" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                        </div>
                    </article>

                </section>
                <section class="col s6">
                    <h2>Choisissez les images complémentaires</h2>

                    <article>
                        <div>
                            <label class=" purple-text text-lighten-3" for="image2">Image 2:</label>
                            <input type="file" name="image2">
                            <input type="hidden" name="ordre_image2" value="2">
                        </div>
                        <div>
                            <label class=" purple-text text-lighten-3" for="legende2">Légende 2:</label>
                            <input type="text" value="<?= $_POST['legende2'] ?? "" ?>" name="legende2" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                            <input type="hidden" name="ordre_legende2" value="2">
                        </div>
                    </article>
                    <article>
                        <div>
                            <label class=" purple-text text-lighten-3" for="image3">Image 3:</label>
                            <input type="file" name="image3">
                            <input type="hidden" name="ordre_image3" value="3">
                        </div>
                        <div>
                            <label class=" purple-text text-lighten-3" for="legende3">Légende 3:</label>
                            <input type="text" value="<?= $_POST['legende3'] ?? "" ?>" name="legende3" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                        </div>
                    </article>
                    <article>
                        <div>
                            <label class=" purple-text text-lighten-3" for="image4">Image 4:</label>
                            <input type="file" name="image4">
                            <input type="hidden" name="ordre_image4" value="4">
                        </div>
                        <div>
                            <label class=" purple-text text-lighten-3" for="legende4">Légende 4:</label>
                            <input type="text" value="<?= $_POST['legende4'] ?? "" ?>" name="legende4" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                        </div>
                    </article>
                </section>
                <section class="col s12">
                    <h2>Corps de l'article :</h2>
                    <article>
                        <textarea style="height: 200px;border: 0.5px solid gray" class="materialize-textarea" name="description"> <?= $_POST['description'] ?? "" ?> </textarea>
                    </article>
                </section>
                <section>
                    <button class="btn waves-effect btn-large waves-light col s12" type="submit" name="valider" value="1">Ajouter un article
                        <i class="material-icons right">note_add</i>
                    </button>
                <!-- <input type="submit" name="valider" value="submit">-->
                </section>
        </form>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>