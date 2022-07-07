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
    echo '<img src="'.$id_article.'">';

}

?>
<section>
    <h1>Ajouter un nouvel article</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <article>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" placeholder="">
        </article>
                        <br />
        <article>
            <label for="image_en_avant">Image en avant:</label>
            <input type="file" name="image_en_avant" placeholder="">
            <input type="hidden" name="ordre_image_en_avant" value="1">
        </article>
        <article>
            <label for="legende_en_avant">Légende associée à l'image en avant:</label>
            <input type="text" name="legende_en_avant" placeholder="">
        </article>
                        <br />
        <article>
            <label for="auteur">Auteur:</label>
            <input type="text" name="auteur" placeholder="">
        </article>
        <article>
            <label for="description">Texte de l'article:</label>
            <textarea name="description" placeholder=""> </textarea>
        </article>

                        <br />
                <article>
                    <h2>Images slider : </h2>
            <label for="image2">Image complémentaire 2:</label>
            <input type="file" name="image2">
            <input type="hidden" name="ordre_image2" value="2">
        </article>
        <article>
            <label for="legende2">Légende complémentaire 2:</label>
            <input type="text" name="legende2">
            <input type="hidden" name="ordre_legende2" value="2">
        </article>

                <article>
            <label for="image3">Image complémentaire 3:</label>
            <input type="file" name="image3">
            <input type="hidden" name="ordre_image3" value="3">
        </article>
        <article>
            <label for="legende3">Légende complémentaire 3:</label>
            <input type="text" name="legende3">
        </article>

                <article>
            <label for="image4">Image complémentaire 4:</label>
            <input type="file" name="image4">
            <input type="hidden" name="ordre_image4" value="4">
        </article>
        <article>
            <label for="legende4">Légende complémentaire 4:</label>
            <input type="text" name="legende4">
        </article>

        <input type="submit" name="valider" value="submit">
    </form>
</section>