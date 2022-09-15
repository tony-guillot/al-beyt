<?php
namespace AlBeyt\Controllers;

use AlBeyt\Models\UtilisateurModel;

class Controller
{
   

    public function __construct()
    {
        $this->modelUtilisateur = new UtilisateurModel;
    }

    public function secure($value)
    {
        
        $value = htmlspecialchars(trim(strip_tags($value))); 
        return $value;
    }

    public function secureEmail($email)
    {
        $email = htmlspecialchars(trim(strip_tags(strtolower(filter_var($email,FILTER_VALIDATE_EMAIL))))); 
        return $email;
    }
    
    public function secureUrl($url)
    {
        $url = htmlspecialchars(trim(strip_tags(strtolower(filter_var($url,FILTER_VALIDATE_URL)))));
        return $url; 
    }

    /**
     * Fonction à apeller en premier afin de sécuriser la partie admin
     * Note : attention a ne pas inclure de header avant l'appel de cette fonction
     * @return void
     */

    public static function secureBackOffice()
    {
        $utilisateurModel = new UtilisateurModel;
        $adminData = $utilisateurModel->getAdminByIdentifiant('collectif.albeyt@gmail.com');

        if($_SESSION['admin']['identifiant'] != $adminData['identifiant'] ||
         $_SESSION['admin']['mot_de_passe'] != $adminData['mot_de_passe'])
        {
            header('Location: connexion.php');
        }
       
    }

}

