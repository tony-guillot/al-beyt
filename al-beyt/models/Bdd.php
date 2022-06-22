<?php
namespace AlBeyt\Models;

use \PDO;
use \PDOException;

abstract class Bdd
{
    private $host = 'localhost';
    private $name ='al_beyt';
    private $user ='root';
    private $password = 'root';
    protected $bdd;

    public function __construct()
    { 
        try 
        {
            $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user,$this->password);
            // Activation des erreurs PDO
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
            $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }
        catch(PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

}



