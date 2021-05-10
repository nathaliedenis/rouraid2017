

<?php
include "connexion.php";

    $prenom = null;
    $nom = null;
    $email = null;
    $message = null;
    $confirmation=" ";
  

        if(isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
            $prenom = trim($prenom);
            $prenom = strtolower($prenom);
            $prenom = ucwords($prenom);
        }

        if(isset($_POST['nom']) && !empty($_POST['nom'])) {
            $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
            $nom = trim($nom);
            $nom = strtolower($nom);
            $nom = ucwords($nom);
        }

        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
            $email = Filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = Filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $message = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
            $message = trim($message);
        }



            if(!is_null($prenom) && ctype_alpha($prenom) && !is_null($nom) && ctype_alpha($nom) && !is_null($email) && !is_null($message)) {

            $sql = $bdd->prepare('INSERT INTO Contact(prenom, nom, email, message_texte, date_envoie) VALUES(:prenom, :nom, :email, :message, NOW())');
            

            	if(!empty($_POST['envoyer'])){
                	if ($sql->execute(array(
                        'prenom' => $prenom,
                        'nom' => $nom,
                        'email' => $email,
                        'message' => $message))){
                        $confirmation = "Votre message a bien été envoyé";

     					    //Construction du mail à envoyer
						    $sMessage = 'Message envoyé le '.date('d/m/Y').' à '.date('H:i')."\r\n";
						    $sMessage .= 'PRENOM : '.$_POST['prenom']."\r\n";
                            $sMessage .= 'NOM : '.$_POST['nom']."\r\n";
						    $sMessage .= 'E-MAIL : '.$_POST['email']."\r\n";
						    $sMessage .= 'MESSAGE : '."\r\n\r\n--\r\n\r\n";
						    $sMessage .= $_POST['message']."\r\n\r\n--\r\n\r\n";
						     
						    // Objet du mail
						    $sObjet = 'ROURAID CONTACT';
						     
						    // Adresse e-mail de
						    $sEmail = 'nathaliedenis76@gmail.com';
						     
						    // Envoi du message
						     
						    mail($sEmail, $sObjet, $sMessage);

				        unset($_POST);
		                }          
                }
            $sql->closeCursor();
            }

            else{
                if(!empty($_POST['envoyer'])){
                $confirmation = "Erreur, veuillez réessayer";
                }
            }
        
        



