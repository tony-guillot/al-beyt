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
    
    function confirmDelete(title,type)
    {   
        if(type == 'evenement')
        {
            let confirmEvent = confirm('Etes vous sûr de supprimer l\'évènement: '+title+'?');
            if(confirmEvent == true)
            {
                alert('L\' évènement '+title+' a été supprimé avec succès.');
            }
            else
            {
                alert('Vous avez annulé la suppression de l\'évènement');
            }
                return confirmEvent;
                // est renvoyé à l'endroit où j'appelle ma fonction  (en l'occurence dans l'attribu 'onclick');
        }
        else
        {
            let confirmArticle = confirm('Etes vous sûr de supprimer l\'article: '+title+'?');
            if(confirmArticle == true)
            {
                alert('L\'article '+title+' a été supprimé avec succès.');
            }
            else
            {
                alert('Vous avez annulé la suppression de l\'article');
            }
            return confirmArticle;
        }


    }

    function confirmDeleteImage(){
        if(confirm("Etes-vous sûr de supprimer cette image ?"))
        {
            alert("L'image a été supprimée avec succès.");
            return true;
        }else{
            return false;
        }
    }