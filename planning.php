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

// Création et recupère les variables
$creneaux_horaires = ['','8-9','9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18', '18-19'];
$jour = getdate();
$dates = getdate();
$fin = $dates['wday'];
$jour = $dates['mday'];
$heure = 8;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>RésaSalle planning</title>
</head>
<body>
<header>
        <?php require('header.php') ?>
</header>

<main class="main_planning">
<h1 class="col-12 text-center h1  text-primary mt-5">
        Planning 
</h1>
<h2 class="col-12 text-center h3 text-danger mb-0 ">
        <?php echo $dates['month'] ?>
</h2>
<?php

// On commence le tableau
echo '<table>';

// Ligne des horaires
echo '<tr class="align-bottom">';
 for ($i=0; $i < 12 ; $i++) { 
        echo '<td>'.$creneaux_horaires[$i].'</td>'; 
}

 // INSCRIPTION DU PREMIER JOUR DE LA SEMAINE
 echo '</tr><tr><td>';
// appel et utilise la fonction Jour
 require('fonction.php');
echo Jour($dates['wday']).'<br>'.$dates['mday'].'</td>';



// Boucle for qui va permettre de passer en revue les jours de la semaine
for ($jour;  $jour < $dates['mday'] + 7 ; $jour++) { 
        
        
        // Boucle for qui va permettre de passer en revue les creneaux horaires 
        for ($heure=8; $heure < 19 ; $heure++) { 
                // Variable qui va permettre d' enregistrer la date et l'heure à la BDD
                $date = $dates['year'].'-'.$dates['mon'].'-'.$jour.' '.$heure.':00:00';

                // Requete BDD
                $req = $bdd->prepare( 'SELECT * FROM `reservations` INNER join `utilisateurs` ON reservations.id_utilisateur = utilisateurs.id WHERE debut = :date');
                $req->execute(array(
                        'date' => $date
                        ));
                $data = $req->fetch();          
                $row = $req->rowCount();

                // Si nous sommes un samedi ou dimanche pas de bakground-color
                if ($dates['wday'] === 0 OR $dates['wday'] === 6 Or $dates['wday'] === 7 OR $dates['wday'] === 13) {
                        ?> <td></td><?php
                break;
                }
                
                // Si notre requete à recupérée une ligne cela veut dire que la salle est réservée, le background sera rouge
                 if ($row === 1) {                       
                        if (isset($_SESSION['login'])) {
                                ?><td class="bg-danger text-light"><a href="evenement.php?jour=<?php echo $dates['wday'] ?>&amp;jour_chiffre=<?php echo $jour ?>&amp;heure_debut=<?php echo $data['debut'] ?>&amp;heure-fin=<?php echo $data['fin'] ?>&amp;titre=<?php echo $data['titre'] ?>&amp;description=<?php echo $data['description'] ?>&amp;login=<?php echo $data['login'] ?>"><?php echo '<p class="mb-0"><b>'.$data['titre'].'</b><br><i> avec <br>'. $data['login'].'</i></p>' ?></a></td><?php 
                        }
                        else {
                                ?><td class="bg-danger text-light"><a href="connexion.php"> <?php echo '<p>'.$data['titre'].'<br><i> avec <br>'. $data['login'].'</i></p>' ?></a></td><?php 
                        }

                        // On va rechercher si une heure après le debut il y a une fin de cours
                        $date_fin = $dates['year'].'-'.$dates['mon'].'-'.$jour.' '.($heure + 1).':00:00';
                        $requete = $bdd->prepare( 'SELECT * FROM `reservations` INNER join `utilisateurs` ON reservations.id_utilisateur = utilisateurs.id WHERE fin = :date');
                        $requete->execute(array(
                        'date' => $date_fin
                        ));
                        $data_fin = $requete->fetch();          
                        $row_fin = $requete->rowCount(); 
                        
                        // variable qui anticipe le premiers tour de boucle car pas de heure++
                        $heure = $heure + 1;

                        // Boucle qui tourne tant que l'horaire de fin n'est pas trouvé et met en rouge les creneaux tant que
                        for ($heure = $heure; $row_fin === 0 ; $heure++) { 
                                if (isset($_SESSION['login'])) {
                                        ?><td class="bg-danger text-light"><a href="evenement.php?jour=<?php echo $dates['wday'] ?>&amp;jour_chiffre=<?php echo $jour ?>&amp;heure_debut=<?php echo $data['debut'] ?>&amp;heure-fin=<?php echo $data['fin'] ?>&amp;titre=<?php echo $data['titre'] ?>&amp;description=<?php echo $data['description'] ?>&amp;login=<?php echo $data['login'] ?>"><?php echo '<p class="mb-0"><b>'.$data['titre'].'</b><br><i> avec <br>'. $data['login'].'</i></p>' ?></a></td><?php 
                                }
                                else {
                                        ?><td class="bg-danger text-light"><a href="connexion.php"> <?php echo '<p>'.$data['titre'].'<br><i> avec <br>'. $data['login'].'</i></p>' ?></a></td><?php 
                                }
                                $date_fin = $dates['year'].'-'.$dates['mon'].'-'.$jour.' '.($heure + 1).':00:00';
                                $requete = $bdd->prepare( 'SELECT * FROM `reservations` INNER join `utilisateurs` ON reservations.id_utilisateur = utilisateurs.id WHERE fin = :date');
                                $requete->execute(array(
                                'date' => $date_fin
                                ));
                                $data_fin = $requete->fetch();          
                                $row_fin = $requete->rowCount();
                        }

                        // -1 pour heure car sinon il va y avoir un td de moins dans la journée
                        $heure = $heure - 1;
                }
                else { // Si la requete ne trouve aucune ligne 'row' c'est que la salle est disponible bg bleu
                        echo '<div class="disponible">';
                        if (isset($_SESSION['login'])) {
                                ?> <td class="bg-primary text-dark"><i><a href="reservation-form.php?date=<?php echo $dates['year'].'-'.$dates['mon'].'-'.$jour?>&amp;horaire_debut=<?php echo $heure;?>">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                        <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                        </svg>
                                </a></i></td><?php 
                        } 
                        else {
                                ?><td class="bg-primary text-dark"><a href="connexion.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-x-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                      </svg></a></td><?php 
                        }
                        echo '</div>';
                        
                }
                
        }
        // INSCRIPTION DES JOURS DE LA SEMAINE 
        // Permet d'arreter le tableau à 6 ou une difference de 7 (sinon ca inscrit toujours en fin du tableau un td jour en plus)
        // Au cas ou l'on soit un dimanche (ben oui 0+6=6)
        if ($fin === 0) {
                if ($dates['wday'] === 6) {
                        echo '</tr>';
                        break;
                }
                else 
        {          
                echo '</tr><tr><td>';
                $dates['wday'] = $dates['wday'] + 1; 
                $dates['mday'] = $dates['mday'] +1;
                echo Jour($dates['wday']).'<br>'.$dates['mday'];
                echo '</td>';
        }
        }

        // Si l'on est un autre jour que dimanche 
        if ($fin != 0) {
                if ($fin +7 === $dates['wday']) {
                        echo '</tr>';
                        break;
                }
                //sinon a chaque passage l'on cloture la ligne et on commence une nouvelle ligne avec le jour ecrit en francais grace à la fonction Jour
                else 
        {          
                echo '</tr><tr><td>';
                $dates['wday'] = $dates['wday'] + 1; 
                echo Jour($dates['wday']);
                echo '</td>';
        }
        }     
}
echo '</table>';
?>
</main>
<footer>
        <?php require('footer.php') ?>
</footer> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>   
</body>
</html>
