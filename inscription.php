<?php 
session_start();

//Reinitialise messages
$erreur_modification = null;
$messageok = null;

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

//Vérifie que le mot de passe à bien été confirmé 
if (isset($_POST['envoyer']) AND  $_POST['password'] != $_POST['confirm_password']) 
{
    $message = 'Mot de passe et confirmation du mot de passe sont différents';
}
// Autre contrôle pour vérifier si la variable $_POST['Bouton'] est bien définie et que la confirmation du mot de pass est ok
if(isset($_POST['envoyer']) AND $_POST['password'] === $_POST['confirm_password']) 
{   
    //enregistre les variables de login et password
    $login = htmlspecialchars($_POST['login']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Vérifie que le login n'est pas déjà pris et est inconnu dans la BDD
    $req = $bdd->prepare ('SELECT `login`FROM `utilisateurs` WHERE login = :login');
    $req->execute(array(
        'login' => $login));

    //Met dans $data le tableau de $req
    $data = $req->fetch();

    // Vérifie si il y a une ligne qui correspond
    $row = $req->rowCount();

    if ($row == 1) 
    {
        $message = $login.' existe déjà.';
    }
    else 
    {
        // Requête d'insertion et insertion
        $nouvelle_inscription = $bdd->prepare ('INSERT INTO utilisateurs (login, password) VALUES (:login, :password)');
        $nouvelle_inscription->execute(array(
        'login' => $login,  
        'password' => $password));
        
        $messageok = "Votre profil a bien été crée, vous pouvez vous connecter.";
    }         
}
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
    <h1 class="col-12 text-center h3  text-primary mt-4">
        S'inscrire
    </h1>
    <?php
     if (isset($messageok)) {
        echo '<p class="col-12 text-center h5 text-success">' .$messageok.' </p>
        <a href="connexion.php" class="btn btn-primary d-block col-9 col-sm-6 col-md-4 col-lg-3 ml-auto mr-auto mb-4">Connexion</a>';
    } 
     if (isset($message)) {
        echo '<p class="col-12 text-center h5 text-danger">' .$message.' </p>';
    } ?>          
    <section class="container col-12 mb-5">
        <form action="" method="post">
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto">
            <label for="Mot de passe">Mot de passe</label>
            <input type="password" class="form-control" id="Mot de passe" name="password" required>
        </div>
        <div class="form-group col-10  col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label  for="Mot de passe">Confirmer le mot de pass</label>
            <input type="password" class="form-control" id="Mot de passe" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary d-block col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto" name="envoyer">confirmer</button>
        </form> 
    </section>         
</main>
<footer>
  <?php require('footer.php') ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>