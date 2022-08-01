<?php 
 require_once '../../../vendor/autoload.php';

 use AlBeyt\Controllers\ArticleController;

 $controllerArticle = new ArticleController();

 if(isset($_GET['id']))
{
    $id = $controllerArticle->secure($_GET['id']);
}
// var_dump($arrayNews);
$newArrayImagesArticle = $controllerArticle->displayImagesByIdArticle($id);

echo json_encode($newArrayImagesArticle);

?>