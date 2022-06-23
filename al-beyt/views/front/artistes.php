<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;

$artists = New ArtisteController;
// $pageCourante = 2;
$displayAllArtists = $artists->displayAllArtists(2);
// $displayAllArtists = $artists->displayAllArtists(5);

 
echo '<pre>';
echo "artists->displayAllArtists 2 </br>";
var_dump($artists->displayAllArtists(1));
echo '</br> </br> </br> </br>';
var_dump($artists->displayAllArtists(2));
echo '</br> </br> </br> </br>';
var_dump($artists->displayAllArtists(3));
echo '</br> </br> </br> </br>';

echo "artists->displayAllArtists 2 </br>";
var_dump($artists->displayAllArtists(4));
echo '</pre>';
?>
