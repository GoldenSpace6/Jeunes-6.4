<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Profil</title>
    <meta charset="utf-8">
    <?php
    session_start();
    /*if($_POST["message"]) {
    mail("mail@ezg.com", "entete");
    }*/

    
    ?>
</head>


<body>
   <script src="checkbox_verification.js" type="text/javascript"></script>

    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_profil titre">
                Profil
        </div>

        <div class="soustitre">
            Je donne de la valeur a mon engagement
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 

        <ul class="les_modules">
                <li><a class="bouton_jeune background" href="profil.php">PROFIL</a> </li>
                <li><a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li><a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>

        <div class="information_profil">
            <div class="texte_profil">
                Votre Profil
            </div>
            <div class="carre_profil">
                <form action="profil.php" method="POST" class="texte_carre_profil">
                    <!--<//?php echo $err?><br>-->
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>" required><br>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>" required><br>
                    <label for="date">Date de naissance:</label>
                    <input type="Date" name="date" id="date" value="<?php echo $_SESSION["info"]["date"];?>" required><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>" required><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" value="<?php echo $_SESSION["info"]["mdp"];?>" required><br>
                    <button type="submit" id="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>  
    <a class="nouvelle_reference" href="nouvelle_reference.php">Nouvelle reference</a>

</body>
</html>
































        <!--
        <div class="information_jeune">
            <div class="texte_jeune">
                    Decrivez votre experience et mettez en avant ce que vous avez retire.
            </div>
            
            
            <div class="arriere_plan_jeune">
                <img src="image/Capture_numero_3-removebg-preview.png" > 
            </div>
            <div class="carre_jeune">
                <form action="jeune.php" method="post" class="texte_carre_jeune">
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
                        <input type="e-mail" name="e-mail" id="e-mail" required><br><br>
                        <button type="submit" id="submit">Envoyer</button>
                </form>
            </div>
            <div class="savoir_etre">
                <div class="mes_savoir_etres">
                    MES SAVOIRS ETRE
                </div>
                
                <div class="petit_rectangle_jeune">
                    <div class="rectangle_texte_1">
                        Je suis*
                    </div>
                    <form class="liste_checkbox" method="post" action="jeune.php">
                        <div>
                            <input type="checkbox" id="autonome" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="autonome">Autonome</label>
                        </div>
                        <div>
                            <input type="checkbox" id="passionne" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="passionne">Passionne</label>
                        </div>
                        <div>
                            <input type="checkbox" id="reflechi" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="reflechi">Reflechi</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a_l_ecoute" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="a_l_ecoute">A l'ecoute</label>
                        </div>
                        <div>
                            <input type="checkbox" id="organise" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="organise">Organise</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fiable" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="fiable">Fiable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="patient" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="patient">Patient</label>
                        </div>
                        <div>
                            <input type="checkbox" id="responsable" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="responsable">Responsable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sociable" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="sociable">Sociable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="optimiste" name="competence" onclick="limitCheckboxSelection(this)">
                            <label for="optimiste">Optimiste</label>
                        </div>
                    </form>   
                </div>
                
                <div class="respect_choix">
                    *Faire 4 choix maximum
                    
                </div>
                
            </div>
        </div> -->
