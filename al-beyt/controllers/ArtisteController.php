<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\ArtisteModel;
use AlBeyt\Models\EvenementModel;
use AlBeyt\Models\DomaineModel;
use AlBeyt\Controllers\Controller;

class ArtisteController extends Controller
{

    protected $modelEvenement;
    protected $modelDomaine;
    protected $modelArtiste;
    
    const NBR_ARTISTE_PAR_PAGE = 10;
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
            $displayAllArtists = $this->modelArtiste->getAllArtists(1000000,0);
        }
        return $displayAllArtists;
    }
    
    public function displayAllArtistsByDomain($id_domaine,$pageCourante)
    { 
        $limit = self::NBR_ARTISTE_PAR_PAGE;
        $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante-1);
        $displayAllArtistsByDomain = $this->modelArtiste->getAllArtistsByDomain($id_domaine,$limit,$offset);
        return $displayAllArtistsByDomain;
    }
    
    public function displayArtistById($id_artiste)
    {
        $displayArtistById = $this->modelArtiste->getArtistById($id_artiste);
        return $displayArtistById;
    }

    public function displayEventsByIdArtist($id_artiste,$pageCourante)
    {
        $limit = self::NBR_EVENEMENT_PAGE_ARTISTE;
        $offset = self::NBR_EVENEMENT_PAGE_ARTISTE * ($pageCourante-1);
        $displayEventsByIdArtist = $this->modelEvenement->getEventsByIdArtist($id_artiste,$limit,$offset);
        return $displayEventsByIdArtist;
    }

    //****/Gestion des requetes d'affichage  front pour l'administrateur\***
    public function displayAllInfoArtists()
    {
        $AllInfoArtists = $this->modelArtiste->getAllInfoArtists();
        return $AllInfoArtists;
    }

    public function displayAllDomains()
    {
        $getAllDomains = $this->modelDomaine->getAllDomains();
        return $getAllDomains;
    }

    public function registerArtist($id_domaine, $nom, $description, $email, $website, $lien_insta, $lien_soundcloud, $lien_facebook, $lien_twitter,$chemin,$legende)
    {
            $id_domaine = $this->secure(intval($id_domaine));
            $nom = $this->secureWithoutTrim($nom);
            $description = $this->secureWithoutTrim($description);
            //!\ upload image comment sécuriser le champs faille upload.    
            $chemin = $this->secure($chemin);
            $legende =$this->secureWithoutTrim($legende);
        

            if(!empty($id_domaine) && !empty($nom) && !empty($description))
            {   
                $id_domaine = $this->secure(intval($id_domaine));
                $nom = $this->secureWithoutTrim($nom);
                $description = $this->secureWithoutTrim($description);
                //!\ upload image comment sécuriser le champs faille upload.    
                $chemin = $this->secure($chemin);
                $legende =$this->secureWithoutTrim($legende);   
            
                $descriptionLen = strlen($description);
                if(($descriptionLen <= 1600) && ($descriptionLen >= 50)) 
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

                            $id_artiste = $this->modelArtiste->insertArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $id_domaine);
                    

                            if(!empty($chemin))
                            {
                                $legendeLen = strlen($legende);
                                if (($legendeLen <= 100) && ($legendeLen >=10))
                                {
                    
                                    $insertImageArtist = $this->modelArtiste->insertImageArtist($chemin,$legende,$id_artiste);
                                }
                                else
                                {
                                    echo 'La légende doit comporter entre 10 et 100 caractères.';
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
                    echo "La description doit être comprise entre 50 et 1600 caractères.";
                }
            }
            else
            {
                echo "Veuillez choisir une pratique et remplir les champs alias ou description.";
            }
        }

        public function modifyArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $statut, $id_domaine, $chemin, $legende, $id_artiste)
        {
            $id_domaine = $this->secure(intval($id_domaine));
            $nom = $this->secureWithoutTrim($nom);
            $description = $this->secureWithoutTrim($description);
            //!\ upload image comment sécuriser le champs faille upload.    
            $chemin = $this->secure($chemin);
            $legende =$this->secureWithoutTrim($legende);
        

            if(!empty($id_domaine) && !empty($nom) && !empty($description))
            {   
                // $id_domaine = $this->secure(intval($id_domaine));
                // $nom = $this->secureWithoutTrim($nom);
                // $description = $this->secureWithoutTrim($description);
                // //!\ upload image comment sécuriser le champs faille upload.    
                // $chemin = $this->secure($chemin);
                // $legende =$this->secureWithoutTrim($legende);   
            
                // $descriptionLen = strlen($description);
                // if(($descriptionLen <= 1600) && ($descriptionLen >= 50)) 
                // {
                //     if(empty($email) || filter_var($email,FILTER_VALIDATE_EMAIL))
                //     {
                
                //         $email = $this->secureEmail($email);

                //         if((empty($lien_twitter) || filter_var($lien_twitter,FILTER_VALIDATE_URL))
                //             && (empty($lien_insta) || filter_var($lien_insta,FILTER_VALIDATE_URL))
                //             && (empty($lien_facebook) || filter_var($lien_facebook,FILTER_VALIDATE_URL))
                //             && (empty($lien_soundcloud) || filter_var($lien_soundcloud,FILTER_VALIDATE_URL)))
                //             {   
                //                 $website = $this->secureUrl($website);
                //                 $lien_insta = $this->secureUrl($lien_insta);
                //                 $lien_soundcloud = $this->secureUrl($lien_soundcloud);
                //                 $lien_facebook = $this->secureUrl($lien_facebook);
                //                 $lien_twitter = $this->secureUrl($lien_twitter);

                                $id_artiste = $this->modelArtiste->updateArtist($website, $nom, $description, $email,$lien_insta, $lien_soundcloud,$lien_facebook,$lien_twitter, $statut, $id_domaine, $id_artiste);
                    

                            // if(!empty($chemin))
                            // {
                            //     $legendeLen = strlen($legende);
                            //     if (($legendeLen <= 100) && ($legendeLen >=10))
                            //     {
                    
                                    $updateImageArtist = $this->modelArtiste->updateImageArtist($chemin,$legende, $id_artiste);
            //                     }
            //                     else
            //                     {
            //                         echo 'La légende doit comporter entre 10 et 100 caractères.';
            //                     }
            //                 }
            //                 else
            //                 {
            //                     echo 'Veuillez choisir une image et remplir le champs "légende"';
            //                 }
            //             }
            //             else
            //             {
            //                 echo 'Veuillez rentrer un format d\'adresse URL valide.';
            //             }
            //         }
            //         else 
            //         {
            //             echo 'Veuillez vérifier le format de l\' adresse email';
            //         }

            //     }
            //     else
            //     {
            //         echo "La description doit être comprise entre 50 et 1600 caractères.";
            //     }
            }
            else
            {
                echo 'Veuillez choisir une pratique et remplir les champs "alias" ou "description".';
            }
           
        }

   

   
                        

}
?>
