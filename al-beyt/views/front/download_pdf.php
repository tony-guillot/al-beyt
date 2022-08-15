<?php
require_once '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use AlBeyt\Controllers\ArticleController;

$option = new Options();
$option->set('isRemoteEnabled',true);
$pdf = new Dompdf($option);
$controllerArticle = new ArticleController();

if(isset($_GET['id_article'])){
    $id = $controllerArticle->secure($_GET['id_article']);
}else{
    header('Location: articles.php');
    exit;
}

$article = $controllerArticle->displayArticleById($id);
$images_article = $controllerArticle->displayImagesByIdArticle($id);
ob_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> <?='Article | '.$article['titre']?> </title>
</head>
<style>
    @font-face
    {
        font-family: 'molgak_classyregular';
        src: url('../css/molgak-classy-regular/molgakclassyregular-nrodg-webfont.woff2') format('woff2'),
             url('../css/molgak-classy-regular/molgakclassyregular-nrodg-webfont.woff') format('woff'),
             url('../css/molgak-classy-regular/molgakclassyregular-nrodg-webfont.ttf') format('ttf');

        font-weight: normal;
        font-style: normal;
    }
    header
    {
        position: relative;
        text-align: left;
        line-height: 1.8em;
        font-family: 'molgak_classyregular', 'arial', serif;
        height: 3em;
        margin-bottom:15px;

    }
    header > *{
        display: inline;
    }
     header .logo{
        position: absolute;
        right: 20px;
         top : -10px;
        height: 4em;
    }
    header .al-beyt{
        position: absolute;
        left: 20px;
        margin-top: 0;
        font-size: 2em;

    }
    main{
        width: 75%;
        margin-left: auto;
        margin-right: auto;
    }
    h2{
        font-family:'inter',sans-serif;
        margin-bottom: 5px;
    }
    .image-principale img{
        margin-top: 25px;
        max-height: 300px;
    }
    .description {
        width: 95%;
        margin-left: 15px;
        text-align: justify;
        line-height: 0.97em;
        text-justify: inter-word;
        font-size: 0.8em;
        font-family:'inter',sans-serif;
    }
    .info{
        font-size: 0.7em;
        font-family:'inter',sans-serif;
    }
    .images {
        width: 80%;
        display: inline-block;
    }

    .image-article {
         
        display: inline-block;
        margin: 10px auto;
        text-align: center;
    }

    .image-article > * {
        display: block;
        width: 90%;
    }
    .image-article img {
        display: block;
    }
    .legende{
        font-size: 0.7em;
        font-family:'inter',sans-serif;
    }
</style>
<body>
    <header>
        <h1 class='al-beyt'>AL-BEYT</h1>
        <img class='logo' src="http://<?= $_SERVER['SERVER_NAME'] ?>/images/logo.png" alt="logo al-beyt">
    </header>
    <main>
        <section>
            <h2><?= $article['titre'] ?></h2>
            <div class="info">par <span><?= $article['auteur'] ?></span>, publié le <span><?= $article['date'] ?></span> </div>
        </section>
        <section class="image-principale">
            <img src="http://<?= $images_article[0]['chemin'] ?>" alt="<?= $images_article[0]['legende'] ?>">
        </section>
        <section>

            <section>
                <!-- <article>
                    <p>
                    </p>
                </article> -->
                <article class="description">
                    <div>
                        <p>
                            <?= nl2br($article['description']) ?>
                        </p>
                    </div>
                </article>
                <article class="images"> <?php if (isset($images_article[1])): ?>
                        <div class="image-article">
                            <img src="http://<?= $images_article[1]['chemin'] ?>"
                                alt="<?= $images_article[1]['legende'] ?>">
                            <span class="legende"><?= $images_article[1]['legende'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if (isset($images_article[2])): ?>
                        <div class="image-article">
                            <img src="http://<?= $images_article[2]['chemin'] ?>"
                                alt="<?= $images_article[2]['legende'] ?>">
                            <span class="legende"><?= $images_article[2]['legende'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if (isset($images_article[3])): ?>
                        <div class="image-article">
                            <img src="http://<?= $images_article[3]['chemin'] ?>"
                                alt="<?= $images_article[3]['legende'] ?>">
                            <span class="legende"><?= $images_article[3]['legende'] ?></span>
                        </div>
                    <?php endif ?></article>
            </section>
        </section>
    </main>
</body>
</html>

<?php
$html = ob_get_clean();
$pdf->loadHtml($html);
$pdf->render();
$pdf->stream("Al-Beyt_article_".$article['id']."_du_".$article['date'].".pdf");