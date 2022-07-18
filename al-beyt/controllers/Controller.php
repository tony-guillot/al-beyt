<?php
namespace AlBeyt\Controllers;

class Controller
{
   

    public function __construct()
    {

    }

    public function secure($value)
    {
        
        $value = htmlspecialchars(trim(strip_tags($value))); 
        return $value;
    }

    // public function secureWithoutTrim($value)
    // {
    //     $value = htmlspecialchars(strip_tags($value));
    //     return $value;
    // }

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
    public function secureBackOffice()
    {
        if($_SESSION['user'][0]['nom'] != 'admin')
        header("Location: index.php");
    }

}