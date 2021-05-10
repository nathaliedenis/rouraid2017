-----------------------------
Rouraid
-----------------------------

Site pour l'organisation d'un raid sportif
Projet d'étude 2016/2017
Licence Professionnelle Informatique et Multimédia appliqués
Université de Nice Sophia-Antipolis

----------------------------

TECHNOS UTILISEES :

Développé en PHP avec le moteur de template Twig.
Construction du CSS avec SASS
Animations et vérifications des formulaires avec Jquery et Ajax
Base de données SQL

Création d'un back office pour la gestion du contenu par les membres de l'organisation :
- connexion sécurisée
- gestion des inscriptions
- diffusion des résultats (league CSV)
- mise à jour du contenu textuel / sponsors / diaporama photos

------------------------------

POUR INSTALLATION EN LOCAL

2 fichiers connexion à la bdd :
 - src/class/database.php
 - src/include/connexion.php

-----------------------------

Accès Back Office en local
/backoffice/login
Login : test
Mot de passe : hello

-----------------------------

Un fichier .csv de résultats généré par l’organisation du rouraid
est joint au dossier, pour test d’importation CSV via back office

-----------------------------