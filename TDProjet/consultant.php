<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">

    <title>Jeunes 6.4 - Référent</title>
    <meta charset="utf-8">

    <?php 
	require("script/phpfonction.php");
        previousPage();
    ?>

</head>


<body>
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_consultant titre">
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
    <div class="information_pour_consultant">
        <div class="texte_formulaire couleur_consultant">
            Validez cet engagement en prenant en compte sa valeur
        </div>
        <div class="arriere_plan">
            <img src="image/6.4_Bleu.png" >
        </div>
        <div class="carre_consultant">
                <div class="carre_jeune">
                    <form action="profil.php" method="POST" class="texte_carre_jeune couleur_jeune carre_formulaire">
                        <p class="couleur_jeune nom"> JEUNE </p>
                        <!--<//?php echo $err?><br>-->
                        <label for="nom">Nom:</label>
                        <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>" disabled><br>
                        <label for="prenom">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>" disabled><br>
                        <label for="date">Date de naissance:</label>
                        <input type="Date" name="date" id="date" value="<?php echo $_SESSION["info"]["date"];?>" disabled><br>
                        <label for="e-mail">E-mail:</label>
                        <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>" disabled><br>
                        <label for="reseau">Réseau social :</label>
                        <input type="text" name="reseau" id="reseau_social" value="<?php echo $jeune["nom"]?>"><br><br><br>
                        <label for="presentation">Mon engagement :</label>
                        <input type="text" name="engagement" id="engagement" value="<?php echo $demande["engagement"]?>"><br>
                        <label for="duree">Durée :</label>
                        <input type="text" name="duree" id="duree" value="<?php echo $demande["duree"]?>"><br>
                    </form>
                </div>
                <div class="carre_referent">
                    <form action="profil.php" method="POST" class="texte_carre_referent couleur_referent carre_formulaire">
                        <p class="couleur_referent nom"> REFERENT </p>
                        <!--<//?php echo $err?><br>-->
                        <label for="nom">Nom:</label>
                        <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>" disabled><br>
                        <label for="prenom">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>" disabled><br>
                        <label for="date">Date de naissance:</label>
                        <input type="Date" name="date" id="date" value="<?php echo $_SESSION["info"]["date"];?>" disabled><br>
                        <label for="e-mail">E-mail:</label>
                        <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>" disabled><br>
                        <label for="reseau">Réseau social :</label>
                        <input type="text" name="reseau" id="reseau_social" value="<?php echo $jeune["nom"]?>"><br><br><br>
                        <label for="presentation">Présentation :</label>
                        <input type="text" name="presentation" id="presentation" value="<?php echo $demande["engagement"]?>"><br>
                        <label for="duree">Durée :</label>
                        <input type="text" name="duree" id="duree" value="<?php echo $demande["duree"]?>"><br>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>
