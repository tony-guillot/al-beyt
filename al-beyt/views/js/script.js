document.addEventListener("DOMContentLoaded", function() {
    //Gestion des erreurs
    if(typeof error !== "undefined")
    {
        let textError = document.createTextNode(error);
        let errorTag = document.getElementById('error-text');
        errorTag.append(textError);
        let iconTag = document.getElementById('error-icon');
        let iconContent = document.createTextNode("error");
        iconTag.append(iconContent);
        let errorSection = document.getElementById('error-section');
        errorSection.style.display = "flex";
    }

    //Gestion des succes
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

