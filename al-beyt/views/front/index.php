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
     //var_dump($lastEvent);
    echo '</pre>';
    shuffle($artists);
    echo '<pre>';
    // var_dump($artists);
    echo '</pre>';
    
?>
<main>
    <section>
        <?php for($i = 0; $i < 15; $i++):?>
        <article>
            <a href="artiste.php?id=<?= $artists[$i]['id']?>"><em><?= $artists[$i]['nom'];?></em></a>
        </article>
        <?php endfor;?>
    </section>
    <section>
        <article>
            <img src="http://<?= $lastEvent['chemin'] ?>" alt="Affiche Prochain évènement Al-Beyt">
        </article>
        <article>
            <div>
                <h1><?= $lastEvent['titre'] ?></h1>
                <p><?= $lastEvent['date_evenement']?> à <?= $lastEvent['heure']?></p>
                <p><?= $lastEvent['adresse'] ?></p>
            </div>
            <div>
                <p>On vous attend Nombreux.ses </p>
            </div>
        </article>
    </section>
</main>
<?php
?>