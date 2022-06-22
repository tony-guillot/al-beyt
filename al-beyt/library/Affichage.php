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
        for($i=0; $i<= self::NB_LIGNES_SELECT; $i++)
        {
            $displayTags=$displayTags.'<article>
                            <label for="artiste'.$i.'">Artiste:</label>
                            <select name="artiste'.$i.'">
                            <option selected value="">veuillez selectionner un artiste</option>
                            ';

            foreach($artists as $artist)
            {
                $displayTags = $displayTags.'<option value="'.$artist["id"].'">'.$artist["nom"].'</option>' ;
            }
            $displayTags = $displayTags.'
                            </select>
                        </article>' ;
        }
        //retour de la fonction
        return $displayTags;
    }

}

?>