<?php
session_start();
require_once '../../../vendor/autoload.php';

use AlBeyt\Controllers\ConnexionController;



if(isset($_POST['submit']))
{
    $controller = New ConnexionController();
    $AdminData = $controller->connexion($_POST['identifiant'], $_POST['mot_de_passe']);
  
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

    <link rel="stylesheet" href="../css/back-office.css">
    <title>Back-office | connexion</title>
</head>
<body>
    <main class="connexion container valign-wrapper  ">
        <section class=" card-panel ">
            <h1>Connexion</h1>
            <form action="" method="post" class="col s12 ">
                <div >
                    <label for="identifiant">Email:</label>
                    <input type="text" name="identifiant" id="login">
                </div>
                <div>
                    <label for="mot_de_passe">Mot de passe:</label>
                    <input type="password" name="mot_de_passe" id="password">
                </div>

                <input class="btn" type="submit" name="submit" value="valider">
            </form>
        </section>     
    </main>
</body>
</html>
<?php
// var_dump('connexion');
// var_dump($_SESSION);
?>




