<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

$title = '💜';
require_once('../include/headerBo.php');
?>

    
<main class="accueil">
<section>
        <?php require_once('../include/sidebar.php');?>
</section>
<section class="center-align">
    <img src="../../../images/al-beyt-copie2.gif" 
    alt="file:///Users/naomimonderer/Documents/al-beyt-copie2.gif" class="transparent">
</section>
</main>
<?php 
require_once('../include/footerBo.php');

?>
