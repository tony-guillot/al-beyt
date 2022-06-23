<?php
namespace AlBeyt\Models;

use \PDO;

class EvenementModel extends Bdd {

    public function getAllEvent()
    {
        $bdd = $this->bdd->prepare(
            'SELECT evenement.titre, evenement.date_evenement, image_evenement.chemin
                FROM evenement
                LEFT JOIN image_evenement ON 
                image_evenement.id_evenement = evenement.id AND image_evenement.ordre = 1;'
        );
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getAllEventByYear($year)
    {
        $bdd = $this->bdd->prepare(
            'SELECT evenement.titre, evenement.date_evenement, image_evenement.chemin
                FROM evenement
                LEFT JOIN image_evenement 
                ON image_evenement.id_evenement = evenement.id 
                AND image_evenement.ordre = 1
                WHERE YEAR(evenement.date_evenement) = :year;
        ');
        $bdd->execute([":year" => $year]);
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



}

    

