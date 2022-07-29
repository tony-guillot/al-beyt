<?php
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\EvenementController;

if(isset($_GET['page'])){
    $page = intval($_GET['page']);
}else{
    $page = 1;
}

$controllerEvent = new EvenementController();
$arrayNews = $controllerEvent->displayLastArticlesAndEvents($page);
$totalNews = $controllerEvent->displayCountLastArticlesAndEvents();
$pageMax = ceil($totalNews/8);

$response = [
    'news' => $arrayNews,
    'pageMax' => $pageMax
];

echo json_encode($response);

/*echo '<pre>';
var_dump($response);
echo '</pre>';*/