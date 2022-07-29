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
    $year = 0;
}

$title = "Articles";
require_once('../include/header.php');
?>

<main  class="contener">
     <section class="sous-contener">
        <section class="filtre  ">
            <ul class="merryweather liens-filtre taille0-huit">
                <li class="filtre">
                    <a class="filtre" <?= (empty($year)) ? Affichage::stylizeCurrentFilter() : "" ?> href="articles.php">Tous les articles</a>
                </li>
                <?php for ($y = date("Y"); $y >= $startYear; $y--): ?>
                    <?php if (!empty($controllerArticle->displayArticlesByYear($y,1))): ?>
                        <li>
                            <a class="filtre" <?= ($y == $year) ? Affichage::stylizeCurrentFilter() : "" ?> href="articles.php?year=<?= $y ?>">&emsp; &emsp; &emsp; &emsp;  &emsp;<?= $y ?> &emsp; &emsp; &emsp; &emsp;&emsp;  &emsp;</a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </section>
        <section class="box-cards">
            <?php foreach ($articles as $article) { ?>
                <article class="cards box-shadow animation2">
                    <a class="link-img" href="article.php?id=<?= $article['id'] ?>">
                        <img  class="boucle" src="http://<?= $article['chemin'] ?>" alt="<?= $article['titre'] ?>">
                    </a>
                    <div class="block-infos articles">
                            <div class="titre-auteur">
                                <h2 class="infos merryweather taille1-trois "><?= $article['titre'] ?></h2>
                                <span class="infos merryweather taille0-huit">Par <em><b> <?= $article['auteur'] ?> </em></b> , publié le <em><?= $article['date'] ?></em></span>
                            </div>
                            <div>
                                <a class="link-img" href="article.php?id=<?= $article['id'] ?>">
                                    <i class="fa-solid fa-circle-plus plus taille1"></i>
                                </a>    

                            </div>
                    </div>
                </article>
            <?php } ?>
        </section>
    </section>
    <section class="conteneur-page">
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