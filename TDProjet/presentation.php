	<!DOCTYPE html>
<html lang="fr">
<head>

    <link rel="stylesheet" href="CSS/main.css" type="text/css">
    <link rel="stylesheet" href="CSS/presentation.css" type="text/css">
    <title>Jeunes 6.4</title>
    <meta charset="utf-8">
    <?php 
        session_start();
		//Met à jour la page actuelle
        $_SESSION['page_actuelle'] = 'presentation.php';
		
		//deconnecte le Jeune en supprimant sa session
        if (isset($_POST['deconnexion'])) { 
            session_destroy();
            header('Location: presentation.php');
            exit;
        }
		
		//Teste si l'utilisateur est connecté ou non
        if (isset($_SESSION['statut'])) {
            $lien = 'profil.php'; // Lien vers le profil de l'utilisateur si il est connecté
        } else {
            $lien = 'inscription.php'; // Lien vers la page de connexion sinon
        }
    ?>
</head>

<body >
    <div class="haut_de_page">
		<!-- Logo renvoyant à la page d'accueil (donc la page actuelle)-->
        <a href="presentation.php" class="logo_home"><img src="image/logohome-removebg-preview.png"></a>
        <div class="les_boutons">
		
            <form action="presentation.php" method="post">
                <!-- Bouton deconnexion, affiché seulement si l'utilisateur est connecté-->
				<button 
                <?php 
                if(!isset($_SESSION['statut'])){  
                  echo "style='display:none;'";
                }
                ?>
                 name="deconnexion" type="submit" class="deconnexion">Deconnexion
                </button> 
                <!-- Affiche le nom et le prénom du Jeune, si il est connecté-->
                <div class="texte-nom">
                    <?php
                    if(isset($_SESSION['statut'])){  
                        echo $_SESSION["info"]["nom"]." - ".$_SESSION["info"]["prenom"];
                        }
                    ?>
                </div>
				
            </form>
        </div>
        <div class="soustitre">
                Pour faire de l'engagement une valeur
        </div>
    </div>

    <div class="haut_de_page_vide"></div>
    <div class="bas_de_page"> 
        
		<!-- Boutons des modules-->
        <ul class="les_modules ">
                <li> <a class="bouton_jeune" href="<?php echo $lien; ?>">JEUNE</a> </li>
                <li> <a class="bouton_referent">REFERENT</a> </li>
                <li> <a class="bouton_consultant">CONSULTANT</a>  </li> 
                <li> <a class="bouton_partenaire" href="partenaire.php">PARTENAIRES</a> </li>
        </ul>

        
        <div class="les_ecritures boite">
            <div>
                <h2 class="titre_paragraphe">De quoi s'agit-il ?</h2>
                <p  class="paragraphe"> 
                        D'une opportunite: celle qu'un engagement quel qu'il soit puisse etre
                        considerer a sa juste valeur ! <br>
                        Toute experience est source d'enrichissement et doit d'etre reconnu
                        largement. <br>
                        Elle revele un potentiel, l'expression d'un savoir-etre a concretiser.
                </p>
            </div>
            <div>
                <h2 class="titre_paragraphe">A qui s'addresse-t'il ?</h2>
                <p  class="paragraphe">
                    
                        A vous, jeunes entre 16 et 30 ans, qui vous etes investis spontanement 
                        dans une association ou dans tout type d'action formelle ou informelle, et   
                        qui avez partage de votre temps, de votre energie, pour apporter un 
                        soutien, une aide, une competence. <br>
                    
                </p>
                <p  class="paragraphe">
                    
                        A vous, responsables de structures ou referents d'un jour, qui avez 
                        croise la route de ces jeunes et avez beneficie meme ponctuellement de 
                        cette implication citoyenne ! <br>
                        C'est l'occasion de vous engager a votre tour pour ces jeunes en confirmant leur richesse pour en avoir ete un temps les temoins mais aussi les
                        beneficiares !
                </p>
            </div>
            <div>
                <p class="paragraphe">
                    
                        A vous, employeurs, recruteurs en ressources humaines, repre-
                        sentants d'organismes de fonction, qui recevez ces jeunes, pour un 
                        emploi, un stage, un cursus de qualification, pour qui le savoir-etre consti-
                        tue le premier fondement de toute capacite humaine. <br> 
                    
                </p>

                <h3 class="titre_paragraphe"> Cet engagement est une ressources a valoriser au fil d'un parcours en 3 etapes :</h3>
            </div>
        </div>

        <div class="les_carees">

            <div class="premier_carre carre">
                <p class="carre_texte_1">
                    1<sup>ere</sup> etape <br>
                    la valorisation
                </p>
                    
                <p class="carre_texte_2">
                    Decrivez votre expe- 
                    rience et mettez en 
                    avant ce que vous en 
                    avez retire.
                </p>
            
            </div>


            <div class="deuxieme_carre carre">
                <p class="carre_texte_1">
                    2<sup>eme</sup> etape <br>
                    la confirmation
                </p>
                    
                <p class="carre_texte_2">
                    Confirmez cette expe-
                    rience et ce que vous
                    avez pu constater au
                    contact de ce jeune
                </p>
            </div>



            <div class="troisieme_carre carre">
                <p class="carre_texte_1">
                    3<sup>eme</sup> etape <br>
                    la consultation
                </p>
                    
                <p class="carre_texte_2">
                    Valider cet engagement
                    en prenant en compte sa
                    valeur.
                </p>
            </div>

        </div>
    </div>



</body>
</html>
