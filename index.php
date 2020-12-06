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
  <?php require('header.php') ?>
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
    <?php require('footer.php') ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>