
<?php
namespace \Controllers;
use \Models\EvenementModel;

class  EvenementController{

    protected $modelEvenement;

    public function __construct()
    {

        $this->modelEvenement = new EvenementModel();
    }
    
    public function  displayEvent()
    {
        $display = $this->modelEvenement->getAllEvent();

        return $display;
    }

    public function registerEvent()
    {
       $insertEvent = $this->modelEvenement->insertEvent();
       return $insertEvent;
    }

}