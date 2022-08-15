<?php

namespace AlBeyt\Models;

use \PDO;

class ArticleModel extends Bdd
{

    public function getAllArticles($limit,$offset)
    {
        $bdd = $this->bdd->prepare(
            'SELECT article.id, article.titre, article.date, article.auteur,article.description, image_article.chemin
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
            'SELECT article.id, article.titre, article.date, article.auteur,article.description, image_article.chemin
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
            'SELECT article.id, article.titre, article.date, article.auteur, article.description, image_article.chemin, image_article.legende
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

    public function getYearFilters()
    {
        $bdd = $this->bdd->prepare(
            'SELECT DISTINCT YEAR(date) as year
                    FROM article
                    ORDER BY year DESC;');
        $bdd->execute();
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

    public function updateArticle($id, $titre, $date, $auteur, $description)
    {
        $bdd = $this->bdd->prepare('UPDATE article
            SET titre = :titre,
            date = :date,
            auteur = :auteur,
            description = :description
            WHERE id = :id
        '
        );
        $bdd->bindValue(":titre", $titre, PDO::PARAM_STR);
        $bdd->bindValue(":date", $date, PDO::PARAM_STR);
        $bdd->bindValue(":auteur", $auteur, PDO::PARAM_STR);
        $bdd->bindValue(":description", $description, PDO::PARAM_STR);
        $bdd->bindValue(":id", $id, PDO::PARAM_INT);
        $bdd->execute();

        return $id;
    }

    public function updateImage($id_article, $chemin, $legende, $ordre)
    {
         $bdd = $this->bdd->prepare('UPDATE image_article
            SET chemin = :chemin,
            legende = :legende
            WHERE id_article = :id AND ordre = :ordre
        '
        );
        $bdd->bindValue(":chemin", $chemin, PDO::PARAM_STR);
        $bdd->bindValue(":legende", $legende, PDO::PARAM_STR);
        $bdd->bindValue(":ordre", $ordre, PDO::PARAM_INT);
        $bdd->bindValue(":id", $id_article, PDO::PARAM_INT);
        $bdd->execute();

        return $id_article;
    }

    public function deleteImageByIdArticle($id_article, $ordre)
    {
        $bdd = $this->bdd->prepare('DELETE FROM image_article
            WHERE id_article = :id AND ordre = :ordre
        '
        );
        $bdd->bindValue(":ordre", $ordre, PDO::PARAM_INT);
        $bdd->bindValue(":id", $id_article, PDO::PARAM_INT);
        $bdd->execute();

        return $id_article;
    }

    public function deleteArticle($id_article)
    {
        $bdd = $this->bdd->prepare('DELETE FROM article
            WHERE id = :id 
        '
        );
        $bdd->bindValue(":id", $id_article, PDO::PARAM_INT);
        $bdd->execute();

    }

    public function updateLegende($id_article, $legende, $ordre)
    {
        $bdd = $this->bdd->prepare('UPDATE image_article
            SET legende = :legende
            WHERE id_article = :id AND ordre = :ordre
        '
        );
        $bdd->bindValue(":legende", $legende, PDO::PARAM_STR);
        $bdd->bindValue(":ordre", $ordre, PDO::PARAM_INT);
        $bdd->bindValue(":id", $id_article, PDO::PARAM_INT);
        $bdd->execute();

        return $id_article;
    }

}