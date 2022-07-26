<?php
    require_once '../../../vendor/autoload.php';
    $title = 'Accueil';
    require_once('../include/header.php');
    use AlBeyt\Controllers\ArtisteController;
    use AlBeyt\Controllers\EvenementController;
    use AlBeyt\Library\Affichage;

$controllerEvent = New EvenementController;
    $controllerArtist = New ArtisteController;
    $lastEvent = $controllerEvent->displayLastEvent();
    $artists = $controllerArtist->displayAllArtists();
    shuffle($artists);


    echo '<pre>';
    // var_dump($artists);
    //  var_dump($lastEvent);
    echo '</pre>';
    echo '<pre>';
    // var_dump($artists);
    echo '</pre>';

    if(isset($_GET['page'])){
        $page = intval($_GET['page']);
    }else{
        $page = 1;
    }

    $start = ($page-1) * 8;
    $stop = $page * 8;
    $arrayNews = $controllerEvent->displayLastArticlesAndEvents($page);

?>
<main class="global-box">
    <section class="parent-shuffle">
        <?php for($i = 0; $i < 10; $i++):?>
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
                        <p class=" index-text-style date-heure"><?= Affichage::printDateFull($lastEvent['date_evenement'])?></p>&emsp;<p class=" index-text-style à">à</p>&emsp;<p class=" index-text-style date-heure"><?= $lastEvent['heure']?></p>
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
        <p class="froufrou"> 	。.:☆*:･'(*⌒―⌒*))) &nbsp; On vous attend nombreux.ses   &nbsp; 	\(★ω★)/ ✧˖° 。.</p>
    </section>
        <section class="news">
        <?php for ($i = $start;$i < $stop; $i++): ?>
            <article class="tile tile-<?= fmod($i,8) ?>">
                <?php if (!empty($arrayNews[$i]['id_article'])): ?>
                    <a href="article.php?id=<?= $arrayNews[$i]['id_article'] ?>">
                        <img src="http://<?= $arrayNews[$i]['chemin_article'] ?>" alt="Aliquam excepturi at architecto.">
                        <div class="info">
                            <div><h2><?= $arrayNews[$i]['titre'] ?></h2>
                                <span>Par <?= $arrayNews[$i]['auteur'] ?>, publié le <?= Affichage::printDate($arrayNews[$i]['date_news']) ?></span>
                            </div>
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="evenement.php?id=<?= $arrayNews[$i]['id_evenement'] ?>">
                        <img src="http://<?= $arrayNews[$i]['chemin_evenement'] ?>" alt="Aliquam excepturi at architecto.">
                    </a>
                <?php endif ?>
            </article>
        <?php endfor ?>
    </section>
</main>
<?php
    require_once('../include/footer.php');
?>