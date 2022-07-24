<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;

$controllerEvenement = new EvenementController();

if(isset($_GET['page'])){
    $page = $controllerEvenement->secure($_GET['page']);
}else{
    $page = 1;
}
$totalEvenements = count($controllerEvenement->displayAllInfosEvent());
$pageMax = ceil($totalEvenements / EvenementController::NB_EVENEMENT_PAR_PAGE);
$startYear = date("Y", strtotime($controllerEvenement->displayAllInfosEvent()[$totalEvenements-1]['date_evenement']));

if(isset($_GET['year']))
{
    $year = $controllerEvenement->secure($_GET['year']);
    $events = $controllerEvenement->displayEventsByYear($year,$page);
}else{
    $events = $controllerEvenement->displayAllInfosEvent($page);
}

$title = "Evènements";
require_once('../include/header.php');
?>

<main class="contener">
    <section  class="sous-contener">
        <section class="filtre" >
            <ul>
                <li>
                    <a href="evenements.php">tous les evenements</a>
                </li>
                <?php for ($y = date("Y"); $y >= $startYear; $y--): ?>
                    <?php if (!empty($controllerEvenement->displayEventsByYear($y,1))): ?>
                        <li>
                            <a href="evenements.php?year=<?= $y ?>"><?= $y ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </section>
        <section class="box-cards-evenements">
            <?php foreach ($events as $event) { ?>
                <article class="cards-evenements">
                    <a href="evenement.php?id=<?= $event['id'] ?>">
                        <div class="box-parallax">
                            <img class="parallax" src="http://<?= $event['chemin'] ?>" alt="<?= $event['titre'] ?>"></div>
                        <div>
                            <div><h2><?= $event['titre'] ?></h2>
                                <span><?= Affichage::printDate($event['date_evenement']) ?></span>
                            </div>
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </a>
                </article>
            <?php } ?>
        </section>
    </section>
    <section class="conteneur-page">
        <?php if ($page != 1): ?>
            <a href="evenements.php?page=<?= $page - 1 ?><?= isset($year) ? "&year=".$year : "" ?>">Page précédente</a>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a  <?= ($i == $page) ? Affichage::stylizeCurrentPage() : "" ?> href="evenements.php?page=<?= $i ?><?= isset($year) ? "&year=".$year : "" ?>"> <?= $i ?> </a>
        <?php endfor ?>
        <?php if ($page != $pageMax): ?>
            <a href="evenements.php?page=<?= $page + 1 ?><?= isset($year) ? "&year=".$year : "" ?>">Page suivante</a>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
?>