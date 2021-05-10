<?php
class Commentaire extends Database{

    protected $pdo;

	public function __construct(){
		parent::__construct();
	}

  

	public function findAll() {
    $req = $this->pdo->prepare('SELECT * FROM Commentaire WHERE moderateur="ok" ORDER BY date_commentaire DESC');
    $req->execute();
    
    return $req->fetchAll();
    
	}

	public function save() {
        
        if (isset($_POST['envoicommentaire'])){
            
            if(!empty($_POST['commentaire']) && !empty($_POST['id_membre']) ){

                if ($_POST['commentaire'] != 'MERCI POUR VOTRE COMMENTAIRE' && $_POST['commentaire'] != 'IL Y A EU UNE ERREUR, VEUILLEZ RECOMMENCER'){

                    $commentaire = htmlentities($_POST['commentaire']);
                    $id_membre = ($_POST['id_membre']);
                    
                    $ajout = $this->pdo->prepare('INSERT INTO Commentaire(texte, id_membre, date_commentaire) VALUES(:texte, :id_membre, NOW())');
                    $ajout->bindParam(':texte', $commentaire);
                    $ajout->bindParam(':id_membre', $id_membre);
                    $ajout->execute();

                        $recup = $this->pdo->prepare("SELECT * FROM Commentaire ORDER BY date_commentaire DESC");
                        $recup->execute();
                        $newCommentaire = $recup->fetch(PDO::FETCH_ASSOC);
                            $newCommentaire["texte"];
                            $newCommentaire["id_commentaire"];
                        
                        //Construction du mail à envoyer
                            $sendMessage = 'date : '.$newCommentaire["date_commentaire"]."\r\n";
                            $sendMessage .= 'id_commentaire : '.$newCommentaire["id_commentaire"]."\r\n";
                            $sendMessage .= 'texte commentaire : '."\r\n\r\n--\r\n\r\n";
                            $sendMessage .= $newCommentaire["texte"]."\r\n\r\n--\r\n\r\n";
                            $sendMessage .= 'Pour valider ce commentaire suivez ce lien : http://www.rouraid.nathalie-denis.net/src/include/moderateur_commentaire.php?id=' . $newCommentaire["id_commentaire"];
                             
                            // Objet du mail
                            $sendObjet = 'ROURAID MODERATEUR COMMENTAIRE';
                             
                            // Adresse e-mail de
                            $sendEmail = 'nathaliedenis76@gmail.com';
                             
                            // Envoi du message
                            mail($sendEmail, $sendObjet, $sendMessage);


                    return 'MERCI POUR VOTRE COMMENTAIRE';
                   
                }
                else{
                    return 'IL Y A EU UNE ERREUR, VEUILLEZ RECOMMENCER';
                }

            }
            else{
                return 'IL Y A EU UNE ERREUR, VEUILLEZ RECOMMENCER';
            }

        }
        
    } 

    public function __destruct() {}                      

}