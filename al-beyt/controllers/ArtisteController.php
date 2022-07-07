<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\ArtisteModel;
use AlBeyt\Models\EvenementModel;

class ArtisteController{

    protected $modelArtiste;
    protected $modelEvenement;
    const NBR_ARTISTE_PAR_PAGE = 10;
    const NBR_EVENEMENT_PAGE_ARTISTE = 4;
    

    public function __construct()
    {
        $this->modelArtiste = new ArtisteModel();
        $this->modelEvenement = new EvenementModel();
    }

    public function displayAllArtists($pageCourante = null)
    {
        if($pageCourante != null){
            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante - 1);
            $displayAllArtists = $this->modelArtiste->getAllArtists($limit, $offset);
        }else{
            $displayAllArtists = $this->modelArtiste->getAllArtists(100000, 0);

        }
        return $displayAllArtists;

    }
    
    public function displayAllArtistsByDomain($id_domain,$pageCourante = null)
    {
        if($pageCourante != null){
            $limit = self::NBR_ARTISTE_PAR_PAGE;
            $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante - 1);
            $displayAllArtistsByDomain = $this->modelArtiste->getAllArtistsByDomain($id_domain, $limit, $offset);
        }else{
            $displayAllArtistsByDomain = $this->modelArtiste->getAllArtistsByDomain($id_domain, 100000, 0);

        }
        return $displayAllArtistsByDomain;
    }
    
    public function displayArtistById($id_artiste)
    {
        $displayArtistById = $this->modelArtiste->getArtistById($id_artiste);
        return $displayArtistById;
    }

    public function displayEventsByIdArtist($id_artiste,$pageCourante)
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


}
?>