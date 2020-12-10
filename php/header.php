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
                    <a class="nav-link" href="../index.php">Accueil</a>
                </li>
                <li class="nav-item ml-3">
                    <a class="nav-link" href="planning.php">Planning</a>
                </li>            
                <li class="nav-item ml-3" >
                <?php 
                if (isset($_SESSION['login'])) {
                    echo '<a class="nav-link" href="profil.php" >Profil</a>';
                }
                else {
                    echo '<a class="nav-link" href="inscription.php" >S\'inscrire</a>';
                }
                ?>
                </li>
                <li class="nav-item ml-3 mr-3">
                    <?php
                if (isset($_SESSION['login'])) {
                    echo '<a class="nav-link" href="deconnexion" >Se déconnecter</a>';
                }
                else {
                    echo '<a class="nav-link" href="connexion.php" >Se connecter</a>';
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