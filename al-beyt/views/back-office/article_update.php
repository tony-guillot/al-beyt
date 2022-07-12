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


}else{
    header('Location: artiste_gestion.php');
}

if( isset($_GET['action']) && $_GET['action'] == "deleteImage"){
    $controllerArticle->supprimeImage($id_article,$_GET['ordre']);

    header('Location: artiste_update.php?id='.$id_article); //on vide les params _GET de l'url
}

if(!empty($_POST['validerImages']))
{
    if(!empty($_FILES['image_en_avant']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image_en_avant'], $_POST['legende_en_avant'], 1);
    }
    if(!empty($_FILES['image2']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image2'], $_POST['legende2'], 2);
    }
    if(!empty($_FILES['image3']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image3'], $_POST['legende3'], 3);
    }
    if(!empty($_FILES['image4']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image4'], $_POST['legende4'], 4);
    }

    $article = $controllerArticle->displayArticleById($id_article);
    $images_article = $controllerArticle->displayImagesByIdArticle($id_article);

}

if(!empty($_POST['valider']))
{
    var_dump($_POST);
}
?>

<section>
    <h1>Editer un article</h1>
    <div class="imagesForm">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Image de présentation : </h2>
            <article>
                <img class="image" id="image_en_avant" alt="<?= $images_article[0]['legende'] ?>"
                     src="<?= $images_article[0]['chemin'] ?>">
                <label for="image_en_avant">Image en avant:</label>
                <input type="file" name="image_en_avant" placeholder="">
                <input type="hidden" name="ordre_image_en_avant" value="1">
                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=1" >Supprimer cette image</a>
            </article>
            <article>
                <label for="legende_en_avant">Légende associée à l'image en avant:</label>
                <input type="text" name="legende_en_avant" value="<?= $images_article[0]['legende'] ?>" placeholder="">
            </article>
            <h2>Images slider : </h2>
            <article>
                <?php if (!empty($images_article[1]['chemin'])): ?>
                <img class="image" id="image2" src="<?= $images_article[1]['chemin'] ?>"
                     alt="<?= $images_article[1]['legende'] ?>">
                <?php endif ?>
                <label for="image2">Image complémentaire 2:</label>
                <input type="file" name="image2">
                <input type="hidden" name="ordre_image2" value="2">
                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=2" >Supprimer cette image</a>

            </article>
            <article>
                <label for="legende2">Légende complémentaire 2:</label>
                <input type="text" value="<?= $images_article[1]['legende'] ?? "" ?>" name="legende2">
            </article>
            <article>
                <?php if (!empty($images_article[2]['chemin'])): ?>
                    <img class="image" id="image3" src="<?= $images_article[2]['chemin'] ?>"
                         alt="<?= $images_article[2]['legende'] ?? ""  ?>">
                <?php endif ?>
                <label for="image3">Image complémentaire 3:</label>
                <input type="file" name="image3">
                <input type="hidden" name="ordre_image3" value="3">
                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=3" >Supprimer cette image</a>

            </article>
            <article>
                <label for="legende3">Légende complémentaire 3:</label>
                <input type="text" value="<?= $images_article[2]['legende'] ?? ""  ?>" name="legende3">
            </article>
            <article>
                <?php if (!empty($images_article[3]['chemin'])): ?>
                    <img class="image" id="image4" src="<?= $images_article[3]['chemin'] ?>"
                         alt="<?= $images_article[3]['legende'] ?? ""  ?>">
                <?php endif ?>
                <label for="image4">Image complémentaire 4:</label>
                <input type="file" name="image4">
                <input type="hidden" name="ordre_image4" value="4">
                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=4" >Supprimer cette image</a>

            </article>
            <article>
                <label for="legende4">Légende complémentaire 4:</label>
                <input type="text" value="<?= $images_article[3]['legende'] ?? "" ?>" name="legende4">
            </article>
            <input type="hidden" value="<?= $id_article ?>">
            <input type="submit" name="validerImages" value="Mettre a jour les images">
        </form>
    </div>
    <form action="" method="post">
        <article>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" value="<?= $article['titre'] ?? ""  ?>" placeholder="">
        </article>
        <article>
            <label for="auteur">Auteur:</label>
            <input type="text" name="auteur" value="<?= $article['auteur'] ?>" placeholder="">
        </article>
        <article>
            <label for="description">Texte de l'article:</label>
            <textarea name="description"  placeholder=""> <?= $article['description'] ?> </textarea>
        </article>
        <input type="hidden" value="<?= $id_article ?>">
        <input type="submit" name="valider" value="Mettre a jour l'article">
    </form>
</section>
