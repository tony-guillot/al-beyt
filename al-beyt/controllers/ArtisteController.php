<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\ArtisteModel;
use AlBeyt\Models\EvenementModel;
use AlBeyt\Models\DomaineModel;
use AlBeyt\Controllers\Controller;
use AlBeyt\Library\image;

class ArtisteController extends Controller
{

    protected $modelEvenement;
    protected $modelDomaine;
    protected $modelArtiste;
    const NBR_ARTISTE_PAR_PAGE = 15;
    const NBR_EVENEMENT_PAGE_ARTISTE = 4;
    

    public function __construct()
    {
        $this->modelArtiste = new ArtisteModel();
        $this->modelEvenement = new EvenementModel();
        $this->modelDomaine = new DomaineModel();


    }

    //****/Gestion des requetes d'affichage front pour les visiteurs\***
    public function displayAllArtists($pageCourante = null)
    {   
        if($pageCourante != null)
        {

            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante-1);
            $displayAllArtists = $this->modelArtiste->getAllArtists($limit,$offset);
        }
        else
        {
            $displayAllArtists = $this->modelArtiste->getAllArtists(100000, 0);
        }
        return $displayAllArtists;
    }
    
    public function displayAllArtistsByDomain($id_domaine,$pageCourante = null)
    {
        if($pageCourante != null){
            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante - 1);
            $displayAllArtistsByDomain = $this->modelArtiste->getAllArtistsByDomain($id_domaine, $limit, $offset);
        }else
        {
            $displayAllArtistsByDomain = $this->modelArtiste->getAllArtistsByDomain($id_domaine, 100000, 0);

        }
        return $displayAllArtistsByDomain;
    }
    public function displayAllArtistsByStatut($statut, $pageCourante)
    {
        if($pageCourante != null)
        {
            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante - 1);
            $displayAllArtistBystatut= $this->modelArtiste->getAllArtistsByStatut($statut, $limit, $offset);
        }
        return $displayAllArtistBystatut;
    }

    public function displayArtistById($id_artiste)
    {   
        $displayArtistById = $this->modelArtiste->getArtistById($id_artiste);
        // var_dump($displayArtistById);
        return $displayArtistById;
    }

    public function displayEventsByIdArtist($id_artiste, $pageCourante = null)
    {
        if($pageCourante != null){
            $limit = self::NBR_EVENEMENT_PAGE_ARTISTE;
            $offset = self::NBR_EVENEMENT_PAGE_ARTISTE * ($pageCourante - 1);
            $displayEventsByIdArtist = $this->modelEvenement->getEventsByIdArtist($id_artiste, $limit, $offset);
        }else{
            $displayEventsByIdArtist = $this->modelEvenement->getEventsByIdArtist($id_artiste, 100000, 0);
        }
        return $displayEventsByIdArtist;
    }

    //****/Gestion des requetes d'affichage  front pour l'administrateur\***
    public function displayAllInfoArtists($pageCourante = null)
    {
        if($pageCourante != null){
            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante - 1);
            $AllInfoArtists = $this->modelArtiste->getAllInfoArtists($limit, $offset);
        }else{
            $AllInfoArtists = $this->modelArtiste->getAllInfoArtists(100000, 0);
        }
        return $AllInfoArtists;
    }

    public function displayAllDomains()
    {
        $getAllDomains = $this->modelDomaine->getAllDomains();
        return $getAllDomains;
    }

    public function registerArtist($id_domaine, $nom, $description, $email, $website, $lien_insta, $lien_soundcloud, $lien_facebook, $lien_twitter,$image,$legende)
    {
        $id_domaine = $this->secure(intval($id_domaine));
        $nom = $this->secure($nom);
        $description = $this->secure($description);
        $legende =$this->secure($legende);


        if(!empty($id_domaine) && !empty($nom) && !empty($description))
        {

            $descriptionLen = strlen($description);
            if(($descriptionLen <= 1600) && ($descriptionLen >= 20))
            {
                if(empty($email) || filter_var($email,FILTER_VALIDATE_EMAIL))
                {

                    $email = $this->secureEmail($email);

                    if((empty($lien_twitter) || filter_var($lien_twitter,FILTER_VALIDATE_URL))
                        && (empty($lien_insta) || filter_var($lien_insta,FILTER_VALIDATE_URL))
                        && (empty($lien_facebook) || filter_var($lien_facebook,FILTER_VALIDATE_URL))
                        && (empty($lien_soundcloud) || filter_var($lien_soundcloud,FILTER_VALIDATE_URL)))
                        {
                            $website = $this->secureUrl($website);
                            $lien_insta = $this->secureUrl($lien_insta);
                            $lien_soundcloud = $this->secureUrl($lien_soundcloud);
                            $lien_facebook = $this->secureUrl($lien_facebook);
                            $lien_twitter = $this->secureUrl($lien_twitter);

                         $id_artiste = $this->modelArtiste->insertArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter,$id_domaine);


                        if(!empty($image))
                        {  
                            $legendeLen = strlen($legende);
                            if (($legendeLen <= 100) && ($legendeLen >=10))
                            {
                                    $chemin = Image::sauvegardeImage($image);
                                         $this->modelArtiste->insertImage($chemin,$legende,$id_artiste);
                            }
                            else
                            {
                                echo 'La légende doit comporter en 10 et 100 caractères.';
                            }
                           
                        }
                        else
                        {
                            echo 'Veuillez choisir une image et remplir le champs légende';
                        }
                       
                    }
                    else
                    {
                        echo 'Veuillez rentrer un format d\'adresse URL valide.';
                    }
                   

                }
                else 
                {
                    echo 'Veuillez vérifier le format de l\' adresse email';
                }
               
            }
            else
            {
                echo "La description doit être comprise entre 20 et 1600 caractères.";
            }
          
        }
        else
        {
            echo "Veuillez choisir une pratique et remplir les champs alias ou description.";
        }
    }


    public function modifyArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $statut, $id_domaine,$id)
    {
        $id_domaine = $this->secure(intval($id_domaine));
        $nom = $this->secure($nom);
        $description = $this->secure($description);
    

        if(!empty($id_domaine) && !empty($nom) && !empty($description))
        {    
        
            $descriptionLen = strlen($description);
            if(($descriptionLen <= 1600) && ($descriptionLen >= 50)) 
            {
                if(empty($email) || filter_var($email,FILTER_VALIDATE_EMAIL))
                {
            
                    $email = $this->secureEmail($email);
                    var_dump($email);

                    if((empty($lien_twitter) || filter_var($lien_twitter,FILTER_VALIDATE_URL))
                        && (empty($lien_insta) || filter_var($lien_insta,FILTER_VALIDATE_URL))
                        && (empty($lien_facebook) || filter_var($lien_facebook,FILTER_VALIDATE_URL))
                        && (empty($lien_soundcloud) || filter_var($lien_soundcloud,FILTER_VALIDATE_URL)))
                        {   
                            $website = $this->secureUrl($website);
                            $lien_insta = $this->secureUrl($lien_insta);
                            $lien_soundcloud = $this->secureUrl($lien_soundcloud);
                            $lien_facebook = $this->secureUrl($lien_facebook);
                            $lien_twitter = $this->secureUrl($lien_twitter);

                            $id_artiste = $this->modelArtiste->updateArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $statut, $id_domaine, $id);
                        }
                        else
                        {
                            echo 'Veuillez rentrer un format d\'adresse URL valide.';
                        }
                }
                else 
                {
                    echo 'Veuillez vérifier le format de l\' adresse email';
                }

            }
            else
            {
                echo "La description doit être comprise entre 50 et 1600 caractères.";
            }
        }
        else
        {
            echo 'Veuillez choisir une pratique et remplir les champs "alias" ou "description".';
        }
        
    }

    public function modifyImageArtist($image, $legende, $id_artiste)
    {   
        if(!empty($image))
        {  
            $legendeLen = strlen($legende);
            if(empty($legende) || (isset($legende) && (($legendeLen <= 100) && ($legendeLen >=10))))
            {
                $chemin = Image::sauvegardeImage($image);
                $updateImageArtist = $this->modelArtiste->updateImageArtist($chemin, $legende, $id_artiste);
            }
            else
            {
                echo 'La légende doit comporter entre 10 et 100 caractères.';
            }
        }
        else
        {
            echo 'Veuillez choisir une image';
        }
    }

    public function modifyLegende($legende,$id_artiste)
    {
        $this->modelArtiste->updateLegende($legende,$id_artiste);
    }

}
                        



?>
