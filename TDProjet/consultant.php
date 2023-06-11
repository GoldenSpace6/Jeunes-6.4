<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">

    <title>Jeunes 6.4 - Référent</title>
    <meta charset="utf-8">

    <?php 
	require("script/phpfonction.php");
    $lien = previousPage();

    //Remplissage automatique des champs 
    if(isset($_GET["id"])){
            
        //Recupère l'id dans l'url
        $urlid = $_GET["id"];
        
        /*Recupère les données de la demande de référence*/
        $d_id = getrefid($d_data,$urlid);

        if($d_id != -1) {
            $demande = $d_data[$d_id];
            $referent = $demande["referent"];
            $jeune = $demande["jeune"];
        } else {
            $lien = previousPage();
        }
    } else {
        $lien = previousPage();
    }

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
                <li> <a class="bouton_referent">REFERENT</a> </li>
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
                <div action="profil.php" method="POST" class="texte_carre_jeune couleur_jeune carre_formulaire">
                    <p class="couleur_jeune nom"> JEUNE </p>
                    <label for="nom">Nom :</label>
                    <input type="text" name="j_nom" id="j_nom" value="<?php echo $jeune["nom"]?>" disabled><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="j_prenom" id="j_prenom" value="<?php echo $jeune["prenom"]?>" disabled><br>
                    <label for="mail">Mail :</label>
                    <input type="e-mail" name="j_e-mail" id="j_e-mail" value="<?php echo $jeune["mail"]?>" disabled><br>
                    <label for="date">Date de naissance :</label>
                    <input type="date" name="date" id="date_naissance" value="<?php echo $jeune["date"]?>" disabled><br>
                </div>
            </div>
            <div class="carre_referent">
                <div action="profil.php" method="POST" class="texte_carre_referent couleur_referent carre_formulaire">
                    <p class="couleur_referent nom"> REFERENT </p>

                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $referent["nom"]?>"><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $referent["prenom"]?>"><br>
                    <label for="mail">Mail :</label>
                    <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $referent["mail"]?>"><br>
                    <br><br><br>
                    <label for="presentation">Présentation :</label>
                    <input type="text" name="presentation" id="presentation" value="<?php echo $demande["engagement"]?>"><br>
                    <label for="duree">Durée :</label>
                    <input type="text" name="duree" id="duree" value="<?php echo $demande["duree"]?>"><br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
