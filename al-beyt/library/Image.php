<?php

namespace AlBeyt\Library;

class Image
{
    const SOUS_REPERTOIRE_IMAGES = '/../../images/';
    const EXTENSIONS_AUTORISEES = ['image/jpeg','image/png','image/gif'];


    public static function sauvegardeImage($image)
    {
        $cheminDestination = "";
        if(isset($image) && $image['error'] == UPLOAD_ERR_OK){
            if(in_array($image['type'], self::EXTENSIONS_AUTORISEES)){
                $nomFichier = str_replace(" ","",$image['name']); //pour eviter les espaces dans le chemin
                //On construit le chemin absolu du dossier dans lequel on va mettre le fichier + nom du fichier (horodaté)
                $cheminDestination = realpath(__DIR__.self::SOUS_REPERTOIRE_IMAGES).DIRECTORY_SEPARATOR.time()."_".$nomFichier;
                move_uploaded_file($image['tmp_name'],$cheminDestination);
            }else{
                //TODO: gestion des erreurs
                echo "<script>alert(\"Extension mauvaise\")</script>";
            }
        }else{
            //TODO: gestion des erreurs
                echo "<script>alert(\"Erreur Upload fichier\")</script>";
        }
        return $cheminDestination;
    }


}