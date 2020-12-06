<?php
// On débute la session
session_start();

// Connexion a la BDD avec descriptif plus clair si il y a une erreur (array) 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
// En cas d'erreur, on affiche un message et on arrête tout
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer

/* Vérificatin que login et password ont été renseignés */
if (isset($_POST['login']) AND isset($_POST['password'])) 
{   
    $login = htmlspecialchars($_POST['login']);
    /* recherche $login dans la base de donnée */    
    $req = $bdd->prepare('SELECT login, password, id FROM utilisateurs WHERE login = :login');
    $req->execute(array(
    'login' => $login
    ));

    //Met dans $data le tableau de $req
    $data = $req->fetch();
    $data['id'];

    // Vérifie si il y a une ligne qui correspond
    $row = $req->rowCount();

    //Si oui verifie que le mot de passe est le bon
    if ($row == 1) {
        if (password_verify($_POST['password'], $data['password'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] =  $data['id'];
            header('location:index.php'); 
        }
        //Sinon mot de passe incorrect
        else {
            $message = "Mot de passe incorrect";
        }
        
    }//Sinon login inexistant
    else {
        $message = "Le nom d'utilisateur est incorrect.";
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
    <title>RésaSalle inscription</title>
</head>
<body>
<header>
    <?php require('header.php') ?>
</header>
<main class="main_inscription justify-content-center">
    <h1 class="col-12 text-center h3  text-primary mt-4">
        Connexion
    <?php if (isset($message)) {
        echo '<p class="col-12 text-center h5 text-danger">'.$message.'</p>';
    }         
    ?>
    </h1>
    <section class="container col-12 mb-5">
        <form action="" method="post">
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label for="Mot de passe">Mot de passe</label>
            <input type="password" class="form-control" id="Mot de passe" name="password" required>
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