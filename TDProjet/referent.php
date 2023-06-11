<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <meta charset="utf-8">
    <title>Jeunes 6.4 - Référent</title>
    <?php
        require("script/phpfonction.php");
        
		//Initialise la demande
        $demande = array("engagement"=>"","duree"=>"","commentaire"=>"","etat"=>"en attente","competence_ref"=>"");
		
        $jeune = array("nom"=>"","prenom"=>"","mail"=>"","date"=>"","mdp"=>"");
        $referent = array("nom"=>"","prenom"=>"","mail"=>"");
        
		//Initialise l'id contenu dans l'url
		$urlid = "";

        $lien = 'inscription.php'; // Lien vers la page de connexion

        //Recupère les données de demande_reference.json
        $d_url = "data/demande_reference.json";
        $d_data = read_json($d_url);

        //Validation du référant 
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            //Recupère les données du formulaire
            if(isset($_POST["id"])){
                $urlid = $_POST["id"];
            }
            //Commentaire
            if(isset($_POST["commentaire"])){
                $comm = $_POST["commentaire"];
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
            //Competence
            if(isset($_POST["competence"])){
                $competences = $_POST["competence"];
            }

            /*Recupère les données de la demande de référence*/
            $d_id = getrefid($d_data,$urlid);
			
			//Valide la référence ssi l'id de l'url est valide
            if($d_id != -1) {
                /*Modifie la référence, dont les informations du référent,
				si jamais le jeune a fait une faute en les remplissant dans la demande*/
                $d_data[$d_id]["commentaire"] = $comm;
                $d_data[$d_id]["referent"] = array("nom"=>$nom,"prenom"=>$prenom,"mail"=>$mail);
                $d_data[$d_id]["competence_ref"] = $competences;
                $d_data[$d_id]["etat"] = "valide";
				$prenom=$d_data[$d_id]["jeune"]["prenom"];
				$mail=$d_data[$d_id]["jeune"]["mail"];
				
                /*Sauvegarde les modification dans demande_reference.json*/
                file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));

                /*=== Envoie d'un email de confirmation au jeune ===*/
				
				//récupère l'adresse de la page actuelle
				$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				
				//modifie la fin de l'adresse pour remplacer le fichier en fin d'adresse par home.html
				$url=rtrim($url, "referent.php")."home.html";
				
				//Définie le message du mail
				$msg="Bonjour $prenom,<br>
				Une demande de r&#233;f&#233;rencement a &#233;t&#233; valid&#233;.<br>
				Pour plus d&#39;informations, visite <a href=$url>Jeune-6.4</a>";
				
				//Envoi du mail (destinataire, message, objet du mail)
                sendmail($mail, $msg, "Confirmation de referencement");
				
				
				
				/*Redirige le référent vers la page de remerciements*/
                header("Location: remerciement.html");
            }
            
        }
        //Remplissage automatique des champs 
        if(isset($_GET["id"])){
            
            //Recupère l'id dans l'url
            $urlid = $_GET["id"];
            
            /*Recupère les données de la demande de référence*/
            $d_id = getrefid($d_data,$urlid);
			
			//Rempli les champs ssi l'id  contenue dans l'url est valide
            if($d_id != -1) {
                $demande = $d_data[$d_id];
                $referent = $demande["referent"];
                $jeune = $demande["jeune"];
				
			
		    //Sinon, si il n'y a pas d'id dans l'url ou qu'il n'est pas valide, l'utilisateur est renvoyé à la page d'accueil
            } else {
                header("Location: home.html");
            }
        } else {
    	    header("Location: home.html");
        }
    ?>
</head>


<body>
    <script src="script/verif_case.js" type="text/javascript"></script>
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_referent titre">
                REFERENT
        </div>

        <div class="soustitre">
            Je confirme la valeur de ton engagement
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        <ul class="les_modules">
            <li><a class="bouton_jeune" href="<?php echo $lien; ?>">JEUNE</a> </li>
            <li><a class="bouton_referent background" href="referent.php">REFERENT</a> </li>
            <li><a class="bouton_consultant">CONSULTANT</a>  </li> 
            <li><a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>
        <form action="referent.php" method="post" class="confirmation_referent">
            <input type="hidden" name="id" value="<?php echo $urlid?>">    
            <div class="couleur_referent texte_formulaire">
                Confirmez cette experience et ce que vous avez pu constater au contact de ce jeune.
            </div>
            <div class="arriere_plan">
                <img src="image/6.4_Vert.png" >
            </div>

            <div class="boite_commentaire">
                <div class="titre_commentaire">
                    COMMENTAIRES
                </div>
                <textarea name="commentaire" id="commentaire" cols="14" rows="13" ><?php echo $demande["commentaire"]?></textarea>
            </div>
            <div class="carre_referent couleur_referent carre_formulaire">
                <label>Référent (Vous) :</label><br>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?php echo $referent["nom"]?>"><br>
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $referent["prenom"]?>"><br>
                <label for="mail">Mail :</label>
                <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $referent["mail"]?>"><br>
                <br><br>
                <label>Information du jeune :</label><br>
                <label for="nom">Nom :</label>
                <input type="text" name="j_nom" id="j_nom" value="<?php echo $jeune["nom"]?>" disabled><br>
                <label for="prenom">Prénom :</label>
                <input type="text" name="j_prenom" id="j_prenom" value="<?php echo $jeune["prenom"]?>" disabled><br>
                <label for="mail">Mail :</label>
                <input type="e-mail" name="j_e-mail" id="j_e-mail" value="<?php echo $jeune["mail"]?>" disabled><br>
                <label for="date">Date de naissance :</label>
                <input type="date" name="date" id="date_naissance" value="<?php echo $jeune["date"]?>" disabled><br>
                <!-- <label for="reseau">Réseau social :</label>
                <input type="text" name="reseau" id="reseau_social" value=""><br>--><br>
                <label for="presentation">Présentation :</label>
                <input type="text" name="presentation" id="presentation" value="<?php echo $demande["engagement"]?>" disabled><br>
                <label for="duree">Durée :</label>
                <input type="text" name="duree" id="duree" value="<?php echo $demande["duree"]?>" disabled><br>
            </div>
            <div class="savoir_etre">
                <div class="mes_savoir_etres_2">
                    SES SAVOIRS ETRE
                </div>
                <div class="petit_rectangle_referent">
                    <div class="rectangle_texte_2">
                        Je confirme sa(son)*
                    </div>
                    <div action="referent.php">
                        <div>
                            <input type="checkbox" id="confiance" name="competence[]" value="confiance" onclick="caseMax(this)">
                            <label for="confiance">Confiance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="bienveillance" name="competence[]" value="bienveillance" onclick="caseMax(this)">
                            <label for="bienveillance">Bienveillance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="respect" name="competence[]" value="respect" onclick="caseMax(this)">
                            <label for="respect">Respect</label>
                        </div>
                        <div>
                            <input type="checkbox" id="honnetete" name="competence[]" value="honnetete" onclick="caseMax(this)">
                            <label for="honnetete">Honnetete</label>
                        </div>
                        <div>
                            <input type="checkbox" id="tolerance" name="competence[]" value="tolerance" onclick="caseMax(this)">
                            <label for="tolerance">Tolerance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="juste" name="competence[]" value="juste" onclick="caseMax(this)">
                            <label for="juste">Juste</label>
                        </div>
                        <div>
                            <input type="checkbox" id="impartial" name="competence[]" value="impartial" onclick="caseMax(this)">
                            <label for="impartial">Impartial</label>
                        </div>
                        <div>
                            <input type="checkbox" id="travail" name="competence[]" value="travail" onclick="caseMax(this)">
                            <label for="travail">Travail</label>
                        </div>
                        
                    </div>   
                </div>
                
                <div class="respect_choix_2">
                    *Faire 4 choix maximum
                    
                </div>
            </div>
            <button name="valider" type="submit" id="valider" class="bouton_valider_referent">Valider</a>
        </form> 
        
    </div>

</body>
</html>
