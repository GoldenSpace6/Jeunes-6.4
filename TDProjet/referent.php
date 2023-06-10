<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <meta charset="utf-8">
    <title>Jeunes 6.4 - Référent</title>
    <?php
        require("script/phpfonction.php");
        
        $demande = array("engagement"=>"","duree"=>"");
        $jeune = array("nom"=>"","prenom"=>"","mail"=>"","duree"=>"","date"=>"");
        $referent = array("");

        if(isset($_GET["id"])){
	    
            $lien = 'inscription.php'; // Lien vers la page de connexion

            //Recupère les données de referantdata.json
            $r_data = read_json("data/demande.json");
            
            //Recupère l'id dans l'url
            $urlid = $_GET["id"];
            
            /*Recupère les données de la demande*/
            $dataid = getrefid($r_data,$urlid);

            if($dataid != -1) {
                $demande = $r_data[$dataid];
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
    <script src="script/checkbox_verification.js" type="text/javascript"></script>
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
            <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
            <li><a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>
        <div class="confirmation_referent">
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
                <textarea name="commentaires" id="commentaires" cols="14" rows="13">Martin s’est très rapidement intégré à notre équipe !</textarea>
            </div>
            <form action="referent.php" method="post" class="carre_referent couleur_referent carre_formulaire">                    <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?php echo $jeune["nom"]?>"><br>
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $jeune["prenom"]?>"><br>
                <label for="date">Date de naissance :</label>
                <input type="date" name="date" id="date_naissance" value="<?php echo $jeune["date"]?>"><br>
                <label for="mail">Mail :</label>
                <input type="e-mail" name="mail" id="e-mail" value="<?php echo $jeune["mail"]?>"><br>
                <label for="reseau">Réseau social :</label>
                <input type="text" name="reseau" id="reseau_social" value="<?php echo $jeune["nom"]?>"><br><br><br>
                <label for="presentation">Présentation :</label>
                <input type="text" name="presentation" id="presentation" value="<?php echo $demande["engagement"]?>"><br>
                <label for="duree">Durée :</label>
                <input type="text" name="duree" id="duree" value="<?php echo $demande["duree"]?>"><br>
            </form>
            <div class="savoir_etre">
                <div class="mes_savoir_etres_2">
                    SES SAVOIRS ETRE
                </div>
                <div class="petit_rectangle_referent">
                    <div class="rectangle_texte_2">
                        Je confirme sa(son)*
                    </div>
                    <form class="liste_checkbox" method="post" action="referent.php">
                        <div>
                            <input type="checkbox" id="confiance" name="competence" value="" onclick="limitCheckboxSelection(this)">
                            <label for="confiance">Confiance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="bienveillance" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="bienveillance">Bienveillance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="respect" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="respect">Respect</label>
                        </div>
                        <div>
                            <input type="checkbox" id="honnetete" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="honnetete">Honnetete</label>
                        </div>
                        <div>
                            <input type="checkbox" id="tolerance" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="tolerance">Tolerance</label>
                        </div>
                        <div>
                            <input type="checkbox" id="juste" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="juste">Juste</label>
                        </div>
                        <div>
                            <input type="checkbox" id="impartial" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="impartial">Impartial</label>
                        </div>
                        <div>
                            <input type="checkbox" id="travail" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="travail">Travail</label>
                        </div>
                        
                    </form>   
                </div>
                
                <div class="respect_choix_2">
                    *Faire 4 choix maximum
                    
                </div>
            </div>
            <a href="" class="bouton_valider_referent">Valider</a>
        </div> 
        
    </div>

</body>
</html>
