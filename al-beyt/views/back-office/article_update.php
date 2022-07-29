<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArticleController;
$controllerArticle = new ArticleController();

if($_GET['id']){
    $id_article = $controllerArticle->secure($_GET['id']);
}else{
    header('Location: article_gestion.php'); //on redirige vers la page de gestion
}

if( isset($_GET['action']) && $_GET['action'] == "deleteImage"){
    $controllerArticle->deleteImage($id_article,$controllerArticle->secure($_GET['ordre']));
    header('Location: article_update.php?id='.$id_article); //on vide les params _GET de l'url
}

if(!empty($_POST['validerImages']))
{
    if(!empty($_FILES['image_en_avant']['name'])) {
        $controllerArticle->modifyImage($id_article, $_FILES['image_en_avant'], $_POST['legende_en_avant'], 1);
    }elseif (!empty($_POST['legende_en_avant']))
    {
        $controllerArticle->modifyLegende($id_article,$_POST['legende_en_avant'], 1);
    }
    if(!empty($_FILES['image2']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image2'], $_POST['legende2'], 2);
    }elseif (!empty($_POST['legende2']))
    {
        $controllerArticle->modifyLegende($id_article,$_POST['legende2'], 2);
    }
    if(!empty($_FILES['image3']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image3'], $_POST['legende3'], 3);
    }elseif (!empty($_POST['legende3']))
    {
        $controllerArticle->modifyLegende($id_article,$_POST['legende3'], 3);
    }
    if(!empty($_FILES['image4']['name']))
    {
        $controllerArticle->modifyImage($id_article, $_FILES['image4'], $_POST['legende4'], 4);
    }elseif (!empty($_POST['legende4']))
    {
        $controllerArticle->modifyLegende($id_article,$_POST['legende4'], 4);
    }

}

if(!empty($_POST['valider']))
{
    $date = date("Y-m-d");
    $controllerArticle->modifyArticle($id_article,$_POST['titre'],$date,$_POST['auteur'],$_POST['description']);
}

$article = $controllerArticle->displayArticleById($id_article);
$images_article = $controllerArticle->displayImagesByIdArticle($id_article);

$title = 'Back-Office';
require_once('../include/header.php');
require_once('../include/sidebar.php');

?>
<main>
    <section>
        <?php require_once('../include/sidebar.php');?>
    </section>
    <section>
        <h1>Modifier un article</h1>
        <form action="" method="post">
            <section>
                <section>
                        <h2>Informations</h2>
                        <article>
                            <label for="titre">Titre:</label>
                            <input type="text" name="titre" value="<?= $article['titre'] ?? "" ?>">
                        </article>
                        <article>
                            <label for="auteur">Auteur:</label>
                            <input type="text" name="auteur" value="<?= $article['auteur'] ?>" >
                        </article>
                </section>
                <section>
                    <article>
                        <label for="description">Corps du texte:</label>
                        <textarea name="description"> <?= $article['description'] ?> </textarea>
                    </article>
                </section>
                <input type="hidden" name="id_article" value="<?= $id_article ?>">
                <input type="submit" name="valider" value="Mettre à jour l'article">
            </section>
        </form>
        <section class="imagesForm">
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Les Images : </h2>
                <section>
                    <h2>Image de couverture</h2>
                    <article>
                        <div>
                            <label for="image_en_avant">Nouvelle image de couverture:</label>
                            <input type="file" name="image_en_avant" placeholder="">
                            <input type="hidden" name="ordre_image_en_avant" value="1">
                        </div>
                        <div>
                            <label for="legende_en_avant">Légende associée à l'image de couverture:</label>
                            <input type="text" name="legende_en_avant" value="<?= $images_article[0]['legende'] ?>" placeholder="">
                        </div>
                    </article>
                    <article>
                        <label for="">Image de couverture actuelle:</label>
                        <img class="image" id="image_en_avant" alt="<?= $images_article[0]['legende'] ?>" src="http://<?= $images_article[0]['chemin'] ?>">
                    </article>
                </section>
                <section>
                    <h2>Image 1</h2>
                    <article>
                        <div>
                            <label for="image2">Nouvelle image 1:</label>
                            <input type="file" name="image2">
                            <input type="hidden" name="ordre_image2" value="2">
                        </div>
                        <div>
                            <label for="">Image 1 actuelle:</label>
                            <?php if (!empty($images_article[1]['chemin'])): ?>
                                <img class="image" id="image2" src="http://<?= $images_article[1]['chemin'] ?>" alt="<?= $images_article[1]['legende'] ?>">
                            <?php else: ?>
                                <img class="image" id="image2" src="http://al-beyt.moi/images/placeholder-image.jpg" alt="">
                            <?php endif ?>
                        </div>
                    </article>
                    <article>
                        <label for="legende2">Légende image 1:</label>
                        <input type="text" value="<?= $images_article[1]['legende'] ?? "" ?>" name="legende2">
                    </article>
                    <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=2">Supprimer cette image</a>
                </section>
                <section>
                    <h2>Image 2</h2>
                    <article>
                        <div>
                            <label for="image3">Nouvelle image 2 :</label>
                            <input type="file" name="image3">
                            <input type="hidden" name="ordre_image3" value="3">
                        </div>
                        <div>
                            <label for="">Image 2 actuelle:</label>
                            <?php if (!empty($images_article[2]['chemin'])): ?>
                                <img class="image" id="image3" src="http://<?= $images_article[2]['chemin'] ?>" alt="<?= $images_article[2]['legende'] ?? "" ?>">
                            <?php else: ?>
                                <img class="image" id="image2" src="http://al-beyt.moi/images/placeholder-image.jpg" alt="">
                            <?php endif ?>
                        </div>
                    </article>
                    <article>
                        <label for="legende3">Légende image 2:</label>
                        <input type="text" value="<?= $images_article[2]['legende'] ?? "" ?>" name="legende3">
                    </article>
                    <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=3">Supprimer cette image</a>
                </section>
                <section>
                    <h2>Image 3</h2>
                    <article>
                        <div>
                            <label for="image4">Image 3:</label>
                            <input type="file" name="image4">
                            <input type="hidden" name="ordre_image4" value="4">
                        </div>
                        <div>
                            <label for="">Image 3 actuelle:</label>
                            <?php if (!empty($images_article[3]['chemin'])): ?>
                                <img class="image" id="image4" src="http://<?= $images_article[3]['chemin'] ?>" alt="<?= $images_article[3]['legende'] ?? "" ?>">
                            <?php else: ?>
                                <img class="image" id="image2" src="http://al-beyt.moi/images/placeholder-image.jpg" alt="">
                            <?php endif ?>
                        </div>
                    </article>
                    <article>
                        <label for="legende4">Légende image 3:</label>
                        <input type="text" value="<?= $images_article[3]['legende'] ?? "" ?>" name="legende4">
                    </article>
                    <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=4">Supprimer cette image</a>
                </section>
                <input type="hidden" value="<?= $id_article ?>">
                <input type="submit" name="validerImages" value="Mettre a jour les images">
            </form>
        </section>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>