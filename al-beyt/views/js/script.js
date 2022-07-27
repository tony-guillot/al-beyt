document.addEventListener("DOMContentLoaded", function() {

    let images = document.getElementsByClassName('parallax');
    for (var i =0; i < images.length; i++) {
        new simpleParallax(images, {
            customWrapper: '.box-parallax',
            scale : 2,
            orientation : "down",
        });
    }

    if(typeof error !== "undefined"){
        let errorTag = document.getElementById('error-text');
        let textError = document.createTextNode(error);
        errorTag.append(textError);
        let errorSection = document.getElementById('error-section');
        errorSection.style.display = "flex";
    }

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

});

