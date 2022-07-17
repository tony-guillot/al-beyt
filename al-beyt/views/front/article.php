<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
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

?>

<main>
    <section>
        <img src="http://<?= $images_article[0]['chemin'] ?>" alt="<?= $images_article[0]['legende'] ?>">
    </section>
    <section>
        <section>
            <h2><?= $article['titre'] ?></h2>
            <div>par <span><?= $article['auteur'] ?></span>, publié le <span><?= $article['date'] ?></span> </div>
        </section>

        <section>
            <!-- <article>
                <p>
                </p>
            </article> -->
            <article>
                <div>
                    <p>
                        <?= $article['description'] ?>
                    </p>
                </div>
                <?php echo Affichage::printImageSliderForArticles($images_article); ?>
            </article>
        </section>
    </section>
</main>
