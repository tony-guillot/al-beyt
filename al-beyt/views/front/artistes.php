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


$domaines = $controller->displayAllDomains();

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id_domaine= intval($_GET['id']);
    $artists = $controller->displayAllArtistsByDomain($id_domaine, $pageCourante);
    $totalArtists = count($controller->displayAllArtistsByDomain($id_domaine));
}
else
{
    $artists = $controller->displayAllArtistsByStatut(1, $pageCourante);
    $id_domaine=0;
    $totalArtists = count($controller->displayAllArtistsByStatut(1));
}
$pageMax = ceil($totalArtists / ArtisteController::NBR_ARTISTE_PAR_PAGE);

$title = "Artistes";
require_once('../include/header.php');
?>
<main class="contener">
    <section class="sous-contener">
        <section class="artistes-filtre">
            <ul class="merryweather liens-filtre taille0-huit">
                <li class="filtre-artistes">
                    <a  class="filtre" <?= (empty($id_domaine)) ? Affichage::stylizeCurrentFilter() : "" ?> href="artistes.php">Tous les artistes</a>
                </li>
                <?php foreach ($domaines as $domaine)
                { ?>
                    <li class="filtre">
                        <a class="filtre" <?= (($domaine['id'] == $id_domaine)) ? Affichage::stylizeCurrentFilter() : "" ?> href="artistes.php?id=<?= $domaine['id'] ?>"><?= $domaine['nom']?></a>
                    </li>
            <?php }?>
            </ul>
        </section>
        <section class=" artistes-box-cards ">
            <section class="artistes-sous-box">

                <?php foreach($artists as $artist)
                {
                    { ?>
                        <article class="template-card artistes-cards">
                            <div>

                                <a href="artiste.php?id=<?= $artist['id']?>">
                                
                                        <img class="artistes-boucle" src="http://<?= $artist['chemin']?>">
        
                                </a>    
                            </div>
                            <div class="artistes-infos molgak taille1 ">
                                <span><?= $artist['nom']?></span>

                                <a href="artiste.php?id=<?= $artist['id']?>">
                                <i class=" artistes fa-solid fa-circle-plus "></i>
                                </a>     
                            </div>

                            
                        </article>
                <?php   }
                } ?>
            </section>
        </section>
    </section>
    <section class="conteneur-page inter">
        <?php if($pageCourante != 1)
        {   ?>
            <a href="artistes.php?page=<?= $pageCourante - 1?><?= !empty($id_domaine) ? "&id=".$id_domaine : "" ?>">&#12298;</a>
  <?php }?>
        <?php for ($i=1; $i <= $pageMax; $i++)
        { ?>
            <a  <?= ($i == $pageCourante) ? 'class="page-active"' : "" ?> href="artistes.php?page=<?= $i?><?= !empty($id_domaine) ? "&id=".$id_domaine : "" ?>"><?= $i?></a>
 <?php  }?>
        <?php if($pageCourante != $pageMax)
        {?>
            <a href="artistes.php?page=<?= $pageCourante + 1 ?><?= !empty($id_domaine) ? "&id=".$id_domaine : "" ?>"> &#12299; </a>
  <?php }
    ?>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>

