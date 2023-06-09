<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php
        require("phpfonction.php");

        //Recupère les données de jeunedata.json
        $j_url = "../data/jeunedata.json";
        $j_file = file_get_contents($j_url);
        $j_data = json_decode($j_file,true);
        
        //Recupère les données de referantdata.json
        $r_url = "../data/referantdata.json";
        $r_file = file_get_contents($r_url);
        $r_data = json_decode($r_file,true);

        //Recupère les données de demande.json
        $d_url = "../data/demande.json";
        $d_file = file_get_contents($d_url);
        $d_data = json_decode($d_file,true);


        $act="";
        if(isset($_POST["action"])) {
            $act=$_POST["action"];
        }

        if($act == "J+" ) {
            echo $act;

            $new=array(
                "nom"=>$_POST["nom"],
                "prenom"=>$_POST["prenom"],
                "mail"=>$_POST["e-mail"],
                "date"=>$_POST["date"],
                "mdp"=>password_hash($_POST["mdp"],PASSWORD_DEFAULT) /*Hash le mot de passe*/
            );

            array_push($j_data,$new);
            file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));


        } elseif($act == "J-" ) {
            echo $act;

            $mail=$_POST["e-mail"];
            $id=getid($j_data,$mail);
            array_splice($j_data,$id,1);

            file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));


        } elseif($act == "R+" ) {
            echo $act;

            $new=array(
                "nom"=>$_POST["nom"],
                "prenom"=>$_POST["prenom"],
                "mail"=>$_POST["e-mail"]
            );

            array_push($r_data,$new);
            file_put_contents($r_url,json_encode($r_data,JSON_PRETTY_PRINT));


        } elseif($act == "R-" ) {
            echo $act;

            $mail=$_POST["e-mail"];
            $id=getid($r_data,$mail);
            array_splice($r_data,$id,1);

            file_put_contents($r_url,json_encode($r_data,JSON_PRETTY_PRINT));


        } elseif($act == "D+" ) {
            echo $act;
            
            $j_id=getid($j_data,$_POST["jeune"]);
            $r_id=getid($r_data,$_POST["referent"]);

            $new=array(
                "id"=>intval($_POST["url_id"]),
                "referant"=>$r_data[$r_id],
                "jeune"=>$j_data[$j_id],
                "duree"=>$_POST["duree"],
                "engagement"=>$_POST["mon_engagement"]
            );

            array_push($d_data,$new);
            file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));


        } elseif($act == "D-" ) {
            echo $act;

            $url_id=$_POST["id"];
            $id=getrefid($d_data,$url_id);
            array_splice($d_data,$id,1);

            file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));
        }
    ?>
</head>
<body>
    <fieldset><form action="admin.php" method="post">
        <h3>Ajouter un compte Jeune :</h3>
        <input type="text" value="J+" name="action" style="display:none;">

        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" required><br>
        <label for="date">Date de naissance:</label>
        <input type="Date" name="date" id="date" required><br>
        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>
        <label for="mdp">Mot de passe:</label>
        <input type="password" name="mdp" id="mdp" minlenght="8" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><form action="admin.php" method="post">
        <h3>Supprimer un compte Jeune :</h3>
        <input type="text" value="J-" name="action" style="display:none;">

        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><form action="admin.php" method="post">
        <h3>Ajouter un Référent :</h3>
        <input type="text" value="R+" name="action" style="display:none;">

        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" required><br>
        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><form action="admin.php" method="post">
        <h3>Supprimer un Référent :</h3>
        <input type="text" value="R-" name="action" style="display:none;">
        
        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><form action="admin.php" method="post">
        <h3>Ajouter une demande :</h3>
        <input type="text" value="D+" name="action" style="display:none;">

        <label for="url_id">Id:</label>
        <input type="text" name="url_id" id="url_id" required><br>
        <label for="jeune">E-mail du jeune:</label>
        <input type="e-mail" name="jeune" id="jeune" required><br>
        <label for="referent">E-mail du Référent:</label>
        <input type="e-mail" name="referent" id="referent" required><br>
        
        <label for="mon_engagement">Mon engagement :</label>
        <input type="text" name="mon_engagement" id="mon_engagement" required><br>
        <label for="duree">Duree :</label>
        <input type="text" name="duree" id="duree" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><form action="admin.php" method="post">
        <h3>Supprimer une demande :</h3>
        <input type="text" value="D-" name="action" style="display:none;">
        
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>
</body>
</html>