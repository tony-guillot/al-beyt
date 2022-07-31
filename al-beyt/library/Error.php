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
}
?>