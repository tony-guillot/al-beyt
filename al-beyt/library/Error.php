<?php 
namespace AlBeyt\Library;

class Error 
{
    // affichage des erreurs dans le back office
    public static function displayError($message){
        return '<script>
                var error = "'.$message.'" ;
                </script>';
    }

    // affichage des message de succes dans le back office
    public static function displaySuccess($message){
        return '<script>
                var success = "'.$message.'" ;
                </script>';
    }
}
?>