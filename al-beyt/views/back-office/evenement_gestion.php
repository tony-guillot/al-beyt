<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;
$controller = New EvenementController;


$allEvents = $controller->displayAllInfosEvent();




echo '<pre>';
// var_dump($allEvents['id']);
// var_dump($allEvents);
echo '</pre>';
?>
<main>
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
                var_dump($id_evenement);
               $artistsByEventId = $controller->displayArtistsByEventId($id_evenement);
               echo '<pre>';
               var_dump($artistsByEventId);
               echo '</pre>';
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
                    <td> <a href="evenement_update.php?id=<?= $id_evenement?>">modifier l'évènement</a> </td>
                    <td></td>

                </tr>
            <?php } ?>            
            </tbody>
        </table>
    

</main>




