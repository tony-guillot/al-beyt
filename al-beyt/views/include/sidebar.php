<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img class="sidenav-background" src="../../../images/flag.jpg" alt="logo al-beyt">
      </div>
      <a href="accueil.php"><img class="circle" src="../../../images/logo.png" alt="logo al-beyt"></a>
      <a href="accueil.php"><span class="green-text text-darken-1 email"><?= $_SESSION['admin']['identifiant']?></span></a>
    </div></li>
      <li><div class="divider"></div></li>
      <li><a class="subheader">Artistes</a></li>
    <li><a href="artiste_ajout.php"><i class="material-icons waves-effect">person_add</i>Ajouter un Artiste</a></li>
    <li><a href="artiste_gestion.php"><i class="material-icons waves-effect">settings</i>Gérer les Artistes</a></li>
    <li><div class="divider"></div></li>
      <li><a class="subheader">Articles</a></li>
    <li><a href="article_ajout.php"><i class="material-icons waves-effect">note_add</i>Ajouter un Article</a></li>
    <li><a href="article_gestion.php"><i class="material-icons waves-effect">settings</i>Gérer les Articles</a></li>
    <li><div class="divider"></div></li>
      <li><a class="subheader">Evenements</a></li>
    <li><a href="evenement_ajout.php"><i class="material-icons waves-effect">date_range</i>Ajouter un Evènement</a></li>
    <li><a href="evenement_gestion.php"><i class="material-icons waves-effect">settings</i>Gérer les Evènements</a></li>
    <li><div class="divider"></div></li>
</ul>


