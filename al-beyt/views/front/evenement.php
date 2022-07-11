<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;

$event = new EvenementController;
echo '<pre>';
echo "displayAllEvent(page : 1) :<br />";
var_dump($event->displayAllEvents(1));
echo "<br /><br /><br />";
echo "displayAllEvent(page : 2) :<br />";
var_dump($event->displayAllEvents(2));
echo "<br /><br /><br />";
echo "displayAllEvent(page : 2) :<br />";
var_dump($event->displayAllEvents(2));
echo "<br /><br /><br />";

echo "displayAllEventByYear(2031, page : 1) :<br />";
var_dump($event->displayEventsByYear(2031,1));
echo "<br /><br /><br />";

echo "displayAllEventByYear(2022, page : 1) :<br />";
var_dump($event->displayEventsByYear(2022,1));
echo "<br /><br /><br />";
echo "displayAllEventByYear(2022, page : 2) :<br />";
var_dump($event->displayEventsByYear(2022,2));
echo "<br /><br /><br />";

echo "displayAllEventByYear(2012, page : 1) :<br />";
var_dump($event->displayEventsByYear(2012,1));
echo "<br /><br /><br />";

echo "displayEventById(1) :<br />";
var_dump($event->displayEventById(1));
echo "<br /><br /><br />";
echo "displayEventById(2) :<br />";
var_dump($event->displayEventById(2));
echo "<br /><br /><br />";
echo "displayEventById(3) :<br />";
var_dump($event->displayEventById(3));
echo "<br /><br /><br />";


echo "displayImagesByEvenementId(1) :<br />";
var_dump($event->displayImagesByEvenementId(1));
echo "<br /><br /><br />";
echo "displayImagesByEvenementId(2) :<br />";
var_dump($event->displayImagesByEvenementId(2));
echo "<br /><br /><br />";
echo "displayImagesByEvenementId(3) :<br />";
var_dump($event->displayImagesByEvenementId(3));
echo "<br /><br /><br />";



echo '<pre />';

?>