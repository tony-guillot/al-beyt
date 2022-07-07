<?php

namespace AlBeyt\Library;

class Affichage
{
    const NB_LIGNES_SELECT = 15;

    public static function printSelectForArtists($artists) : string
    {
        //construction du code html
        $displayTags = '';
       // $artists = NULL;
        for($i=1; $i<= self::NB_LIGNES_SELECT; $i++)
        {
            $displayArticle = '<article>
                                            <label for="artiste'.$i.'">Artiste'.$i.':</label>
                                            <select name="id_artiste'.$i.'">
                                                <option selected value="">veuillez selectionner un artiste</option>
                            ';

            foreach($artists as $artist)
            {
                $displayArticle = $displayArticle.'   <option value="'.$artist["id"].'">'.$artist["nom"].'</option>' ;
            }
            $displayArticle = $displayArticle.'
                                            </select>
                                        </article>' ;
            $displayTags = $displayTags . $displayArticle;
        }

        //retour de la fonction
        return $displayTags;
    }

    public function printAllArtists()
    {

    }

    public function printAllEventByIdArtist($eventsByIdArtist)
    {

    }
}

?>