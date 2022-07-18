<?php
require_once '../../../vendor/autoload.php';
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

$title = 'Modif Artiste';
require_once('../include/headerBo.php');
?>
<main>
    <section>
        <?php require_once('../include/sidebar.php');?>
    </section>
    <section>
        <section>
            <article>
                <a href="artiste_gestion.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                <h1>Modifier <?php echo $artist['nom']?></h1>
            </article>
             <form action="artiste_update.php?id=<?=$artist['id_artiste']?>" method="post">
                <article>
                    <label for="">Pour cacher l'artiste à tes visiteurs décoche la case:</label>
                    <label class="switch">
                        <?php if($artist['statut']==1){?>
                            <input type="checkbox" name="statut"  value=1 checked>
                        <?php }else{ ?>
                            <input type="checkbox" name="statut" value=1>
                            <?php }?>
                        
                        <span class="slider round"></span>
                    </label>
                </article>
                <section>
                    <article>
                        <label for="nom">Allias ou Nom:</label>
                        <input type="text" placeholder="King Tubby" name="nom" value="<?= $artist['nom']?>"></br>
                    </article>
                    <article>
                        <label for="id_domaine">Pôle:</label>
                            <select name="id_domaine">
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
                        <div>
                            <i class="fa-solid fa-envelope"></i>
                            <label for="email">Email:</label>
                            <input type="text" name="email" value="<?= $artist['email']?>"> </br>
                        </div>
                        <div>
                            <i class="fa-solid fa-globe"></i>
                            <label for="website">Site web:</label>
                            <input type="text" name="website" value="<?= $artist['website']?>"></br>
                        </div>    
                    </article>
                </section>
                <section>    
                    <article>
                        <h2>Réseaux-sociaux:</h2>
                        <div>
                            <i class="fa-brands fa-instagram"></i>
                            <label for="insta">Instagram:</label>
                            <input type="text"  name="insta" value="<?= $artist['lien_insta']?>"></br>
                        </div>
                        <div>
                            <i class="fa-brands fa-soundcloud"></i>
                            <label for="soundcloud">Soundcloud:</label>
                            <input type="text"  name="soundcloud" value="<?= $artist['lien_soundcloud']?>"></br>
                        </div>
                        <div>
                            <i class="fa-brands fa-facebook"></i>
                            <label for="facebook">Facebook:</label>
                            <input type="text" name="facebook" value="<?= $artist['lien_facebook']?>"></br>
                        </div>
                        <div>
                            <i class="fa-brands fa-twitter"></i>
                            <label for="twitter">Twitter:</label>
                            <input type="text" name="twitter" value="<?= $artist['lien_twitter']?>"></br>
                        </div>
                    </article> 
                </section>
                <section>
                    <article>
                        <label for="description">Texte de présentation:</label>
                        <textarea name="description" value=""><?= $artist['description']?></textarea></br></br>
                    </article>
                </section>
                <input type="submit" name="submit" value="remplacer les informations">
            </form>
        </section>
        <section>
            <h2>Image de présentation:</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <article>
                    <div>           
                        <label for="image">Nouvelle image:</label>
                        <input type="file" name="image" placeholder=""></br>
                    </div>
                    <div>
                        <h3>Aperçu de l'image actuelle:</h3>
                        <img src="http://<?= $artist['chemin']?>">  
                    </div>
                </article>
                <article>
                    <label for="legende">Légende ou crédits:</label>
                    <input type="text" name="legende" value="<?= $artist['legende']?>" placeholder=""> 
                </article>
                <article>
                    <input type="submit" name="replace_image" value="remplacer l'image de l'artiste">
                </article>
            </form>
        </section>
    </section>   
</main>
<?php 
require_once('../include/footer.php');
?>
  