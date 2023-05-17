<html>
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Inscription</title>

    <?php
    function find($tab,$email) {
        echo $email;
    }

    $url = "test.json";
    $file = file_get_contents($url);
    $arr = json_decode($file,true);
    
    $errNom = $errPrenom = $errMail = $errDate = $errMdp = "";
    $nom = $prenom = $mail = $date = $mdp = "";
        
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $date = $_POST["date"];
    $mdp = $_POST["mdp"];
    if (empty($mail)) {
        $errMail = "Mail n'existe pas ou vide";
    } 
    if(empty($nom)) {
        $errNom = "Nom manquant";
        $err = 1;
    }
    if(empty($prenom)) {
        $errPrenom = "Prenom manquant";
        $err = 1;
    }
    if(empty($date)) {
        $errDate = "*Date manquant";
        $err = 1;
    }
    if(empty($mdp)) {
        $errMdp = "*Mot de passe manquant";
        $err = 1;
    }
    if($err != 1) {
        find($arr,$mail);

        array_push($arr,array(
            "nom"=>$nom,
            "prenom"=>$prenom,
            "mail"=>$mail,
            "date"=>$date,
            "mdp"=>$mdp
        ));
        //echo 'Bonjour ' . htmlspecialchars($_POST["nom"]) . '!';
    
        file_put_contents($url,json_encode($arr,JSON_PRETTY_PRINT));
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
    
        <div class="texte_inscription">
            <form action="inscription.php" method="POST">
                <fieldset>
                    <legend>Créer ton compte</legend>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom"><?php echo $errNom?><br>
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom"><?php echo $errPrenom?><br>
                    <label for="date">Date de naissance</label>
                    <input type="Date" name="date" id="date"><?php echo $errDate?><br>
                    <label for="e-mail">E-mail</label>
                    <input type="email" name="mail" id="e-mail"><?php echo $errMail?><br>
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp" minlenght="8"><?php echo $errMdp?>
                    <button type="submit">Login</button>
                </fieldset> 
            </form>
        </div>
    </div>  
    <a href="connexion.html">J'ai déjà un compte</a>
</body>
</html>
