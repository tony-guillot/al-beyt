<?php
session_start();
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ConnexionController;

if(isset($_POST['submit']))
{
    $controller = new ConnexionController();
    $controller->connexion($_POST['identifiant'], $_POST['mot_de_passe']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Materialize CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Materialize JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Materialize icone -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/back-office.css">
    <title>Back-office | connexion</title>
</head>

<body class="body-connexion">
    <main class="connexion container valign-wrapper">
        <section class=" card-panel ">
         <img class="center" style='width:100px;' src ="../../../images/logo.png">
            <form class="typo" action="" method="post" class="col s12 ">
                <div>
                    <label  class=" purple-text text-lighten-2 " for="identifiant"> Email administrateur:</label>
                    <input type="text" name="identifiant" id="login" placeholder="admin@domaine.com">
                </div>
                <div>
                    <label class=" purple-text text-lighten-2 "  for="mot_de_passe">Mot de passe:</label>
                    <input type="password" name="mot_de_passe" id="password">
                </div>
                <div id="error-section" class=" red-text text-lighten-3 valign-wrapper z-depth-0">
                    <i id="error-icon" class="material-icons"></i> &ensp;
                    <p id="error-text"></p>
                </div>
                    <input class="btn purple darken-2 valign-wrapper" type="submit" name="submit" value="valider">
            </form>
        </section>     
    </main>
</body>
</html>





