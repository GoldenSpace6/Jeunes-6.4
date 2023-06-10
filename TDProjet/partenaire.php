<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/partenaire.css" type="text/css">
    <title>Jeunes 6.4 - Partenaires</title>
    <meta charset="utf-8">
    <?php
        session_start();
        if (isset($_SESSION['statut'])) {
            $lien = 'profil.php'; // Lien vers le profil de l'utilisateur
        } else {
            $lien = 'inscription.php'; // Lien vers la page de connexion
        }
    ?>
</head>


<body>
    
    <div class="haut_de_page">
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>

        <div class="titre_partenaire titre">
                PARTENAIRES
        </div>
    </div>
    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        
        <div class="les_modules">
                <li> <a class="bouton_jeune" href="<?php echo $lien; ?>">JEUNE</a> </li>
                <li> <a class="bouton_referent" href="referent.php">REFERENT</a> </li>
                <li> <a class="bouton_consultant" href="consultant.php">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire background" href="partenaire.php">PARTENAIRES</a> </li>
        </div>
        <div class="les_ecritures2">
            <div>
                    <p class="text_partenaire">
                        JEUNES 6.4 est un dispositif issu de la <a href="charte2013.pdf">chartre de l'engagement</a> pour la
                        jeunesse signée en 2013 par des partenaires institutionnels...
                    </p>
            </div>
            <div class="images">
                <a href="https://www.service-public.fr/" target="_blank"><img class="logo-rep" src="image/logo-rep.png"></a>
                <a href="https://www.nouvelle-aquitaine.fr/" target="_blank"><img class="logo-aqu" src="image/logo-aqu.png"></a>
                <a href="https://www.le64.fr/" target="_blank"><img class="logo-pyr" src="image/logo-pyr.png"></a>
                <a href="https://www.ameli.fr/" target="_blank"><img class="logo-ame" src="image/logo-ame.png"></a>
                <a href="https://le64.fr/guide-jeunes-64" target="_blank"><img class="logo_home" src="image/logo-adj.png"></a>
                <a href="https://annuaire.action-sociale.org/CAF/CAF-64445-01-caf-de-bearn-et-soule---siege-de-pau.html" target="_blank"><img class="logo-caf" src="image/logo-caf.png"></a>
                <a href="https://annuaire.action-sociale.org/CAF/CAF-64102-01-caf-du-pays-basque-et-du-seignanx---siege-de-bayonne.html" target="_blank"><img class="logo-caf2" src="image/logo-caf2.png"></a>
                <a href="https://www.msa.fr/lfp" target="_blank"><img class="logo-msa" src="image/logo-msa.png"></a>
                <a href="https://www.univ-pau.fr/fr/index.html" target="_blank"><img class="logo-pau" src="image/logo-pau.png"></a>
            </div>
            <div> 
                <p class="text_partenaire2">...qui ont décidé de mettre en commun leurs actions pour les jeunes<br>
                des Pyrénées-Atlantiques</p>
        </div>
        </div>
    </div>
</body>
</html>

