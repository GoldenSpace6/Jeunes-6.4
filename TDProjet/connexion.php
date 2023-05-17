<html>
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Inscription</title>

    <?php
    function find($tab,$email) {
        foreach($tab as $i) {
        }
        echo $email;
    }

    $url = "test.json";
    $file = file_get_contents($url);
    $arr = json_decode($file,true);
    
    $err = "";
    $nom = $prenom = $mail = $date = $mdp = "";
        
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    if (empty($mail) or empty($mdp) or getmdp($arr,$mail)!=$mdp) {
        $err = "E-Mail ou mot de passe invalide";
    } else {
        echo "Bonjour".$mail;
        getmdp($arr,$mail);
        //header("home.html");
    }
?>
</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.html"><img class="logo_home" src="image/logohome-removebg-preview.png"></a>

        <div class="titre_inscription">
                INSCRIPTION
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
                    <input type="e-mail" name="mail" id="e-mail"><br>
                    <label for="mdp">Mot de passe</label>
                    <input type="passeword" name="mdp" id="mdp">
                    <button type="submit">Connexion</button>
                </fieldset> 
            </form>
        </div>
    </div>  
    <a href="inscription.php">Je n'ai pas de compte</a>
</body>
</html>
