<?php
require_once '../../../vendor/autoload.php';
require_once('../include/headerBo.php');


use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();
var_dump($_SESSION);




$title = '💜';


?>
<main class="accueil">
<img src="../../../images/al-beyt-copie2.gif" 
alt="file:///Users/naomimonderer/Documents/al-beyt-copie2.gif" class="transparent">
    <section>
        <?php require_once('../include/sidebar.php');?>
    </section>
    <section>

    </section>
</main>
<?php 
require_once('../include/footerBo.php');

?>
