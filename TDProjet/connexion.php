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

            /*Verifie l'existance du compte jeune*/
            $id=getid($j_data,$mail);
            
            /*Verifie le mot de passe*/
            if ($id===-1 or !password_verify($mdp,$j_data[$id]["mdp"])){
                $error = "E-Mail ou mot de passe invalide.";
            } else {
                /*Créé un session*/
                $_SESSION["id"] = $id;
                $_SESSION["info"] = $j_data[$id];
                $_SESSION['statut'] = 'connecter';
                
                /*redirige vers la page d'accueil*/
                header("Location: presentation.php");
            }
        }
    ?>
</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_connexion titre">
                CONNEXION
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page">  
        <div class="les_modules">
                <li> <a class="bouton_connexion background" href="connexion.php">JEUNE</a> </li>
                <li> <a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li> <a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </div>

        <div class="information_connexion">
            <div class="couleur_connexion texte_formulaire">
                Connecte ton compte
            </div>
            <form action="connexion.php" method="POST" class="carre_connexion couleur_connexion carre_formulaire">
                    <?php echo $error?><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" required><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" required> <br> <br>
                    <div class="boutton_submit"><button type="submit" id="submit">Connexion</button></div>
            </form>
            <div class="jai_pas_compte"><a href="inscription.php">Je n'ai pas de compte</a></div>
        </div>
    </div>  
</body>
</html>
