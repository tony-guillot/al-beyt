<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;

$controller = New ArtisteController;
$pageCourante = 1;
$artists = $controller->displayAllArtists();
$displayAllArtistsByDomain= $controller->displayAllArtistsByDomain($id_domaine);

 
echo '<pre>';
// echo "displayAllArtistsByDomain domaine:3 art page courante:3 </br>";
// var_dump($displayAllArtistsByDomain = $artists->displayAllArtistsByDomain(2,1));
// echo '</br> </br> </br> </br>';
// var_dump($artists->displayAllArtists(2));
echo '</br> </br> </br> </br>';
var_dump($artists->displayAllArtists());
echo '</br> </br> </br> </br>';

// echo "artists->displayAllArtists 2 </br>";
// var_dump($artists->displayAllArtists(4));
echo '</pre>';
?>
<main>

    <?php foreach($artists as $artist)
    { ?>
        <div>
            <a href="artiste_update.php?id=<?= $artist['id']?>">
                <img src="<?= $artist['chemin']?>">
                <div><?= $artist['nom']?></div>
            </a>
        </div>
    <?php } ?>
</main>    
   