<?php

class Dateraid extends Database{

    protected $pdo;

    public $date_raid;
    public $date_inscription;

    public $jour;
    public $mois;
    public $annee;
    public $joursemaine;

    public $cp;
    public $ce1;
    public $ce2;
    public $cm1;
    public $cm2;
    public $sixieme;
    public $cinquieme;


    public function __construct(){
        parent::__construct();

        $req = $this->pdo->query("SELECT DAYOFWEEK(date_raid), date_raid, date_inscription FROM Info_raid WHERE langue = 'fr' ");
            while ($donnees = $req->fetch()){
            
            $this->date_raid = $donnees["date_raid"];
            $this->date_inscription = $donnees["date_inscription"];
            $this->joursemaine = $donnees["DAYOFWEEK(date_raid)"];

            $this->date_detail = date_parse($this->date_raid);
            $this->jour = $this->date_detail['day'];
            $this->mois = $this->date_detail['month'];
            $this->annee = $this->date_detail['year'];
        }
    }


    public function dateFrancais(){

            switch($this->joursemaine){
                case 1 : ($this->joursemaine = "Dimanche"); break;
                case 2 : ($this->joursemaine = "Lundi"); break;
                case 3 : ($this->joursemaine = "Mardi"); break;
                case 4 : ($this->joursemaine = "Mercredi"); break;
                case 5 : ($this->joursemaine = "Jeudi"); break;
                case 6 : ($this->joursemaine = "Vendredi"); break;
                case 7 : ($this->joursemaine = "Samedi"); break;
            }

            switch($this->mois){
                case 1 : ($this->mois = "janvier"); break;
                case 2 : ($this->mois = "fevrier"); break;
                case 3 : ($this->mois = "mars"); break;
                case 4 : ($this->mois = "avril"); break;
                case 5 : ($this->mois = "mai"); break;
                case 6 : ($this->mois = "juin"); break;
                case 7 : ($this->mois = "juillet"); break;
                case 8 : ($this->mois = "aout"); break;
                case 9 : ($this->mois = "septembre"); break;
                case 10 : ($this->mois = "octobre"); break;
                case 11 : ($this->mois = "novembre"); break;
                case 12 : ($this->mois = "decembre"); break;
            }

            return $this->joursemaine . " " . $this->jour . " " . $this->mois . " " . $this->annee;
    }



    public function calculAge(){
        $this->cp = $this->annee - 7;
        $this->ce1 = $this->annee - 8;
        $this->ce2 = $this->annee - 9;
        $this->cm1 = $this->annee - 10;
        $this->cm2 = $this->annee - 11;
        $this->sixieme = $this->annee - 12;
        $this->cinquieme = $this->annee - 13;

        return array($this->cp, $this->ce1, $this->ce2, $this->cm1, $this->cm2, $this->sixieme, $this->cinquieme);

    }

    public function __destruct() {}

}

