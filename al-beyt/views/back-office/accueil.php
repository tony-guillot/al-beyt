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
<section class="center-align back-office">
    <span>مساحة الإدارة</span>
 </section>
</main>
<?php 
require_once('../include/footerBo.php');

?>
