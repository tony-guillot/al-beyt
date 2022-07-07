<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\EvenementModel;

class  EvenementController{

    protected $modelEvenement;
    const NB_EVENEMENT_PAR_PAGE = 2;

    public function __construct()
    {
        $this->modelEvenement = new EvenementModel();
    }
    
    public function displayAllEvents($pageCourante)
    {
        $limit = self::NB_EVENEMENT_PAR_PAGE ;
        $offset = self::NB_EVENEMENT_PAR_PAGE * ($pageCourante-1) ;
        $display = $this->modelEvenement->getAllEvents($limit,$offset);
        return $display;
    }

        public function displayEventsByYear($year, $page)
    {
        $limit = self::NB_EVENEMENT_PAR_PAGE ;
        $offset = self::NB_EVENEMENT_PAR_PAGE * ($page-1) ;
        $display = $this->modelEvenement->getAllEventsByYear($year, $limit, $offset);
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