<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Connexion</title>
    <meta charset="utf-8">

    <?php
        require("script/phpfonction.php");
        
        $error = $nom = $prenom = $mail = $date = $mdp = "";
        
		//met à jour la page actuelle
        if(isset($_SESSION['page_actuelle'])){
            $_SESSION['page_actuelle'] = 'connexion.php';
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            //Recupère les données de jeunedata.json
            $j_data = read_json("data/jeunedata.json");
            
            //Recupère les données du formulaire
            if(isset($_POST["e-mail"])){
                $mail = $_POST["e-mail"];
            }
            if(isset($_POST["mdp"])){
                $mdp = $_POST["mdp"];
            }

            /*Recherche le compte jeune*/
            $id=getid($j_data,$mail);
            
            /*Verifie le mot de passe et l'existance du compte*/
            if ($id===-1 or !password_verify($mdp,$j_data[$id]["mdp"])){
                $error = "E-Mail ou mot de passe invalide.";
            } else {
                /*Créé un session contenant le statut "connecter" et les informations du jeune*/
                $_SESSION["id"] = $id;
                $_SESSION["info"] = $j_data[$id];
                $_SESSION['statut'] = 'connecter';
                
                /*Redirige vers la page d'accueil*/
                header("Location: presentation.php");
            }
        }
    ?>
</head>


<body>
    
    <div class="haut_de_page">
	<!-- Logo renvoyant vers l'accueil -->
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_jeune titre">
                CONNEXION
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page">
		<!-- Boutons des modules-->
        <div class="les_modules">
                <li> <a class="bouton_jeune background" href="inscription.php">JEUNE</a> </li>
                <li> <a class="bouton_referent">REFERENT</a> </li>
                <li> <a class="bouton_consultant">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </div>

        <div class="information_connexion">
            <div class="couleur_jeune texte_formulaire">
                Connecte ton compte
            </div>
            <form action="connexion.php" method="POST" class="carre_connexion couleur_jeune carre_formulaire">
                    <!-- Message d'erreur, vide de base-->
					<?php echo $error?><br>
					
					<!-- Champs de saisie pour la connexion-->
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" required><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" required> <br> <br>
					
					<!-- Bouton de connexion-->
                    <div class="boutton_submit"><button type="submit" id="submit">Connexion</button></div>
            </form>
			<!-- Bouton de changement de page vers la création de compte-->
            <div class="jai_pas_compte"><a href="inscription.php">Je n'ai pas de compte</a></div>
        </div>
    </div>  
</body>
</html>