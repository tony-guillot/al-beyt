<?php
namespace AlBeyt\Controllers;
use AlBeyt\Library\Image;
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

    public function displayImagesByEvenementId($id)
    {
       $display = $this->modelEvenement->getImagesByEvenementId($id);
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
        $id_evenement = 0;
        if (!empty($titre) && !empty($adresse) && !empty($date) && !empty($heure)  && !empty($description)) {
            if (strlen($titre) < 150) {
                if (!empty($image_en_avant['name']) && $image_en_avant['size'] < Image::TAILLE_LIMITE) {
                    if (empty($image2['name']) || (!empty($image2['name'])  && $image2['size'] < Image::TAILLE_LIMITE)) {
                        $id_evenement = $this->modelEvenement->insertEvent($titre, $adresse, $date, $heure, $description);
                        $cheminImageEnAvant = Image::sauvegardeImage($image_en_avant);
                        if ($cheminImageEnAvant != "") {
                            $this->modelEvenement->insertImage($cheminImageEnAvant, $legende_en_avant, $id_evenement, $ordre_image_en_avant);
                        }
                        if (!empty($image2['name'])) {
                            $cheminImage2 = Image::sauvegardeImage($image2);
                            if ($cheminImage2 != "") {
                                $this->modelEvenement->insertImage($cheminImage2, $legende2, $id_evenement, $ordre_image2);
                            }
                        }
                        if (!empty($ids_artistes)) {
                            foreach ($ids_artistes as $id_artiste) {
                                if ($id_artiste != "") {
                                    $this->modelEvenement->insertParticipationArtisteByEvent($id_artiste, $id_evenement);
                                }
                            }
                        }
                    }else{
                        echo 'Veuillez choisir une image complémentaire valide. (Taille limite = 2Mo maximum)';
                    }
                }
                else
                {
                    echo 'Veuillez choisir une image d\'affiche valide. (Taille limite = 2Mo maximum)';
                }
            }
            else
            {
               echo 'La longueur du titre ne doit pas exceder 150 caracteres.';
            }
        }
        else
        {
            echo "Veuillez remplir les champ Titre, Adresse, Date, Heure et Description.";
        }


        return $id_evenement;
    }
    //---------------------------------------------------------------------------------\\
    // Dans le cas où il n'y a pas de deuxième image:
    // - insertion de l'image 2 et update de l'image_en_avant
    // dans  2 requetes indépendantes.
    public function registerImage($image2, $legende2, $id_evenement, $ordre_image2)
    {
        $this->modelEvenement->insertImage($image2,$legende2, $id_evenement, $ordre_image2);
    } 

    public function modifyImage($image_en_avant, $legende_en_avant, $id_evenement, $ordre_image_en_avant)
    {
        $this->modelEvenement->updateImagesEvent($image_en_avant, $legende_en_avant, $id_evenement, $ordre_image_en_avant);
    }

    //---------------------------------------------------------------------------------\\


    public function modifyEvent($titre, $adresse, $date, $heure, $description, $id)
    {       
         $this->modelEvenement->updateEvent($titre, $adresse, $date, $heure, $description, $id);
    }

    public function modifyImagesEvent($image_en_avant, $legende_en_avant, $ordre_image_en_avant, $image2, $legende2, $ordre_image2, $id_evenement)
    {   
        // var_dump('controller');
        // var_dump($image_en_avant); 
        // echo '</br>';
        if(!empty($image_en_avant['name']))
        {   

             $chemin_en_avant = Image::sauvegardeImage($image_en_avant);
            if(!empty($chemin_en_avant))
            {   

                 $this->modelEvenement->updateImagesEvent($chemin_en_avant, $legende_en_avant, $ordre_image_en_avant, $id_evenement);

            }
        }
        if(!empty($image2['name']))
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