<?php
require_once '../../../vendor/autoload.php';
require_once('../include/sidebar.php');
require_once('../include/header.php');
use AlBeyt\Controllers\ArtisteController;
$controller = New ArtisteController;
// $domains = $controller->displayAllDomains();
$allInfoArtists = $controller->displayAllInfoArtists();

echo '<pre>';
// var_dump($allInfoArtists);
echo '</pre>';

// $value = [ 'insta' => $artists['lien_insta'],
//             'soundcloud' => $artists['lien_soundcloud']];
// if(!empty($value))
// {
//     echo $value;
// }
// else
// {
//     echo 'champs vide';
// }

?>
<main>
    <section>
        <table>
            <thead>
                   <th>Image</th>
                   <th>Legende </th>
                   <th>Allias/Nom</th>
                   <th>Description</th>
                   <th>Pôle</th>
                   <th>Email</th>
                   <th>Site Web</th>
                   <th>Instagram</th>
                   <th>Soundcloud</th>
                   <th>Facebook</th>
                   <th>Twitter</th>
                   <th>Modifier</th>
                   <th>Statut</th>
            </thead>
            <tbody>
               
                <?php foreach($allInfoArtists as $artist)
                {  ?>
                    <tr>
                        <td><?= $artist['chemin']?></td>
                        <td><?= $artist['legende']?></td>
                        <td><?= $artist['nom']?></td>
                        <td><?= $artist['description']?></td>
                        <td><?= $artist['domaine']?></td>
                        <td><?php
                            if(!empty($artist['email']))
                            {
                               echo $artist['email'];
                            }
                            else
                            {
                                echo 'aucune information';
                            }
                            ?></td>
                        <td><?= $artist['website']?></td>
                        <td><?= $artist['lien_insta']?></td>
                        <td><?= $artist['lien_soundcloud']?></td>
                        <td><?= $artist['lien_facebook']?></td>
                        <td><?= $artist['lien_twitter']?></td>
                        <td><a href="artiste_update.php?id=<?=  $artist['id_artiste']?>"><i class="fa-solid fa-wrench"></i></td>
                        <td>
                            <?php if($artist['statut'] == 1)
                                {echo '<i class="fa-solid fa-eye"></i>';}
                                else
                                {echo '<i class="fa-solid fa-eye-slash"></i>';} ?>
                        </td>
                        
                       
                    </tr>  
                    
            <?php } ?>
            
            </tbody>
        </table>
    </section>
</main>    
