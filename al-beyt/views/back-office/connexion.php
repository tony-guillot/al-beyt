<?php

require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ConnexionController;



if(isset($_POST['submit']))
{
    $controller = New ConnexionController();
    $AdminData = $controller->connexion($_POST['identifiant'], $_POST['mot_de_passe']);
  
}
?>
<main class="page_connexion">
    <section>
        <h1>Connexion</h1>
        <form action="" method="post">
            <div>
                <label for="identifiant">Email:</label>
                <input type="text" name="identifiant" id="login">
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" name="mot_de_passe" id="password">
            </div>

            <input class="btn" type="submit" name="submit" value="valider">
        </form>
        <?php 
        // if(isset($check))
        //     {
        //         echo $check;
        //     }
        ?>
    </section>     
</main>
<?php
var_dump('connexion');
var_dump($_SESSION);
?>




