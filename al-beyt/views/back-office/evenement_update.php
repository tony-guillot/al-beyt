<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

use AlBeyt\Controllers\EvenementController;
$controller = New EvenementController;

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
    $imagesEvent = $controller->displayImagesByEventId($id);
}else{
    header('Location: evenement_gestion.php'); //on redirige vers la page de gestion
    exit;
}


if(isset($_POST['valider']))
{   

    $controller->modifyEvent(  $_POST['titre'],
                                                $_POST['adresse'],
                                                $_POST['date'],
                                                $_POST['heure'],
                                                $_POST['description'],
                                                $id
                                            );
}

if(isset($_POST['image']))
{
     $id_evenement = intval($id);
    if(!empty($imagesEvent[1]) )
    {     
        $controller->modifyImagesEvent( $_FILES['image_en_avant'],
        $_POST['legende_en_avant'],
        $_POST['ordre_image_en_avant'],
        $_FILES['image2'],
        $_POST['legende2'],
        $_POST['ordre_image2'],
        $id_evenement
       );

       $controller->modifyLegende($_POST['legende_en_avant'],$_POST['ordre_image_en_avant'],$id_evenement);
       $controller->modifyLegende($_POST['legende2'],$_POST['ordre_image2'],$id_evenement);
    }
    else
    {
        $controller->modifyImage($_FILES['image_en_avant'],
                                                $_POST['legende_en_avant'],
                                                $_POST['ordre_image_en_avant'],
                                                $id_evenement);
        $controller->modifyLegende($_POST['legende_en_avant'],$_POST['ordre_image_en_avant'],$id_evenement);
        $controller->registerImage($_FILES['image2'],
                                                $_POST['legende2'],
                                                $id_evenement,
                                                $_POST['ordre_image2']);
        //$controller->modifyLegende($_POST['legende2'],$_POST['ordre_image2'],$id_evenement);

    }
    
   
}

$event = $controller->displayEventById($id);
$imagesEvent = $controller->displayImagesByEventId($id);

//si  il n'y a aucune image 2 en bdd on insert sinon on remplace.


// l'image 1 est toujours remplie. si tu soumets le formulaire il faut dans tout les cas submit les données de l'image 1 est
// si l'image 2 est vide il faut inserer sinon il faut udpate.
$imagesEvent = $controller->displayImagesByEventId($id);

$title = 'Modif evenement';
require_once('../include/headerBo.php');
require_once('../include/sidebar.php');
?>
<main class="container">
    <section class="row formulaire container">
        <section class="col s12 ">
            <a href="evenement_gestion.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
            <h1>Modifier l'évènement</h1> 
        </section>
        <section class="form-bloc">

        
        <section class="col s6">
            <h2> Informations de l'évènement:</h2>
            <form  class="typo" action="" method="post" >
                <article>
                    <div class="margin">
                        <label class=" purple-text text-lighten-3" for="titre">Titre:</label>
                        <input class="grey-text text-darken-2"  class="grey-text text-darken-2" type="text" name="titre" value="<?= $event['titre']?>">
                    </div>
                    <div class="margin">
                        <label class=" purple-text text-lighten-3" for="adresse">Adresse:</label>
                        <input class="grey-text text-darken-2"  type="text" name="adresse" value="<?= $event['adresse'] ?>">
                    </div>
                    <div class="margin">
                        <label class=" purple-text text-lighten-3" for="date">Date:</label>
                        <input class="grey-text text-darken-2"  type="date" name="date" value="<?= $event['date_evenement'] ?>" >
                    </div>
                    <div class="margin">
                        <label class=" purple-text text-lighten-3" for="heure">Heure de début:</label>
                        <input class="grey-text text-darken-2"  type="text" value="<?= $event['heure'] ?>" name="heure">
                    </div>
                </article>
                <article>
                    <div class="margin">
                        <label class=" purple-text text-lighten-3" for="description">Description de l'évènement:</label>
                        <textarea class="materialize-textarea" style="height: 600px;border: 0.5px solid gray" name="description"><?= $event['description'] ?></textarea>
                    </div>
                </article> 
                <button class="btn waves-effect btn-large waves-light col s12" type="submit" name="valider" value="Sauvegarder">Mettre à jour les informations de l'évènement
            <i class="material-icons right">date_range</i>
        </button>
        <!--<input type="submit" name="image" value="Sauvegarder">-->
        </form>
        </section>
        <section class="col s6">
            <h2> Images de l'évènement:</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <section>
                    <h3 class=" purple-text text-darken-2">Modifier l'affiche</h3>
                    <article>
                        <div class="margin">
                            <label class=" purple-text text-lighten-3" for="image_en_avant">Choisir un nouvelle affiche:</label></br>
                            <input class="grey-text text-darken-2"  type="file" name="image_en_avant" placeholder="">
                            <input class="grey-text text-darken-2"  type="hidden" name="ordre_image_en_avant" value="1">
                        </div>
                        <div class="margin">
                        <label class=" purple-text text-lighten-3" for="">Affiche Actuelle:</label>
                        <img src="http://<?= $imagesEvent[0]['chemin']?>" alt=""> </br>
                        </div>
                    </article>
                    <article>
                        <div class="margin">
                            <label class=" purple-text text-lighten-3" for="legende_en_avant"> Légende:</label>
                            <input class="grey-text text-darken-2"  type="text" name="legende_en_avant" value="<?= $imagesEvent[0]['legende']?>" placeholder="">
                        </div>
                    </article>
                </section>
                <section>
                    <h3 class=" purple-text text-darken-2">Modifier l'image complémentaire</h3>
                   <article>
                        <div class="margin">
                            <label class=" purple-text text-lighten-3" for="image2">Choisir une image complémentaire:</label> </br>
                            <input class="grey-text text-darken-2"  type="file" name="image2">
                            <input class="grey-text text-darken-2"  type="hidden" name="ordre_image2" value="2">
                        </div>
                        <div class="margin">
                            <label class=" purple-text text-lighten-3" for=""> Image complémentaire actuelle:</label>
                            <?php
                                if(!empty($imagesEvent[1]['chemin'])):?>
                            <img style="width:100%;" class="image" id="image1" src="http://<?= $imagesEvent[1]['chemin']?>" alt=""></br>
                            <?php else:?>
                                <img style="width:100%" class="image" src="http://al-beyt.moi/images/placeholder.jpg" alt="image vide">
                            <?php endif?>
                        </div>
                    </article>

                    <article>
                        <div class="margin">
                            <label class=" purple-text text-lighten-3" for="legende2">Légende complémentaire:</label>
                            <input class="grey-text text-darken-2"  type="text" value="<?= $imagesEvent[1]['legende'] ?? "" ?>" name="legende2">
                        </div>
                    </article>
                </section>
                <section>
                    <button class="btn waves-effect waves-light col s6" type="submit" name="image" value="sauvegarder"> 
                        Mettre à jour les images
                        <i class="material-icons right">photo_library</i>
                    </button>
                </section>
            </form>
            </section>
        </section>
    </section>
</main>
<?php
require_once('../include/footerBo.php');
?>