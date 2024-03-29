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

    public function getAllInfosEvents($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT e.id, e.titre, e.adresse, e.date_evenement, e.heure, e.description, e.lien_billeterie, image_e.chemin
            FROM evenement as e
            LEFT JOIN image_evenement as image_e
            ON image_e.id_evenement = e.id
            AND image_e.ordre = 1
            ORDER BY date_evenement DESC
            LIMIT :limit OFFSET :offset ;'
        );
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function getLastEvent()
    {
        $bdd = $this->bdd->prepare('SELECT e.id, e.titre, e.adresse, e.date_evenement, e.heure, image_e.chemin
            FROM evenement as e
            LEFT JOIN image_evenement as image_e
            ON image_e.id_evenement = e.id
            AND image_e.ordre = 1
            ORDER BY e.date_evenement DESC LIMIT 1');
        $bdd->execute();
        $result = $bdd->fetch(PDO::FETCH_ASSOC);

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
                ORDER BY evenement.date_evenement DESC
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
            'SELECT id,titre ,adresse ,date_evenement, heure , description, lien_billeterie
            FROM evenement
            WHERE evenement.id = :id ;'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetch();

        return $result;
    }

        public function getImagesByEventId($id)
    {
         $bdd = $this->bdd->prepare(
            'SELECT id, chemin, legende, ordre
                    FROM image_evenement
                    WHERE image_evenement.id_evenement = :id 
                    ORDER BY image_evenement.ordre;'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getEventsByIdArtist($id_artiste,$limit,$offset)
    {
        $bdd = $this->bdd->prepare('SELECT e.id, e.titre, e.date_evenement,image_evenement.chemin
                                    FROM evenement as e 
                                    LEFT JOIN image_evenement
                                    ON e.id = image_evenement.id_evenement
                                    AND image_evenement.ordre = 1
                                    INNER JOIN artiste_evenement
                                    ON e.id = artiste_evenement.id_evenement 
                                    WHERE id_artiste = :id_artiste
                                    ORDER BY date_evenement desc
                                    LIMIT :limit OFFSET :offset');
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->bindValue(":id_artiste" , $id_artiste, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    /**
     * Cette requete SQL retourne les derniers evenenements et les derniers articles (triés par date).
     * @param $offset
     * @return array contenant les colones des articles et des evenements en même temps
     */
    public function getLastArticlesAndEvents($limit,$offset){
        $bdd = $this->bdd->prepare(
            'SELECT a.id AS id_article, titre, auteur, i.chemin AS chemin_article, NULL AS id_evenement, NULL AS chemin_evenement, date AS date_news
            FROM article a
            INNER JOIN image_article i ON a.id = i.id_article AND ordre = 1
            
            UNION
            
            SELECT NULL AS id_article, NULL as titre, NULL as auteur, NULL AS chemin_article, e.id AS id_evenement, i.chemin AS chemin_evenement, e.date_evenement AS date_news
            FROM evenement e
            INNER JOIN image_evenement i ON e.id = i.id_evenement  AND ordre = 1
            
            ORDER BY date_news DESC
            LIMIT :limit OFFSET :offset;'
        );
        $bdd->bindValue(":limit" , $limit, PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->execute();
        return $bdd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYearFilters()
    {
        $bdd = $this->bdd->prepare(
            'SELECT DISTINCT YEAR(date_evenement) as year
                    FROM evenement
                    ORDER BY year DESC;');
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function insertEvent($titre, $adresse, $date_evenement, $heure, $description, $lien_billeterie)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO evenement (titre, adresse, date_evenement, heure, description, lien_billeterie) 
                    VALUES (:titre, :adresse, :date_evenement, :heure, :description, :lien_billeterie)'
        );
        $bdd->bindValue(":titre" , $titre, PDO::PARAM_STR);
        $bdd->bindValue(":adresse" , $adresse, PDO::PARAM_STR);
        $bdd->bindValue(":date_evenement" , $date_evenement, PDO::PARAM_STR);
        $bdd->bindValue(":heure" , $heure, PDO::PARAM_STR);
        $bdd->bindValue(":description" , $description, PDO::PARAM_STR);
        $bdd->bindValue(":lien_billeterie" , $lien_billeterie, PDO::PARAM_STR);

        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }

    public function insertImage($chemin, $legende, $id_evenement, $ordre)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO image_evenement (chemin, legende, id_evenement, ordre) 
                    VALUES (:chemin, :legende, :id_evenement, :ordre)'
        );
        $bdd->bindValue(":chemin" , $chemin, PDO::PARAM_STR);
        $bdd->bindValue(":legende" , $legende, PDO::PARAM_STR);
        $bdd->bindValue(":id_evenement" , $id_evenement, PDO::PARAM_INT);
        $bdd->bindValue(":ordre" , $ordre, PDO::PARAM_INT);
        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }

    public function insertParticipationArtisteByEvent($id_artiste, $id_evenement)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO artiste_evenement (id_artiste, id_evenement) VALUES  (:id_artiste, :id_evenement)'
        );
        $bdd->bindValue(":id_artiste" , $id_artiste, PDO::PARAM_INT);
        $bdd->bindValue(":id_evenement" , $id_evenement, PDO::PARAM_INT);
        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }

    public function updateEvent($titre, $adresse, $date, $heure, $description, $lien_billeterie, $id)
    {
        $bdd = $this->bdd->prepare('UPDATE evenement
                                    SET titre = :titre,
                                        adresse = :adresse,
                                        date_evenement = :date,
                                        heure = :heure,
                                        description = :description,
                                        lien_billeterie = :lien_billeterie
                                        WHERE id = :id');
        $bdd->execute(["titre" => $titre,
                      "adresse" => $adresse,
                      "date" => $date,
                      "heure" => $heure,
                      "description" => $description,
                      "lien_billeterie" => $lien_billeterie,
                      ":id" => $id ]);
    }

    public function updateImagesEvent($chemin, $legende, $ordre, $id_evenement)
    {   $id_evenement = intval($id_evenement);
        $bdd = $this->bdd->prepare('UPDATE image_evenement
                                    SET chemin = :chemin,
                                        legende = :legende
                                    WHERE id_evenement = :id_evenement 
                                    AND ordre = :ordre');

        $bdd->execute(array(':chemin' => $chemin,
                            ':legende' => $legende,
                            ':ordre' => $ordre,
                            ':id_evenement' => $id_evenement
        ));
    }


    public function deleteEvent($id)
    {
        $bdd = $this->bdd->prepare('DELETE FROM evenement WHERE id = :id');
        $bdd->execute(array(':id' => $id));
    }

    public function deleteImageComplementaire($id)
    {
        $bdd = $this->bdd->prepare('DELETE FROM image_evenement 
                                    WHERE id_evenement = :id_evenement 
                                    AND ordre = 2');
        $bdd->execute(array(':id_evenement' => $id));
    }

    public function updateLegende($legende, $ordre, $id_evenement)
    {
        $bdd = $this->bdd->prepare('UPDATE image_evenement
                                    SET legende = :legende
                                    WHERE id_evenement = :id_evenement 
                                    AND ordre = :ordre');

        $bdd->execute(array(':legende' => $legende,
                            ':ordre' => $ordre,
                            ':id_evenement' => $id_evenement
        ));
    }

}

    

