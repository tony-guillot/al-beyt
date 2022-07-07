<?php
namespace AlBeyt\Models;
use \PDO;

class ArtisteModel extends Bdd 
{
    public function getAllArtists($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT artiste.nom, image_artiste.chemin 
            FROM artiste 
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            ORDER BY artiste.nom ASC
            LIMIT :limit OFFSET :offset');
        $bdd->bindValue(':limit',$limit, PDO::PARAM_INT);
        $bdd->bindValue(':offset',$offset,PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);
        
        return $result;

    }
    

    public function getAllArtistsByDomain($id_domain,$limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT artiste.nom, image_artiste.chemin
            FROM artiste
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            INNER JOIN domaine
            ON artiste.id_domaine = domaine.id
            WHERE domaine.id = :id_domain 
            ORDER BY artiste.nom ASC
            LIMIT :limit OFFSET :offset');
        $bdd->bindValue(':limit',$limit, PDO::PARAM_INT);
        $bdd->bindValue(':offset',$offset, PDO::PARAM_INT);
        $bdd->bindValue(':id_domain',$id_domain, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getArtistById($id_artiste)
    {
        $bdd = $this->bdd->prepare(
            'SELECT nom, description, email, lien_insta, lien_soundcloud, lien_facebook, lien_twitter, chemin,legende
            FROM artiste
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            WHERE artiste.id = :id_artiste
            ORDER BY artiste.nom ASC');
        $bdd->bindValue(':id_artiste',$id_artiste, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertArtist()
    {
    
    }
    
    public function updateArtiste($id)
    {

    }


}

?>