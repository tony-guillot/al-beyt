<?php

namespace AlBeyt\Library;

class Image
{
    const SOUS_REPERTOIRE_IMAGES = '/../../images/';
    const TYPES_AUTORISES = ['image/jpeg','image/png','image/gif'];
    const TAILLE_LIMITE = 2000000; // = 2 Mo


    public static function sauvegardeImage($image)
    { 
        $urlDestination = "";
        if(isset($image) && $image['error'] == UPLOAD_ERR_OK){
            if(in_array($image['type'], self::TYPES_AUTORISES)){
                $nomFichier = str_replace(" ","",$image['name']); //pour eviter les espaces dans le chemin
                //On construit le chemin absolu du dossier dans lequel on va mettre le fichier + nom du fichier (horodaté)
                $nomFichierSurServeur = time()."_".$nomFichier;
                $cheminDestination = realpath(__DIR__.self::SOUS_REPERTOIRE_IMAGES).DIRECTORY_SEPARATOR.$nomFichierSurServeur;
                move_uploaded_file($image['tmp_name'],$cheminDestination);
                $urlDestination = $_SERVER['HTTP_HOST']."/images/".$nomFichierSurServeur;
            }else{
                //TODO: gestion des erreurs
                echo "Extension mauvaise";
            }
        }else{
            //TODO: gestion des erreurs
                echo " Erreur Upload fichier";
        }
        return $urlDestination;
    }


}