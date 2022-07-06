<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;
$artist = New ArtisteController;




$displayArtistById = $artist->displayArtistById($id_artiste);
$displayEventByIdArtist = $artist->displayEventsByIdArtist($id_artiste,$pageCourante);

echo '<pre>';
var_dump($displayArtistById = $artist->displayArtistById(1));
var_dump($displayArtistById = $artist->displayArtistById(2));
var_dump($displayArtistById = $artist->displayArtistById(3));
var_dump($displayArtistById = $artist->displayArtistById(10));
echo '</pre>';


echo '<pre>';
var_dump($displayEventByIdArtist = $artist->displayEventsByIdArtist(1));
var_dump($displayEventByIdArtist = $artist->displayEventsByIdArtist(2));

echo '</pre>';


?>
<main>
    <section>
        
    </section>
    <section>
        <article>
           
        </article>
    </section>
</main>