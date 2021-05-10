<?php
session_start();
include "connexion.php";



    if (isset($_SESSION['register']) && isset($_POST['reduction']) ){
        $nb_equipes = count($_SESSION['register']);

        if ($nb_equipes >= 2){

            $req = $bdd->query('SELECT reduction FROM Tarif');
            $donnees = $req->fetch();

            $reduction = $nb_equipes * $donnees['reduction'];
        }

    echo $reduction;
        
    }
