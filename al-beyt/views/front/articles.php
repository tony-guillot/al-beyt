<?php
require_once '../../../vendor/autoload.php';
$title = "El-Beyt : Articles";
require_once('../include/header.php');
use AlBeyt\Controllers\ArticleController;
$controllerArticle = new ArticleController();

if(isset($_GET['page'])){
    $page = $controllerArticle->secure($_GET['page']);
}else{
    $page = 1;
}
$totalArticles = count($controllerArticle->displayAllArticles());
$pageMax = ceil($totalArticles / ArticleController::NB_ARTICLE_PAR_PAGE);

if(isset($_GET['year']))
{
    $year = $controllerArticle->secure($_GET['year']);
    $articles = $controllerArticle->displayArticlesByYear($year,$page);
}else{
    $articles = $controllerArticle->displayAllArticles($page);
}

?>

<main>
    <section>
        <section>
            <ul>
                <li>
                    <a href="articles.php">tous les articles</a>
                </li>
                <?php for ($y = date("Y"); $y >= 2021; $y--): ?>
                    <li>
                        <a href="articles.php?year=<?= $y ?>"><?= $y ?></a>
                    </li>
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
            <a href="articles.php?page=<?= $page - 1 ?>">Page précédente</a>
        <?php endif ?>

        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a href="articles.php?page=<?= $i ?>"> <?= $i ?> </a>
        <?php endfor ?>

        <?php if ($page != $pageMax): ?>
            <a href="articles.php?page=<?= $page + 1 ?>">Page suivante</a>
        <?php endif ?>
    </section>
</main>