<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArticleController;
use AlBeyt\Library\Affichage;

$controllerArticle = new ArticleController();

if(isset($_GET['delete'])){
    $idDelete = $controllerArticle->secure($_GET['delete']);
    $controllerArticle->deleteArticle($idDelete);
    header('Location: article_gestion.php'); //on vide les params _GET de l'url

}

if(isset($_GET['page'])){
    $page = $controllerArticle->secure($_GET['page']);
}else{
    $page = 1;
}
$totalArticles = count($controllerArticle->displayAllArticles());
$pageMax = ceil($totalArticles / ArticleController::NB_ARTICLE_PAR_PAGE);

$allArticles = $controllerArticle->displayAllArticles($page);

$title ="Gestion article";
require_once('../include/headerBo.php');
?>
<?php require_once('../include/sidebar.php');?>
<main class="container">
    <h1 class="header">Gestion des articles</h1>
    <section>
    </section>
    <section>
        <table class="stripped highlight">
            <thead>
                <th>Image principale</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Auteur</th>
                <th>Description</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
            <?php
            foreach($allArticles as $allArticle) {
                $id_article = $allArticle['id'];
                $image = $controllerArticle->displayImagesByIdArticle($id_article);
                ?>
                <tr>
                    <td><img class="imageGestion" src="http://<?= $image[0]['chemin']?>"></td>
                    <td><?= $allArticle['titre']?></td>
                    <td><?= $allArticle['date']?></td>
                    <td><?= $allArticle['auteur']?></td>
                    <td><?= $allArticle['description']?></td>
                    <td> <a href="article_update.php?id=<?= $id_article?>"><i class="fa-solid fa-wrench"></i></a> </td>
                    <form action="" methode='get'>
                        <td>
                            <button class="button-trash" name="delete" type="submit" value='<?= $id_article?>'><i class="fa-solid fa-trash button-trash "></i></button>
                        </td>
                    </form>
                </tr>
            <?php   } ?>
            </tbody>
        </table>
</section>
<section class="container pagination center-align">
    <?php if ($page != 1): ?>
        <a href="article_gestion.php?page=<?= $page - 1 ?>">Page précédente</a>
    <?php endif ?>

    <?php for ($i = 1; $i <= $pageMax ; $i++): ?>
        <a  <?= ($i == $page) ? Affichage::stylizeCurrentPage() : "" ?> href="article_gestion.php?page=<?= $i ?>"> <?= $i ?> </a>
    <?php endfor ?>

    <?php if ($page != $pageMax): ?>
        <a href="article_gestion.php?page=<?= $page + 1 ?>">Page suivante</a>
    <?php endif ?>
    </section>
</main>

<?php
require_once('../include/footerBo.php');
?>
