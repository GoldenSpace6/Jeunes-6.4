<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <title>Jeunes 6.4 - Jeune</title>
    <meta charset="utf-8">
    <?php
        require("script/phpfonction.php");

        $errmail = $nom = $prenom = $mail = $duree = $eng = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Recupère les données de demande_reference.json
            $d_url = "data/demande_reference.json";
            $d_data = read_json($d_url);

            //Recupère les données du formulaire
            if(isset($_POST["duree"])){
                $duree = $_POST["duree"];
            }
            if(isset($_POST["mon_engagement"])){
                $eng = $_POST["mon_engagement"];
            }
            //Referent
            if(isset($_POST["nom"])){
                $nom = $_POST["nom"];
            }
            if(isset($_POST["prenom"])){
                $prenom = $_POST["prenom"];
            }
            if(isset($_POST["e-mail"])){
                $mail = $_POST["e-mail"];
            }

            /*Genère un id random*/
            do {
                $url_id=rand(0,100000);
            } while(getrefid($d_data,$url_id) != -1);

            /*Créé une nouvelle référence*/
            $new=array(
                "id"=>$url_id,
                "referent"=>array("nom"=>$nom,"prenom"=>$prenom,"mail"=>$mail),
                "jeune"=>$_SESSION["info"],
                "duree"=>$duree,
                "engagement"=>$eng,
                "commentaire"=>"",
                "competence_ref"=>"",
                "etat"=>"en attente"
            );

            /*L'ajoute au fichier*/
            array_push($d_data,$new);
            file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));
            
            /*Envoie un email de référence*/
            $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url=rtrim($url, "nouvelle_reference.php")."referent.php?id=".$url_id;
			$msg="<p>Bonjour,<br><br>
			Le projet Jeunes-6.4 est un dispositif de valorisation de l&#39;engagement des jeunes en Pyr&#233;n&#233;es<br>
			Atlantiques soutenu par l&#39;Etat, le Conseil G&#233;n&#233;ral, le Conseil R&#233;gional, les CAF B&#233;arn<br>
			Soule et Pays Basque, la MSA, la CPAM. Le projet, adress&#233; aux jeunes entre 16 et 30 ans, vise &#224; valoriser<br>
			toute exp&#233;rience comme source d&#39;enrichissement qui puisse &#234;tre reconnue comme l&#39;expression d&#39;un savoir-faire ou savoir-&#234;tre.<br>
			Afin de compl&#233;ter leur CV, les jeunes peuvent demander des r&#233;f&#233;rences qui confirment leur exp&#233;rience<br>
			(clubs de sport, b&#233;n&#233;volat, services &#224; domiciles, etc.). Ces r&#233;f&#233;rences pourront &#234;tre consult&#233;es par un recruteur potentiel.<br><br>
			Dans le cadre de ce dispositif, $nom $prenom a effectu&#233; une demande de r&#233;f&#233;rencement.<br>
			Pour accepter cette demande en temps que r&#233;f&#233;rent, visitez: <a href=$url>Jeune-6.4</a><br>Si vous n&#39;&#234;tes pas concern&#233; par ce mail, vous pouvez l&#39;ignorer.</p>";
            sendmail($mail, $msg, "Demande de referencement");
            
            /*Redirige vers la page d'accueil*/
            header("Location: presentation.php");
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
            Je donne de la valeur a mon engagement
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 

        <ul class="les_modules">
                <li><a class="bouton_jeune background" href="profil.php">JEUNE</a> </li>
                <li><a class="bouton_referent">REFERENT</a> </li>
                <li><a class="bouton_consultant">CONSULTANT</a>  </li> 
                <li><a class="bouton_partenaire" href="partenaire.html">PARTENAIRES</a> </li>
        </ul>
        
        <div class="information_jeune">
            <div class="couleur_jeune texte_formulaire">
                    Decrivez votre experience et mettez en avant ce que vous avez retire.
            </div>
            
            <div class="arriere_plan">
                <img src="image/6.4_Rose.png" >
            </div>

            <form action="nouvelle_reference.php" method="post">
            
                <div class="carre_jeune couleur_jeune carre_formulaire">
                    <h3>Experience :</h3>
                    <label for="mon_engagement">Mon engagement :</label>
                    <input type="text" name="mon_engagement" id="mon_engagement" required><br>
                    <label for="duree">Duree :</label>
                    <input type="text" name="duree" id="duree" required>
                    <h3>Référent :</h3>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required><br>
                    <label for="prenom">Prenom :</label>
                    <input type="text" name="prenom" id="prenom" required><br>
                    <label for="e-mail">E-mail :</label>
                    <input type="e-mail" name="e-mail" id="e-mail" required><br><?php echo $errmail ?><br>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
        </div> 
    </div>

    

</body>
</html>
