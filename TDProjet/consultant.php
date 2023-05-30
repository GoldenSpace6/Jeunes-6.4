<html>
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <title>Jeunes 6.4 - Référent</title>

    <?php 
        session_start();
        if($_SESSION['page_actuelle'] == 'inscription.php' && !isset($_SESSION['statut'])){
            header("Location: inscription.php");
            exit;
        }
        if($_SESSION['page_actuelle'] == 'presentation.php' && !isset($_SESSION['statut'])){
            header("Location: presentation.php");
            exit;
        }
        if($_SESSION['page_actuelle'] == 'connexion.php' && !isset($_SESSION['statut'])){
            header("Location: connexion.php");
            exit;
        }
        if (isset($_SESSION['statut'])) {
            $lien = 'profil.php'; // Lien vers le profil de l'utilisateur
        } else {
            $lien = 'inscription.php'; // Lien vers la page de connexion
        }
    ?>

</head>


<body>
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_consultant titre">
                CONSULTANT
        </div>

        <div class="soustitre">
            Je donne de la valeur a ton engagement
        </div>

    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        
        <div class="les_modules">
                <li> <a class="bouton_jeune" href="<?php echo $lien; ?>">JEUNE</a> </li>
                <li> <a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li> <a class="bouton_consultant background" href="consultant.php">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire " href="partenaire.php">PARTENAIRES</a> </li>
        </div>
    </div>





</body>
</html>
