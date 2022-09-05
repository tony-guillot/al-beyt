function loadActu(page) {
    let url = '../include/fil_actu.php?page=' + page

    fetch(url)
        .then(response => response.json())
        .then((response) => {
            console.log(response.pageMax);
            if (page < response.pageMax && page !== 1) {
                document.getElementById('actu-next').style.display = "inline";
                for (var i = 0; i < 8; i++) {
                    document.getElementById('tile-' + i).style.display = "block";
                    if (response.news[i].id_article == null) {
                        //evenements
                        document.getElementById('tile-info-' + i).style.display = "none";

                        let aTag = document.getElementById('link-' + i);
                        aTag.href = 'evenement.php?id=' + response.news[i].id_evenement;

                        let imgTag = document.getElementById('link-img-' + i);
                        imgTag.src = 'http://' + response.news[i].chemin_evenement;

                    } else {
                        //articles
                        document.getElementById('tile-info-' + i).style.display = "flex";

                        let aTag = document.getElementById('link-' + i);
                        aTag.href = 'article.php?id=' + response.news[i].id_article;
                        let aPlusTag = document.getElementById('link-plus-' + i);
                        aPlusTag.href = 'article.php?id=' + response.news[i].id_article;

                        let imgTag = document.getElementById('link-img-' + i);
                        imgTag.src = 'http://' + response.news[i].chemin_article;

                        let spanTag = document.getElementById('auteur-date-' + i);
                        spanTag.innerHTML = 'Par <em><b>' + response.news[i].auteur + '</b></em>, publié le ' + response.news[i].date_news;

                        let hTag = document.getElementById('titre-' + i);
                        hTag.innerHTML = response.news[i].titre;
                    }
                }
            }else{
                document.getElementById('actu-next').style.display = "none";
                for (var j = 0; j < 8; j++) {
                    if (response.news[j] == null) {
                        document.getElementById('tile-' + j).style.display = "none";
                        document.getElementById('tile-info-' + j).style.display = "none";
                    }
                }
            }
        });
}

document.addEventListener("DOMContentLoaded", function() {
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
});

