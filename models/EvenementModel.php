<?php

require_once('Bdd.php');
class EvenementModel extends Bdd {

    public function getAllEvent()
    {
        $bdd = $this->bdd->prepare(
        'SELECT * from evenement 
        INNER JOIN artiste_evenement
        ON evenement.id = artiste_evenement.id_evenement
        INNER JOIN artiste
        ON artiste_evenement.id_artiste = artiste.id
        INNER JOIN image_evenement
        ON image_evenement.id_evenement = evenement.id');
        $bdd->execute();
        $result = $bdd->fetch();

        return $result;
    }

    

    // public function getEvenementByYear(){

    //     $bdd = $this->bdd->prepare('SELECT * from evenement where ');
        

    // }

    }

    

