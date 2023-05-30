<html>
<head>

    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Jeunes 6.4 - Inscription</title>
    <script src="checkbox_verification.js" type="text/javascript"></script>
    <?php
    
    function getid($tab,$email) {
        for ($i = 0; $i <= count($tab); $i++) {
            if($tab[$i]["mail"] == $email) {
                return $i;
            }
        }
        return -1;
    }

        function error() {
            return false;
        }
        $errmail = "";
        
        session_start();
        if(isset($_SESSION['page_actuelle'])){
            $_SESSION['page_actuelle'] = 'inscription.php';
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $url = "jeunedata.json";
            $file = file_get_contents($url);
            $data = json_decode($file,true);
                
            $nom = $prenom = $mail = $date = $mdp = "";

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

            $id=getid($data,$mail);

            if(error()) {
                die("ERR0R");
            }elseif ($id===-1) {
                $errmail="e-mail deja inscrit.";
            } else {
                $new=array(
                    "nom"=>$nom,
                    "prenom"=>$prenom,
                    "mail"=>$mail,
                    "date"=>$date,
                    "mdp"=>$mdp
                );
                array_push($data,$new);
                file_put_contents($url,json_encode($data,JSON_PRETTY_PRINT));
                
               
                $_SESSION["id"] = $id;
                $_SESSION["info"] = $new;
                $_SESSION['statut'] = 'connecter';
                
                header("Location: presentation.php");
                
            }
        }
        
    ?>

</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_inscription titre">
                INSCRIPTION
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page">  
        <ul class="les_modules">
                <li> <a class="bouton_jeune background" href="inscription.php">JEUNE</a> </li>
                <li> <a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li> <a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>
        <div class="information_inscription">    
            <div class="texte_inscription">
                Créer ton compte
            </div>

            <div class="carre_inscription">
                <form action="inscription.php" method="post" class="texte_carre_inscription">
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["id"][];?>" required><br>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" required><br>
                    <label for="date">Date de naissance:</label>
                    <input type="Date" name="date" id="date" required><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" required> <br><?php echo $errmail; ?><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" minlenght="8" required><br>
                    <button type="submit" id="submit">Login</button>
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
        <a class="deja_un_compte" href="connexion.php">J'ai déjà un compte</a>
</body>
</html>

