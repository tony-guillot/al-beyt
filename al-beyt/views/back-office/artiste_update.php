<?php
require_once '../../../vendor/autoload.php';
session_start();
use AlBeyt\Controllers\Controller;
$controller = new Controller();
Controller::secureBackOffice();

use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;
$domains = $controller->displayAllDomains();

if($_GET['id'])
{
    $id = intval($_GET['id']);
    $artist = $controller->displayArtistById($id);
}

if(isset($_POST['submit']))
{   
   
    if(isset($_POST['statut']) && $_POST['statut'] ==1)
    {
        $statut = 1;
    }else
    {
        $statut = 0;
    }

    $controller->modifyArtist(
    $_POST['website'],
    $_POST['nom'],
    $_POST['description'],
    $_POST['email'],
    $_POST['insta'],
    $_POST['soundcloud'],
    $_POST['facebook'],
    $_POST['twitter'],
    $statut,
    $_POST['id_domaine'],
    $id);

    $artist = $controller->displayArtistById($id);
}


if(isset($_POST['replace_image']))
{
    $id_artiste = intval($id);
    $controller->modifyImageArtist($_FILES['image'], $_POST['legende'], $id_artiste);
    $controller->modifyLegende($_POST['legende'], $id_artiste);
    $artist = $controller->displayArtistById($id);
}

$title = 'Modification artiste';
require_once('../include/headerBo.php');
require_once('../include/sidebar.php');
?>
<main class="container">
    <section class="update-headings">
        <a class="gestion-retour" href="artiste_gestion.php">
            <i class="material-icons tooltipped medium" data-position="bottom"  data-tooltip="Retour vers la page de gestion" >keyboard_arrow_left</i>
        </a>
        <h1>Modifier <?php echo $artist['nom']?></h1>
    </section>
    <section class="row formulaire ">
        <section class="col s6">
            <h2>Informations:</h2>
            <form action="artiste_update.php?id=<?=$artist['id_artiste']?>" method="post">
                <article class="margin">
                    <label class=" purple-text text-lighten-3">Visibilité de l'artiste :</label>
                    <label class="switch">
                        <?php if($artist['statut']==1){?>
                           
                            <input class="grey-text text-darken-2" type="checkbox" name="statut"  value=1 checked>
                          
                        <?php }else{ ?>
                    
                            <input class="grey-text text-darken-2" type="checkbox" name="statut" value=1>
                            
                            <?php }?>
                        
                        <span class="slider round"></span>
                    </label>
                </article>
                <section>
                    <article class="margin">
                        <label class=" purple-text text-lighten-3"  for="nom">Allias ou Nom:</label>
                        <input class="grey-text text-darken-2" type="text" placeholder="King Tubby" name="nom" value="<?= $artist['nom']?>"></br>
                    </article>
                    <article class="margin">
                        <label class=" purple-text text-lighten-3"  for="id_domaine">Pôle:</label>
                            <select class="browser-default"  name="id_domaine">
                                    <option value="<?= $artist['id_domaine']?>"><?= $artist['nom_domaine']?></option>
                                
                                <?php  foreach($domains as $domain) 
                                { if($artist['id_domaine'] !== $domain['id'])
                                    {?>
                                        <option value="<?= $domain['id']?>"><?= $domain['nom']?></option>
                                    <?php
                                    } 
                                }?>
                            </select></br>
                    </article>
                    <article>
                        <div class="margin">
                            <i class="fa-solid fa-envelope"></i>
                            <label class=" purple-text text-lighten-3"  for="email">Email:</label>
                            <input class="grey-text text-darken-2" type="text" name="email" value="<?= $artist['email']?>"> </br>
                        </div>
                        <div class="margin">
                            <i class="fa-solid fa-globe"></i>
                            <label class=" purple-text text-lighten-3"  for="website">Site web:</label>
                            <input class="grey-text text-darken-2" type="text" name="website" value="<?= $artist['website']?>"></br>
                        </div>    
                    </article>
                </section>
                <section class="margin">    
                    <article>
                        <h2>Réseaux-sociaux:</h2>
                        <div class="margin">
                            <i class="fa-brands fa-instagram"></i>
                            <label class=" purple-text text-lighten-3"  for="insta">Instagram:</label>
                            <input class="grey-text text-darken-2" type="text"  name="insta" value="<?= $artist['lien_insta']?>"></br>
                        </div>
                        <div class="margin">
                            <i class="fa-brands fa-soundcloud"></i>
                            <label class=" purple-text text-lighten-3"  for="soundcloud">Soundcloud:</label>
                            <input class="grey-text text-darken-2" type="text"  name="soundcloud" value="<?= $artist['lien_soundcloud']?>"></br>
                        </div>
                        <div class="margin">
                            <i class="fa-brands fa-facebook"></i>
                            <label class=" purple-text text-lighten-3"  for="facebook">Facebook:</label>
                            <input class="grey-text text-darken-2" type="text" name="facebook" value="<?= $artist['lien_facebook']?>"></br>
                        </div>
                        <div class="margin">
                            <i class="fa-brands fa-twitter"></i>
                            <label class=" purple-text text-lighten-3"  for="twitter">Twitter:</label>
                            <input class="grey-text text-darken-2" type="text" name="twitter" value="<?= $artist['lien_twitter']?>"></br>
                        </div>
                    </article> 
                </section>
            </section>
            <section class='col s6'>
                <section>
                    <article>
                        <h2>Texte de présentation:</h2>
                        <textarea class="materialize-textarea" style="height: 600px;border: 0.5px solid gray" name="description" value=""><?= $artist['description']?></textarea></br></br>
                    </article>
                </section>
            </section>        
            <section>
                <button class="btn grey-text text-lighten-5 waves-effect btn-large waves-light col s12" type="submit" name="submit" value="remplacer les informations">
                    Editer les informations de l'artiste
                </button>    
            </section>
        </form>
       
        <section class=" margin col s6">
            <h2>Image de présentation:</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <section>
                    <article>
                        <div>           
                            <label class=" purple-text text-lighten-3" for="image">Nouvelle image:</label>
                            <input class="grey-text text-darken-2" type="file" name="image" ></br>
                        </div>
                        <div>
                            <h3>Aperçu de l'image actuelle:</h3>
                            <img src="http://<?= $artist['chemin']?>">  
                        </div>
                    </article>
                    <article>
                        <label class=" purple-text text-lighten-3"  for="legende">Légende ou crédits:</label>
                        <input class="grey-text text-darken-2" type="text" name="legende" value="<?= $artist['legende']?>" placeholder=""> 
                    </article>
                </section>
        </section>        
                <section class=" col s12 row">
                        <button class="btn grey-text text-lighten-5 waves-effect btn-large waves-light col s12" type="submit" name="replace_image">
                            Editer l'image de présentation
                        </button>    
                </section>
                   
            </form>
        
    </section>   
</main>
<?php 
require_once('../include/footerBo.php');
?>
  