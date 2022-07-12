<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;
$domains = $controller->displayAllDomains();
echo '<pre>';
// var_dump($controller->displayAllDomains());
echo '</pre>';

if(isset($_POST['submit']))
{
    $retrieveData = $controller->registerArtist(
    $_POST['id_domaine'],
    $_POST['nom'],
    $_POST['description'],
    $_POST['email'],
    $_POST['website'],
    $_POST['insta'],
    $_POST['soundcloud'],
    $_POST['facebook'],
    $_POST['twitter'],
    $_POST['url'],
    $_POST['legende']);
}
?>
<main>
    <section>
        <article>
             <h1>Ajouter un.e nouvel.le artiste</h1>
             

             
             <form action="" method="post" enctype="multipart/form-data">
                <label for="id_domaine">choisir un domaine</label>
                <select name="id_domaine">
                        <option value="">sélectionner une pratique artistique</option>
                    
                    <?php  foreach($domains as $domain) 
                    { ?>
                        <option value="<?= $domain['id']?>"><?= $domain['nom']?></option>
                    <?php
                    } ?>
                </select></br>

                 <label for="nom">Allias ou Nom:</label>
                 <input type="text" placeholder="King Tubby" name="nom"></br>
                 <label for="description">Description:</label>
                 <textarea name="description" ></textarea> </br></br>
                    <!-- *artiste image* -->
                 
                    <label for="image">Choisir une image représentant l'artiste:</label>
                    <!-- <input type="file" name="image"> -->
                    <input type="text" name="url" placeholder="https://testurl.com/"></br>
                    <label for="legende">Légende ou crédits de l'image</label>
                    <input type="text" name="legende"></br>
                 <!-- */artiste image* -->
                 <label for="email">Email pro de l'artiste:</label>
                 <input type="text" placeholder="king.tubby@tubby.com" name="email"></br>
                 <label for="website">Lien du site web:</label>
                 <input type="text" placeholder="https://reggae.fr/artiste-biographie/211_King-Tubby.html" name="website"></br>
                 <h2>Les réseaux-sociaux:</h2>
                    <label for="insta">Lien Instagram:</label>
                    <input type="text" placeholder="https://www.instagram.com/tubbyofficial" name="insta"></br>
                    <label for="soundcloud">Lien Soundcloud:</label>
                    <input type="text" placeholder="https://www.soundcloud.com/tubbyofficial" name="soundcloud"></br>
                    <label for="facebook">Lien Facebook:</label>
                    <input type="text" placeholder="https://www.facebook.com/tubbyofficial" name="facebook"></br>
                    <label for="twitter">Lien Twitter:</label>
                    <input type="text" placeholder="https://twitter.com/tubbyofficial" name="twitter"></br>
              
                 <input type="submit" name="submit" value="Ajouter l'artiste">
            </form>
        </article>
    </section>
</main>
