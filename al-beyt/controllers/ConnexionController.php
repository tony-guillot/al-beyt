<?php

namespace AlBeyt\Controllers;

use AlBeyt\Models\UtilisateurModel;

class ConnexionController extends Controller

{   public $modelUtilisateur;

    public function __construct()
    {

        $this->modelUtilisateur = new UtilisateurModel;
    }

    public function connexion($identifiant,$mot_de_passe)
    {  
         
        if( !empty($identifiant)  && !empty($mot_de_passe))
        {    

            if(filter_var($identifiant,FILTER_VALIDATE_EMAIL))
            {  
                
                $adminData = $this->modelUtilisateur->getAdminByIdentifiant($identifiant);

                if($identifiant == $adminData['identifiant'])
                {
                
                    $mdp_hash = $adminData['mot_de_passe'];
                
                    if(password_verify($mot_de_passe, $mdp_hash))
                    {   
                        $_SESSION['admin'] = $adminData;
                        header('Location: accueil.php');
                    }
                    else
                    {

                        echo 'Veuillez saisir le bon mot de passe';
                    }

                }
                else
                {
                    echo 'Veuillez saisir le bon email.';
                }
               
            }
            else
            {
                echo 'Veuillez saisir un format d\'email valide';
            }   
        }
        else
        {
            echo 'Veuillez remplir les champs vides.';
        }
        return $adminData;
    }
    
}

?>