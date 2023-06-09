<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <link rel="stylesheet" href="CSS/nouveau_consultant.css" type="text/css">
    <title>Jeunes 6.4 - nouveau_consultant</title>
    <meta charset="utf-8">

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

        <div class="couleur_jeune titre">
                JEUNE
        </div>

        <div class="soustitre">
            Je donne de la valeur a ton engagement
        </div>

    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        
        <div class="les_modules">
            <li><a class="bouton_jeune background" href="profil.php">PROFIL</a> </li>
            <li><a class="bouton_referent" href="referent.php">REFERENT</a> </li>
            <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
            <li><a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </div>
    </div>
    <div class="les_ecritures">
            <div>
                <p class="texte_nouveau_consultant">
                    Entrez les informations de votre consultant.
                </p>
            </div>
            <div class="carre_profil_consultant">
                <form action="profil.php" method="POST" class="carre_consultant couleur_consultant carre_formulaire">
                    <!--<//?php echo $err?><br>-->
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>" disabled><br>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>" disabled><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>" disabled><br>
                    <button class=valider type="submit" id="submit" >Envoyer</button>
                </form>
            </div> 
        </div>



</body>
</html>
