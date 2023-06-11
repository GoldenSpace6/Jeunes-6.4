<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php
        require("phpfonction.php");

        //Recupère les données de jeunedata.json
        $j_url = "../data/jeunedata.json";
        $j_data = read_json($j_url);

        //Recupère les données de demande_reference.json
        $d_url = "../data/demande_reference.json";
        $d_data = read_json($d_url);


        $act="";
        if(isset($_POST["action"])) {
            $act=$_POST["action"];
        }

        if($act == "J+" ) {
            echo $act;

            $new = array(
                "nom"=>$_POST["nom"],
                "prenom"=>$_POST["prenom"],
                "mail"=>$_POST["e-mail"],
                "date"=>$_POST["date"],
                "mdp"=>password_hash($_POST["mdp"],PASSWORD_DEFAULT) /*Hash le mot de passe*/
            );

            array_push($j_data,$new);
            file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));


        } elseif($act == "J-" ) {

            $mail = $_POST["e-mail"];
            $id = getid($j_data,$mail);
            if($id != -1) {
                echo $act;
                array_splice($j_data,$id,1);
            }

            file_put_contents($j_url,json_encode($j_data,JSON_PRETTY_PRINT));


        } elseif($act == "D+" ) {
            echo $act;
            
            $j_id = getid($j_data,$_POST["jeune"]);
            $r_id = getid($r_data,$_POST["referent"]);

            $new = array(
                "id"=>intval($_POST["url_id"]),
                "referent"=>$r_data[$r_id],
                "jeune"=>$j_data[$j_id],
                "duree"=>$_POST["duree"],
                "engagement"=>$_POST["mon_engagement"]
            );

            array_push($d_data,$new);
            file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));


        } elseif($act == "D-" ) {

            $url_id = intval($_POST["id"]);
            $id = getrefid($d_data,$url_id);
            if($id != -1) {
                echo $act;
                array_splice($d_data,$id,1);
            }

            file_put_contents($d_url,json_encode($d_data,JSON_PRETTY_PRINT));
        }
    ?>
</head>
<body>
    <fieldset><legend>Ajouter un compte Jeune :</legend>
    <form action="admin.php" method="post">
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


    <fieldset><legend>Supprimer un compte Jeune :</legend>
    <form action="admin.php" method="post">
        <input type="text" value="J-" name="action" style="display:none;">

        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><legend>Ajouter un Référent :</legend>
    <form action="admin.php" method="post">
        <input type="text" value="R+" name="action" style="display:none;">

        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" required><br>
        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><legend>Supprimer un Référent :</legend>
    <form action="admin.php" method="post">
        <input type="text" value="R-" name="action" style="display:none;">
        
        <label for="e-mail">E-mail:</label>
        <input type="e-mail" name="e-mail" id="e-mail" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>


    <fieldset><legend>Ajouter une demande de référence :</legend>
    <form action="admin.php" method="post">
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


    <fieldset><legend>Supprimer une demande de référence :</legend>
    <form action="admin.php" method="post">
        <input type="text" value="D-" name="action" style="display:none;">
        
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" required><br>

        <button type="submit" id="submit">Submit</button>
    </form></fieldset>
</body>
</html>