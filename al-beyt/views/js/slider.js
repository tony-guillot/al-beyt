
var indexSlide = 0;

function displaySlider (id,sens) {  

    url = '../include/slider.php?id='+id;
    fetch(url)
    .then((response) => { 

        
        return response.json();
    })
    .then((response)=>{ 

        //var slide = [response[1]['chemin'], response[2]['chemin'], response[3]['chemin']];
        var slide = [];
        response.forEach((image, index) => {
          slide[index] = image['chemin'];
        });


        indexSlide = indexSlide + sens;

        if (indexSlide < 0) {
            indexSlide = slide.length - 1;
        }
        if (indexSlide > slide.length - 1){
            indexSlide = 0;
        }

        document.getElementById("slide").src = 'http://'+slide[indexSlide];
        // console.log(slide[indexSlide]);
    }); 
}


// function displaySlider (id,sens) {  

//     url = '../include/slider.php?id='+id;
//        // console.log(id)
//        // console.log(url);
//    fetch(url)
//    .then((response) => {

       
//        return response.json();
//    })
//    .then((response)=> { 

//        // console.log(response[0]['chemin']);
//        var slide = new Array(response[1]['chemin'], response[2]['chemin'], response[3]['chemin']);
//        // console.log(slide);
       
//        indexSlide = indexSlide + sens;
//        if (indexSlide < 0) // si le click dépasse les 3 index (0,1,2 soit la longueur du tableau) du tableau en partant vers la gauche,
//        {
//            indexSlide = slide.length - 1; // on atterit à la fin du tableau car la position :indexSlide 
//                                        // prendra la valeur de la longueur du tableau (ici 2 car on compte 0,1,2).
//        }
//        if (indexSlide > slide.length - 1) // si le click dépasse les 3 index (0,1,2 soit la longueur du tableau) en partant vers la droite;
//        {
//            indexSlide = 0;// on attribu à indexSlide (= la position), la valeur de début du tableau, soit 0.
//        }
//        document.getElementById("slide").src = 'http://'+slide[indexSlide];
//        console.log(slide[indexSlide]);

     
       
//    });

   

// }