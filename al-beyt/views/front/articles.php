<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArticleController;
use AlBeyt\Library\Affichage;

$controllerArticle = new ArticleController();

if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $controllerArticle->secure($_GET['page']);
}else{
    $page = 1;
}

if(isset($_GET['year']) && !empty($_GET['year']))
{
    $year = $controllerArticle->secure($_GET['year']);
    $articles = $controllerArticle->displayArticlesByYear($year,$page);
    $totalArticles = count($controllerArticle->displayArticlesByYear($year));
}else{
    $articles = $controllerArticle->displayAllArticles($page);
    $year = 0;
    $totalArticles = count($controllerArticle->displayAllArticles());
}

$pageMax = ceil($totalArticles / ArticleController::NB_ARTICLE_PAR_PAGE);
$yearFilter = $controllerArticle->displayYearFilters();

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
                <?php foreach ($yearFilter as $y): ?>
                        <li class="filtre">
                            <a class="filtre" <?= ($y['year'] == $year) ? Affichage::stylizeCurrentFilter() : "" ?> href="articles.php?year=<?= $y['year'] ?>"><?= $y['year'] ?></a>
                        </li>
                <?php endforeach ?>
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
    <section class="conteneur-page inter">
        <?php if ($page != 1): ?>
            <a href="articles.php?page=<?= $page - 1 ?><?= !empty($year) ? "&year=".$year : "" ?>"> &lt;&lt; </a>
        <?php endif ?>

        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a  <?= ($i == $page) ? 'class="page-active"' : "" ?> href="articles.php?page=<?= $i ?><?= !empty($year) ? "&year=".$year : "" ?>"> <?= $i ?> </a>
        <?php endfor ?>

        <?php if ($page != $pageMax): ?>
            <a href="articles.php?page=<?= $page + 1 ?><?= !empty($year) ? "&year=".$year : "" ?>"> &gt;&gt;</a>
        <?php endif ?>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>