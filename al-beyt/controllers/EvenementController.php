<?php
namespace AlBeyt\Controllers;
use AlBeyt\Library\Image;
use AlBeyt\Models\EvenementModel;
use AlBeyt\Models\ArtisteModel;

class  EvenementController
{

    protected $modelEvenement;
    const NB_EVENEMENT_PAR_PAGE = 2;

    public function __construct()
    {
        $this->modelEvenement = new EvenementModel();
        $this->modelArtiste = new ArtisteModel();
    }
    
    public function displayAllEvents($pageCourante = null)
    {
        if($pageCourante != null)
        {
            
            $limit = self::NB_EVENEMENT_PAR_PAGE ;
            $offset = self::NB_EVENEMENT_PAR_PAGE * ($pageCourante-1) ;
            $display = $this->modelEvenement->getAllEvents($limit,$offset);
            
        }
        else
        {
            $display = $this->modelEvenement->getAllEvents(1000000,0);
        }

        return $display;
    }
    public function displayAllInfosEvent($pageCourante = null)
    {   
        if($pageCourante != null)
        {
            
            $limit = self::NB_EVENEMENT_PAR_PAGE ;
            $offset = self::NB_EVENEMENT_PAR_PAGE * ($pageCourante-1) ;
            $display = $this->modelEvenement->getAllInfosEvents($limit,$offset);
        }
        else
        {
            $display = $this->modelEvenement->getAllInfosEvents(1000000,0);
        }
        return $display;
    }

    public function displayArtistsByEventId($id_evenement)
    {
        $display = $this->modelArtiste->getArtistsByEventId($id_evenement); 
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

    public function displayImagesByEventId($id)
    {
       $display = $this->modelEvenement->getImagesByEventId($id);
       return $display;
    }

    public function registerEvent(
        $titre,
        $image_en_avant,
        $legende_en_avant,
        $ordre_image_en_avant,
        $adresse,
        $date,
        $heure,
        $description,
        $image2,
        $legende2,
        $ordre_image2,
        $ids_artistes
    )
    {
        //TODO: conditions gestion d'erreur
        $id_evenement = $this->modelEvenement->insertEvent($titre, $adresse, $date, $heure, $description);

        

        if($id_evenement){
            if(!empty($image_en_avant) &&  !empty($legende_en_avant)){
                $cheminImageEnAvant = Image::sauvegardeImage($image_en_avant);
                if ($cheminImageEnAvant != "") {
                    $this->modelEvenement->insertImage($cheminImageEnAvant, $legende_en_avant, $id_evenement, $ordre_image_en_avant);
                }
            }

            if(!empty($image2) &&  !empty($legende2)){
                $cheminImage2 = Image::sauvegardeImage($image2);
                if( $cheminImage2 != "") {
                    $this->modelEvenement->insertImage($cheminImage2, $legende2, $id_evenement, $ordre_image2);
                }
            }

            if(!empty($ids_artistes)){
                foreach($ids_artistes as $id_artiste)
                {
                    if($id_artiste != ""){
                        $this->modelEvenement->insertParticipationArtisteByEvent($id_artiste, $id_evenement);
                    }
                }
            }
        }

        return $id_evenement;
    }

    public function modifyEvent($titre, $adresse, $date, $heure, $description, $id)
    {       
         $this->modelEvenement->updateEvent($titre, $adresse, $date, $heure, $description, $id);
    }

    public function modifyImagesEvent($image_en_avant, $legende_en_avant, $ordre_image_en_avant, $image2, $legende2, $ordre_image2, $id_evenement)
    {   
        var_dump($id_evenement);
        if(!empty($image_en_avant) && !empty($_legende_en_avant))
        {
             $chemin_en_avant = Image::sauvegardeImage($image_en_avant);
            if(!empty($chemin_en_avant))
            {
                 $this->modelEvenement->updateImagesEvent($chemin_en_avant, $legende_en_avant, $ordre_image_en_avant, $id_evenement);

            }
        }
        if(!empty($image2) && !empty($legende2))
        {
             $chemin2 = Image::sauvegardeImage($image2);
            if(!empty($chemin2))
            {
                 $this->modelEvenement->updateImagesEvent($chemin2, $legende2, $ordre_image2, $id_evenement);
            }
        }
        
    }

    public function supprimeEvent($id)
    {
        $this->modelEvenement->deleteEvent($id);
    }

}