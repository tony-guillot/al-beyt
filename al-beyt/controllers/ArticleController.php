<?php

namespace AlBeyt\Controllers;

use AlBeyt\Library\Error;
use AlBeyt\Library\Image;
use AlBeyt\Models\ArticleModel;

class ArticleController extends Controller
{

    protected $modelArticle;
    const NB_ARTICLE_PAR_PAGE = 2;

    public function __construct()
    {
        $this->modelArticle = new ArticleModel();
    }
    
    public function displayAllArticles($pageCourante)
    {
        $limit = self::NB_ARTICLE_PAR_PAGE ;
        $offset = self::NB_ARTICLE_PAR_PAGE * ($pageCourante-1) ;
        $display = $this->modelArticle->getAllArticles($limit,$offset);
        return $display;
    }

    public function displayArticlesByYear($year, $page)
    {
        $limit = self::NB_ARTICLE_PAR_PAGE ;
        $offset = self::NB_ARTICLE_PAR_PAGE * ($page-1) ;
        $display = $this->modelArticle->getAllArticlesByYear($year, $limit, $offset);
        return $display;
    }

    public function displayArticleById($id)
    {
       $display = $this->modelArticle->getArticleById($id);
       return $display;
    }

    public function displayImagesByIdArticle($id)
    {
        $images = $this->modelArticle->getImagesByIdArticle($id);
        $display = $this->reorderImages($images); //ré-arrange l'array en fonction de l'ordre des images
        return $display;
    }

    public function reorderImages($images)
    {
        foreach ($images as $imgArticle) {
            $images_article[$imgArticle['ordre'] - 1] = $imgArticle;
        }
        return $images_article;
    }

    public function registerArticle($titre,$auteur,$description,$image_en_avant,$legende_en_avant,$image2,$legende2, $image3,$legende3, $image4,$legende4)
    {
        if(empty($titre) || empty($auteur) || empty($description) || empty($image_en_avant) || empty($legende_en_avant))
        {
            //TODO: gestion des erreurs
            echo "<script>alert(\"Il manque informations\")</script>";
            return -1;
        }

        $id_article = $this->modelArticle->insertArticle($titre, $auteur, $description);
        $cheminImageEnAvant = Image::sauvegardeImage($image_en_avant);

        if( $cheminImageEnAvant != ""){
            $this->modelArticle->insertImage($cheminImageEnAvant, $legende_en_avant,$id_article,1);
        }

        if(!empty($image2) &&  !empty($legende2)){
            $cheminImage2 = Image::sauvegardeImage($image2);
            if( $cheminImage2 != "") {
                $this->modelArticle->insertImage($cheminImage2, $legende2, $id_article, 2);
            }
        }
        if(!empty($image3) &&  !empty($legende3)){
            $cheminImage3 = Image::sauvegardeImage($image3);
            if( $cheminImage3 != "") {
                $this->modelArticle->insertImage($cheminImage3, $legende3, $id_article, 3);
            }
        }
        if(!empty($image4) &&  !empty($legende4)){
            $cheminImage4 = Image::sauvegardeImage($image4);
            if( $cheminImage4 != "") {
                $this->modelArticle->insertImage($cheminImage4, $legende4, $id_article, 4);
            }
        }
        return $id_article;
    }

    public function modifyArticle($id_article, $titre, $date, $auteur, $description)
    {
        $titre = $this->secure($titre);
        $date = $this->secure($date);
        $auteur = $this->secure($auteur);
        $description = $this->secure($description);

        if(!empty($titre) && !empty($description) && !empty($auteur) && !empty($date))
        {
            if(strlen($titre) > 100){

                if(strlen($auteur) > 50){
                    $this->modelArticle->updateArticle($id_article, $titre, $date, $auteur, $description);
                }
                else
                {
                    //Error::afficheErreur('Le nom de l\'auteur ne doit pas dépasser 50 caracteres.');
                }
            }
            else
            {
                //Error::afficheErreur('Le titre ne doit pas dépasser 100 caracteres.');
            }
        }
        else
        {
            //Error::afficheErreur('Veuillez remplir les champs.');
        }

        return $id_article;
    }

    public function modifyImage($id_article, $image, $legende, $ordre)
    {
        if ( strlen($legende) < 100) {
            $chemin = Image::sauvegardeImage($image);

            $images = $this->modelArticle->getImagesByIdArticle($id_article);

            if(isset($images[$ordre-1])){
                $this->modelArticle->updateImage($id_article, $chemin, $legende, $ordre);
            }else{
                $this->modelArticle->insertImage($chemin, $legende, $id_article , $ordre);
            }

        }else{
            //Error::afficheErreur('La légende doit compter entre 10 et 100 caracteres.');
        }
    }

    public function supprimeImage($id_article, $ordre)
    {
        $this->modelArticle->deleteImageByIdArticle($id_article,$ordre);
    }




}