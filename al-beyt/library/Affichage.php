<?php

namespace AlBeyt\Library;

/**
 * @author Daouda SARR
 */
class Affichage
{
    /**
     * nombre de listes déroulantes à afficher sur la page via la fonction printSelectForArtists()
     */
    const NB_LIGNES_SELECT = 15;

    /**
     * Retourne le code html nécéssaire à la selection des artistes participant à un évènement
     *
     * @param $artists : liste d'artistes à afficher comme < option > à l'interieur de toutes les listes déroulantes
     * @param $selected : liste d'artistes précédemment sélectionnés (à réinjecter suite à une soumission du formulaire)
     * @return string : contient le code html nécéssaire a l'affichage des listes déroulantes
     */
    public static function printSelectForArtists($artists,$selected) : string
    {
        //construction du code html
        $displayTags = '';
        for($i=1; $i<= self::NB_LIGNES_SELECT; $i++)
        {
            $selectedDefault = !empty($selected[$i-1]) ? "selected" : "";
            $displayArticle = '<label for="artiste'.$i.'">Artiste'.$i.':</label>
                                <select name="id_artiste'.$i.'">
                                <option '.$selectedDefault.' value="">veuillez selectionner un artiste</option>';
            foreach($artists as $artist)
            {
                $selectedAttr = "";
                if(!empty($selected)){
                    $selectedAttr = ($artist['id'] == $selected[$i-1]) ? "selected" : "";
                }
                $displayArticle = $displayArticle.'<option value="'.$artist["id"].'" '.$selectedAttr.' >'.$artist["nom"].'</option>' ;
            }
            $displayArticle = $displayArticle.'</select>' ;
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