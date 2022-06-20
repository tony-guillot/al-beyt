
    <?php

    require_once('../include/header.php');
    use \Controllers\EvenementController; 
   
    
    $event = New EvenementController;
    
    $all_event = $event->displayEvent();

    var_dump($all_event);
     

    ?>
