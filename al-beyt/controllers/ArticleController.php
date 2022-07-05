<?php

namespace AlBeyt\Controllers;

use AlBeyt\Library\Image;
use AlBeyt\Models\ArticleModel;

class ArticleController
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
        $display = $this->modelArticle->getImagesByIdArticle($id);
        return $display;
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


}