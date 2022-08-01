document.addEventListener("DOMContentLoaded", function() {

    //Gestion des erreurs 
    if(typeof error !== "undefined")
    {
        let errorTag = document.getElementById('error-text');
        let textError = document.createTextNode(error);
        errorTag.append(textError);
        let errorSection = document.getElementById('error-section');
        errorSection.style.display = "flex";
    }
    

     // Pagination 
        var page = 1;
        loadActu(1);

        let prevButton = document.getElementById('actu-prev');
        let nextButton = document.getElementById('actu-next');

        prevButton.addEventListener("click", function () {
            if (page > 0) {
                page--;
                loadActu(page);
            }
        });
        nextButton.addEventListener("click", function () {
            page++;
            loadActu(page);
        })

    // Parralax
    let images = document.getElementsByClassName('parallax');
    for (var i =0; i < images.length; i++) {
        new simpleParallax(images, {
            customWrapper: '.box-parallax',
            scale : 2,
            orientation : "down",
        });
    }    

});

