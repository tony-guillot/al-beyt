<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\EvenementController;
use AlBeyt\Library\Affichage;

$controllerEvenement = new EvenementController;

// supprimer un évènement.
if(isset($_GET['delete']))
{   
    $id = $_GET['delete'];
    $controllerEvenement->supprimeEvent($id);
}

if(isset($_GET['page'])){
    $page = $controllerEvenement->secure($_GET['page']);
}else{
    $page = 1;
}

$allEvents = $controllerEvenement->displayAllInfosEvent($page);

$totalEvents = count($controllerEvenement->displayAllInfosEvent());
$pageMax = ceil($totalEvents / EvenementController::NB_EVENEMENT_PAR_PAGE);


$title = 'Gestion evenement';
require_once('../include/headerBo.php');
?>
<?php require_once('../include/sidebar.php');?>
<main class="container">
    <h1 class="header">Gestion des évènements</h1>
    <section>
    </section>
    <section>
        <table class="stripped highlight">
            <thead>
                <th>Affiche</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Artiste.s</th>
                <th>Adresse</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
                <?php foreach($allEvents as $allEvent)
                {  $id_evenement = $allEvent['id'];
                   $artistsByEventId = $controllerEvenement->displayArtistsByEventId($id_evenement);
                    ?>
                    <tr>
                        <td><img class="imageGestion" src="http://<?= $allEvent['chemin']?>" alt="Affiche de l'evenement"></td>
                        <td><?= $allEvent['titre']?></td>
                        <td><?= $allEvent['description']?></td>
                        <td>
                            <?php foreach($artistsByEventId as $artists)
                                {   
                                echo  ' '.$artists['nom'].' </br>';
                                }?>
                        </td>
                        <td><?= $allEvent['adresse']?></td>
                        <td><?= $allEvent['date_evenement']?></td>
                        <td><?= $allEvent['heure']?></td>
                        <td> <a href="evenement_update.php?id=<?= $id_evenement?>"><i class="fa-solid fa-wrench"></i></a> </td>
                        <form action="" methode='get'>
                            <td>
                                <button class="button-trash" name="delete" type="submit" value='<?= $id_evenement?>'><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>            
            </tbody>
        </table>
    </section>
    <section class="container pagination center-align">
    <?php if ($page != 1): ?>
        <a href="evenement_gestion.php?page=<?= $page - 1 ?>">Page précédente</a>
    <?php endif ?>

    <?php for ($i = 1; $i <= $pageMax ; $i++): ?>
        <a <?= ($i == $page) ? Affichage::stylizeCurrentPage() : "" ?> href="evenement_gestion.php?page=<?= $i ?>"> <?= $i ?> </a>
    <?php endfor ?>

    <?php if ($page != $pageMax): ?>
        <a href="evenement_gestion.php?page=<?= $page + 1 ?>">Page suivante</a>
    <?php endif ?>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>







