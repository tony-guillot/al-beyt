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
    <section class="box1">
        <section class="bandeau">
        <article class="logo-index">
                <img  class="logo-gif" src="../../../images/al-beyt-violet.gif" 
                alt="logo 3D rotatif" class="transparent">
            </article>
        </section>
        <section class="box-prochain-event">
            <section class="box-title-prochain-evenement">
                <h2  class="title-index prochain-evenement"><span style ="font-size:1.9em; font-weight:100;">P</span>ROChaiN  EveNeMenT</h2>
            </section>
            <section class="index-parent-event">
            
                <article class="parent-index-affiche linear-gradiant">
                    <a href="evenement.php?id=<?= $lastEvent['id']?>">
                        <img  class="index-affiche" src="http://<?= $lastEvent['chemin'] ?>" alt="Affiche Prochain évènement Al-Beyt" >
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
        </section>

     </section>

                <!-- <hr class="hr-event"> -->
    
        <section class="index-artistes">
            <section class="titre2">
                    <h2 class="title-index ">DEcouvrez nos Artistes prEfEre.es</h2>
            </section>
            <section class="box-names">
                <section class="parent-shuffle">
                    <?php for($i = 0; $i < 20; $i++):?>
                    <article class="names">
                    <a class="link-names gradient-text" href="artiste.php?id=<?= $artists[$i]['id']?>"><em><?=$artists[$i]['nom'];?></em></a>
                    <!-- <p>&emsp;&emsp;&emsp;✴</p>  -->
                    <p>&emsp;</p> 
                    </article>
                    <?php endfor;?>
                </section>
            </section>
    </section>
   
    <section id="news" class="news box-cards" style="flex-direction: row;">
    <h2 class="title-index fil-actu">Suivez vos Actualites...</h2>
        <?php for ($i = 0;$i < 8; $i++):?>
            <article id="tile-<?=$i?>" class="tile tile-<?=$i?>">
                    <a id="link-<?=$i?>">
                        <img id="link-img-<?=$i?>">
                    </a>
                    <div id="tile-info-<?=$i?>" class="tile-info block-infos articles">
                        <div class="titre-auteur"><h2 class="infos merryweather taille1-trois " id="titre-<?=$i?>" ></h2>
                            <span class="infos merryweather taille0-huit" id="auteur-date-<?=$i?>"></span>
                        </div>
                        <div>
                            <a id="link-plus-<?=$i?>" class="link-img"><i class="fa-solid fa-circle-plus taille1"></i></a>
                        </div>
                    </div>
            </article>
        <?php endfor ?>
    </section>
    <section class="pagination-actu">
        <a id="actu-prev" href="#news"> &#12298; </a>
        &ensp;
        <a id="actu-next" href="#news"> &#12299; </a>
    </section>
</main>
<script src="../js/fil_actu.js"></script>
<?php
    require_once('../include/footer.php');
?>