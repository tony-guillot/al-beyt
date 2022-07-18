<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\EvenementController;
$controller = New EvenementController;

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
    $event = $controller->displayEventById($id);
}

$displayImagesByEventId = $controller->displayImagesByEventId($id);

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
    if(!empty($displayImagesByEventId[1]) )
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
    }
    
   
}
$imagesEvent = $controller->displayImagesByEventId($id);

$title = 'Modif evenement';
require_once('../include/headerBo.php');
?>
<main>
    <section>
        <?php require_once('../include/sidebar.php');?>
    </section>
    <section>
        <section>
            <a href="artiste_gestion.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
            <h1>Modifier l'évènement</h1> 
        </section>
        <section>
            <h2> Informations de l'évènement:</h2>
            <form action="" method="post" >
                <article>
                    <div>
                        <label for="titre">Titre:</label>
                        <input type="text" name="titre" value="<?= $event['titre']?>">
                    </div>
                    <div>
                        <label for="adresse">Adresse:</label>
                        <input type="text" name="adresse" value="<?= $event['adresse'] ?>">
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="date" name="date" value="<?= $event['date_evenement'] ?>" >
                    </div>
                    <div>
                        <label for="heure">Heure de début:</label>
                        <input type="text" value="<?= $event['heure'] ?>" name="heure">
                    </div>
                </article>
                <article>
                    <div>
                        <label for="description">Description de l'évènement:</label>
                        <textarea name="description"><?= $event['description'] ?></textarea>
                    </div>
                </article> 
                <article>
                    <input type="submit" name="valider" value="sauvegarder">
                </article>
            </form>
        </section>
        <section>
            <h2> Images de l'évènement:</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <article>
                    <article>
                        <div>
                            <label for="image_en_avant">Affiche:</label></br>
                            <img src="http://<?= $imagesEvent[0]['chemin']?>" alt=""> </br>
                        </div>  
                        <div>
                            <label for="legende_en_avant"> Légende:</label>
                            <input type="text" name="legende_en_avant" value="<?= $imagesEvent[0]['legende']?>" placeholder="">
                        </div>
                    </article>
                    <article>
                        <div>
                            <input type="file" name="image_en_avant" placeholder="">
                            <input type="hidden" name="ordre_image_en_avant" value="1">
                        </div>
                    </article>
                </article>
                <article>
                    <article>
                        <div>
                            <label for="image2">Image complémentaire:</label> </br>
                            <img src="http://<?= $imagesEvent[1]['chemin'] ?? ""?>" alt=""> </br>
                        </div>
                        <div>
                            <label for="legende2">Légende complémentaire</label>
                            <input type="text" value="<?= $imagesEvent[1]['legende'] ?? "" ?>" name="legende2">
                        </div>
                    </article>
                    <article>
                        <div>
                            <input type="file" name="image2">
                            <input type="hidden" name="ordre_image2" value="2">
                        </div>
                    </article>
                </article>
                <article>
                    <input type="submit" name="image" value="Sauvegarder">
                </article>
            </form>
        </section>
    </section>
</main>
<?php 
require_once('../include/footer.php');
?>