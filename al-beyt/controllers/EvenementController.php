<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\EvenementModel;

class  EvenementController{

    protected $modelEvenement;

    public function __construct()
    {
        $this->modelEvenement = new EvenementModel();
    }
    
    public function displayAllEvent()
    {
        $display = $this->modelEvenement->getAllEvent();
        return $display;
    }

        public function displayEventByYear($year)
    {
        $display = $this->modelEvenement->getAllEventByYear($year);
        return $display;
    }

        public function displayEventById($id)
    {
       $display = $this->modelEvenement->getEventById($id);
       return $display;
    }

    public function registerEvent()
    {
       $insertEvent = $this->modelEvenement->insertEvent();
       return $insertEvent;
    }

}