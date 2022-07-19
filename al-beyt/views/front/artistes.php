<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Library\Affichage;

$controller = New ArtisteController;

if(isset($_GET['page']) && !empty($_GET['page']))
{   
    $pageCourante = intval($_GET['page']);
}
else
{
    $pageCourante = 1;
}
$totalArtists = count($controller->displayAllArtists());
$pageMax = ceil($totalArtists / ArtisteController::NBR_ARTISTE_PAR_PAGE);

$domaines = $controller->displayAllDomains();

if(isset($_GET['id']))
{
    $id_domaine= intval($_GET['id']);
    $artists = $controller->displayAllArtistsByDomain($id_domaine, $pageCourante);

}
else
{
    $artists = $controller->displayAllArtistsByStatut(1, $pageCourante);
}

$title = "Artistes";
require_once('../include/header.php');
?>
<main class="contener" >
    <section class="sous-contener">
        <section class="filtre">
            <ul>
                    <li>
                        <a href="artistes.php">Tous les artistes</a>
                    </li>
                <?php foreach ($domaines as $domaine)
                { ?>
                    <li>
                        <a href="artistes.php?id=<?= $domaine['id'] ?>"><?= $domaine['nom']?></a>
                    </li>
            <?php }?>
            </ul>
        </section>
        <section  class="cards-artists">
            <?php foreach($artists as $artist)
            {
                { ?>
                    <article>
                        <a href="artiste.php?id=<?= $domaine['id']?>">
                            <div>
                                <img src="http://<?= $artist['chemin']?>">
                            </div>
                            <div>
                                <span><?= $artist['nom']?></span>
                                <i class="fa-solid fa-circle-plus"></i>
                            </div>

                    </a>
                </article>
      <?php }
        } ?></section>
    </section>
    <section>
        <?php if($pageCourante != 1)
        {   ?>
            <a href="artistes.php?page=<?= $pageCourante - 1?><?= isset($id_domaine) ? "&id=".$id_domaine : "" ?>">Page précédente</a>
  <?php }?>
        <?php for ($i=1; $i <= $pageMax; $i++)
        { ?>
            <a  <?= ($i == $pageCourante) ? Affichage::stylizeCurrentPage() : "" ?> href="artistes.php?page=<?= $i?><?= isset($id_domaine) ? "&id=".$id_domaine : "" ?>"><?= $i?></a>
 <?php  }?>
        <?php if($pageCourante != $pageMax)
        {?>
            <a href="artistes.php?page=<?= $pageCourante + 1 ?><?= isset($id_domaine) ? "&id=".$id_domaine : "" ?>">Page suivante</a>
  <?php }
    ?>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>

