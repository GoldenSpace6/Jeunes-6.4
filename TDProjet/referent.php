<html lang="fr">
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Référent</title>
    <?php
        function getrefid($tab,$code) {
            for ($i = 0; $i <= count($tab); $i++) {
                if($tab[$i]["id"] == $code) {
                    return $i;
                }
            }
            return -1;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $url = "jeunedata.json";
            $file = file_get_contents($url);
            $arr = json_decode($file,true);
  
            $urlid = $_GET("id");
            $dataid = getrefid($data,$urlid);
            if($dataid != -1) {
                $demande = $data[$temp];
            }
        }
    ?>
</head>


<body>
    <script src="checkbox_verification.js" type="text/javascript"></script>
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_referent titre">
                REFERENT
        </div>

        <div class="soustitre">
            Je confirme la valeur de ton engagement
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        <ul class="les_modules">
            <li><a class="bouton_jeune" href="jeune.php">JEUNE</a> </li>
            <li><a class="bouton_referent background" href="referent.php">REFERENT</a> </li>
            <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
            <li><a class="bouton_partenaire" href="partenaire.html">PARTENAIRES</a> </li>
        </ul>
        <div class="confirmation_referent">
            <div class="texte_referent">
                Confirmez cette experience et ce que vous avez pu constater au contact de ce jeune.
            </div>
            <div class="arriere_plan_referent">
                <img src="image/Capture_numero_3-removebg-preview.png" > 
            </div>

            <div class="carre_referent">
                <form action="referent.php" method="post" class="texte_carre_referent">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom"><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom"><br>
                    <label for="date">Date de naissance :</label>
                    <input type="date" name="date" id="date_naissance"><br>
                    <label for="mail">Mail :</label>
                    <input type="e-mail" name="mail" id="e-mail"><br>
                    <label for="reseau">Réseau social :</label>
                    <input type="text" name="reseau" id="reseau_social"><br><br><br>
                    <label for="presentation">Présentation :</label>
                    <input type="text" name="presentation" id="presentation"><br>
                    <label for="duree">Durée :</label>
                    <input type="text" name="duree" id="duree"><br>
                </form>
            </div>
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
                            <input type="checkbox" id="confiance" name="competence" value="<?php echo "test"?>" onclick="limitCheckboxSelection(this)">
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
        <div class="boite_commentaire">
            <div class="titre_commentaire">
                COMMENTAIRES
            </div>
            <textarea name="commentaires" id="commentaires" cols="14" rows="13">Martin s’est très rapidement intégré à notre équipe !</textarea>
        </div>   
    </div>

    

</body>
</html>
