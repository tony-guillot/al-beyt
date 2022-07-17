<?php
require_once '../../../vendor/autoload.php';
$title = "Evènement";
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;
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
?>

<main>
    <section>
        <section>
            <article>
                    <h1><?= $event['titre'] ?></h1>
            </article>
            <article>
                <span><?= $event['adresse'] ?></span>
                <span><?= $event['date_evenement'] ?> à <?= $event['heure'] ?></span>
                <span> avec
                    <?php
                    foreach ($artistes as $artiste) {
                    ?>
                        <a href="artiste.php?id=<?= $artiste['id'] ?>"><?= $artiste['nom'] ?></a>
                    <?php } ?>
                </span>
            </article>
        </section>
        <section>
            <article>
                <img src="http://<?= $images_event[0]['chemin'] ?>" alt="<?= $images_event[0]['legende'] ?>">
                <span><?= $images_event[0]['legende'] ?></span>
            </article>
        </section>
    </section>
    <hr />
    <section>
        <article>
            <p>
                <?= $event['description'] ?>
            </p>
        </article>
        <?php if (isset($images_event[1])): ?>
            <article>
                <div>
                    <img src="http://<?= $images_event[1]['chemin'] ?>" alt="<?= $images_event[1]['legende'] ?>">
                    <span><?= $images_event[1]['legende'] ?></span>
                </div>
            </article>
        <?php endif ?>
    </section>
</main>
<?php
require_once('../include/footer.php');
