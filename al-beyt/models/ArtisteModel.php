<?php
namespace AlBeyt\Models;
use \PDO;

class ArtisteModel extends Bdd 
{   
    //cette fonction est conçue à destination du back-office
    public function getAllArtists($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT artiste.id_domaine, artiste.id, artiste.nom, image_artiste.chemin 
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

    public function getAllArtistsByDomain($id_domaine,$limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT domaine.id as domaineId, artiste.id, artiste.nom, image_artiste.chemin
            FROM artiste
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            INNER JOIN domaine
            ON artiste.id_domaine = domaine.id
            WHERE domaine.id = :id_domaine 
            AND statut = 1
            ORDER BY artiste.nom ASC
            LIMIT :limit OFFSET :offset');
        $bdd->bindValue(':limit', $limit, PDO::PARAM_INT);
        $bdd->bindValue(':offset', $offset, PDO::PARAM_INT);
        $bdd->bindValue(':id_domaine', $id_domaine, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);
       
        return $result;
    }

    public function getArtistsByEventId($id_evenement)
    {
        $bdd = $this->bdd->prepare(
            'SELECT artiste.nom
             FROM artiste
             INNER JOIN artiste_evenement
             ON artiste.id = artiste_evenement.id_artiste
             WHERE id_evenement = :id_evenement');
        $bdd->bindValue(":id_evenement", $id_evenement, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //cette fonction est conçue à destination du côté visiteurs
    //!\
    public function getAllArtistsByStatut($statut, $limit, $offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT artiste.id, artiste.nom, image_artiste.chemin 
            FROM artiste 
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            WHERE statut = :statut
            ORDER BY artiste.nom ASC
            LIMIT :limit OFFSET :offset');
        $bdd->bindValue(':limit',$limit, PDO::PARAM_INT);
        $bdd->bindValue(':offset',$offset,PDO::PARAM_INT);
        $bdd->bindValue(':statut',$statut, PDO::PARAM_BOOL);
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    
    // page artistes.php côté visiteurs
  

    public function getArtistById($id_artiste)
    {
        $bdd = $this->bdd->prepare(
            'SELECT domaine.nom as nom_domaine, domaine.id as id_domaine, artiste.id as id_artiste ,website, artiste.nom, description, email, lien_insta, lien_soundcloud, lien_facebook, lien_twitter, chemin,legende, statut
            FROM artiste
            INNER JOIN image_artiste
            ON artiste.id = image_artiste.id_artiste
            INNER JOIN domaine
            ON artiste.id_domaine = domaine.id
            WHERE artiste.id = :id_artiste');
        $bdd->bindValue(':id_artiste',$id_artiste, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getAllInfoArtists()
    {
        $bdd = $this->bdd->prepare(
            'SELECT  artiste.id as id_artiste, domaine.nom as domaine, artiste.nom, description, email, lien_insta, lien_soundcloud, lien_facebook, lien_twitter, chemin,legende, statut,website
            FROM artiste 
            INNER JOIN image_artiste 
            ON artiste.id = image_artiste.id_artiste 
            INNER JOIN domaine 
            ON artiste.id_domaine = domaine.id 
            ORDER BY artiste.nom ASC ');
        $bdd->execute();
        $result = $bdd->fetchall(PDO::FETCH_ASSOC);

        return $result;
    }
    public function insertArtist($website, $nom, $description, $email, $lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter,$id_domaine)
    {   
        
        $bdd = $this->bdd->prepare('INSERT INTO artiste (website, nom, description, email, lien_insta, lien_soundcloud,lien_facebook,lien_twitter, id_domaine)
                                    VALUES (:website, :nom, :description, :email, :lien_insta, :lien_soundcloud,:lien_facebook,:lien_twitter, :id_domaine)');
        $bdd->execute(array(':website' => $website,
                            ':nom' => $nom,
                            ':description' => $description,
                            ':email' => $email,
                            ':lien_insta' => $lien_insta,
                            ':lien_soundcloud' => $lien_soundcloud,
                            ':lien_facebook' => $lien_facebook,
                            ':lien_twitter' => $lien_twitter,
                            
                            ':id_domaine' => $id_domaine));

        $id_artiste = $this->bdd->lastInsertId();
        return $id_artiste;
    }


    public function insertImage($chemin, $legende, $id_artiste)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO image_artiste (chemin,legende,id_artiste)
            VALUES (:chemin, :legende , :id_artiste)'
        );
        $bdd->bindValue(":chemin" , $chemin,PDO::PARAM_STR);
        $bdd->bindValue(":legende" , $legende, PDO::PARAM_STR);
        $bdd->bindValue(":id_artiste", $id_artiste, PDO::PARAM_INT);
        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }
    
    public function updateArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $statut, $id_domaine, $id)
    {
        $bdd = $this->bdd->prepare('UPDATE artiste 
                                    SET  website = :website,
                                         nom = :nom,
                                         description= :description,
                                         email= :email,
                                         lien_insta= :lien_insta,
                                         lien_soundcloud= :lien_soundcloud,
                                         lien_facebook= :lien_facebook,
                                         lien_twitter= :lien_twitter,
                                         statut = :statut,
                                         id_domaine= :id_domaine
                                    WHERE id = :id');

        $bdd->execute(array(':website' => $website,
                            ':nom' => $nom,
                            ':description' => $description,
                            ':email' => $email,
                            ':lien_insta' => $lien_insta,
                            ':lien_soundcloud' => $lien_soundcloud,
                            ':lien_facebook' => $lien_facebook,
                            ':lien_twitter' => $lien_twitter,
                            ':statut' => $statut,
                            ':id_domaine' => $id_domaine,
                            ':id' => $id    
                            ));
        return $id;                          
    }

    public function updateImageArtist($chemin,$legende, $id_artiste)
    {
        // var_dump($id_artiste);

    
        $bdd = $this->bdd->prepare('UPDATE image_artiste
                                    SET chemin= :chemin,
                                        legende= :legende
                                    WHERE id_artiste = :id_artiste');
        $bdd->bindValue(':chemin', $chemin, PDO::PARAM_STR);
        $bdd->bindValue(':legende', $legende, PDO::PARAM_STR);
        $bdd->bindValue(':id_artiste', $id_artiste, PDO::PARAM_INT);
    
        $bdd->execute();

    }


}

?>