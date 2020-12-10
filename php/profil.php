<?php
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

$login = $_SESSION['login'];

if (isset($_POST['envoyer']) AND $_POST['new_password'] =! $_POST['confirm_password'])
{
    $message = 'Mot de passe et confirmation mot de passe différents';
}
else 
{
    if(isset($_POST['envoyer']) ) 
    {
        // Réecriture des variables recupérées dans base de données
        $loginn=htmlspecialchars($_POST['new_login'], ENT_QUOTES);

        // Sécurisation du mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        
        // Requête de modification d'enregistrement
        $modifierprofil= $bdd ->prepare('UPDATE `utilisateurs` SET login =:loginn, password = :password WHERE login=:login');
        $modifierprofil -> execute (array(
            'loginn' => $loginn,
            'password' => $password,
            'login' => $login
        ));
        
        // Confirmation texte et changement de la variable $_SESSION['login']
        $messageok = "<p class=\"col-12 text-center h5 text-danger\">Votre profil a bien été modifié!</p>";
        $_SESSION['login'] = $loginn;
        $login = $loginn;                
    }  
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprimaire_inscription</title>
</head>
<body>
<header>
    <?php require('header.php') ?>
</header>
<main class="main_inscription justify-content-center">
    <h1 class="col-12 text-center h3  text-primary mt-4">
        Modifier son profil
    </h1>
    <?php
    if (isset($messageok)) {
        echo $messageok;
    }?>
    <section class="container col-12 mb-5">
        <form action="" method="post">
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="new_login" placeholder="<?php echo $login ?>" required>
        </div>
        <div class="form-group col-10 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto">
            <label for="Mot de passe">Mot de passe</label>
            <input type="password" class="form-control" id="Mot de passe" name="password" required>
        </div>
        <div class="form-group col-10  col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2">
            <label  for="Mot de passe">Confirmer le mot de passe</label>
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