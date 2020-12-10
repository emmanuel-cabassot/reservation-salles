<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RésaSalle</title>
</head>
<body>
<header>
    <!-- UTILISATION DE BOOTSTRAP -->
  <section class="navbar navbar-expand-md navbar-dark bg-primary">
      <div class="container-fluid">
          <a class="navbar-brand ml-4 " href="../index.php"> 
          RésaSalle
          </a>

          <!--menu burger-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          
          <!-- barre nav -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav nav-fill ml-auto">
                  <li class="nav-item ml-3 ">
                      <a class="nav-link" href="index.php">Accueil</a>
                  </li>
                  <li class="nav-item ml-3">
                      <a class="nav-link" href="php/planning.php">Planning</a>
                  </li>            
                  <li class="nav-item ml-3" >
                  <?php 
                  if (isset($_SESSION['login'])) {
                      echo '<a class="nav-link" href="php/profil.php" >Profil</a>';
                  }
                  else {
                      echo '<a class="nav-link" href="php/inscription.php" >S\'inscrire</a>';
                  }
                  ?>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                      <?php
                  if (isset($_SESSION['login'])) {
                      echo '<a class="nav-link" href="php/deconnexion" >Se déconnecter</a>';
                  }
                  else {
                      echo '<a class="nav-link" href="php/connexion.php" >Se connecter</a>';
                  }
                  ?>
                  </li>
              </ul>
          </div>
      </div>
  </section>
  <!--  FIN DU CALVAIRE et retour a un peu de CSS -->
  <section class="background">
      <p class="text-center">Réservez votre salle de fitness</p>
</section>
</header>
<main class="main_index justify-content-center">
  <h1 class="col-12 text-center h3  text-primary mt-4">
    <?php
    if (isset($_SESSION['login'])) {
      echo '<p class="col-12  text-center h3 text-primary mt-4 mb-4">Bonjour '.$_SESSION['login'].'</p>';
    }?>
    ResaSalle comment ça marche?
  </h1>
  <p class="col-12 text-center mb-5">
    Vous réservez la salle pour un créneau horaire avec la description du cours que vous souhaitez donner et ensuite les gens peuvent voir ce que vous souhaitez faire et s'y inscrire.
  </p>
  <h2 class="col-12 text-center h3 text-black mb-0 pb-0 mt-3">Nos salles disponibles sur marseille</h2>
  <svg width="1em" height="1.3em" viewBox="0 0 16 16" class="bi bi-chevron-double-down col-12 ml-auto mr-auto mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
  <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
</svg>
  <section class="presentation_salles">
    <section class="salle">
    <h3>Salle point de côté</h3>
      <section class="presentation">
       
        <section class="image">
          <img src="images/background.jpg" alt="salle de sport point de côté">
        </section>
        <section class="texte">
          <p>Grande salle pouvant accueillir 28 personnes.<br>
          matériel sur place: tapis de gym, des poids légers, tapis et coussins de méditation<br>
          La salle est située au 23 Boulevard de la libération, 13001 Marseille</p>
          <a href="planning.php" class="btn btn-primary col-12">Planning et réservation</button></a>
        </section>
      </section>
    </section>
  </section>
</main>
<footer>
  <section class="footer_logo">
      <a href="index.php"><img src="images/logo.png" alt="logo outils"> RésaSalle</a>
  </section>
  <address>
      ResaSalle,
      17 impasse du Pharo,
      13007 Marseille
  </address>
  <section class="social">
      <ul>
          <li><a href="https://twitter.com/?lang=fr" target="_blank"><img src="images/twitter.png" alt="logo twitter"></a></li>
          <li><a href="https://fr-fr.facebook.com/" target="_blank"><img src="images/facebook.png" alt="logo facebook"></a></li>
          <li><a href="https://www.instagram.com/?hl=fr" target="_blank"><img src="images/instagram.png" alt="logo instagram"></a></li>
      </ul>   
  </section>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>