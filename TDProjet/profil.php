<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulaire.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Profil</title>
    <meta charset="utf-8">
	<script src="script/verif_case.js" type="text/javascript"></script>
    <?php
        require("script/phpfonction.php");

        $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["action"])) {
                if($_POST["action"] == "profil") {
                    //Recupère les données de jeunedata.json
                    $j_url = "data/jeunedata.json";
                    $j_data = read_json($j_url);
                    $id=$_SESSION["id"];
                        
                    //Recupère les données du formulaire
                    if(isset($_POST["nom"])){
                        $j_data[$id]["nom"]=$_POST["nom"];
                    }
                    if(isset($_POST["prenom"])){
                        $j_data[$id]["prenom"]=$_POST["prenom"];
                    }
                    if(isset($_POST["e-mail"])){
                        $j_data[$id]["mail"]=$_POST["e-mail"];
                    }
                    if(isset($_POST["date"])){
                        $j_data[$id]["date"]=$_POST["date"];
                    }
                    if(isset($_POST["mdp"])){
                        $j_data[$id]["mdp"]=$_POST["mdp"];
                    }
                    if(isset($_POST["competence"])){
                        $j_data[$id]["competences"]=$_POST["competence"];
                    }
                    file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));
                    $_SESSION["info"] = $j_data[$id];
                    $message="Profil modifié";



                } elseif($_POST["action"] == "consultant") {
                    
                    //Recupère les données de demande_consultant.json
                    $c_url = "data/demande_consultant.json";
                    $c_data = read_json($c_url);

                    //Recupère les données de demande_reference.json
                    $d_url = "data/demande_reference.json";
                    $d_data = read_json($d_url);
                    

                    /*Genère un id random*/
                    do {
                        $url_id=rand(0,100000);
                    } while(getrefid($c_data,$url_id) != -1);

                    /*Ajoute toutes les references checked*/
                    $reference=[];
                    foreach($d_data as $i) {
                        if(isset($_POST[$i["id"]])) {
                            if( !empty($_POST[ $i["id"] ]) ) {
                                array_push($reference,array(
                                    "referent"=>$i["referent"],
                                    "duree"=>$i["duree"],
                                    "engagement"=>$i["engagement"],
                                    "commentaire"=>$i["commentaire"]
                                ));
                            }
                        }
                    }
                    
                    /*Créé une nouvelle demande_consultant*/
                    $new=array(
                        "id"=>$url_id,
                        "jeune"=>$_SESSION["info"],
                        "referencent"=>$reference
                    );

                    /*L'ajoute au fichier*/
                    array_push($c_data,$new);
                    file_put_contents($c_url,json_encode($c_data,JSON_PRETTY_PRINT));
					$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$url=rtrim($url, "profil.php")."consultant.php?id=".$url_id;
					$prenom=$_SESSION["info"]["prenom"];
					$nom=$_SESSION["info"]["nom"];
					echo "here:".$_POST["c_mail"];
					$msg="<p>Bonjour,<br><br>
					Le projet Jeunes-6.4 est un dispositif de valorisation de l&#39;engagement des jeunes en Pyr&#233;n&#233;es<br>
					Atlantiques soutenu par l&#39;Etat, le Conseil G&#233;n&#233;ral, le Conseil R&#233;gional, les CAF B&#233;arn<br>
					Soule et Pays Basque, la MSA, la CPAM. Le projet, adress&#233; aux jeunes entre 16 et 30 ans, vise &#224; valoriser<br>
					toute exp&#233;rience comme source d&#39;enrichissement qui puisse &#234;tre reconnue comme l&#39;expression d&#39;un savoir-faire ou savoir-&#234;tre.<br>
					Afin de compl&#233;ter leur CV, les jeunes peuvent demander des r&#233;f&#233;rences qui confirment leur exp&#233;rience<br>
					(clubs de sport, b&#233;n&#233;volat, services &#224; domiciles, etc.). Ces r&#233;f&#233;rences pourront &#234;tre consult&#233;es par un recruteur potentiel.<br><br>
					Dans le cadre de ce dispositif, $nom $prenom vous propose de consulter ses r&#233;f&#233;rencement : <a href=$url>Jeune-6.4</a>";
					sendmail($_POST["c_email"], $msg, "Consultation Jeune 6.4");
                }
            }
        }    
     
    ?>
</head>


<body>

    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="couleur_jeune titre">
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
            <li><a class="bouton_referent">REFERENT</a> </li>
            <li><a class="bouton_consultant">CONSULTANT</a>  </li> 
            <li><a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>

        <div class="information_profil">
            <div class="texte_formulaire couleur_jeune">
                Votre Profil
            </div>
            
			<form action="profil.php" method="POST">
				<div class="carre_formulaire couleur_jeune">
                    <input type="hidden" name="action" value="profil">

                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>"><br>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>"><br>
                    <label for="date">Date de naissance:</label>
                    <input type="Date" name="date" id="date" value="<?php echo $_SESSION["info"]["date"];?>"><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>"><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" value=""><br>

                    <button name="valider" type="submit" id="submit_valider">Valider</button>    
                </div>
                <div class="savoir_etre">
                    <div class="mes_savoir_etres">
                        MES SAVOIRS ETRE
                    </div>
                    
                    <div class="petit_rectangle_jeune liste_checkbox" method="post" action="profil.php">
                        <div class="rectangle_texte_1">
                            Je suis*
                        </div>
                        <div>
                            <input type="checkbox" id="autonome" name="competence[]" value="autonome" onclick="caseMax(this)" <?php echo get_comp("autonome");?>>
                            <label for="autonome">Autonome</label>
                        </div>
                        <div>
                            <input type="checkbox" id="passionne" name="competence[]" value="passionne" onclick="caseMax(this)" <?php echo get_comp("passionne");?>>
                            <label for="passionne">Passionne</label>
                        </div>
                        <div>
                            <input type="checkbox" id="reflechi" name="competence[]" value="reflechi" onclick="caseMax(this)" <?php echo get_comp("reflechi");?>>
                            <label for="reflechi">Reflechi</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a_l_ecoute" name="competence[]" value="a_l_ecoute" onclick="caseMax(this)" <?php echo get_comp("a_l_ecoute");?>>
                            <label for="a_l_ecoute">A l'ecoute</label>
                        </div>
                        <div>
                            <input type="checkbox" id="organise" name="competence[]" value="organise" onclick="caseMax(this)" <?php echo get_comp("organise"); ?>>
                            <label for="organise">Organise</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fiable" name="competence[]" value="fiable" onclick="caseMax(this)" <?php echo get_comp("fiable"); ?>>
                            <label for="fiable">Fiable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="patient" name="competence[]" value="patient" onclick="caseMax(this)" <?php echo get_comp("patient");?>>
                            <label for="patient">Patient</label>
                        </div>
                        <div>
                            <input type="checkbox" id="responsable" name="competence[]" value="responsable" onclick="caseMax(this)" <?php echo get_comp("responsable");?>>
                            <label for="responsable">Responsable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sociable" name="competence[]" value="sociable" onclick="caseMax(this)" <?php echo get_comp("sociable");?>>
                            <label for="sociable">Sociable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="optimiste" name="competence[]" value="optimiste" onclick="caseMax(this)" <?php echo get_comp("optimiste"); ?>>
                            <label for="optimiste">Optimiste</label>
                        </div>
                    </div>
                </div>
            </form>
            
            <form class="carre_formulaire couleur_referent" method="POST" action="profil.php">
                <label>Mes Références:</label><br>
                <input type="hidden" name="action" value="consultant">
                <?php

                    //Recupère les données de demande_reference.json
                    $d_url = "data/demande_reference.json";
                    $d_data = read_json($d_url);
                    
                    foreach($d_data as $reference) {

                        //Affiche Chacune des référence
                        if($reference["jeune"]["mail"]==$_SESSION["info"]["mail"]) {
                            echo "<div class='mes_references'>";

                            if($reference["etat"]=="valide") {
                                echo "<input type='checkbox' name='".$reference["id"]."' >";
                            }
                            echo "Demande ".$reference["etat"];
                            
                            echo "<hr>Mon engagement : ".$reference["engagement"]."<br>";
                            echo "Durée : ".$reference["duree"]."<br><br>";
                            
                            echo "Referent:<br>";
                            echo "Nom : ".$reference["referent"]["nom"]."<br>";
                            echo "Prenom : ".$reference["referent"]["prenom"]."<br>";
                            echo "E-mail : ".$reference["referent"]["mail"]."<br><br>";

                            echo '
                            <div>
                                <input type="checkbox" '.get_comp_tab("confiance",$reference["competence_ref"]).'>
                                <label>Confiance</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("bienveillance",$reference["competence_ref"]).'>
                                <label>Bienveillance</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("respect",$reference["competence_ref"]).'>
                                <label>Respect</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("honnetete",$reference["competence_ref"]).'>
                                <label>Honnetete</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("tolerance",$reference["competence_ref"]).' >
                                <label>Tolerance</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("juste",$reference["competence_ref"]).'>
                                <label>Juste</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("impartial",$reference["competence_ref"]).'>
                                <label>Impartial</label>
                            </div>
                            <div>
                                <input type="checkbox" '.get_comp_tab("travail",$reference["competence_ref"]).'>
                                <label>Travail</label>
                            </div>';
                            echo "</div>";
                        }
                    }
                ?>
                <label>Demande de consultation :</label><br>
                <label for="c_email">E-mail :</label>
                <input type="e-mail" name="c_email" id="c_email" value="" required>
                <button name='modifier' type='submit' id='submit'>demande consultant</button>
            </form>
            <a class="nouvelle_reference" href="nouvelle_reference.php">Nouvelle reference</a>
        </div>
    </div>

</body>
</html>
