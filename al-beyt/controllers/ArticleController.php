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

        if(!empty($titre) && !empty($auteur) && !empty($description) )
        {
            if (strlen($titre) > 150)
            {
                if (!empty($image_en_avant['name']))
                {
                    $id_article = $this->modelArticle->insertArticle($titre, $auteur, $description);
                    $cheminImageEnAvant = Image::sauvegardeImage($image_en_avant);
                    if ($cheminImageEnAvant != "") {
                        $this->modelArticle->insertImage($cheminImageEnAvant, $legende_en_avant, $id_article, 1);
                    }
                    if (empty($image2['name']) || (!empty($image2['name']) && $image2['size'] < Image::TAILLE_LIMITE)) {
                        $cheminImage2 = Image::sauvegardeImage($image2);
                        if ($cheminImage2 != "") {
                            $this->modelArticle->insertImage($cheminImage2, $legende2, $id_article, 2);
                        }else{
                            echo 'Veuillez choisir une image 2 valide. (Taille limite = 2Mo maximum)';
                        }
                    }
                    if (!empty($image3) && !empty($legende3)) {
                        $cheminImage3 = Image::sauvegardeImage($image3);
                        if ($cheminImage3 != "") {
                            $this->modelArticle->insertImage($cheminImage3, $legende3, $id_article, 3);
                        }else{
                            echo 'Veuillez choisir une image 3 valide. (Taille limite = 2Mo maximum)';
                        }
                    }
                    if (!empty($image4) && !empty($legende4)) {
                        $cheminImage4 = Image::sauvegardeImage($image4);
                        if ($cheminImage4 != "") {
                            $this->modelArticle->insertImage($cheminImage4, $legende4, $id_article, 4);
                        }else{
                            echo 'Veuillez choisir une image 4 valide. (Taille limite = 2Mo maximum)';
                        }
                    }
                } else {
                    echo 'Veuillez choisir une image de présentation valide (Taille limite = 2Mo maximum).';
                }
            }
            else{
                echo 'La longueur du titre ne doit pas exceder 150 caracteres.';
            }
        }
        else
        {
            echo 'Veuillez remplir les champ Titre, Auteur et Texte de l\'article';
        }

        return $id_article;
    }


}