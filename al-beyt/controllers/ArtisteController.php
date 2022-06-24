<?php
namespace AlBeyt\Controllers;
use AlBeyt\Models\ArtisteModel;

class ArtisteController{

    protected $modelArtiste;
    const NBR_ARTISTE_PAR_PAGE = 2;
    

    public function __construct()
    {
        $this->modelArtiste = new ArtisteModel();
    }

    public function displayAllArtists($pageCourante)
    {   
        $limit = self::NBR_ARTISTE_PAR_PAGE;
        $offset = self::NBR_ARTISTE_PAR_PAGE * ($pageCourante-1);
        $displayAllArtists = $this->modelArtiste->getAllArtists($limit,$offset);
        return $displayAllArtists;
    }
    

}
?>