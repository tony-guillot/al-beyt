<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
require_once('../include/sidebar.php');

use AlBeyt\Controllers\ArticleController;

$controllerArticle = new ArticleController();

if($_GET['id']){
    $id_article = $_GET['id'];

    $article = $controllerArticle->displayArticleById($id_article);
    $images_article = $controllerArticle->displayImagesByIdArticle($id_article);


}

if(!empty($_POST['valider']))
{


}
?>

<section>
    <h1>Editer un article</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <article>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" value="<?= $article['titre'] ?>" placeholder="">
        </article>
        <article>
            <img class="image" id="image_en_avant" alt="<?= $article['legende_en_avant'] ?>" src="<?= $article['chemin_image_en_avant'] ?>" >
            <label for="image_en_avant">Image en avant:</label>
            <input type="file" name="image_en_avant" placeholder="">
            <input type="hidden" name="ordre_image_en_avant" value="1">
        </article>
        <article>
            <label for="legende_en_avant">Légende associée à l'image en avant:</label>
            <input type="text" name="legende_en_avant" value="<?= $article['legende_en_avant'] ?>" placeholder="">
        </article>
        <article>
            <label for="auteur">Auteur:</label>
            <input type="text" name="auteur" value="<?= $article['auteur'] ?>" placeholder="">
        </article>
        <article>
            <label for="description">Texte de l'article:</label>
            <textarea name="description"  placeholder=""> <?= $article['description'] ?> </textarea>
        </article>
        <article>
            <h2>Images slider : </h2>
            <img class="image" id="image2" src="<?= $article['chemin_image2'] ?>"  alt="<?= $article['legende2'] ?>">
            <label for="image2">Image complémentaire 2:</label>
            <input type="file" name="image2">
            <input type="hidden" name="ordre_image2" value="2">
        </article>
        <article>
            <label for="legende2">Légende complémentaire 2:</label>
            <input type="text" value="<?= $article['legende2'] ?>" name="legende2">
            <input type="hidden" name="ordre_legende2" value="2">
        </article>
        <article>
            <img class="image" id="image3" src="<?= $article['chemin_image3'] ?>"  alt="<?= $article['legende3'] ?>">
            <label for="image3">Image complémentaire 3:</label>
            <input type="file" name="image3">
            <input type="hidden" name="ordre_image3" value="3">
        </article>
        <article>
            <label for="legende3">Légende complémentaire 3:</label>
            <input type="text" value="<?= $article['legende3'] ?>" name="legende3">
        </article>
        <article>
            <img class="image" id="image4" src="<?= $article['chemin_image4'] ?>"  alt="<?= $article['legende4'] ?>">
            <label for="image4">Image complémentaire 4:</label>
            <input type="file" name="image4">
            <input type="hidden" name="ordre_image4" value="4">
        </article>
        <article>
            <label for="legende4">Légende complémentaire 4:</label>
            <input type="text" value="<?= $article['legende4'] ?>" name="legende4">
        </article>
        <input type="hidden" value="<?= $id_article ?>">
        <input type="submit" name="valider" value="submit">
    </form>
</section>
