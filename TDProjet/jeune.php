<html lang="fr">
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Jeune</title>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    function mail($destinataire,$lien,$nom,$prenom) {
        
        $mail = new PHPMailer(true); //intitialise un élément PHPMailer
        try {
            $mail->SMTPDebug = 0; //désactive les messages d'erreurs
            $mail->isSMTP(); //configure la connection en SMTP
            $mail->Host = 'smtp.laposte.net;'; //Configure l'adresse du serveur
            $mail->SMTPAuth = true; //Configure la connection comme authentifié
            $mail->Username = 'jeune-6.4'; //Configure le nom d'utilisateur de l'adresse mail
            $mail->Password = '20/20Minimum'; //Configure le mot de passe de l'adresse mail
            $mail->SMTPSecure = 'ssl'; //Configure la connection avec le protocole 'ssl'
            $mail->Port = 465; //Configure le port à 465. (le port 587 peut être utilisé avec le protocole tls)
            
            $mail->setFrom('jeune-6.4@laposte.net', 'Jeune-6.4'); //Configure l'adresse mail de l'expéditeur
            $mail->addAddress($destinataire); //Configure l'adresse mail du destinataire
            
            $mail->isHTML(true); //Configure le message du mail comme étant en html
            $mail->Subject = 'Demande de réferencement'; //Définie le l'objet du mail
            $mail->Body = "<p>Bonjour,<br>$nom $prenom a effectué une demande de référencement.<br> Pour plus d'informations, visitez: $lien<br>Si vous n'êtes pas concerné par ce mail, vous pouvez l'ignorer.</p> "; //Définie le message du mail en html
            $mail->AltBody = "Bonjour,   $nom $prenom a effectué une demande de référencement.  Pour plus d'informations, visitez: $lien Si vous n'êtes pas concerné par ce mail, veuillez l'ignorer."; //Définie le message du mail affiché si l'HTML n'est pas supporté.
            $mail->send(); //Envoie le mail
            echo "Mail has been sent successfully!"; //DEBUG
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; //DEBUG
        }
    }
    if($_POST["message"]) {
        mail("mail@ezg.com", "entete");
        
    }
    ?>
</head>


<body>
   <script src="checkbox_verification.js" type="text/javascript"></script>

    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_jeune titre">
                JEUNE
        </div>

        <div class="soustitre">
            Je donne de la valeur a mon engagement
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 

        <ul class="les_modules">
                <li><a class="bouton_jeune background" href="jeune.php">JEUNE</a> </li>
                <li><a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li><a class="bouton_partenaire" href="partenaire.html">PARTENAIRES</a> </li>
        </ul>
        
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
        </div> 
    </div>

    

</body>
</html>
