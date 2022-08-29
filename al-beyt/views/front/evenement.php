<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;
$controllerEvenement = new EvenementController;

if(isset($_GET['id'])){
    $id = $controllerEvenement->secure($_GET['id']);
}else{
    header('Location: evenements.php');
    exit;
}

$event = $controllerEvenement->displayEventById($id);
$images_event = $controllerEvenement->displayImagesByEventId($id);
$artistes = $controllerEvenement->displayArtistsByEventId($id);

$title = "Evènement";
require_once('../include/header.php');
?>

<main class="event">
    <section class="contener1">
        <section class="titre-affiche">
            <article class="titre ">
                    <h1 class="titre"><?= $event['titre'] ?></h1>
            </article>
            <article class="affiche">
                <a href="http://<?= $images_event[0]['chemin'] ?>" target="_blank">
                <img  src="http://<?= $images_event[0]['chemin'] ?>" alt="<?= $images_event[0]['legende'] ?>">
                </a> 
                <span class="legende merryweather"><?= $images_event[0]['legende'] ?></span>
            </article>
        </section>

        <section class="bloc-info inter ">
          <article class="infos">
              <?php 

                if(!empty($event['lien_billeterie']))
                { ?>
                    <div class="billeterie">
                        <span><i class="fa-solid fa-ticket"></span></i> <a class="label-billeterie" href="<?=$event['lien_billeterie']?>">Billeterie  en  ligne </i></a><span class="kamo">(つ✧ω✧)つ</span></br>
                    </div>
           <?php
                }

                ?>
                <span class="adresse merryweather"><?= $event['adresse'] ?></span></br>
                <span class="sub-infos"> <?= Affichage::printDate($event['date_evenement']) ?>  à  <?= $event['heure'] ?></span> </br>
                <span class="sub-infos">  

                    <?php

                    if(!empty($artistes))
                    {
                        echo 'avec';
                    }
                    foreach ($artistes as $artiste) {
                    ?>  
                        <a  class="artistes" href="artiste.php?id=<?= $artiste['id'] ?>"><?= $artiste['nom'] ?></a> ❥
                    <?php } ?>
                </span>
            </article>
        </section>
    </section>
    <hr class="hr-event">
    <section class="contener2">
        <article class="description inter">
            <p> 
                <?= nl2br($event['description']) ?>
            </p>
        </article>
        <?php if (isset($images_event[1])): ?>
        <article class="bloc-image2">
                
                    <img  src="http://<?= $images_event[1]['chemin'] ?>" alt="<?= $images_event[1]['legende'] ?>">
                    <span class="legende2  merryweather"><?= $images_event[1]['legende'] ?></span>
    
        </article>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
