document.addEventListener("DOMContentLoaded", function() {
    let images = document.getElementsByClassName('parallax');
    for (var i =0; i < images.length; i++) {
        new simpleParallax(images, {
            customWrapper: '.box-parallax',
            scale : 2,
            orientation : "down",
        });
    }
});