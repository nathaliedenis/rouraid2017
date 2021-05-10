<?php

class Inscription extends Database{

    protected $pdo;
    public $equipe_nom;
    public $adulte_nom;
    public $adulte_prenom;
    public $lien_avec_enfant;
    public $enfant_nom;
    public $enfant_prenom;
    public $enfant_sexe;
    public $enfant_naissance;
    public $niveau;
    public $id_membre;
    public $id_equipe;
    public $nb_repas;
    public $reduction;
    public $ref_commandef;
    public $prix_commandef;


	public function __construct(){
		parent::__construct();
	}

    public function maxEquipe(){
        $date=date('Y');
        $requete = $this->pdo->query ("SELECT COUNT(*) as nombre FROM Equipe WHERE year(date_inscription)=$date AND paiement='ok'");
      
        $nb_equipe = $requete->fetch();      

        if ($nb_equipe['nombre'] >= 100){ 

                // Objet du mail
                $sendObjet = 'INSCRIPTION BLOQUE A 100';
                 // message du mail
                $sendMessage = 'Nous avons 100 équipes inscrites à ce jour, les inscriptions au rouraid sont fermées';           
                // Adresse e-mail de
                $sendEmail = 'nathaliedenis76@gmail.com';
                // Envoi du message
                mail($sendEmail, $sendObjet, $sendMessage);

                return true;
            }
            else{
                return false;
            }

    }

	public function nouvelleEquipe() {
        
        if (isset($_POST['info_equipe'])){
            
            if(!empty($_POST['equipe_nom']) && !empty($_POST['adulte_nom']) && !empty($_POST['adulte_prenom']) && !empty($_POST['lien_avec_enfant']) && !empty($_POST['enfant_nom']) && !empty($_POST['enfant_prenom']) && !empty($_POST['enfant_sexe']) && !empty($_POST['enfant_naissance']) && !empty($_POST['niveau']) && !empty($_POST['id_membre']) ){

            	$this->lien_avec_enfant = ($_POST['lien_avec_enfant']);
                $this->enfant_sexe = ($_POST['enfant_sexe']);
                $this->enfant_naissance = ($_POST['enfant_naissance']);
                $this->id_membre = ($_POST['id_membre']);
                $this->niveau = ($_POST['niveau']);

                $this->equipe_nom = ($_POST['equipe_nom']);
                $equipe_nom_lenght = strlen($this->equipe_nom);
                $this->adulte_nom = ($_POST['adulte_nom']);
                $adulte_nom_lenght = strlen($this->adulte_nom);
                $this->adulte_prenom = ($_POST['adulte_prenom']);
                $adulte_prenom_lenght = strlen($this->adulte_prenom);
                $this->enfant_nom = ($_POST['enfant_nom']);
                $enfant_nom_lenght = strlen($this->enfant_nom);
                $this->enfant_prenom = ($_POST['enfant_prenom']);
                $enfant_prenom_lenght = strlen($this->enfant_prenom);

                $regex = "/^([a-z\\sàâçèëéêîïôùûüñ-]+)$/si";

                $req = $this->pdo->prepare("SELECT equipe_nom FROM Equipe");
                $req->execute();
                while ($donnees1 = $req->fetch()) {
                    if (strtolower($this->equipe_nom) == strtolower($donnees1['equipe_nom']) ){
                        return "Ce nom d'équipe existe déjà, merci d'en choisir un autre";
                    }
                }

                if($equipe_nom_lenght <= 40){
                    $this->equipe_nom = htmlspecialchars($_POST['equipe_nom']);
                    $this->equipe_nom = trim($this->equipe_nom);
                    $this->equipe_nom = strtolower($this->equipe_nom);
                    $this->equipe_nom = ucwords($this->equipe_nom);

                    if($adulte_nom_lenght <= 20 && preg_match($regex,$this->adulte_nom)){
                    $this->adulte_nom = htmlspecialchars($_POST['adulte_nom']);
                    $this->adulte_nom = trim($this->adulte_nom);
                    $this->adulte_nom = strtolower($this->adulte_nom);
                    $this->adulte_nom = ucwords($this->adulte_nom);

                        if($adulte_prenom_lenght <= 20 && preg_match($regex,$this->adulte_prenom)){
                        $this->adulte_prenom = htmlspecialchars($_POST['adulte_prenom']);
                        $this->adulte_prenom = trim($this->adulte_prenom);
                        $this->adulte_prenom = strtolower($this->adulte_prenom);
                        $this->adulte_prenom = ucwords($this->adulte_prenom);
                            
                            if($enfant_nom_lenght <= 20 && preg_match($regex,$this->enfant_nom)){
                            $this->enfant_nom = htmlspecialchars($_POST['enfant_nom']);
                            $this->enfant_nom = trim($this->enfant_nom);
                            $this->enfant_nom = strtolower($this->enfant_nom);
                            $this->enfant_nom = ucwords($this->enfant_nom);

                                if($enfant_prenom_lenght <= 20 && preg_match($regex,$this->enfant_prenom)){
                                $this->enfant_prenom = htmlspecialchars($_POST['enfant_prenom']);
                                $this->enfant_prenom = trim($this->enfant_prenom);
                                $this->enfant_prenom = strtolower($this->enfant_prenom);
                                $this->enfant_prenom = ucwords($this->enfant_prenom);



                                /*//////////////////////////////////////////

                                $ajout = $this->pdo->prepare("INSERT INTO Equipe(equipe_nom, adulte_nom, adulte_prenom, lien_avec_enfant, enfant_nom, enfant_prenom, enfant_sexe, enfant_naissance, niveau, id_membre, date_inscription) VALUES (:equipe_nom, :adulte_nom, :adulte_prenom, :lien_avec_enfant, :enfant_nom, :enfant_prenom, :enfant_sexe, :enfant_naissance, :niveau, :id_membre, NOW())");

                                $ajout->bindParam(':equipe_nom', $this->equipe_nom);
                                $ajout->bindParam(':adulte_nom', $this->adulte_nom);
                                $ajout->bindParam(':adulte_prenom', $this->adulte_prenom);
                                $ajout->bindParam(':lien_avec_enfant', $this->lien_avec_enfant);
                                $ajout->bindParam(':enfant_nom', $this->enfant_nom);
                                $ajout->bindParam(':enfant_prenom', $this->enfant_prenom);
                                $ajout->bindParam(':enfant_sexe', $this->enfant_sexe);
                                $ajout->bindParam(':enfant_naissance', $this->enfant_naissance);
                                $ajout->bindParam(':niveau', $this->niveau);
                                $ajout->bindParam(':id_membre', $this->id_membre);

                                    if ($ajout->execute()){

                                            $req = $this->pdo->prepare("SELECT id_equipe FROM Equipe WHERE equipe_nom = $this->equipe_nom");
                                            $req->execute();
                                            $newequipe = $req->fetch();
                                            $this->id_equipe = $newequipe['id_equipe'];

                                ////////////////////////////////////////*/


                                        $_SESSION['register'][] = [
                                            'equipe_nom' => $this->equipe_nom,
                                            'adulte_nom' => $this->adulte_nom,
                                            'adulte_prenom' => $this->adulte_prenom,
                                            'lien_avec_enfant' => $this->lien_avec_enfant,
                                            'enfant_nom' => $this->enfant_nom,
                                            'enfant_prenom' => $this->enfant_prenom,
                                            'enfant_sexe' => $this->enfant_sexe,
                                            'enfant_naissance' => $this->enfant_naissance,
                                            'niveau' => $this->niveau,
                                            'id_membre' => $this->id_membre               
                                        ];   

                                        header('Location:?page=inscription2');
                                        return $_SESSION['register'];

                                }
                                else{
                                    $this->enfant_prenom = "";
                                    return "Le prénom de l'enfant n'est pas valide";
                                }
                            }
                            else{
                                $this->enfant_nom = "";
                                return "Le nom de l'enfant n'est pas valide";
                            }
                        }
                        else{
                            $this->adulte_prenom = "";
                            return "Le prénom de l'adulte n'est pas valide";
                        }
                    }
                    else{
                        $this->adulte_nom = "";
                        return "Le nom de l'adulte n'est pas valide";
                    }
                }
                else{
                    $this->equipe_nom = "";
                    return "Le nom de l'équipe n'est pas valide";
                }
            }
            else{
                return 'IL Y A EU UNE ERREUR, VEUILLEZ RECOMMENCER';
            }        
        }
        else{
           
        }
    } 


    

public function repas(){

    if ( isset($_POST['repas']) || isset($_POST['repas_seul'])) {

        if (!empty($_POST['nb_repas']) ){
            $nb = $_POST['nb_repas'];

            $_SESSION['repas'] = $nb;         
        }
    }


    if (isset($_GET['repas'])){
        if($_GET['repas'] == "moins" && $_SESSION['repas']>0){
            $nb = $_SESSION['repas'];
            $nb = $nb - 1;
            $_SESSION['repas'] = $nb;
        }
    }

    if (isset($_GET['repas'])){
        if($_GET['repas'] == "plus" && $_SESSION['repas']<99){
            $nb = $_SESSION['repas'];
            $nb = $nb + 1;
            $_SESSION['repas'] = $nb;
        }
    }

    return $_SESSION['repas'];


}


public function famille(){

    if (isset($_SESSION['register'])){
        $nb_equipes = count($_SESSION['register']);
        if ($nb_equipes >= 2){
            return $nb_equipes;
        }
    }
}



public function montantPanier(){

    $montant_panier = 0;

    if (isset($_SESSION['repas'])){
        $nb_repas = $_SESSION['repas'];
    }
    else{
        $nb_repas = 0;
    }

    if (isset($_SESSION['register'])){
        $nb_equipes = count($_SESSION['register']);
    }
    else{
        $nb_equipes = 0;
    }

    $req = $this->pdo->query('SELECT * FROM Tarif');
    $donnees = $req->fetch();

    $montant_panier += ($nb_equipes * $donnees['tarif_normal']) + ($nb_repas * $donnees['tarif_repas'] - $this->reduction);

    return $montant_panier;
}



public function supprimerEquipe(){

    if (isset($_GET['index_equipe'])){
        $index = $_GET['index_equipe'];
        
        unset($_SESSION['register'][$index]);

    }
}

public function refCommande(){
    if ( isset($_POST['validerinscription']) && !empty($_POST['condition']) ){
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token = substr(str_shuffle(str_repeat($code, 20)), 0, 20);
        $_SESSION['reference'] = $token;
    }
    return $_SESSION['reference'];
}

public function prixCommande(){
    if ( isset($_POST['validerinscription']) && !empty($_POST['condition']) && !empty($_POST['prix'])){
        $_SESSION['prix']=$_POST['prix'];
    }
    return $_SESSION['prix'];
}

public function saveInscription(){

    if ( isset($_POST['validerinscription']) && !empty($_POST['condition']) ){


        if (isset($_SESSION['register'])){

            foreach ($_SESSION['register'] as $equipe){

            $ajout = $this->pdo->prepare("INSERT INTO Equipe(equipe_nom, adulte_nom, adulte_prenom, lien_avec_enfant, enfant_nom, enfant_prenom, enfant_sexe, enfant_naissance, niveau, id_membre, date_inscription, ref_commande) VALUES (:equipe_nom, :adulte_nom, :adulte_prenom, :lien_avec_enfant, :enfant_nom, :enfant_prenom, :enfant_sexe, :enfant_naissance, :niveau, :id_membre, NOW(), :ref_commande)");

            $ajout->bindParam(':equipe_nom', $equipe['equipe_nom']);
            $ajout->bindParam(':adulte_nom', $equipe['adulte_nom']);
            $ajout->bindParam(':adulte_prenom', $equipe['adulte_prenom']);
            $ajout->bindParam(':lien_avec_enfant', $equipe['lien_avec_enfant']);
            $ajout->bindParam(':enfant_nom', $equipe['enfant_nom']);
            $ajout->bindParam(':enfant_prenom', $equipe['enfant_prenom']);
            $ajout->bindParam(':enfant_sexe', $equipe['enfant_sexe']);
            $ajout->bindParam(':enfant_naissance', $equipe['enfant_naissance']);
            $ajout->bindParam(':niveau', $equipe['niveau']);
            $ajout->bindParam(':id_membre', $equipe['id_membre']);
            $ajout->bindParam(':ref_commande', $_SESSION['reference']);

                if ($ajout->execute()){
                        unset($_SESSION['register']);
                }
            }
        }
    }
}



public function saveRepas(){

    if ( isset($_POST['validerinscription']) && !empty($_POST['condition']) ){

        if (isset($_SESSION['repas'])){
            
            $nb_repas = $_SESSION['repas'];

            $mail = $_SESSION['Auth']['mail'];
            $mdp = $_SESSION['Auth']['mdp'];

            if($nb_repas > 0){

                $req = $this->pdo->query("SELECT id_membre FROM Membre WHERE mail='$mail' AND password='$mdp'");
                $donnees = $req->fetch();
                $id = $donnees['id_membre'];

                $ajout = $this->pdo->prepare("INSERT INTO Repas(nb_repas, date_commande, id_membre, ref_commande) VALUES (:nb_repas, NOW(), :id_membre, :ref_commande)");

                $ajout->bindParam(':nb_repas', $nb_repas);
                $ajout->bindParam(':id_membre', $id);
                $ajout->bindParam(':ref_commande', $_SESSION['reference']);

                if ($ajout->execute()){
                    unset($_SESSION['repas']);

                }
            }
        }
    }

}

PUBLIC function paiementOk(){

    if (isset($_POST['succes']) && !empty($_POST['ref']) ) {

        $ref = $_POST['ref'];

        $confirm_equipe = $this->pdo->prepare("UPDATE Equipe SET paiement='ok' WHERE ref_commande=?");
        $confirm_equipe->execute (array($ref));

        $confirm_repas = $this->pdo->prepare("UPDATE Repas SET paiement='ok' WHERE ref_commande=?");
        $confirm_repas->execute (array($ref));

        unset($_SESSION['reference']);
        unset ($_SESSION['prix']);
        return true;

    }
}

PUBLIC function paiementRefus(){

    if (isset($_POST['echec']) && !empty($_POST['ref']) ) {

        $ref = $_POST['ref'];

        $confirm_equipe = $this->pdo->prepare("UPDATE Equipe SET paiement='refus' WHERE ref_commande=?");
        $confirm_equipe->execute (array($ref));

        $confirm_repas = $this->pdo->prepare("UPDATE Repas SET paiement='refus' WHERE ref_commande=?");
        $confirm_repas->execute (array($ref));

        unset($_SESSION['reference']);
        unset ($_SESSION['prix']);
        return true;

    }
}



public function panierVide(){
     if ( isset($_POST['validerinscription'])){
        if (empty($_SESSION['register']) && empty($_SESSION['repas'])){
            header('Location:index.php');
        }
    }
}



public function finCommande(){
    if (isset($_POST['annulerinscription'])){
        unset($_SESSION['register']);
        unset($_SESSION['repas']);
    }
}




public function __destruct() {}                      

}







