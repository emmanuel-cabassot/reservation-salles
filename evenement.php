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
<main class="main_evenement">
    <section class="page_evenement">  
        <!-- Le cours et avec qui  --> 
        <h1><?php  echo $_GET['titre'].' ( '.$_GET['login'].' )';?></h1>
        <!-- Le jour, Heure de début et de fin -->
        <p class="heure_evenement">
            <?php require('fonction.php');echo Jour($_GET['jour']);?> De <?php $date = new DateTime($_GET['heure_debut']);echo $date->format('H');?>
        à  <?php $dates = new DateTime($_GET['heure-fin']);echo $dates->format('H');?>h</p>
        <!-- Description -->
        <p><?php echo $_GET['description']?></p>           
    </section>
</main>
<footer>
    <?php require('footer.php') ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>