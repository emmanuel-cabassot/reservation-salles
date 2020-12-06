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

// Quand le formulaire à été confirmé, j'envoie une requete
if (isset($_POST['debut'])) {
    if ($_POST['debut'] >= $_POST['fin']) {
        $message_erreur = 'l\'heure de fin doit être supérieure à l\'heure de début';
    
    }
    else {
        $dat = $_GET['date'];
        for ($i=$_POST['debut']; $i < $_POST['fin']; $i++) { 
            $date = $dat.' '.$i.':00:00';
            $req = $bdd->prepare("SELECT * FROM `reservations` WHERE debut = :date");
            $req->execute(array(
            'date'=>$date
            ));
    
            $data = $req->fetch();          
            $row = $req->rowCount();
    
            // Si je trouve une ligne qui correspond cela veut dire que le créneau est pris
            if ($row === 1) {
                $message_erreur = 'Ce créneau horaire est déjà pris';
            continue;       
            }            
        }
        if (!isset($message_erreur)) {
            $req = $bdd->prepare('INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES(:titre, :description, :debut, :fin, :id_utilisateur)');
            $req->execute(array(
            'titre' => htmlspecialchars($_POST['titre']),
            'description' => htmlspecialchars($_POST['description']),
            'debut' => htmlspecialchars($_POST['date'].' '. $_POST['debut'].':00:00'),
            'fin' => htmlspecialchars($_POST['date'].' '. $_POST['fin'].':00:00'),
            'id_utilisateur' => $_SESSION['id']
            ));   
            
            $message_ok = 'Vous avez réservé la Salle pour le '.$_POST['date'].' de '.$_POST['debut'].' heures à '.$_POST['fin'].' heures.'; 
        }
    
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
    <title>RésaSalles réserver</title>
</head>
<body>
<header>
    <?php require('header.php') ?>
</header>
<main class="main_inscription justify-content-center">
<h1 class="col-12 text-center h3  text-primary mt-4 mb-4">
        Réserver un créneau horaire
    </h1>
    <?php
    if (isset($message_ok)) {
        echo '<p class="col-12 text-center h5 text-success">'.$message_ok.'</p>';
    } 
    if (isset($message_erreur)) {
        echo '<p class="col-12 text-center h5 text-danger">'.$message_erreur.'</p>';
    } 
    ?>          
<section class="container col-12 mb-5">
    <form action="#" method="post">
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2 text-center">
            <label for="titre">Nom de la séance</label>
            <input type="text" class="form-control" name="titre" id="titre" required>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2 text-center">
            <label for="description">Descrption de la séance</label>
            <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Description"></textarea>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2 text-center">
            <label for="titre" >Date</label>      
            <input type="date" class="form-control" id="start" name="date" value="<?php  $dates= date_create($_GET['date']);echo date_format($dates, 'Y-m-d');;?>" min="2018-01-01">
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2 text-center">
            <label for="debut">Heure du début de la séance</label>
            <input type="number" class="form-control" id="debut" name="debut" min="8" max="18" value="<?php echo $_GET['horaire_debut'] ?>" required>
        </div>
        <div class="col-12 col-sm-9 col-md-6 col-lg-4 ml-auto mr-auto mb-2 text-center">
            <label for="fin">Heure de fin</label>  
            <input type="number" class="form-control" id="fin" name="fin" min="9" max="19" value="<?php $ffin = $_GET['horaire_debut'] + 1; echo $ffin?>" required>
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