<?php

namespace AlBeyt\Controllers;

use AlBeyt\Models\UtilisateurModel;
use AlBeyt\library\Error;

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
			$identifiant = trim($identifiant);
			
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

                        echo Error::displayError('Mot de passe incorrect. Recommence zebi');
                    }
                }
                else
                {
                    echo Error::displayError('Email incorrect. Veuillez recommencer.');
                }
               
            }
            else
            {
                echo Error::displayError('Format d\'email incorrect');
            }   
        }
        else
        {
            echo Error::displayError('Veuillez remplir les champs.');
        }
   
    }
    
}