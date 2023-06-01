<?php
    /*use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    */
    function getid($tab,$email) {
        for ($i = 0; $i <= count($tab); $i++) {
            if($tab[$i]["mail"] == $email) {
                return $i;
            }
        }
        return -1;
    }
    function getrefid($tab,$code) {
        if(is_countable($tab) > 0){ 
            for ($i = 0; $i <= count($tab); $i++) {
                if($tab[$i]["id"] == $code) {
                    return $i;
                }
            }
        }
        return -1;
    }
    function sendmail($destinataire,$lien,$nom,$prenom) {
        
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
            $mail->Subject = 'Demande de réferencement'; //Définie le l'objet du mail
            $mail->Body = "<p>Bonjour,<br>$nom $prenom a effectué une demande de référencement.<br> Pour plus d'informations, visitez: $lien<br>Si vous n'êtes pas concerné par ce mail, vous pouvez l'ignorer.</p> "; //Définie le message du mail en html
            $mail->AltBody = "Bonjour,   $nom $prenom a effectué une demande de référencement.  Pour plus d'informations, visitez: $lien Si vous n'êtes pas concerné par ce mail, veuillez l'ignorer."; //Définie le message du mail affiché si l'HTML n'est pas supporté.
            $mail->send(); //Envoie le mail
            echo "Mail has been sent successfully!"; //DEBUG
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; //DEBUG
        }
    }
?>
