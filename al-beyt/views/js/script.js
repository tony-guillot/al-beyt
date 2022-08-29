document.addEventListener("DOMContentLoaded", function() {
    //Gestion des erreurs
    if(typeof error !== "undefined")
    {
        let textError = document.createTextNode(error);
        let errorTag = document.getElementById('error-text');
        errorTag.append(textError);
        let iconTag = document.getElementById('error-icon');
        let iconContent = document.createTextNode("error_outline");
        iconTag.append(iconContent);
        let errorSection = document.getElementById('error-section');
        errorSection.style.display = "flex";
    }

    //Gestion des succès
    if(typeof success !== "undefined")
    {
        let textError = document.createTextNode(success);
        let errorTag = document.getElementById('error-text');
        errorTag.append(textError);
        let iconTag = document.getElementById('error-icon');
        let iconContent = document.createTextNode("check_circle");
        iconTag.append(iconContent);
        let errorSection = document.getElementById('error-section');
        errorSection.style.display = "flex";
    }
    
   });
    
   
     // Gestion des succès de suppression avec la confirmation
    function confirmDelete(eventTitre)
    {
        console.log(eventTitre);

        // confirm('Are you sure you want?')
        var answer =  confirm('Etes vous sûr de supprimer l\'évènement: '+eventTitre+'?');

        if(answer == true)
        {
            alert('L\' évènement '+eventTitre+' a été supprimer avec succès.');
        }
        else
        {
            alert('Vous avez annuler la suppression.');
        }

    }




