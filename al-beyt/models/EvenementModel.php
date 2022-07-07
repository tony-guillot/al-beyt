<?php
namespace AlBeyt\Models;

use \PDO;

class EvenementModel extends Bdd {

    public function getAllEvents($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT evenement.id, evenement.titre, evenement.date_evenement, image_evenement.chemin
                FROM evenement
                LEFT JOIN image_evenement ON 
                image_evenement.id_evenement = evenement.id AND image_evenement.ordre = 1
                LIMIT :limit OFFSET :offset ;'
        );
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getAllEventsByYear($year,$limit, $offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT evenement.id, evenement.titre, evenement.date_evenement, image_evenement.chemin
                FROM evenement
                LEFT JOIN image_evenement 
                ON image_evenement.id_evenement = evenement.id 
                AND image_evenement.ordre = 1
                WHERE YEAR(evenement.date_evenement) = :year
                LIMIT :limit OFFSET :offset ;'
        );
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->bindValue(":year" , $year, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getEventById($id)
    {
        $bdd = $this->bdd->prepare(
            'SELECT id,titre ,adresse ,date_evenement, heure , description
            FROM evenement
            WHERE evenement.id = :id ;'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetch();

        return $result;
    }

    public function getEventsByIdArtist($id_artiste,$limit,$offset)
    {
        $bdd = $this->bdd->prepare('SELECT e.titre, e.date_evenement,image_evenement.chemin
                                    FROM evenement as e 
                                    LEFT JOIN image_evenement
                                    ON e.id = image_evenement.id_evenement
                                    AND image_evenement.ordre = 1
                                    INNER JOIN artiste_evenement
                                    ON e.id = artiste_evenement.id_evenement 
                                    WHERE id_artiste = :id_artiste 
                                     LIMIT :limit OFFSET :offset ');
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->bindValue(":id_artiste" , $id_artiste, PDO::PARAM_INT);
        $result = $bdd->fetch(PDO::FETCH_ASSOC);

        return $result;
    }



}

    

