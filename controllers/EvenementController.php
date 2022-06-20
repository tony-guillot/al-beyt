
<?php
namespace \Controllers;
use \Models\EvenementModel;

class  EvenementController{

        public function __construct()
        {

            $this->modelEvenement = new EvenementModel();
        }
    
    public function  displayEvent()
    {
        $display = $this->modelEvenement->getAllEvent();

        return $display;
    }

    

}