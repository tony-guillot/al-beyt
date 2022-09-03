<?php

namespace AlBeyt\Library;


use \DateTime;
use \IntlDateFormatter as IntlDateFormatter;

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
            $displayArticle = '
            <div class="margin"><label class=" purple-text text-lighten-3" for="artiste'.$i.'">Artiste'.$i.':</label>
                                <select class="browser-default" name="id_artiste'.$i.'">
                                <option '.$selectedDefault.' value="">veuillez selectionner un artiste</option>';
            foreach($artists as $artist)
            {
                $selectedAttr = "";
                if(!empty($selected)){
                    $selectedAttr = ($artist['id'] == $selected[$i-1]) ? "selected" : "";
                }
                $displayArticle = $displayArticle.'<option value="'.$artist["id"].'" '.$selectedAttr.' >'.$artist["nom"].'</option>' ;
            }
            $displayArticle = $displayArticle.'</select></div>' ;
            $displayTags = $displayTags . $displayArticle;
        }
        //retour de la fonction
        return $displayTags;
    }

    public static function printDate($date)
    {
       return date_format(date_create($date),'d/m/Y');
    }

    public static function printDateFull($date)
    {
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
       return ucfirst($formatter->format(date_create($date)));
    }

    public static function printImageSliderForArticles($images_article)
    {
        $displayTags = '';
        if (isset($images_article[1]))
        {
            $displayTags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <div id="sliderImages" class="carousel carousel-dark" data-ride="carousel" >
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="2" aria-label="Slide 3"></button>
                          </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="width:300px;" src="http://'. $images_article[1]['chemin'] .'" alt="'. $images_article[1]['legende'] .'" >
                                <div class="carousel-caption d-block">
                                    <h5>'. $images_article[1]['legende'] .'</h5>
                                </div>
                            </div>';
           if(isset($images_article[2]))
           {
                $displayTags .= '<div class="carousel-item">
                                    <img  style="width:300px;" src="http://'. $images_article[2]['chemin'] .'" alt="'. $images_article[2]['legende'] .'">
                                    <div class="carousel-caption d-block">
                                        <h5>'. $images_article[2]['legende'] .'</h5>
                                    </div>
                                </div>';
           }
           if(isset($images_article[3]))
           {
                $displayTags .= '<div class="carousel-item">
                                    <img style="width:300px;" src="http://'. $images_article[3]['chemin'] .'" alt="'. $images_article[3]['legende'] .'">
                                    <div class="carousel-caption d-block">
                                        <h5>'. $images_article[3]['legende'] .'</h5>
                                    </div>
                                </div>';
           }
               $displayTags .= '</div>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#sliderImages" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#sliderImages" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                  </button>
                            </div>';
        }
        return $displayTags;
    }

    public function printSliders() 
    {
        
    }

    public static function stylizeCurrentPage()
    {
        $style = 'style="color: #FF7272;"';
        return $style;
    }

    public static function stylizeCurrentFilter()
    {
        $style = 'style="
                  color: #FF7272;
                  font-size: 1em;"';
        return $style;
    }

    public function printAllArtists()
    {

    }

    public function printAllEventByIdArtist($eventsByIdArtist)
    {

    }

    public static function printLinks($email, $website, $instagram, $twitter, $soundcloud, $facebook)
    {
        $print = "";
        $print .= '<div class="email-siteweb">';
            if(!empty($email))
            {
                $print .= '<a href="'.$email.'"><i class="fa-solid fa-envelope"></i>&ensp;'.$email.'</a>';
            }
            if(!empty($website))
            {
                $print .= '<a href="'.$website.'"><i class="fa-solid fa-globe"></i>&ensp;'.$website.'</a>';
            }
        $print .= '</div>';

        $print .= '<div class="reseaux">';
        if(!empty($instagram))
        {
            $print .= '<a href="'.$instagram.'" title=" ↗ Me rendre sur la page instagram de l\'artiste"><i class="fa-brands fa-instagram"></i></a>';
        }
        if(!empty($twitter))
        {
            $print .= '<a href="'.$twitter.'" title=" ↗ Me rendre sur la page twitter de l\'artiste"><i class="fa-brands fa-twitter"></i></a>';
        }
        if(!empty($soundcloud))
        {
            $print .= '<a href="'.$soundcloud.'" title=" ↗ Me rendre sur la page soundcloud de l\'artiste"><i class="fa-brands fa-soundcloud"></i></a>';
        }
        if(!empty($facebook))
        {
            $print .= '<a href="'.$facebook.'" title=" ↗ Me rendre sur la page soundcloud de l\'artiste"><i class="fa-brands fa-facebook"></i></a>';
        }
        $print .= '</div>';

        return $print;
    }


}

?>
