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
        <section class="filtre">
            <ul class="merryweather liens-filtre taille0-six">
                <li class="filtre">
                    <a class="filtre" <?= (empty($year)) ? Affichage::stylizeCurrentFilter() : "" ?> href="articles.php">Tous les articles</a>
                </li>
                <?php for ($y = date("Y"); $y > 2021; $y--): ?>
                    <li class="filtre">
                        <a class="filtre"  <?= ($y == $year) ? Affichage::stylizeCurrentFilter() : "" ?>  href="articles.php?year=<?= $y ?>"><?= $y ?></a>
                    </li>
                <?php endfor ?>
            </ul>
        </section>
        <section class="box-cards">
            <?php foreach ($articles as $article) { ?>
                <article class="cards">
                    <a class="link-img" href="article.php?id=<?= $article['id'] ?>">
                        <img  class="boucle" src="http://<?= $article['chemin'] ?>" alt="<?= $article['titre'] ?>">
                    </a>    
                    <div class="block-infos">
                            <div class="titre-auteur">
                                <h2 class="infos merryweather taille1"><?= $article['titre'] ?></h2>
                                <span class="infos merryweather taille0-huit">Par <?= $article['auteur'] ?>, publié le <?= $article['date'] ?></span>
                            </div>
                            <div>
                                <i class="fa-solid fa-circle-plus plus taille1"></i>
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