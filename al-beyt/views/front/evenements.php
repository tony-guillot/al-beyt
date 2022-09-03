<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;

$controllerEvenement = new EvenementController();

if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $controllerEvenement->secure($_GET['page']);
}else{
    $page = 1;
}

if(isset($_GET['year']) && !empty($_GET['year']))
{
    $year = $controllerEvenement->secure($_GET['year']);
    $events = $controllerEvenement->displayEventsByYear($year,$page);
    $totalEvenements = count($controllerEvenement->displayEventsByYear($year));
}else{
    $events = $controllerEvenement->displayAllInfosEvent($page);
    $year = 0;
    $totalEvenements = count($controllerEvenement->displayAllInfosEvent());
}

$pageMax = ceil($totalEvenements / EvenementController::NB_EVENEMENT_PAR_PAGE);
$yearFilter = $controllerEvenement->displayYearFilters();

$title = "Evènements";
require_once('../include/header.php');
?>

<main class="contener">
    <section  class="sous-contener">
        <section class="filtre">
            <ul class="merryweather liens-filtre taille0-huit">
                <li class="filtre">
                    <a  class="filtre" <?= (empty($year)) ? Affichage::stylizeCurrentFilter() : "" ?> class="" href="evenements.php">Tous les évènements</a>
                </li>
                <?php foreach ($yearFilter as $y): ?>
                        <li class="filtre">
                            <a class="filtre" <?= ($y['year'] == $year) ? Affichage::stylizeCurrentFilter() : "" ?> href="evenements.php?year=<?= $y['year'] ?>"><?= $y['year'] ?></a>
                        </li>
                <?php endforeach ?>
            </ul>
        </section>
        <section class="box-cards">
            <?php foreach ($events as $event) { ?>
                <article class="cards animation2 animation">
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
    </section>
    <section class="conteneur-page inter">
        <?php if ($page != 1): ?>
            <a href="evenements.php?page=<?= $page - 1 ?><?= !empty($year) ? "&year=".$year : "" ?>"> &#12298; </a>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a  <?= ($i == $page) ? 'class="page-active"' : "" ?> href="evenements.php?page=<?= $i ?><?= !empty($year) ? "&year=".$year : "" ?>"> <?= $i ?> </a>
        <?php endfor ?>
        <?php if ($page != $pageMax): ?>
            <a href="evenements.php?page=<?= $page + 1 ?><?= !empty($year) ? "&year=".$year : "" ?>"> &#12299; </a>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
?>