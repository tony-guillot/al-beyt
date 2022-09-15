<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

use AlBeyt\Controllers\ArtisteController;
use AlBeyt\Library\Affichage;

$controller = New ArtisteController;

if(isset($_GET['page'])){
    $page = intval($_GET['page']);
}else{
    $page = 1;
}

$allInfoArtists = $controller->displayAllInfoArtists($page);
$totalArtists = count($controller->displayAllInfoArtists());
$pageMax = ceil($totalArtists / ArtisteController::NBR_ARTISTE_PAR_PAGE);

$title = 'Gestion artistes';
require_once('../include/headerBo.php');
?>
<?php require_once('../include/sidebar.php');?>
<main class="container">
    <h1 class="header">Gestion des artistes</h1>
    <section>
        <table class="table centered highlight table-gestion">
            <thead>
                   <th>Image</th>
                   <th>Legende </th>
                   <th>Allias/Nom</th>
                   <th>Description</th>
                   <th>Pôle</th>
                   <th>Email</th>
            <!--   <th>Site Web</th>
                   <th>Instagram</th>
                   <th>Soundcloud</th>
                   <th>Facebook</th>
                   <th>Twitter</th> -->
                   <th>Modifier</th>
                   <th>Statut</th>
            </thead>
            <tbody>
                <?php foreach($allInfoArtists as $artist)
                {  ?>
                    <tr class='row color-hover border'>
                        <td><img class="imageGestion" src="http://<?= $artist['chemin']?>" alt="Image principale"></td>
                        <td><?= $artist['legende']?></td>
                        <td><?= $artist['nom']?></td>
                        <td><?= substr($artist['description'],0,300).'[...]'?></td>
                        <td><?= $artist['domaine']?></td>
                        <td><?php
                            if(!empty($artist['email']))
                            {
                               echo $artist['email'];
                            }
                            else
                            {
                                echo 'aucun email enregistré';
                            }
                            ?>
                        </td>
                   <!-- <td><?= $artist['website']?></td>
                        <td><?= $artist['lien_insta']?></td>
                        <td><?= $artist['lien_soundcloud']?></td>
                        <td><?= $artist['lien_facebook']?></td>
                        <td><?= $artist['lien_twitter']?></td> -->
                        <td class="buttons"><a href="artiste_update.php?id=<?=  $artist['id_artiste']?>" title="Editer"><i class="edit material-icons grey-text text-darken-4">edit</i></td>
                        <td class="buttons">
                            <?php if($artist['statut'] == 1)
                                {echo '<i class="material-icons">visibility</i>';}
                                else
                                {echo '<i class="material-icons">visibility_off</i>';} ?>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
    <section class="container pagination center-align">
    <?php if ($page != 1): ?>
        <a href="artiste_gestion.php?page=<?= $page - 1 ?>">Page précédente</a>
    <?php endif ?>

    <?php for ($i = 1; $i <= $pageMax ; $i++): ?>
        <a <?= ($i == $page) ? Affichage::stylizeCurrentPage() : "" ?> href="artiste_gestion.php?page=<?= $i ?>"> <?= $i ?> </a>
    <?php endfor ?>

    <?php if ($page != $pageMax): ?>
        <a href="artiste_gestion.php?page=<?= $page + 1 ?>">Page suivante</a>
    <?php endif ?>
    </section>
</main>
<?php 
require_once('../include/footerBo.php');
?>  
