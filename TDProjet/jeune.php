<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <title>Jeunes 6.4 - Jeune</title>
    <?php
        require("script/phpfonction.php");
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Recupère referantdata.json
            $r_url = "data/referantdata.json";
            $r_file = file_get_contents($r_url);
            $r_data = json_decode($r_file,true);

            //Recupère demande.json
            $d_url = "data/demande.json";
            $d_file = file_get_contents($d_url);
            $d_data = json_decode($d_file,true);

                
            $nom = $prenom = $mail = $duree = $eng = "";

            if(isset($_POST["duree"])){
                $duree = $_POST["duree"];
            }
            if(isset($_POST["mon_engagement"])){
                $eng = $_POST["mon_engagement"];
            }

            //Referant
            if(isset($_POST["nom"])){
                $nom = $_POST["nom"];
            }
            if(isset($_POST["prenom"])){
                $prenom = $_POST["prenom"];
            }
            if(isset($_POST["e-mail"])){
                $mail = $_POST["e-mail"];
            }

            $id=getid($r_data,$mail);
            if(false) {
                die("ERR0R");
            }elseif ($id ===-1) {
                $errmail="e-mail non reconnu.";
            } else {
                do {
                    $url_id=rand(0,100000);
                } while(getrefid($url_id) != -1);
                $new=array(
                    "id"=>123456 /*generate random id*/,
                    "referant"=>array("nom"=>$nom,"prenom"=>$prenom,"mail"=>$mail),
                    "jeune"=>$_SESSION["info"],
                    "duree"=>$duree,
                    "engagement"=>$eng
                );
                array_push($d_data,$new);
                file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));
                
                //if($_POST["message"]) {
                //    sendmail($mail, "localhost:8080/referent.php?id=".$url_id,$_SESSION["nom"],$_SESSION["prenom"]);
                //}

                //header("Location: presentation.php");
                
            }
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
            <form action="jeune.php" method="post">
            
                <div class="carre_jeune">
                    <div class="texte_carre_jeune">
                        <h3>Experience :</h3>
                        <label for="mon_engagement">Mon engagement :</label>
                        <input type="text" name="mon_engagement" id="mon_engagement" required><br>
                        <label for="duree">Duree :</label>
                        <input type="text" name="duree" id="duree" required>  
                        <h3>Référent :</h3><?php echo $errmail ?>
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" required><br>
                        <label for="prenom">Prenom :</label>
                        <input type="text" name="prenom" id="prenom" required><br>
                        <label for="e-mail">E-mail :</label>
                        <input type="e-mail" name="e-mail" id="e-mail" required><br><br>
                        <button type="submit" id="submit">Envoyer</button>
                    </div>
                </div>
               <!-- <div class="savoir_etre">
                    <div class="mes_savoir_etres">
                        MES SAVOIRS ETRE
                    </div>
                    
                    <div class="petit_rectangle_jeune">
                        <div class="rectangle_texte_1">
                            Je suis*
                        </div>
                        <div class="liste_checkbox">
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
                        </div>   
                    </div>
                    
                    <div class="respect_choix">
                        *Faire 4 choix maximum
                        
                    </div>
                    
                </div>-->
            </form>
        </div> 
    </div>

    

</body>
</html>
