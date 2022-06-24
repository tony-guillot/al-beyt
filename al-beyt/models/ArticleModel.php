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
            'SELECT article.id, article.titre, article.DATE, article.auteur, image_article.chemin
                    FROM article
                    LEFT JOIN image_article ON image_article.id_article = article.id
                    WHERE article.id = :id'     /*TODO: Gestion des images */
        );
        $bdd->execute([':id' => $id]);
        $result = $bdd->fetch();

        return $result;
    }
}