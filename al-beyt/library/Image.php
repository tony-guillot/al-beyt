<?php

namespace AlBeyt\Library;

class Image
{
    const SOUS_REPERTOIRE_IMAGES = '/../../images/'; // repertoire_images.
    const TYPES_AUTORISES = ['image/jpeg','image/png','image/gif'];
    const TAILLE_LIMITE = 1000000; // = 1 Mo


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
                echo Error::displayError("Verifiez le type de fichier (types .jpeg, .png, .gif)");
            }
        }else{
                echo Error::displayError("Le serveur a rencontré une erreur lors du chargement de la photo, merci de réessayer");
        }
        return $urlDestination;
    }


}