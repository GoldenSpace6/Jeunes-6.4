<html>
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Connexion</title>

    <?php
    require("script/phpfonction.php");
    session_start();
    
    $error = "";
    
    if(isset($_SESSION['page_actuelle'])){
        $_SESSION['page_actuelle'] = 'connexion.php';
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = "data/jeunedata.json";
    $file = file_get_contents($url);
    $data = json_decode($file,true);
    
    
    $nom = $prenom = $mail = $date = $mdp = "";
    

    if(isset($_POST["e-mail"])){
        $mail = $_POST["e-mail"];
    }
    if(isset($_POST["mdp"])){
        $mdp = $_POST["mdp"];
    }
    $id=getid($data,$mail);
    
    if ($id===-1 or $data[$id]["mdp"]!=$mdp){
        $error = "E-Mail ou mot de passe invalide.";
    } else {
        echo "Bonjour ".$mail;
        $_SESSION["id"] = $id;
        $_SESSION["info"] = $data[$id];
        $_SESSION['statut'] = 'connecter';
        header("Location: presentation.php");
    }
    }
?>
</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_connexion titre">
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
            <div class="texte_connexion">
                Connecte ton compte
            </div>
            <div class="carre_connexion">
                <form action="connexion.php" method="POST" class="texte_carre_connexion">
                        <?php echo $error?><br>
                        <label for="e-mail">E-mail:</label>
                        <input type="e-mail" name="e-mail" id="e-mail" required><br>
                        <label for="mdp">Mot de passe:</label>
                        <input type="password" name="mdp" id="mdp" required> <br> <br>
                        <div class="boutton_submit"><button type="submit" id="submit">Connexion</button></div>
                </form>
            </div>
            <div class="jai_pas_compte"><a href="inscription.php">Je n'ai pas de compte</a></div>
        </div>
    </div>  
</body>
</html>
