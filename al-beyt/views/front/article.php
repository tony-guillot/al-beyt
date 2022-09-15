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

$title = "Article - ".$article['titre'];
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$abstract = substr($article['description'],0,100).'[...]';
$tweet = "Un article du collectif Al-Beyt : ";
require_once('../include/header.php');
?>
<script>

    /** Script permettant de rajouter dynamiquement les balises meta nécéssaires au partage sur Facebook **/
    var metaUrl = document.createElement('meta');
    metaUrl.setAttribute("property","og:url");
    metaUrl.setAttribute("content","<?= $url ?>");
    document.getElementsByTagName('head')[0].appendChild(metaUrl);

    var metaType = document.createElement('meta');
    metaType.setAttribute("property","og:type");
    metaType.setAttribute("content","article");
    document.getElementsByTagName('head')[0].appendChild(metaType);

    var metaTitle = document.createElement('meta');
    metaTitle.setAttribute("property","og:title");
    metaTitle.setAttribute("content","<?= $article['titre'] ?>");
    document.getElementsByTagName('head')[0].appendChild(metaTitle);

    var metaDescription = document.createElement('meta');
    metaDescription.setAttribute("property","og:description");
    metaDescription.setAttribute("content","<?= $abstract ?>");
    document.getElementsByTagName('head')[0].appendChild(metaDescription);

    var metaImage = document.createElement('meta');
    metaImage.setAttribute("property","og:description");
    metaImage.setAttribute("content","<?= $images_article[0]['chemin'] ?>");
    document.getElementsByTagName('head')[0].appendChild(metaImage);

</script>
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
                        <a title="Partager sur twitter" href="<?= "https://twitter.com/intent/tweet?text=$tweet&url=".urlencode($url)."&hashtags=collectif,albeyt,syrie" ?>" target="popup"
                            onclick="window.open('<?= "https://twitter.com/intent/tweet?text=$tweet&url=".urlencode($url)."&hashtags=collectif,albeyt,syrie" ?>','popup','width=600,height=600'); return false;"  ><i class="fa-brands fa-twitter"></i></a>
                        <a  title="Partager sur facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>" target="popup"
                            onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>','popup','width=600,height=600'); return false;"><i class="fa-brands fa-facebook"></i></a>
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
            <?php if (!empty($images_article[1]) || !empty($images_article[2]) || !empty($images_article[3])): ?>
                <!-- <a href="http://<?= $images_article[1]['chemin']; ?>" target="_blank"></a> -->
                <img src="http://<?= $images_article[1]['chemin'] ?? $images_article[2]['chemin'] ?? $images_article[3]['chemin']; ?>"
                     alt="<?= $images_article[1]['legende'] ?>" id="slide">

                <div id="precedent" onclick="displaySlider(<?= $id ?>,-1)">&lsaquo;</div>
                <div id="suivant" onclick="displaySlider(<?= $id ?>,1)">&rsaquo;</div>
            <?php endif ?>
            </div>
        </section>

    <script>displaySlider(<?= $id.',0'?>) </script>
</main>
<?php 
require_once('../include/footer.php');
?>
