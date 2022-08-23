<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

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
require_once('../include/headerBo.php');
require_once('../include/sidebar.php');

?>
<main class="container">
   <section class="row formulaire ">
        <section class="col s12 update-headings">
            <a class="gestion-retour" href="article_gestion.php">
                <i class="material-icons tooltipped medium" data-position="bottom"  data-tooltip="Retour vers la page de gestion" >keyboard_arrow_left</i>
            </a>
            <h1>Modifier un article</h1>
        </section> 
        <form class="typo" action="" method="post">   
            <section class=" margin form-bloc container ">
                <section class="col s8">
                    <h2>Informations</h2>
                    <article>
                        <label class=" purple-text text-lighten-3" for="titre">Titre:</label>
                        <input class="grey-text text-darken-2" type="text" name="titre" value="<?= $article['titre'] ?? "" ?>">
                    </article>
                    <article>
                        <label class=" purple-text text-lighten-3" for="auteur">Auteur:</label>
                        <input class="grey-text text-darken-2" type="text" name="auteur" value="<?= $article['auteur'] ?>" >
                    </article>
                </section>
                <section class="col s10">
                    <article>
                        <label class=" purple-text text-lighten-3" for="description">Modifier le contenu :</label>
                        <textarea class="materialize-textarea" style="height: 600px;border: 0.5px solid gray"  name="description"> <?= $article['description'] ?> </textarea>
                    </article>
                </section>
                    <input type="hidden" name="id_article" value="<?= $id_article ?>">
                    <button class="btn grey-text text-lighten-5 waves-effect btn-large waves-light col s12" type="submit" name="valider" value="Mettre à jour l'article">
                       Editer l'article
                    </button>
                </section>
            </section>        
        </form>
        <section class="container">
           <h2>Les Images :</h2>
            <form class="typo" action="" method="post" enctype="multipart/form-data">
                   
                        <section class="z-depth-1 grey lighten-5 padding-card col s12 imagesForm">
                            <h2 class="center-align">Image de couverture :</h2>
                            <article class="margin">
                                <div class="margin">
                                    <label class=" purple-text text-lighten-3" for="image_en_avant">Nouvelle image de couverture :</label> </br>
                                    <input class="grey-text text-darken-2" type="file" name="image_en_avant" placeholder="">
                                    <input  type="hidden" name="ordre_image_en_avant" value="1">
                                </div>
                                <div class="margin">
                                    <label class=" purple-text text-lighten-3" for="legende_en_avant">Légende associée à l'image de couverture:</label>
                                    <input class="grey-text text-darken-2" type="text" name="legende_en_avant" value="<?= $images_article[0]['legende'] ?>" placeholder="">
                                </div>
                            </article>
                            <article>
                                <label class=" purple-text text-lighten-3" for="">Image de couverture actuelle:</label></br>
                                <img style="width:70%";class="image" id="image_en_avant" alt="<?= $images_article[0]['legende'] ?>" src="http://<?= $images_article[0]['chemin'] ?>">
                            </article>
                        </section>
                        <section class="col s12 row">
                            <section class="z-depth-1 grey cards lighten-5  col s4 imagesForm">
                                <h2>Image 1</h2>
                                <article>
                                    <div class="margin">
                                        <label class=" purple-text text-lighten-3" for="image2">Modifier l'image 1:</label></br>
                                        <input class="grey-text text-darken-2" type="file" name="image2">
                                        <input type="hidden" name="ordre_image2" value="2">
                                    </div>
                                    <div class="margin">
                                        <label class=" purple-text text-lighten-3" for="">Image 1 actuelle:</label></br>
                                        <?php if (!empty($images_article[1]['chemin'])):?>
                                            <img  style="width:100%"  class="image" id="image2" src="http://<?= $images_article[1]['chemin'] ?>" alt="<?= $images_article[1]['legende'] ?>">
                                        <?php else: ?>
                                            <img class="image" id="image2" src="http://al-beyt.moi/images/placeholder.jpg" alt="">
                                        <?php endif ?>
                                    </div>
                                </article>
                                <article>
                                    <label class=" purple-text text-lighten-3" for="legende2">Légende de l'image 1:</label></br>
                                    <input class="grey-text text-darken-2" type="text" value="<?= $images_article[1]['legende'] ?? "" ?>" name="legende2">
                                </article>
                                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=2">Supprimer cette image</a>
                            </section>
                            <section class="z-depth-1 grey lighten-5 col s4  cards imagesForm">
                                <h2>Image 2</h2>
                                <article>
                                    <div class="margin">
                                        <label class=" purple-text text-lighten-3" for="image3">Modifier l'image 2 :</label></br>
                                        <input class="grey-text text-darken-2" type="file" name="image3">
                                        <input type="hidden" name="ordre_image3" value="3" >
                                    </div>
                                    <div class="margin">
                                        <label class=" purple-text text-lighten-3" for="">Image 2 actuelle:</label></br>
                                        <?php if (!empty($images_article[2]['chemin'])): ?>
                                            <img style="width:100%"  class="image" id="image3" src="http://<?= $images_article[2]['chemin'] ?>" alt="<?= $images_article[2]['legende'] ?? "" ?>">
                                        <?php else: ?>
                                            <img  style="width:100%"  class="image" id="image2" src="http://al-beyt.moi/images/placeholder.jpg" alt="">
                                        <?php endif ?>
                                    </div>
                                </article>
                                <article>
                                    <label class=" purple-text text-lighten-3" for="legende3">Légende de l'image 2:</label></br>
                                    <input class="grey-text text-darken-2" type="text" value="<?= $images_article[2]['legende'] ?? "" ?>" name="legende3">
                                </article>
                                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=3">Supprimer cette image</a>
                            </section>
                            <section class="z-depth-1 grey lighten-5  col s4  cards imagesForm">
                                <h2>Image 3</h2>
                                <article class="">
                                    <div class=" margin">
                                        <label class=" purple-text text-lighten-3" for="image4">Modifier l'image 3:</label></br>
                                        <input class="grey-text text-darken-2" type="file" name="image4"></br>
                                        <input class="grey-text text-darken-2" type="hidden" name="ordre_image4" value="4">
                                    </div>
                                    <div class="margin">
                                        <label class=" purple-text text-lighten-3" for="">Image 3 actuelle:</label></br>
                                        <?php if (!empty($images_article[3]['chemin'])): ?>
                                            <img style="width:100%"  class="image" id="image4" src="http://<?= $images_article[3]['chemin'] ?>" alt="<?= $images_article[3]['legende'] ?? "" ?>">
                                        <?php else: ?>
                                            <img style="width:100%" class="image" id="image2" src="http://al-beyt.moi/images/placeholder.jpg" alt="">
                                        <?php endif ?>
                                    </div>
                                </article>
                                <article>
                                    <label class=" purple-text text-lighten-3" for="legende4">Légende image 3:</label>
                                    <input class="grey-text text-darken-2" type="text" value="<?= $images_article[3]['legende'] ?? "" ?>" name="legende4">
                                </article>
                                <a href="article_update.php?id=<?= $id_article ?>&action=deleteImage&ordre=4">Supprimer cette image</a>
                        </section>
                    </section> 
                    <section class="row col s12">
                        <input type="hidden" value="<?= $id_article ?>">
                        <button class="waves-effect btn-large waves-light col s12" type="submit" name="validerImages" value="Mettre a jour les images">
                            Editer les images
                        </button>
                    </section>                       
            </form>
        </section>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>