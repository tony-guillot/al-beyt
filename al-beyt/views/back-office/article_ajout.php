<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
require_once('../include/sidebar.php');

use AlBeyt\Controllers\ArticleController;

$controllerArticle = new ArticleController();

if(!empty($_POST['valider']))
{
    echo "<pre>";
    $id_article = $controllerArticle->registerArticle($_POST['titre'], $_POST['auteur'], $_POST['description'], $_FILES['image_en_avant'], $_POST['legende_en_avant'],  $_FILES['image2'],  $_POST['legende2'], $_FILES['image3'],  $_POST['legende3'], $_FILES['image4'],  $_POST['legende4']);
    echo "Success : id_Article = ".$id_article ;
    echo "</pre>";
}
?>
<main>
    <section>
        <h1>Ajouter un nouvel article</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <section>
                <h2>Informations de l'article</h2>
                <article>
                    <label for="titre">Titre:</label>
                    <input type="text" name="titre" value="<?= $_POST['titre'] ?? "" ?>">
                </article>
                <article>
                    <label for="auteur">Auteur:</label>
                    <input type="text" name="auteur" value="<?= $_POST['auteur'] ?? "" ?>">
                </article>
                <article>
                    <div>
                        <label for="image_en_avant">Image principale:</label>
                        <input type="file" name="image_en_avant" >
                        <input type="hidden" name="ordre_image_en_avant" value="1">
                    </div>
                    <div>
                        <label for="legende_en_avant">Légende :</label>
                        <input type="text" name="legende_en_avant" value="<?= $_POST['legende_en_avant'] ?? "" ?>" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                    </div>
                </article>

            </section>
            <section>
                <h2>Choisissez les images complémentaires</h2>

                <article>
                    <div>
                        <label for="image2">Image 2:</label>
                        <input type="file" name="image2">
                        <input type="hidden" name="ordre_image2" value="2">
                    </div>
                    <div>
                        <label for="legende2">Légende 2:</label>
                        <input type="text" value="<?= $_POST['legende2'] ?? "" ?>" name="legende2" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                        <input type="hidden" name="ordre_legende2" value="2">
                    </div>
                </article>
                <article>
                    <div>
                        <label for="image3">Image 3:</label>
                        <input type="file" name="image3">
                        <input type="hidden" name="ordre_image3" value="3">
                    </div>
                    <div>
                        <label for="legende3">Légende 3:</label>
                        <input type="text" value="<?= $_POST['legende3'] ?? "" ?>" name="legende3" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                    </div>
                </article>
                <article>
                    <div>
                        <label for="image4">Image 4:</label>
                        <input type="file" name="image4">
                        <input type="hidden" name="ordre_image4" value="4">
                    </div>
                    <div>
                        <label for="legende4">Légende 4:</label>
                        <input type="text" value="<?= $_POST['legende4'] ?? "" ?>" name="legende4" placeholder="Exemple : crédits photographiques, nom des personnes sur la photo, etc...">
                    </div>
                </article>
            </section>
            <section>
                <h2>Corps de l'article :</h2>
                <article>
                    <textarea name="description"> <?= $_POST['description'] ?? "" ?> </textarea>
                </article>
            </section>
            <input type="submit" name="valider" value="submit">
        </form>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>