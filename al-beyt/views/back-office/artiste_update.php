<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
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

    $retrieveData = $controller->modifyArtist(
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
    $retriveImage = $controller->modifyImageArtist($_POST['image'], $_POST['legende'], $id_artiste);
    $artist = $controller->displayArtistById($id);
}

?>
<main>
    <section>
        <h1>Modifier l'artiste <?php echo $artist['nom']?></h1>
        <form action="artiste_update.php?id=<?=$artist['id_artiste']?>" method="post" >
            <section>
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
                <article>
                <label for="nom">Allias ou Nom:</label>
                    <input type="text" placeholder="King Tubby" name="nom" value="<?= $artist['nom']?>"></br>
                </article>
                <article>
                    <label for="id_domaine">choisir un domaine</label>
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
                        <label for="email">Email pro de l'artiste:</label>
                        <input type="text" name="email" value="<?= $artist['email']?>"></br>
                    </div>
                    <div>
                        <label for="website">Lien du site web:</label>
                        <input type="text" name="website" value="<?= $artist['website']?>"></br>
                    </div>    
                </article>
                <article>
                    <h2>Les réseaux-sociaux:</h2>
                    <div>
                        <label for="insta">Lien Instagram:</label>
                        <input type="text"  name="insta" value="<?= $artist['lien_insta']?>"></br>
                    </div>
                    <div>
                        <label for="soundcloud">Lien Soundcloud:</label>
                        <input type="text"  name="soundcloud" value="<?= $artist['lien_soundcloud']?>"></br>
                    </div>
                    <div>
                        <label for="facebook">Lien Facebook:</label>
                        <input type="text" name="facebook" value="<?= $artist['lien_facebook']?>"></br>
                    </div>
                    <div>
                        <label for="twitter">Lien Twitter:</label>
                        <input type="text" name="twitter" value="<?= $artist['lien_twitter']?>"></br>
                    </div>
                </article> 
            </section>
            <section>
                <article>
                <label for="description">Description:</label>
                    <textarea name="description" value=""><?= $artist['description']?></textarea></br></br>
                </article>
            </section>
            <input type="submit" name="submit" value="remplacer les informations">
        </form>

        <form action="" method="post" enctype="multipart/form-data">
            <p>Pour remplacer l'image de l'artiste, cliquez ici</p>
        <article>
                    <!-- *artiste image* -->
                    
                    <label for="image">Choisir une image représentant l'artiste:</label>
                        <!-- <input type="file" name="image"> -->
                        <input type="text" name="image" value="<?= $artist['chemin']?>"></br>
                        <label for="legende">Légende ou crédits de l'image</label>
                        <input type="text" name="legende" value="<?= $artist['legende']?>"></br>
                    <!-- */artiste image* -->
                    <input type="submit" name="replace_image" value="remplacer l'image de l'artiste">
                </article>
        </form>
    </section>
</main>