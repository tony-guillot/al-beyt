<?php
namespace AlBeyt\Models;

use \PDO;

class UtilisateurModel extends Bdd
{
    
    public function getAdminByIdentifiant($identifiant)
    {
        $bdd = $this->bdd->prepare('SELECT * FROM utilisateur WHERE identifiant=:identifiant');
        $bdd->execute(array('identifiant' => $identifiant ));
        $result = $bdd->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateAdminById($id, $identifiant, $mot_de_passe)
    {
        $bdd = $this->bdd->prepare('UPDATE utilisateur SET identifiant= :identifiant, :mot_de_passe = :mot_de_passe WHERE id=:id');
        $result = $bdd->execute(array(':id' => $id,
                                      ':identifiant' => $identifiant,
                                      ':mot_de_passe' => $mot_de_passe));

        return $result;
    }

    public function updateEmailById($id, $identifiant)
    {  
        $bdd = $this->bdd->prepare("UPDATE utilisateur SET identifiant= :identifiant WHERE id = :id");
        $result = $bdd->execute(array(':id' => $id, ':identifiant' => $identifiant));

        return $result;
    }

    public function updatePasswordById($id, $mot_de_passe)
    {  
        $bdd = $this->bdd->prepare("UPDATE utilisateur SET mot_de_passe = :mot_de_passe WHERE id = :id");
        $result = $bdd->execute(array(':id' => $id, ':mot_de_passe'=> $mot_de_passe));

      return $result;
    }


    
}