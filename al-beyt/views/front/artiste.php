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
<main>
    <section>
        <section>
            <article>
                <div>
                    <h1><?php echo $artist['nom']?></h1>
                    <p><?= $artist['description']?></p>
                </div>
                <?= Affichage::printLinks($artist['email'],
                                        $artist['website'],
                                        $artist['lien_insta'],
                                        $artist['lien_twitter'],
                                        $artist['lien_soundcloud'],
                                        $artist['lien_facebook'])
                ?>

            </article>
            <article>
                <img src="http://<?= $artist['chemin']?>" alt="">
                <p><?= $artist['legende']?></p>
            </article>
        </section>
        <hr>
        <section>
            <?php foreach($events as $event)
            { 
                // var_dump($event)
                ?>
            <article>
                <a href="evenement.php?id=<?= $event['id']?>">
                    <div>
                        <img src="http://<?= $event['chemin']?>" alt="">
                    </div>
                    <div>
                        <div>
                            <h1><?= $event['titre']?></h1>
                            <p><?= $event['date_evenement']?></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </div>
                </a>
            </article>
      <?php }?>    
                <article>
                
                        <?php 
                     
                        if($pageCourante != 1)
                {   ?>
                    <a href="artiste.php?page=<?= $pageCourante - 1?>&id=<?=$id_artiste?>">Page précédente</a>
        <?php }?>
                <?php for ($i=1; $i <= $pageMax; $i++)
                { ?>

                    <a href="artiste.php?page=<?= $i?>&id=<?=$id_artiste?>"><?= $i?></a>
        <?php  }?>
                <?php if($pageCourante != $pageMax)
                {?>
                    <a href="artiste.php?page=<?= $pageCourante + 1 ?>&id=<?=$id_artiste?>">Page suivante</a>
        <?php }
    ?>

                </article>

        </section>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>