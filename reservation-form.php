<?php 
session_start();

// Connexion a la BDD avec descriptif plus clair si il y a une erreur (array) 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RésaSalles_inscription</title>
</head>
<body>
<header>
    <?php require('header.php') ?>
</header>
<main class="main_inscription justify-content-center">
<section class="container col-12 mb-5">
    <form action="" methode="post">
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="titre" >Nom de la séance</label>
            <input type="text" class="form-control" name="titre" id="titre" required>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="description">Descrption de la séance</label>
            <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Description"></textarea>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="titre" >Date</label>      
            <input type="date" class="form-control" id="start" name="trip-start" value="2018-07-22" min="2018-01-01">
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="debut">Heure du début de la séance</label>
            <input type="number" class="form-control" id="debut" name="debut" min="8" max="18" placeholder="ouvert de 8h a 19h" required>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="fin">Heure de fin</label>  
            <input type="number" class="form-control" id="debut" name="debut" min="9" max="19" placeholder="ouvert de 8h a 19h" required>
        </div>
        </div>
            <button type="submit" class="btn btn-primary d-block col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto" name="envoyer">confirmer</button>
        </div>
        </form> 
    </form>
    </section>
</main>

<footer>
  <?php require('footer.php') ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>