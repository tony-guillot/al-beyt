<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArticleController;
use AlBeyt\Library\Affichage;

$controllerArticle = new ArticleController();

if(isset($_GET['id'])){
    $id = $controllerArticle->secure($_GET['id']);
}else{
    header('Location: articles.php');
    exit;
}
$article = $controllerArticle->displayArticleById($id);
$images_article = $controllerArticle->displayImagesByIdArticle($id);
// echo '<pre>';
// var_dump($images_article);
// echo '</pre>';

$title = "Article";
require_once('../include/header.php');
?>

<main class="article-main">
    <section class="article">
        <section class="box-cover-article">
            <a href="http://<?= $images_article[0]['chemin'] ?>" target="_blank">
            <img class="img" src="http://<?= $images_article[0]['chemin'] ?>" alt="<?= $images_article[0]['legende'] ?>">
            </a>
            <span class=" legende inter"> <?= $images_article[0]['legende'] ?></span>
        </section>
        <section class="contener-article merryweather">
            <section class="sous-contener-article">
                <div class="icones">
                        <a title="Télécharger l'article au format PDF" href="download_pdf.php?id_article=<?=$id?>"><i class="fa-solid fa-download" ></i></a>
                        <a title="Partager sur twitter" href=""><i class="fa-brands fa-twitter"></i></a>
                        <a  title="Partager sur facebook" href=""><i class="fa-brands fa-facebook"></i></a>
                    </div>
                    <div class="infos-article">
                        <h2 class="titre-article "><?= $article['titre'] ?></h2>
                        <div class="auteur-date">par &emsp14;<span><?= $article['auteur'] ?></span>,&emsp14;publié le &emsp14;<span><?= $article['date'] ?></span> </div>
                    </div>
            </section>

                <hr class="hr-article">

            <section class="box-description inter">
                <article>
                    <div>
                        <p class="taille0-huit">
                            <?= nl2br($article['description']) ?>
                        </p>
                    </div>
                
                </article>
            </section>
        </section>
    </section>    

    <section class="box-slider">
        <div id="slider">
            <!-- <a href="http://<?= $images_article[1]['chemin'];?>" target="_blank"></a> -->
            <img  src="http://<?= $images_article[1]['chemin'];?>"
             alt="<?php $_images_article[1]['legende']?>" id="slide">
             
            <div id="precedent" onclick="displaySlider(<?=$id ?>,-1)">&lsaquo;</div>
            <div id="suivant" onclick="displaySlider(<?=$id ?>,1)">&rsaquo;</div>
        </div>
    </section>


    <script>displaySlider(<?= $id.',0'?>) </script>
</main>
<?php 
require_once('../include/footer.php');
?>
