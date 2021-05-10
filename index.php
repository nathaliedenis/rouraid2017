<?php
session_start();

require "src/init.php";
require_once 'src/class/database.php';

//variable globale

require "src/class/langue.php";
$langue = new Langue();
$twig -> addGlobal('langue', $langue->getLangue() );

require "src/class/auth.php";
$auth = new Auth();
if (isset($_POST['deconnect'])){
    $auth -> deconnect();
}
$twig -> addGlobal('membre', $auth );

require "src/class/inscription.php";
$inscription = new Inscription();
$twig -> addGlobal('maxEquipe', $inscription->maxEquipe());

require "src/class/dateraid.php";
$ladate = new Dateraid();
$twig -> addGlobal('ladate', $ladate);
$twig -> addGlobal('annee', $ladate->calculAge());

require "src/class/requete.php";
$requete = new Requete($_SESSION['langue']);
$twig -> addGlobal('sponsors', $requete->getTableFr('Sponsor'));
$twig -> addGlobal('users', $requete->getTableFr('Membre'));
$twig -> addGlobal('infos', $requete->getTable('Info_raid'));
$twig -> addGlobal('prix', $requete->getPrix('Tarif'));

if(isset($_SESSION)) {$twig -> addGlobal('session', $_SESSION);}


//rend le template correspondant

$page = isset($_GET['page']) ? $_GET['page'] : null;

switch ($page){


case 'presentation' :
unset($_SESSION['register']);
unset($_SESSION['repas']);
echo $twig->render('pages/presentation.twig',[
        'presentations' => $requete->getTableOrder('Presentation', 'index_contenu'),
        'programmes' => $requete->getTableOrder('Programme', 'index_contenu'),
        'annees_photo' => $requete->getTableDistinctFr('Photo', 'annee_raid'),
        'photos' => $requete->getTableOrderFr('Photo', 'annee_raid DESC'),

    ]);
break;


case 'epreuves' : 
unset($_SESSION['register']);
unset($_SESSION['repas']);
echo $twig->render('pages/epreuves.twig',[
        'epreuves' => $requete->getTableOrder('Epreuve', 'index_contenu'),
    ]);
break;


case 'equipes' : 
unset($_SESSION['register']);
unset($_SESSION['repas']);
require "src/class/equipe.php";
$Equipe = new Equipe();
echo $twig->render('pages/equipes.twig',[
        'equipes' => $Equipe->getEquipe()
    ]);
break;


case 'resultats' : 
unset($_SESSION['register']);
unset($_SESSION['repas']);
require "src/class/resultat.php";
$Resultat = new Resultat();
echo $twig->render('pages/resultats.twig',[

       // 'supprimscore' => $Resultat->supprimScore(),
        'scores' => $Resultat->getScore(),
        'resultats' => $Resultat->getResultat(),

    ]);
break;


case 'infos_pratiques' : 
unset($_SESSION['register']);
unset($_SESSION['repas']);
include "src/include/form_contact.php";
echo $twig->render('pages/infos_pratiques.twig', [
        'cats_reglement' => $requete->getTableOrder('Cat_reglement', 'index_contenu'),
        'reglements' => $requete->getTable('Reglement'),
        'confirmation' => $confirmation
    ]);
break;



case 'connexion_mbr' : 
require "src/include/login_mbr.php";
echo $twig->render('pages/connexion_mbr.twig', [
        'msg1_membre' => $msg1_membre,
        'msg2_membre' => $msg2_membre
    ]);
break;

case 'moncompte' : 
require "src/class/compte.php";
$Compte = new Compte();
echo $twig->render('pages/moncompte.twig',[
    'teams' => $Compte->getEquipeCpt(),
    'nb_repas' => $Compte->getRepasCpt(),
    'commentaires' => $Compte->getCommentaireCpt()
    ]);
break;


case 'inscription1' : 

echo $twig->render('pages/inscription1.twig', [
        'newequipes' => $inscription->nouvelleEquipe(),
    ]);
break;


case 'inscription2' : 
echo $twig->render('pages/inscription2.twig');
break;


case 'inscription3' : 
echo $twig->render('pages/inscription3.twig');
break;


case 'recapitulatif' :

echo $twig->render('pages/recapitulatif.twig', [

    'fin'=> $inscription -> finCommande(),

    'nb_repas' => $inscription -> repas(),

 //  'reduction' => $inscription-> reduction(),

    'supprimerEquipe' => $inscription-> supprimerEquipe(),
    
    'teams' => $_SESSION['register'],

    'famille' => $inscription-> famille(),
    
    'montant_panier' => $inscription-> montantPanier(),

    ]);
break;



case 'confirm_commande' :

echo $twig->render('pages/confirm_commande.twig', [

    'panierVide' => $inscription-> panierVide(),

    'prix' => $inscription-> prixCommande(),

    'ref' => $inscription-> refCommande(),

    'saveInscription' => $inscription-> saveInscription(),

    'saveRepas' => $inscription-> saveRepas()


    ]);

break;


case 'confirm_paiement' :
echo $twig->render('pages/confirm_paiement.twig', [

    'prix' => $inscription-> prixCommande(),

    'ref' => $inscription-> refCommande(),

    'succes' => $inscription-> paiementOk(),

    'echec' => $inscription-> paiementRefus()

    ]);
break;


case 'inscription_close' :
echo $twig->render('pages/inscription_close.twig');
break;



case 'confirmation' : 
echo $twig->render('pages/confirmation.twig', [
        'var' => 'blabla'
    ]);
break;


case 'commentaire' : 
require "src/class/commentaire.php";
$commentaires = new Commentaire();
echo $twig->render('pages/commentaire.twig',[
    'commentaires' => $commentaires -> findAll(),
    'save_commentaires' => $commentaires -> save()
    ]);
break;

case 'mentionlegale' :
echo $twig->render('pages/mentionlegale.twig', [
    'cats_reglement' => $requete->getTableOrder('Cat_reglement', 'index_contenu'),
    'reglements' => $requete->getTable('Reglement')
    ]);
break;

case 'accessibilite' :
echo $twig->render('pages/accessibilite.twig');
break;

case 'plansite' :
echo $twig->render('pages/plansite.twig');
break;


default: 

echo $twig->render('pages/accueil.twig',[
    'fin'=> $inscription -> finCommande()
    ]);
}

