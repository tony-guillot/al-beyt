<?php
require_once '../../../vendor/autoload.php';
use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;
$domains = $controller->displayAllDomains();
if(isset($_POST['submit']))
{
    $controller->registerArtist(
    $_POST['id_domaine'],
    $_POST['nom'],
    $_POST['description'],
    $_POST['email'],
    $_POST['website'],
    $_POST['insta'],
    $_POST['soundcloud'],
    $_POST['facebook'],
    $_POST['twitter'],
    $_FILES['image'],
    $_POST['legende']);
}
$title ="Ajout article";
require_once('../include/headerBo.php');
?>
        <?php require_once('../include/sidebar.php');?>
<main class="container">
    <form action="" method="post" enctype="multipart/form-data">
    <section>
    </section>
    <section class="row formulaire">
        <section>
            <h1 class="col s12">Ajouter un.e nouvel.le artiste</h1>
        </section>
        <section class="col s6">
            <h2>Information de l'artiste</h2>
            <article>
                <label for="nom">Allias ou Nom:</label>
                <input type="text" placeholder="King Tubby" name="nom"></br>
            </article>
            <article>
                <label for="id_domaine">Pôle</label>
                <select name="id_domaine">
                        <option value="">sélectionner une pratique artistique</option>
                    
                    <?php  foreach($domains as $domain) 
                    { ?>
                        <option value="<?= $domain['id']?>"><?= $domain['nom']?></option>
                    <?php
                    } ?>
                </select></br>
            </article>
            <article>
                <i class="fa-solid fa-envelope"></i>
                <label for="email">Email:</label>
                <input type="text" placeholder="king.tubby@tubby.com" name="email"></br>
            </article>
            <article>
                <i class="fa-solid fa-globe"></i>
                <label for="website">Site web:</label>
                <input type="text" placeholder="https://reggae.fr/artiste-biographie/211_King-Tubby.html" name="website"></br>
            </article>
        </section>
        <section class="col s6">
            <h2>Réseaux-sociaux:</h2>
            <article>
                <div>
                    <i class="fa-brands fa-instagram"></i>
                    <label for="insta"> Instagram:</label>
                    <input type="text" placeholder="https://www.instagram.com/tubbyofficial" name="insta"></br>
                </div>
                <div>
                    <i class="fa-brands fa-soundcloud"></i>
                    <label for="soundcloud">Soundcloud:</label>
                    <input type="text" placeholder="https://www.soundcloud.com/tubbyofficial" name="soundcloud"></br>
                </div>
                <div>
                    <i class="fa-brands fa-facebook"></i>
                    <label for="facebook">Facebook:</label>
                    <input type="text" placeholder="https://www.facebook.com/tubbyofficial" name="facebook"></br>
                </div>
                <div>
                    <i class="fa-brands fa-twitter"></i>
                    <label for="twitter">Twitter:</label>
                    <input type="text" placeholder="https://twitter.com/tubbyofficial" name="twitter"></br>
                </div>
            </article>
        </section>
        <section class="col s6">
            <article>
                <label for="description">Texte de présentation:</label>
                <textarea style="height: 160px;border: 0.5px solid gray" class="materialize-textarea" name="description"></textarea> </br></br>
            </article>
        </section>
        <section class="col s6">
            <h2>Image de présentation:</h2>
            <article>
                <div>
                    <label for="image">Choisir une image:</label>
                    <input type="file" name="image">
                </div>
                <div>
                    <label for="legende">Légende ou crédits de l'image:</label>
                    <input type="text" name="legende"></br>
                </div>
            </article>
            <!--<input type="submit" name="submit" value="Ajouter l'artiste">-->
        </section>
        <button class="btn waves-effect btn-large waves-light col s12" type="submit" value="1" name="valider">Ajouter un artiste
            <i class="material-icons right">person_add</i>
        </button>
    </section>
    </form>
</main>
<?php 
require_once('../include/footerBo.php');
?>
