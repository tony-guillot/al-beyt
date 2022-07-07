<?php

namespace AlBeyt\Models;

use \PDO;

class ArticleModel extends Bdd
{

    public function getAllArticles($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT article.id, article.titre, article.DATE, article.auteur, image_article.chemin
                    FROM article
                    LEFT JOIN image_article ON image_article.id_article = article.id
                    AND image_article.ordre = 1
                    ORDER BY article.date DESC
                    LIMIT :limit OFFSET :offset'
        );
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getAllArticlesByYear($year,$limit, $offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT article.id, article.titre, article.DATE, article.auteur, image_article.chemin
                    FROM article
                    LEFT JOIN image_article ON image_article.id_article = article.id
                    AND image_article.ordre = 1
                    WHERE YEAR(DATE) = :year
                    ORDER BY article.date DESC
                    LIMIT :limit OFFSET :offset'
        );
        $bdd->bindValue(":limit" , $limit,PDO::PARAM_INT);
        $bdd->bindValue(":offset" , $offset, PDO::PARAM_INT);
        $bdd->bindValue(":year" , $year, PDO::PARAM_INT);
        $bdd->execute();
        $result = $bdd->fetchAll();

        return $result;
    }

    public function getArticleById($id)
    {
        $bdd = $this->bdd->prepare(
            'SELECT article.id, article.titre, article.DATE, article.auteur, image_article.chemin, image_article.legende
                    FROM article
                    LEFT JOIN image_article ON image_article.id_article = article.id AND image_article.ordre = 1
                    WHERE article.id = :id'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetch();

        return $result;
    }

    public function getImagesByIdArticle($id)
    {
        $bdd = $this->bdd->prepare(
            'SELECT image_article.id, image_article.chemin, image_article.legende, image_article.ordre
                    FROM image_article 
                    WHERE image_article.id_article = :id
                    ORDER BY image_article.ordre'
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetchAll();

        return $result;
    }

    public function insertArticle($titre, $auteur, $description)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO article (titre, date, auteur, description)
            VALUES (:titre, NOW(),:auteur, :description)'
        );
        $bdd->bindValue(":titre" , $titre,PDO::PARAM_STR);
        $bdd->bindValue(":auteur" , $auteur, PDO::PARAM_STR);
        $bdd->bindValue(":description" , $description, PDO::PARAM_STR);
        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }

        public function insertImage($chemin, $legende, $id_article, $ordre)
    {
        $bdd = $this->bdd->prepare(
            'INSERT INTO image_article (chemin,legende,id_article,ordre)
            VALUES (:chemin, :legende , :id_article, :ordre)'
        );
        $bdd->bindValue(":chemin" , $chemin,PDO::PARAM_STR);
        $bdd->bindValue(":legende" , $legende, PDO::PARAM_STR);
        $bdd->bindValue(":id_article", $id_article, PDO::PARAM_INT);
        $bdd->bindValue(":ordre" , $ordre, PDO::PARAM_INT);
        $bdd->execute();
        $result = $this->bdd->lastInsertId();

        return $result;
    }


}