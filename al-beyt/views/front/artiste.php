<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Library\Affichage;
$controller = New ArtisteController;
$affichage = New Affichage;

if(isset($_GET['page']) && !empty($_GET['page']))
{   
    $pageCourante = $_GET['page'];
    
}
else
{
    $pageCourante = 1;
}

if(isset($_GET['id']) && !empty($_GET['id']) )
{
    $id_artiste = intval($_GET['id']);
    // var_dump($id_artiste);
    $artist = $controller->displayArtistById($id_artiste);
    // var_dump($artist);
    $events = $controller->displayEventsByIdArtist($id_artiste, $pageCourante);
    // echo '<pre>';
    // var_dump($artist);
    // echo '</pre>';
}
else
{
    header('Location: artistes.php');
    // echo 'Cet évènement a été supprimé.';
   
}

$id_artiste = intval($_GET['id']);
$totalEventsByPage = count($controller->displayEventsByIdArtist($id_artiste));
$pageMax = ceil($totalEventsByPage / ArtisteController::NBR_EVENEMENT_PAGE_ARTISTE);
// var_dump('TOTAL EVENT',$controller->displayEventsByIdArtist($id_artiste));

$title = "Artiste";
require_once('../include/header.php');
?>
<main class="artiste">
    <section class="contener ">
        <section class="contener1">
            <article class="infos-artiste">
                <div class="nom-description">
            <h1 class="nom taille4 "><span class="stars">✧ &ensp; </span><span><?php echo $artist['nom']?></span><span class="stars"> &ensp; ✧</span></h1>
                    <p class="description"><?= $artist['description']?></p>
                </div>
                <div class="links">

                
                    <?= Affichage::printLinks($artist['email'],
                                        $artist['website'],
                                        $artist['lien_insta'],
                                        $artist['lien_twitter'],
                                        $artist['lien_soundcloud'],
                                        $artist['lien_facebook'])
                ?>
                </div>
            </article>
            <article class="box-image">
                <a href="http://<?= $artist['chemin']?>" target="_blank">
                    <img src="http://<?= $artist['chemin']?>" alt="">
                </a>
                <p class="legende inter"><?= $artist['legende']?></p>
            </article>
        </section>
        <hr class="hr-event">
       <?php  if($pageMax ==0){
        echo '<p class="artiste-event-placeholder"> ✿ Cet.te artiste n\'a pas encore participé à l\'un de nos évènements ✿ </p>';
        }
       ?>
        <section class="box-cards">
            <?php foreach ($events as $event) { ?>
                <article class="cards box-shadow animation2">
                    <a class="link-img" href="evenement.php?id=<?= $event['id'] ?>">
                        <img class="boucle" src="http://<?= $event['chemin'] ?>" alt="<?= $event['titre'] ?>">
                    </a>    
                    <div class="block-infos">

                        <div class="titre-auteur"> 
                            <h2 class="infos merryweather taille1-trois "><?= $event['titre'] ?></h2>
                            <span class="infos merryweather taille0-huit"> <em><b> <?= Affichage::printDate($event['date_evenement']) ?> </em></b></span>
                        </div>
                        <div>
                            <a class="link-img" href="evenement.php?id=<?= $event['id'] ?>">
                                <i class="fa-solid fa-circle-plus plus taille1"></i>
                            </a> 
                        </div>
                    </div>
                  
                </article>
            <?php } ?>
        </section>
        <section class="conteneur-page pagination-artiste inter">
       
                <?php
                if($pageMax != 0)
                {
                    if($pageCourante != 1)
                    {   ?>
                        <a href="artiste.php?page=<?= $pageCourante - 1?>&id=<?=$id_artiste?>">&#12298;</a>
                    <?php }?>
                    <?php for ($i=1; $i <= $pageMax; $i++)
                    { ?>
                        <a  <?= ($i == $pageCourante) ? Affichage::stylizeCurrentPage() : "" ?> href="artiste.php?page=<?= $i?>&id=<?=$id_artiste?>"><?= $i?> </a>
                    <?php  }?>
                    <?php if($pageCourante != $pageMax)
                    {  
                        var_dump($pageMax);
                        ?>
                        <a href="artiste.php?page=<?= $pageCourante + 1 ?>&id=<?=$id_artiste?>">&#12299;</a>
                    <?php }
                }
                
               
                ?>
    
        </section>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>