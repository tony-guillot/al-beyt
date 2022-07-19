<?php
    require_once '../../../vendor/autoload.php';
    $title = 'Accueil';
    require_once('../include/header.php');
    use AlBeyt\Controllers\ArtisteController;
    use AlBeyt\Controllers\EvenementController;
    $controllerEvent = New EvenementController;
    $controllerArtist = New ArtisteController;
    $lastEvent = $controllerEvent->displayLastEvent();
    $artists = $controllerArtist->displayAllArtists();
    echo '<pre>';
    // var_dump($artists);
    //  var_dump($lastEvent);
    echo '</pre>';
    shuffle($artists);
    echo '<pre>';
    // var_dump($artists);
    echo '</pre>';
    
?>
<main class="global-box">
    <section class="parent-shuffle">
        <?php for($i = 0; $i < 15; $i++):?>    
        <article class="names">
          <a class="link-names" href="artiste.php?id=<?= $artists[$i]['id']?>"><em><?=$artists[$i]['nom'];?></em></a>
        </article>
    <!--✹ -->   
        <?php endfor;?>
    </section>
    <section class="index-parent-event">
        <article class="parent-index-affiche">
            <a href="evenement.php?id=<?= $lastEvent['id']?>">
                <img  class="index-affiche" src="http://<?= $lastEvent['chemin'] ?>" alt="Affiche Prochain évènement Al-Beyt">
            </a>
        </article>
        <article class="index-parent-infos">
            <div class="index-infos">
                <h1 class="index-text-style event-titre"><?= $lastEvent['titre'] ?></h1>

                <div class="parent-date-heure">
                    <div class="flex">
                        <p class=" index-text-style date-heure"><?= $lastEvent['date_evenement']?></p>&emsp;<p class=" index-text-style à">à</p>&emsp;<p class=" index-text-style date-heure"><?= $lastEvent['heure']?></p>
                    </div>
                    <p class="index-text-style adresse"><?= $lastEvent['adresse'] ?></p>
                    
            
                </div>
            </div>
            <div class="index-plus">
                <a href="evenement.php?id=<?= $lastEvent['id']?>">
                    <i class="fa-solid fa-circle-plus index-icon"></i>
                </a>    
            </div>    
        </article>
    </section>
    <section class="mignon">
    <p class="froufrou">On vous attend Nombreux.ses </p>
    </section>
</main>
<?php
    require_once('../include/footer.php');
?>