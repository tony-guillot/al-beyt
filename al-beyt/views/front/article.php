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

$title = "Article";
require_once('../include/header.php');
?>

<main class="article">
    <section class="box-cover-article">
        <img class="img" src="http://<?= $images_article[0]['chemin'] ?>" alt="<?= $images_article[0]['legende'] ?>">
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
                <?php echo Affichage::printImageSliderForArticles($images_article); ?>
            </article>
        </section>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>
