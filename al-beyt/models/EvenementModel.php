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

        public function getImagesByEvenementId($id)
    {
         $bdd = $this->bdd->prepare(
            'SELECT id, chemin, legende, ordre
                    FROM image_evenement
                    WHERE image_evenement.id_evenement = :id ;'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetchAll();

        return $result;
    }



}

    

