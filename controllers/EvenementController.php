
<?php

require_once('../models/EvenementModel.php');

class  EvenementController{

        public function __construct(){

            $this->modelEvenement = new EvenementModel;
        }
    
    public function  displayEvent(){

            $display = $this->modelEvenement->getAllEvent();

            return $display;

            
          
    }

}