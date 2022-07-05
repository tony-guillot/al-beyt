<?php

namespace AlBeyt\Controllers;

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
}