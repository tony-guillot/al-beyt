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
<section style="font-size:10em;color:grey;" class="center-align">
    <span>مساحة الإدارة</span>
 </section>
</main>
<?php 
require_once('../include/footerBo.php');

?>
