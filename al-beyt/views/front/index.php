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

    if(isset($_GET['page'])){
        $page = intval($_GET['page']);
    }else{
        $page = 1;
    }

    /*Ici on gère la pagination depuis la vue et non depuis le modèle*/
    $start = ($page-1) * 8;
    $stop = $page * 8;
    $arrayNews = $controllerEvent->displayLastArticlesAndEvents(1);
    $pageMax = ceil(count($arrayNews)/8);


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
<!--    <section id="news" class="news">-->
<!--        --><?php //for ($i = 0;$i < 8; $i++): ?>
<!--            <article  class="tile tile---><?//= fmod($i,8) ?><!--">-->
<!--                --><?php //if (!empty($arrayNews[$i]['id_article'])): ?>
<!--                    <a id="link---><?//= fmod($i,8) ?><!--" href="article.php?id=--><?//= $arrayNews[$i]['id_article'] ?><!--">-->
<!--                        <img id="link-img---><?//= fmod($i,8) ?><!--" src="http://--><?//= $arrayNews[$i]['chemin_article'] ?><!--" alt="Aliquam excepturi at architecto.">-->
<!--                        <div class="info">-->
<!--                            <div><h2 id="titre---><?//= fmod($i,8) ?><!--" >--><?//= $arrayNews[$i]['titre'] ?><!--</h2>-->
<!--                                <span id="auteur-date---><?//= fmod($i,8) ?><!--">Par --><?//= $arrayNews[$i]['auteur'] ?><!--, publié le --><?//= Affichage::printDate($arrayNews[$i]['date_news']) ?><!--</span>-->
<!--                            </div>-->
<!--                            <i class="fa-solid fa-circle-plus"></i>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                --><?php //else: ?>
<!--                    <a id="link---><?//= fmod($i,8) ?><!--" href="evenement.php?id=--><?//= $arrayNews[$i]['id_evenement'] ?><!--">-->
<!--                        <img id="link-img---><?//= fmod($i,8) ?><!--" src="http://--><?//= $arrayNews[$i]['chemin_evenement'] ?><!--" alt="Aliquam excepturi at architecto.">-->
<!--                    </a>-->
<!--                --><?php //endif ?>
<!--            </article>-->
<!--        --><?php //endfor ?>
<!--    </section>-->
    <section id="news" class="news">
        <?php for ($i = 0;$i < 8; $i++):?>
            <article id="tile-<?=$i?>" class="tile tile-<?=$i?>">
                    <a id="link-<?=$i?>" >
                        <img id="link-img-<?=$i?>">
                        <div id="tile-info-<?=$i?>" class="tile-info block-infos articles">
                            <div class="titre-auteur"><h2 class="infos merryweather taille1-trois " id="titre-<?=$i?>" ></h2>
                                <span class="infos merryweather taille0-huit" id="auteur-date-<?=$i?>"></span>
                            </div>
                            <div>
                                <a id="link-plus" class="link-img"><i class="fa-solid fa-circle-plus taille1"></i></a>
                            </div>
                        </div>
                    </a>
            </article>
        <?php endfor ?>
    </section>
    <section class="pagination">
        <a id="actu-prev" href="#news"> &larr; </a>
        <a id="actu-next" href="#news"> &rarr; </a>
    </section>
</main>
<script src="../js/fil_actu.js"></script>
<?php
    require_once('../include/footer.php');
?>