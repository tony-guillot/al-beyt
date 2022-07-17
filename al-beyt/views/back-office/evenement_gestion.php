<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;
$controller = New EvenementController;
$allEvents = $controller->displayAllInfosEvent();

// supprimer un évènement.
if(isset($_GET['delete']))
{   
    $id = $_GET['delete'];
    $supprime = $controller->supprimeEvent($id);
   
}
?>

<main>
    <section>
        <table>
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
                   $artistsByEventId = $controller->displayArtistsByEventId($id_evenement);
                    ?>
                    <tr>
                        <td><?= $allEvent['chemin']?></td>
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
                                <button name="delete" type="submit" value='<?= $id_evenement?>'><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>            
            </tbody>
        </table>
    </section>    
</main>
<?php 
require_once('../include/footer.php');
?>







