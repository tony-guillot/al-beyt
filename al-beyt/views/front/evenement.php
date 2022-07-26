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
        <section class="bloc-info">
            <article class="titre">
                    <h1><?= $event['titre'] ?></h1>
            </article>
            <article class="infos">
                <span><?= $event['adresse'] ?></span>
                <span><?= Affichage::printDate($event['date_evenement']) ?> à <?= $event['heure'] ?></span>
                <span> avec
                    <?php
                    foreach ($artistes as $artiste) {
                    ?>
                        <a href="artiste.php?id=<?= $artiste['id'] ?>"><?= $artiste['nom'] ?></a>
                    <?php } ?>
                </span>
            </article>
        </section>
        <section class="affiche">
            <article>
                <img style="width:300px" src="http://<?= $images_event[0]['chemin'] ?>" alt="<?= $images_event[0]['legende'] ?>">
                <span><?= $images_event[0]['legende'] ?></span>
            </article>
        </section>
    </section>
    <hr />
    <section class="contener2">
        <article class="description">
            <p>
                <?= $event['description'] ?>
            </p>
        </article >
        <?php if (isset($images_event[1])): ?>
            <article class="image2">
                <div>
                    <img  style="width:300px"  src="http://<?= $images_event[1]['chemin'] ?>" alt="<?= $images_event[1]['legende'] ?>">
                    <span><?= $images_event[1]['legende'] ?></span>
                </div>
            </article>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
