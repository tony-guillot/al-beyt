<?php
require_once '../../../vendor/autoload.php';
$title = "Evènements";
require_once('../include/header.php');
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


if(isset($_GET['year']))
{
    $year = $controllerEvenement->secure($_GET['year']);
    $events = $controllerEvenement->displayEventsByYear($year,$page);
}else{
    $events = $controllerEvenement->displayAllInfosEvent($page);
}

?>

<main>
    <section>
        <section>
            <ul>
                <li>
                    <a href="evenements.php">tous les evenements</a>
                </li>
                <?php for ($y = date("Y"); $y >= 2021; $y--): ?>
                    <li>
                        <a href="evenements.php?year=<?= $y ?>"><?= $y ?></a>
                    </li>
                <?php endfor ?>
            </ul>
        </section>
        <section>
            <?php foreach ($events as $event) { ?>
                <article>
                    <a href="evenement.php?id=<?= $event['id'] ?>">
                        <img src="http://<?= $event['chemin'] ?>" alt="<?= $event['titre'] ?>">
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
    <section>
        <?php if ($page != 1): ?>
            <a href="evenement.php?page=<?= $page - 1 ?>">Page précédente</a>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pageMax; $i++): ?>
            <a href="evenement.php?page=<?= $i ?>"> <?= $i ?> </a>
        <?php endfor ?>
        <?php if ($page != $pageMax): ?>
            <a href="evenement.php?page=<?= $page + 1 ?>">Page suivante</a>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
?>