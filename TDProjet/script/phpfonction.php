<?php
session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

// Cherche un mail dans $tab correspondant à celui passé en paramètre, retourne son index, et -1 sinon.
    function getid($tab,$email) {
        for ($i = 0; $i < count($tab); $i++) {
            if($tab[$i]["mail"] == $email) {
                return $i;
            }
        }
        return -1;
    }

//cherche une compétence parmis les infos, si elles existent
function get_comp($comp) {
		if(isset($_SESSION["info"]["competences"])){
			if ($_SESSION["info"]["competences"]!=""){
				if (is_array($_SESSION["info"]["competences"])){
					if (in_array($comp, $_SESSION["info"]["competences"])){
						return "checked";
					}
                    			else{
                        			return "disabled";
                    			}
					}else {
						if ($_SESSION["info"]["competences"]=$comp){
						return "checked";
					}
				}
			}
		}
        
		return "unchecked";
		}

//Ouvre un fichier puis retourne son contenu
    function read_json($url){
        $r_file = file_get_contents($url);
        return json_decode($r_file,true);
    }

// Cherche un élément dans $tab correspondant à celui passé en paramètre, retourne son index, et -1 sinon.
    function getrefid($tab,$code) {
        if(is_array($tab)){ 
            for ($i = 0; $i < count($tab); $i++) {
                if($tab[$i]["id"] == $code) {
                    return $i;
                }
            }
        }
        return -1;
    }

//renvoie à la page précédente en utilisant la session
    function previousPage() {
        session_start();
        if(isset($_SESSION['page_actuelle']) && !isset($_SESSION['statut'])) {
            if($_SESSION['page_actuelle'] == 'inscription.php'){
                header("Location: inscription.php");
                exit;
            }
            if($_SESSION['page_actuelle'] == 'presentation.php'){
                header("Location: presentation.php");
                exit;
            }
            if($_SESSION['page_actuelle'] == 'connexion.php'){
                header("Location: connexion.php");
                exit;
            }
        }
        if (isset($_SESSION['statut'])) {
            return 'profil.php'; // Lien vers le profil de l'utilisateur
        } else {
            return 'inscription.php'; // Lien vers la page de connexion
        }
    }

//Envoi un e-mail
    function sendmail($destinataire,$msg) {
        
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
            $mail->Subject = 'Demande de referencement'; //Définie le l'objet du mail
            $mail->Body = $msg; //Définie le message du mail en html
            $mail->send(); //Envoie le mail
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; //DEBUG
        }
    }
?>
