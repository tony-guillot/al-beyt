<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\EvenementController;

$event = new EvenementController;

echo "displayAllEvent( ) :<br />";
var_dump($event->displayAllEvent());
echo "<br /><br /><br />";


echo "displayAllEventByYear(2031) :<br />";
var_dump($event->displayEventByYear(2031));
echo "<br /><br /><br />";

echo "displayAllEventByYear(2022) :<br />";
var_dump($event->displayEventByYear(2022));
echo "<br /><br /><br />";

echo "displayAllEventByYear(2012) :<br />";
var_dump($event->displayEventByYear(2012));
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



?>