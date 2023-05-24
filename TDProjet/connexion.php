<html>
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Inscription</title>

    <?php
    function getid($tab,$email) {
        for ($i = 0; $i <= count($tab; $i++) {
        foreach($tab as $jeune) {
            if($tab[$i]["mail"] == $email) {
                return $i;
            }
        }
        return null;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = "jeunedata.json";
    $file = file_get_contents($url);
    $data = json_decode($file,true);
    
    $err = "";
    $nom = $prenom = $mail = $date = $mdp = "";
    

    if(isset($_POST["e-mail"])){
        $mail = $_POST["e-mail"];
    }
    if(isset($_POST["mdp"])){
        $mdp = $_POST["mdp"];
    }
    $id=getid($data,$mail);
    
    if (empty($id) or $data[$id]["mdp"]!=$mdp) {
        $err = "E-Mail ou mot de passe invalide.";
    } else {
        echo "Bonjour ".$mail;
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["info"] = $data[$id];
        //header("home.html");
    }
    }
?>
</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_inscription titre">
                CONNEXION
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page">  
        <div class="les_modules">
                <li> <a class="bouton_jeune" href="jeune.html">JEUNE</a> </li>
                <li> <a class="bouton_referent" href="referent.html">REFERENT</a> </li>
                <li> <a class="bouton_consultant" href="consultant.html">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.html">PARTENAIRES</a> </li>
        </div>
        
        <div class="texte_connexion">
            <form action="connexion.php" method="POST">
                <fieldset>
                    <legend>Connecte ton compte</legend>
                    <?php echo $err?><br>
                    <label for="e-mail">E-mail</label>
                    <input type="e-mail" name="mail" id="e-mail" required><br>
                    <label for="mdp">Mot de passe</label>
                    <input type="passeword" name="mdp" id="mdp" required>
                    <button type="submit">Connexion</button>
                </fieldset> 
            </form>
        </div>
    </div>  
    <a href="inscription.php">Je n'ai pas de compte</a>
</body>
</html>
