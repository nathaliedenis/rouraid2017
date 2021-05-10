<?php

class Langue extends Database{

    protected $pdo;
    // la langue utilisée est mémorisée dans une variable de session
    // La langue par défaut est le français
    public $langue;
    public $otherlang;

    public function __construct(){
        parent::__construct();
        $this->langue = 'fr';
    }

    public function getLangue(){

	// On restaure la langue mémorisée dans la variable de session dédiée
    if(isset($_SESSION['langue']))
        $this->langue = $_SESSION['langue']; 
        // Changement de langue ?
        $this->otherlang = false;
    	// On regarde s'il faut changer la langue
        if(isset($_GET['langue'])) {
            switch($_GET['langue']) {
                case 'fr':
                case 'en':
                    $this->langue = $_GET['langue'];
                    // Changement de langue : oui
                    $this->otherlang = true;
                    break;
            }
        }
    	// On mémorise la langue pour la page
        $_SESSION['langue'] = $this->langue;
        return $_SESSION['langue'];
    }

    public function __destruct() {}
    
}
