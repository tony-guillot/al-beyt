<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;

$artists = New ArtisteController;
$pageCourante = 1;
$displayAllArtists = $artists->displayAllArtists($pageCourante);
$displayAllArtistsByDomain= $artists->displayAllArtistsByDomain($id_domain,$pageCourante);

 
echo '<pre>';
// echo "displayAllArtistsByDomain domaine:3 art page courante:3 </br>";
// var_dump($displayAllArtistsByDomain = $artists->displayAllArtistsByDomain(2,1));
// echo '</br> </br> </br> </br>';
// var_dump($artists->displayAllArtists(2));
echo '</br> </br> </br> </br>';
var_dump($artists->displayAllArtists(1));
echo '</br> </br> </br> </br>';

// echo "artists->displayAllArtists 2 </br>";
// var_dump($artists->displayAllArtists(4));
echo '</pre>';
?>
<main>
    <section>
        <?php
            // foreach($artists as $allArtists)
            // {
            //     echo $allArtiste[''];
            // }        
        ?>
    </section>
</main>    