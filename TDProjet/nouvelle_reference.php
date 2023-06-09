<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <title>Jeunes 6.4 - Jeune</title>
    <meta charset="utf-8">
    <?php
        require("script/phpfonction.php");
        session_start();

        $errmail = $nom = $prenom = $mail = $duree = $eng = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Recupère les données de referantdata.json
            $r_data = read_json("data/referantdata.json");

            //Recupère les données de demande.json
            $d_data = read_json("data/demande.json");

            //Recupère les données du formulaire
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

            /*Verifie l'existance du référent*/
            $id=getid($r_data,$mail);

            if ($id ===-1) {
                $errmail="e-mail non reconnu.";
            } else {
                /*Genère un id random*/
                do {
                    $url_id=rand(0,100000);
                } while(getrefid($d_data,$url_id) != -1);

                /*Créé une nouvelle demande*/
                $new=array(
                    "id"=>$url_id,
                    "referant"=>array("nom"=>$nom,"prenom"=>$prenom,"mail"=>$mail),
                    "jeune"=>$_SESSION["info"],
                    "duree"=>$duree,
                    "engagement"=>$eng
                );

                /*L'ajoute au fichier*/
                array_push($d_data,$new);
                file_put_contents("data/demande.json",json_encode($d_data,JSON_PRETTY_PRINT));
                
                /*Envoie un email de demande*/
                sendmail($mail, "localhost:8080/referent.php?id=".$url_id,$_SESSION["info"]["nom"],$_SESSION["info"]["prenom"]);
                
                /*Redirige vers la page d'accueil*/
                header("Location: presentation.php");
                
            }
        }
    ?>
</head>


<body>
   <script src="checkbox_verification.js" type="text/javascript"></script>

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
                <li><a class="bouton_jeune background" href="nouvelle_reference.php">JEUNE</a> </li>
                <li><a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li><a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li><a class="bouton_partenaire" href="partenaire.html">PARTENAIRES</a> </li>
        </ul>
        
        <div class="information_jeune">
            <div class="couleur_jeune texte_formulaire">
                    Decrivez votre experience et mettez en avant ce que vous avez retire.
            </div>
            
            <div class="arriere_plan">
                <img src="image/6.4 Rouge.png" >
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
