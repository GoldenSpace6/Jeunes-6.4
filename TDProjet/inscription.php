<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Inscription</title>
    <meta charset="utf-8">
    <script src="script/verif_case.js" type="text/javascript"></script>
    <?php
        require("script/phpfonction.php");
		
		//Met à jour la page actuelle
        if(isset($_SESSION['page_actuelle'])){
            $_SESSION['page_actuelle'] = 'inscription.php';
        }
        
		//initialise les champs
        $errmail = $nom = $prenom = $mail = $date = $mdp = $competences = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Recupère les données de jeunedata.json
            $j_url = "data/jeunedata.json";
            $j_data = read_json($j_url);
                
            //Recupère les données du formulaire
            if(isset($_POST["nom"])){
                $nom = $_POST["nom"];
            }
            if(isset($_POST["prenom"])){
                $prenom = $_POST["prenom"];
            }
            if(isset($_POST["e-mail"])){
                $mail = $_POST["e-mail"];
            }
            if(isset($_POST["date"])){
                $date = $_POST["date"];
            }
            if(isset($_POST["mdp"])){
                $mdp = $_POST["mdp"];
            }
            if(isset($_POST["competence"])){
                $competences = $_POST["competence"];
            }
            /*Vérifie qu'aucun compte n'existe avec ce mail*/
            $id=getid($j_data,$mail);

            if ($id!=-1) {
                $errmail="e-mail deja inscrit.";
            } else {
                
                /*Créé un nouveau compte jeune*/
                $new=array(
                    "nom"=>$nom,
                    "prenom"=>$prenom,
                    "mail"=>$mail,
                    "date"=>$date,
                    "mdp"=>password_hash($mdp,PASSWORD_DEFAULT), /*Hash le mot de passe*/
                    "competences"=>$competences
                );
                
                /*L'ajoute au fichier*/
                array_push($j_data,$new);
                file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));
                
               
                /*Créé un session*/
                $_SESSION["id"] = $id;
                $_SESSION["info"] = $new;
                $_SESSION['statut'] = 'connecter';
                
                /*redirige vers la page d'accueil*/
                header("Location: presentation.php");
                
            }
        }
        
    ?>

</head>


<body>
    
    <div class="haut_de_page">
	<!-- Logo renvoyant vers l'accueil-->
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_jeune titre">
                INSCRIPTION
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
	<!-- Boutons des modules-->
        <ul class="les_modules">
                <li> <a class="bouton_jeune background" href="inscription.php">JEUNE</a> </li>
                <li> <a class="bouton_referent">REFERENT</a> </li>
                <li> <a class="bouton_consultant">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>
        <form action="inscription.php" method="post" class="information_jeune">    
            <div class="couleur_jeune texte_formulaire">
                Créer ton compte
            </div>
			<!-- Champs de saisie pour l'inscription-->
            <div class="texte_carre_inscription couleur_jeune carre_formulaire">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" required><br>
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom" required><br>
                <label for="date">Date de naissance:</label>
                <input type="Date" name="date" id="date" required><br>
                <label for="e-mail">E-mail:</label>
                <input type="e-mail" name="e-mail" id="e-mail" required><br>
				
				<!-- Espace pour le message d'erreur si l'email est déjà associé à un compte-->
				<?php echo $errmail; ?><br>
				
				<!-- Champ du mot de passe, d'au moins 8 caractères-->
                <label for="mdp">Mot de passe:</label>
                <input type="password" name="mdp" id="mdp" minlenght="8" required><br>
				
				<!-- Bouton de validation-->
                <div class="boutton_submit"><button type="submit" id="submit">Login</button></div>
            </div>

            <div class="savoir_etre">
                <div class="mes_savoir_etres">
                    MES SAVOIRS ETRE
                </div>
                    
                <div class="petit_rectangle_jeune liste_checkbox" method="POST" action="inscription.php">
                        <div class="rectangle_texte_1">
                            Je suis*
                        </div>
						<!-- Cases des différents savoir-êtres, associées à la fonction caseMax
						qui coche la case seulement si il n'y en a pas déjà 4 de cochées-->
                        <div>
                            <input type="checkbox" id="autonome" name="competence[]" value="autonome" onclick="caseMax(this)">
                            <label for="autonome">Autonome</label>
                        </div>
                        <div>
                            <input type="checkbox" id="passionne" name="competence[]" value="passionne" onclick="caseMax(this)">
                            <label for="passionne">Passionne</label> 
                        </div>
                        <div>
                            <input type="checkbox" id="reflechi" name="competence[]" value="reflechi" onclick="caseMax(this)">
                            <label for="reflechi">Reflechi</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a_l_ecoute" name="competence[]" value="a_l_ecoute" onclick="caseMax(this)">
                            <label for="a_l_ecoute">A l'ecoute</label>
                        </div>
                        <div>
                            <input type="checkbox" id="organise" name="competence[]" value="organise" onclick="caseMax(this)">
                            <label for="organise">Organise</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fiable" name="competence[]" value="fiable" onclick="caseMax(this)">
                            <label for="fiable">Fiable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="patient" name="competence[]" value="patient" onclick="caseMax(this)">
                            <label for="patient">Patient</label>
                        </div>
                        <div>
                            <input type="checkbox" id="responsable" name="competence[]" value="responsable" onclick="caseMax(this)">
                            <label for="responsable">Responsable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sociable" name="competence[]" value="sociable" onclick="caseMax(this)">
                            <label for="sociable">Sociable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="optimiste" name="competence[]" value="optimiste" onclick="caseMax(this)">
                            <label for="optimiste">Optimiste</label>
                        </div>
                    </div>
                
                <div class="respect_choix">
                    *Faire 4 choix maximum
                    
                </div>
            </div> 
			
			<!-- Bouton pour aller à la page de connexion-->
            <div class="deja_un_compte"><a href="connexion.php">J'ai déjà un compte</a></div>
    </form>
    </div> 
</body>
</html>