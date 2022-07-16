<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArticleController;
$controllerArticle = new ArticleController();

if(isset($_GET['id'])){
    $id = $controllerArticle->secure($_GET['id']);
}else{
    header('Location: articles.php');
    exit;
}
$article = $controllerArticle->displayArticleById($id);
$images_article = $controllerArticle->displayImagesByIdArticle($id);

?>

<main>
    <section>
        <img src="http://<?= $images_article[0]['chemin'] ?>" alt="<?= $images_article[0]['legende'] ?>">
    </section>
    <section>
        <section>
            <h2><?= $article['titre'] ?></h2>
            <div>par <span><?= $article['auteur'] ?></span>, publié le <span><?= $article['date'] ?></span> </div>
        </section>

        <section>





            <!-- <article>
                <p>

                </p>
            </article> -->
            <article>
                <div>
                    <p>
                        <?= $article['description'] ?>
                    </p>
                </div>

               <?php if (isset($images_article[1])): ?>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <div id="sliderImages" class="carousel carousel-dark" data-ride="carousel" >
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#sliderImages" data-bs-slide-to="2" aria-label="Slide 3"></button>
                          </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="http://<?= $images_article[1]['chemin'] ?>" alt="<?= $images_article[1]['legende'] ?>" >
                                <div class="carousel-caption d-block">
                                    <h5><?= $images_article[1]['legende'] ?></h5>
                                </div>
                            </div>
                            <?php if (isset($images_article[2])): ?>
                                <div class="carousel-item">
                                    <img src="http://<?= $images_article[2]['chemin'] ?>" alt="<?= $images_article[2]['legende'] ?>">
                                    <div class="carousel-caption d-block">
                                        <h5><?= $images_article[2]['legende'] ?></h5>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (isset($images_article[3])): ?>
                                <div class="carousel-item">
                                    <img src="http://<?= $images_article[3]['chemin'] ?>" alt="<?= $images_article[3]['legende'] ?>">
                                   <div class="carousel-caption d-block">
                                        <h5><?= $images_article[3]['legende'] ?></h5>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#sliderImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#sliderImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                    </div>
                <?php endif ?>


                <!-- <div>
                  <img src="<?= $images_article[1]['chemin'] ?>" alt="<?= $images_article[1]['legende'] ?>">
                  <img src="<?= $images_article[2]['chemin'] ?>" alt="<?= $images_article[2]['legende'] ?>">
                  <img src="<?= $images_article[3]['chemin'] ?>" alt="<?= $images_article[3]['legende'] ?>">
                    <p>

                    </p>
                </div>-->
            </article>
        </section>
    </section>
</main>
