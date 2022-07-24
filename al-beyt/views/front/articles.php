<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArticleController;
use AlBeyt\Library\Affichage;

$controllerArticle = new ArticleController();

if(isset($_GET['page'])){
    $page = $controllerArticle->secure($_GET['page']);
}else{
    $page = 1;
}
$totalArticles = count($controllerArticle->displayAllArticles());
$pageMax = ceil($totalArticles / ArticleController::NB_ARTICLE_PAR_PAGE);
$startYear = date("Y", strtotime($controllerArticle->displayAllArticles()[$totalArticles-1]['date']));

if(isset($_GET['year']))
{
    $year = $controllerArticle->secure($_GET['year']);
    $articles = $controllerArticle->displayArticlesByYear($year,$page);
}else{
    $articles = $controllerArticle->displayAllArticles($page);
}

$title = "Articles";
require_once('../include/header.php');
?>

<main  class="contener">
     <section class="sous-contener">
        <section class="filtre">
            <ul>
                <li>
                    <a href="articles.php">tous les articles</a>
                </li>
                <?php for ($y = date("Y"); $y >= $startYear; $y--): ?>
                    <?php if (!empty($controllerArticle->displayArticlesByYear($y,1))): ?>
                        <li>
                            <a href="articles.php?year=<?= $y ?>"><?= $y ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </section>
        <section>
            <?php foreach ($articles as $article) { ?>
                <article>
                    <a href="article.php?id=<?= $article['id'] ?>">
                        <img src="http://<?= $article['chemin'] ?>" alt="<?= $article['titre'] ?>">
                        <div>

                            <div><h2><?= $article['titre'] ?></h2>
                                <span>Par <?= $article['auteur'] ?>, publié le <?= $article['date'] ?></span>
                            </div>
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </a>
                </article>
            <?php } ?>
        </section>
    </section>
    <section>
        <?php if ($page != 1): ?>
            <a href="articles.php?page=<?= $page - 1 ?><?= isset($year) ? "&year=".$year : "" ?>">Page précédente</a>
        <?php endif ?>

        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a  <?= ($i == $page) ? Affichage::stylizeCurrentPage() : "" ?> href="articles.php?page=<?= $i ?><?= isset($year) ? "&year=".$year : "" ?>"> <?= $i ?> </a>
        <?php endfor ?>

        <?php if ($page != $pageMax): ?>
            <a href="articles.php?page=<?= $page + 1 ?><?= isset($year) ? "&year=".$year : "" ?>">Page suivante</a>
        <?php endif ?>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>