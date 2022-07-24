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

});

