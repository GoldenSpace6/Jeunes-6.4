<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/utilisateur.css" type="text/css">
    <title>Jeunes 6.4 - Profil</title>
    <meta charset="utf-8">
	<script src="script/checkbox_verification.js" type="text/javascript"></script>
    <?php
    $modificationEncours= 0;
    if(isset($_POST["modifier"])){
        $modificationEncours= 1;
    }
    $message ="";
    
        require("script/phpfonction.php");
            $message = "";
            $nom = $_SESSION["info"]["nom"];
            $prenom = $_SESSION["info"]["prenom"];
            $mail = $_SESSION["info"]["mail"];
            $date = $_SESSION["info"]["date"];
            $mdp = $_SESSION["info"]["mdp"];
            $competence = $_SESSION["info"]["competences"];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
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
                
            }    
     
    ?>
</head>


<body>

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
            
			<form action="profil.php" method="POST" class="texte_carre_profil">
				<div class="carre_profil">
                    <?php if($modificationEncours != 1){
                     echo $message;
                    } ?><br>
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"];?>" 
                    <?php
                        if( $modificationEncours === 1){
                            echo ' ';
                        }
                        else{
                            echo "disabled";
                        }
                   ?>><br>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["info"]["prenom"];?>" 
                    <?php
                        if( $modificationEncours === 1){
                            echo ' ';
                        }
                        else{
                            echo "disabled";
                        }
                   ?>><br>
                    <label for="date">Date de naissance:</label>
                    <input type="Date" name="date" id="date" value="<?php echo $_SESSION["info"]["date"];?>" 
                    <?php
                        if( $modificationEncours === 1){
                            echo ' ';
                        }
                        else{
                            echo "disabled";
                        }
                   ?>><br>
                    <label for="e-mail">E-mail:</label>
                    <input type="e-mail" name="e-mail" id="e-mail" value="<?php echo $_SESSION["info"]["mail"];?>" 
                    <?php
                        if( $modificationEncours === 1){
                            echo ' ';
                        }
                        else{
                            echo "disabled";
                        }
                   ?>><br>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" name="mdp" id="mdp" value="" 
                    <?php
                        if( $modificationEncours === 1){
                            echo ' ';
                        }
                        else{
                            echo "disabled";
                        }
                   ?>><br>
					

                    <button name="modifier" type="submit" id="submit"
                    <?php
                    if($modificationEncours === 1){
                        echo "style='display:none;'";
                    }
                   ?>
                   > >Modifier</button>


                   <button name="valider" type="submit" id="submit_valider"
                   <?php
                    if(!isset($_POST['modifier'])){
                        echo "style='display:none;'";
                    } 
                   ?>
                   > >Valider</button>    
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
                            <input type="checkbox" id="autonome" name="competence[]" value="autonome" onclick="limitCheckboxSelection(this)"
                            <?php
                                if( $modificationEncours === 1 && !in_array("autonome", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("autonome");
                                
                            ?>
                            ><label for="autonome">Autonome</label>
                        </div>
                        <div>
                            <input type="checkbox" id="passionne" name="competence[]" value="passionne" onclick="limitCheckboxSelection(this)"
                            <?php 
                            if( $modificationEncours === 1 && !in_array("passionne", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("passionne");
                                
                            ?>
                            ><label for="passionne">Passionne</label>
                        </div>
                        <div>
                            <input type="checkbox" id="reflechi" name="competence[]" value="reflechi" onclick="limitCheckboxSelection(this)"
                            <?php 
                            if( $modificationEncours === 1 && !in_array("reflechi", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("reflechi");
                                
                            ?>
                            ><label for="reflechi">Reflechi</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a_l_ecoute" name="competence[]" value="a_l_ecoute" onclick="limitCheckboxSelection(this)"
                            <?php 
                            if($modificationEncours === 1 && !in_array("a_l_ecoute", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("a_l_ecoute");
                                
                            ?>
                            ><label for="a_l_ecoute">A l'ecoute</label>
                        </div>
                        <div>
                            <input type="checkbox" id="organise" name="competence[]" value="organise" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("organise", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("organise");
                                
                            ?>
                            ><label for="organise">Organise</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fiable" name="competence{]" value="fiable" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("fiable", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("fiable");
                                
                            ?>
                            ><label for="fiable">Fiable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="patient" name="competence[]" value="patient" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("patient", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("patient");
                                
                            ?>
                            ><label for="patient">Patient</label>
                        </div>
                        <div>
                            <input type="checkbox" id="responsable" name="competence[]" value="responsable" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("responsable", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("responsable");
                                
                            ?>
                            ><label for="responsable">Responsable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sociable" name="competence[]" value="sociable" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("sociable", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            } 
                            echo get_comp("sociable");
                                
                            ?>
                            ><label for="sociable">Sociable</label>
                        </div>
                        <div>
                            <input type="checkbox" id="optimiste" name="competence[]" value="optimiste" onclick="limitCheckboxSelection(this)"
                            <?php
                            if( $modificationEncours === 1 && !in_array("optimiste", $_SESSION["info"]["competences"])){
                                echo "enabled";
                            }  
                            echo get_comp("optimiste");
                                
                            ?>
                            ><label for="optimiste">Optimiste</label>
                        </div>
                    </div>
                </div>
            </form>   
            
            <div class="carre_profil">Mes Reference
                <a class="nouvelle_reference" href="nouvelle_reference.php">Nouvelle reference</a>  
            </div>
            
        </div>
    </div>  

</body>
</html>

