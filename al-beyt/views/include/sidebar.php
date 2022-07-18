<!-- <section class="contener-bo">
    <article class="nav-bo">
        <div class="contener-titre-bo">
            <h1 class="titre-bo"><a href="accueil.php">BACK OFFICE</a></h1>
        </div>
        <div class="contener-liste-bo">
            <ul class="ul-nav-bo" >
                <li class="liste-bo">
                    <a href="artiste_ajout.php"> <i class="fa-solid fa-user"></i> Ajouter un Artiste</a>
                </li>

                <li class="liste-bo">
                    <a href="artiste_gestion.php"><i style="font-size:0.9em;" class="fa-solid fa-gear"></i>Gérer les Artistes</a>
                </li>

                <li class="liste-bo">
                   <a href="article_ajout.php"><i class="fa-regular fa-file-lines"></i>Ajouter un Article</a>
                </li>

                <li class="liste-bo">
                   <a href="article_gestion.php"><i style="font-size:0.9em;" class="fa-solid fa-gear"></i> Gérer les Articles</a>
                </li>

                <li class="liste-bo">
                   <a href="evenement_ajout.php"><i class="fa-regular fa-calendar-plus"></i>Ajouter un Evènement</a>
                </li>

                <li class="liste-bo">
                   <a href="evenement_gestion.php"><i style="font-size:0.9em;" class="fa-solid fa-gear"></i> Gérer les Evènements</a>
                </li>
            </ul>
        </div> 
        
    </article>
</section> -->


  <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img class="sidenav-background" src="../../../images/flag.jpg" alt="logo al-beyt">
      </div>
      <a href="#"><img class="circle" src="../../../images/logo.png" alt="logo al-beyt"></a>
      <a href="#"><span class="green-text text-darken-3 name">Admin</span></a>
      <a href="#"><span class="green-text text-darken-1 email">admin@admin.com</span></a>
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
  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

<script>
       $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.sidenav').open();
        });
</script>
<!-- <ul id="slide-out" class="sidenav">
  <li><div class="user-view">
    <div class="background">
      <img src="images/office.jpg">
    </div>
    <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
    <a href="#name"><span class="white-text name">John Doe</span></a>
    <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
  </div></li>
  <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
  <li><a href="#!">Second Link</a></li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Back Office</a></li>
  <li><a href="artiste_ajout.php"><i class="fa-solid fa-user"></i>Ajouter un Artiste</a></li>
  <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->
