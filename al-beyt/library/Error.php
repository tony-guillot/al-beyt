<?php 
namespace AlBeyt\Library;

class Error 
{
    public static function displayError($message){
        return '<script>
                var error = "'.$message.'" ;
            </script>';
    }
}
?>