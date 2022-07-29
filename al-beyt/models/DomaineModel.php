<?php
namespace AlBeyt\Models;

use \PDO;


class DomaineModel extends Bdd
{
    public function getAllDomains()
    {
        $bdd = $this->bdd->prepare('SELECT * FROM domaine');
        $bdd->execute();
        $result = $bdd->fetchAll(PDO::FETCH_ASSOC);
       
        return $result;
    }

    
}

?>