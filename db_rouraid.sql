-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : db774398232.hosting-data.io
-- Généré le : lun. 10 mai 2021 à 09:43
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP : 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db774398232`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`id_admin`, `login`, `password`) VALUES
(1, 'test', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d');

-- --------------------------------------------------------

--
-- Structure de la table `Cat_reglement`
--

CREATE TABLE `Cat_reglement` (
  `id_cat_reglement` int(10) NOT NULL,
  `libelle` varchar(250) NOT NULL,
  `index_contenu` int(10) NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Cat_reglement`
--

INSERT INTO `Cat_reglement` (`id_cat_reglement`, `libelle`, `index_contenu`, `langue`) VALUES
(1, 'Le déroulement', 2, 'fr'),
(2, 'Itinéraires', 3, 'fr'),
(3, 'Incident matériel', 4, 'fr'),
(4, 'Abandon', 5, 'fr'),
(5, 'Absence ou retard', 6, 'fr'),
(6, 'Causes principales de pénalités', 7, 'fr'),
(7, 'Acceptation du règlement', 8, 'fr'),
(8, 'Réserve', 9, 'fr'),
(9, 'Le matériel', 10, 'fr'),
(10, 'Matériel obligatoire', 11, 'fr'),
(11, 'Matériel conseillé', 12, 'fr'),
(12, 'Parc VTT', 13, 'fr'),
(13, 'La sécurité', 14, 'fr'),
(14, 'Les classements', 15, 'fr'),
(15, 'Droit à l\'image', 16, 'fr'),
(16, 'Assurance – Inscription – Forfait', 1, 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `id_commentaire` int(10) NOT NULL,
  `texte` mediumtext NOT NULL,
  `id_membre` int(10) NOT NULL,
  `date_commentaire` datetime NOT NULL,
  `moderateur` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Commentaire`
--

INSERT INTO `Commentaire` (`id_commentaire`, `texte`, `id_membre`, `date_commentaire`, `moderateur`) VALUES
(1, 'Merci pour cette super organisation, on a pass&eacute; une tr&egrave;s bonne journ&eacute;e!!!', 1, '2017-04-25 14:34:07', 'ok'),
(2, 'C\'etait cool !', 1, '2017-04-25 14:34:46', ''),
(4, 'Super journ&eacute;e sportive avec les enfants !!!', 2, '2017-04-26 19:20:53', 'ok'),
(5, 'Merci on a pass&eacute; une tr&egrave;s bonne journ&eacute;e ! On reviendra l\'ann&eacute;e prochaine !', 3, '2017-04-26 19:24:11', 'ok'),
(6, 'quelle merveilleuse journ&eacute;e, en plus Theo et Camille sont mont&eacute;s sur le podium, merci &agrave; tout l\'&eacute;quipe !', 4, '2017-04-26 19:31:47', 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `Contact`
--

CREATE TABLE `Contact` (
  `id_contact` int(11) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message_texte` mediumtext NOT NULL,
  `date_envoie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Contact`
--

INSERT INTO `Contact` (`id_contact`, `prenom`, `nom`, `email`, `message_texte`, `date_envoie`) VALUES
(1, 'Laurent', 'Durand', 'laurent@mail.fr', 'Ceci est un test', '2017-04-26');

-- --------------------------------------------------------

--
-- Structure de la table `Epreuve`
--

CREATE TABLE `Epreuve` (
  `id_epreuve` int(10) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `texte` mediumtext NOT NULL,
  `index_contenu` int(2) NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Epreuve`
--

INSERT INTO `Epreuve` (`id_epreuve`, `titre`, `texte`, `index_contenu`, `langue`) VALUES
(7, 'Le cross', '- 600 m pour les pitchouns* et les poussins*.\n- 200 m (2 boucles de 600 m) pour les benjamins*.\n- 1800 m (3 boucles de 600 m) pour les collégiens*.\nLe Temps pour effectuer la boucle de 600 m est compris entre 4 et 8 mn.\nNB: Au cours du cross la distance qui vous séparera du point d’arrivée vous sera indiquée tous les 100m.', 1, 'fr'),
(8, 'La mini course d\'orientation', 'De vraies balises de Course d’Orientation seront dissimulées sur le périmètre de jeu. Au début de l’épreuve, les concurrents se verront remettre une fiche de pointage ainsi qu’une carte indiquant les emplacements des balises.\nL’épreuve consistera à trouver un maximum de balises pendant le temps imposé.\nPrécaution: l’aire de jeu de cette épreuve comporte quelques buissons et épineux. Ceux ci sont peu dangereux (aucune victime à déplorer l’année dernière ;-)), les jambes des plus téméraires et volontaires ont quelque peu souffert… Bien que non nécessaire, un pantalon de toile ou jogging remplacera avantageusement les jupes ou autres mini shorts pour la durée de cette épreuve.', 2, 'fr'),
(9, 'Le parcours acrobatique', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 'fr'),
(10, 'Le tir à la carabine', 'Epreuve de précision gérée par notre partenaire Biathlon 06 dans laquelle il faudra, à l’aide de carabines laser, atteindre des cibles et marquer un maximum de points.', 4, 'fr'),
(11, 'Le quizz', 'Epreuve polymorphe culturelle et ludique où il faudra à la fois faire travailler vos méninges mais aussi utiliser vos connaissances sur l’environnement, la nature, la région...', 5, 'fr'),
(12, 'Le biathlon / vtt', 'Course au temps avec alternance de VTT et de tir à la carabine.\nDes balises (type balise de Course d’Orientation) sont à poinçonner sur chaque circuit pour valider les passages.\nCes balises seront bien visibles sur la passage des VTT (contrairement aux palises de l’épreuve de Course d’Orientation qui sont dissimulées). 20 minutes de pénalité seront infligées par balise manquante.\nLe classement de cette épreuve ce fait sur le temps total du parcours, plus les éventuelles pénalités de balises manquantes.\n- Parcours pitchouns* : 1 km, dénivelé + : 30m\n- Parcours poussins* : 2 km, dénivelé + : 70 m\n- Parcours benjamins* : 4km, dénivelé + : 100 m\n- Parcours collèges* : 6 km, dénivelé + : 200 m', 6, 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `id_equipe` int(10) NOT NULL,
  `equipe_nom` varchar(250) NOT NULL,
  `adulte_nom` varchar(250) NOT NULL,
  `adulte_prenom` varchar(250) NOT NULL,
  `lien_avec_enfant` varchar(250) NOT NULL,
  `enfant_nom` varchar(250) NOT NULL,
  `enfant_prenom` varchar(250) NOT NULL,
  `enfant_sexe` varchar(250) NOT NULL,
  `enfant_naissance` int(4) NOT NULL,
  `niveau` varchar(250) NOT NULL,
  `couleur` varchar(250) NOT NULL DEFAULT 'NC',
  `dossard` int(10) NOT NULL,
  `id_membre` int(10) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `ref_commande` varchar(20) NOT NULL,
  `paiement` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Equipe`
--

INSERT INTO `Equipe` (`id_equipe`, `equipe_nom`, `adulte_nom`, `adulte_prenom`, `lien_avec_enfant`, `enfant_nom`, `enfant_prenom`, `enfant_sexe`, `enfant_naissance`, `niveau`, `couleur`, `dossard`, `id_membre`, `date_inscription`, `ref_commande`, `paiement`) VALUES
(1, 'Les Gazelles', 'Francine', 'Paul', 'Père', 'Francine', 'Lisa', 'Fille', 2006, 'Benjamin', 'NC', 0, 1, '2017-04-25 14:15:12', 'RP3ZDS1U4XMOF3QQ3PMH', 'ok'),
(2, 'Les Indestructibles', 'Francine', 'Anne', 'Mère', 'Francine', 'Hugo', 'Garçon', 2009, 'Poussin', 'NC', 0, 1, '2017-04-25 14:15:12', 'RP3ZDS1U4XMOF3QQ3PMH', 'ok'),
(3, 'Fast And Furious', 'Dupont', 'Fred', 'Père', 'Dupont', 'Mathis', 'Garçon', 2009, 'Poussin', 'NC', 0, 2, '2017-04-26 19:20:20', 'H4XX1MXRH82O16FJNTR2', 'ok'),
(4, 'Les Etoiles Filantes', 'Sassi', 'Julie', 'Mère', 'Sassi', 'Emma', 'Fille', 2007, 'Benjamin', 'NC', 0, 3, '2017-04-26 19:23:08', 'KBLSUZUPU6VYW3ZHRXAA', 'ok'),
(5, 'Les Fous Du Raid', 'Berne', 'Dimitri', 'Père', 'Berne', 'Sarah', 'Fille', 2004, 'College', 'NC', 0, 4, '2017-04-26 19:30:22', '4Q6KNYDSKRWYKQNG7Q6T', 'ok'),
(6, 'Les Bronzes Font Le Raid', 'Berne', 'Theo', 'Frère/soeur', 'Berne', 'Camille', 'Fille', 2010, 'Pitchoun', 'NC', 0, 4, '2017-04-26 19:30:22', '4Q6KNYDSKRWYKQNG7Q6T', 'ok'),
(7, 'Les panthères roses', 'Denis', 'Nathalie', 'Mère', 'Denis', 'Emma', 'Fille', 2004, 'College', 'NC', 0, 6, '2019-10-15 18:38:36', 'WNFHXZ1NTU2DU6VCSCWD', 'ok'),
(8, 'Green Cats', 'Green', 'Steve', 'Père', 'Green', 'Anna', 'Fille', 2010, 'Pitchoun', 'NC', 0, 8, '2021-05-10 11:24:49', 'DT4CJSCFMEYIC4SK5P7V', 'ok'),
(9, 'Les Walibis', 'Dupont', 'Julie', 'Frère/soeur', 'Dupont', 'Noé', 'Garçon', 2004, 'College', 'NC', 0, 8, '2021-05-10 11:41:30', 'DD79KPHPJM6RJ047G3IV', 'ok'),
(10, 'Go Girl', 'Dupont', 'Maria', 'Mère', 'Dupont', 'Emma', 'Fille', 2007, 'Benjamin', 'NC', 0, 8, '2021-05-10 11:41:30', 'DD79KPHPJM6RJ047G3IV', 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `Info_raid`
--

CREATE TABLE `Info_raid` (
  `id_info_raid` int(10) NOT NULL,
  `date_raid` date NOT NULL,
  `date_inscription` date NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `texte_informatif` mediumtext NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Info_raid`
--

INSERT INTO `Info_raid` (`id_info_raid`, `date_raid`, `date_inscription`, `adresse`, `email`, `texte_informatif`, `langue`) VALUES
(1, '2017-05-14', '2017-03-02', 'Association Le Rouraid\r\nMaison des associations\r\n06650 Le Rouret', 'rouraid06@gmail.com', 'Préparez-vous \r\npour le rouraid 2017', 'fr'),
(2, '2017-05-14', '2017-03-02', 'Association Le Rouraid\r\nMaison des associations\r\n06650Le Rouret', 'rouraid06@gmail.com\r\n', 'Get ready for the race !!!', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE `Membre` (
  `id_membre` int(10) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Membre`
--

INSERT INTO `Membre` (`id_membre`, `nom`, `prenom`, `mail`, `password`, `date_inscription`) VALUES
(1, 'Francine', 'Paul', 'paul@mail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-25'),
(2, 'Dupont', 'Caroline', 'caroline@mail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-26'),
(3, 'Sassi', 'Julie', 'julie@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-26'),
(4, 'Berne', 'Dimitri', 'dimitri@mail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-26'),
(5, 'Sdfs', 'Sdf', 'ds@sdnk.ff', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2019-06-14'),
(6, 'Gefq', 'Dfghq', 'nn@bhj.fr', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2019-10-15'),
(7, 'Ghfdh', 'Gfdhdfgh', 'gh@bm.ff', '056eafe7cf52220de2df36845b8ed170c67e23e3', '2020-01-16'),
(8, 'Green', 'Steve', 'green@gmail.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '2021-05-10');

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `id_photo` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `alt` varchar(250) NOT NULL,
  `annee_raid` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Photo`
--

INSERT INTO `Photo` (`id_photo`, `url`, `alt`, `annee_raid`) VALUES
(1, 'rouraid2016_1.jpg', 'Rouraid 2016', 2016),
(2, 'rouraid2016_2.jpg', 'Rouraid 2016', 2016),
(3, 'rouraid2016_3.jpg', 'Rouraid 2016', 2016),
(4, 'rouraid2016_4.jpg', 'Rouraid 2016', 2016),
(5, 'rouraid2016_5.jpg', 'Rouraid 2016', 2016),
(6, 'rouraid2016_6.jpg', 'Rouraid 2016', 2016),
(7, 'rouraid2016_7.jpg', 'Rouraid 2016', 2016),
(8, 'rouraid2016_8.jpg', 'Rouraid 2016', 2016),
(9, 'rouraid2016_9.jpg', 'Rouraid 2016', 2016),
(21, 'rouraid2015_1.jpg', 'rouraid 2015', 2015),
(22, 'rouraid2015_2.jpg', 'rouraid 2015', 2015),
(23, 'rouraid2015_3.jpg', 'rouraid 2015', 2015),
(24, 'rouraid2015_4.jpg', 'rouraid 2015', 2015),
(25, 'rouraid2015_5.jpg', 'rouraid 2015', 2015),
(26, 'rouraid2015_6.jpg', 'rouraid 2015', 2015),
(27, 'rouraid2015_7.jpg', 'rouraid 2015', 2015),
(28, 'rouraid2015_8.jpg', 'rouraid 2015', 2015),
(29, 'rouraid2016_10.jpg', 'rouraid 2016', 2016),
(30, 'rouraid2016_11.jpg', 'rouraid 2016', 2016);

-- --------------------------------------------------------

--
-- Structure de la table `Presentation`
--

CREATE TABLE `Presentation` (
  `id_presentation` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `texte` text NOT NULL,
  `index_contenu` int(2) NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Presentation`
--

INSERT INTO `Presentation` (`id_presentation`, `titre`, `texte`, `index_contenu`, `langue`) VALUES
(1, 'La petite histoire', 'Tout a commencé en 2009 lorsqu\'une équipe de copains parents d\'élèves de l\'école primaire du Rouret a eu l\'idée d\'utiliser pour une manifestation sportive, familiale et conviviale le très joli site naturel du Camp Romain, tout d\'abord au sein de l\'association de parents d\'élèves. Le projet a très rapidement pris de l\'ampleur et l\'association Rouraid, contraction du nom du village Le Rouret et du mot raid, a été créée en 2010. Depuis, les enfants de primaire ont bien grandi, mais le Rouraid est toujours là et s\'y mêlent continuité et nouveauté, tant dans le bureau et parmi les bénévoles, de tous âges et de tous métiers, que dans l\'organisation même des épreuves.\r\nBien évidemment, le cross et le vtt sont des incontournables, mais s\'y sont rajoutés la course d\'orientation, et l’épreuve de tir à la carabine laser qui a remplacé la sarbacane. Le quizz et le parcours du combattant se renouvellent, eux, tous les ans. Nous sommes ravis d\'accueillir les familles entières, de plus en plus nombreuses, pour une journée champêtre et sportive, où tous, à commencer par les petits auxquels sont proposés divers jeux et le Minirouraid, passent une excellente journée.', 4, 'fr'),
(2, 'La charte nature', '<strong>Le Camp Romain est un cadre naturel et privilégié qui n’est pas un simple terrain de jeu mais un milieu que nous devons connaître et comprendre pour mieux le protéger et le sauvegarder.</strong>\r\n- Ni cueillette, ni prélèvement : Animaux, plantes, minéraux et fossiles appartiennent au paysage.\r\n- Ne rien jeter : La nature n’est pas une poubelle.\r\n- Ramasser les déchets trouvés : Même si ce ne sont pas les nôtres.\r\n- Respect de la signalisation : Ne pas sortir des sentiers, le piétinement abimerait les espèces végétales qui les encadrent.\r\n- Pas de feu : Pas de cigarette évidemment.\r\n- Respect de la faune : Ne pas perturber la tranquillité des animaux sauvages.\r\n- Animaux de compagnie (pour les supporters) : Ils doivent être tenus en laisse.', 3, 'fr'),
(4, 'Le mini Rouraid', 'En parrallèle, un <strong>\"mini rouraid\"</strong> est organisé pour occuper les plus petits. Il est gratuit et réservé aux enfants de maternelles.\r\nLes épreuves du mini-rouraid : tir à la sarbacane, mini run and Bike, quizz environnement et parcours d’obstacles.\r\nInscriptions sur place.\r\nPensez à apporter vos vélos (même avec roulettes) et casques.', 2, 'fr'),
(38, 'Le Rouraid', 'Chaque année, depuis 2010, l’association Le Rouraid, organise un raid dédié aux familles qui allie nature, convivialité et sport.\r\nCe raid se déroule en pleine nature, sur le plateau des milles chênes au Rouret.\r\nIl regroupe 100 équipes composées de 2 participants : un enfant (de 6 à 13 ans) et un adulte. Ensemble, ils s’attaquent à diverses épreuves, tel qu’un cross, un biathlon (vtt / tir à la carabine), une course d’orientation, un quizz, un parcours accrobatique et du tir à la carabine.\r\nA l&#039;issue des épreuves un repas convivial est servi sur de grandes tables sous les arbres. \r\nC’est une formidable occasion pour les parents et les enfants de partager un moment sportif et ludique.', 1, 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `Programme`
--

CREATE TABLE `Programme` (
  `id_programme` int(10) NOT NULL,
  `heure_debut` varchar(250) NOT NULL,
  `etape_titre` varchar(250) NOT NULL,
  `texte_etape` text NOT NULL,
  `index_contenu` int(3) NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Programme`
--

INSERT INTO `Programme` (`id_programme`, `heure_debut`, `etape_titre`, `texte_etape`, `index_contenu`, `langue`) VALUES
(1, '8 h 00', 'Accueil des participants', 'Après avoir garé votre voiture sur le parking du plateau des mille chênes, mis à votre disposition, vous pourrez récupérer vos dossards à l’accueil <strong>en échange de vos certificats médicaux.</strong>', 1, 'fr'),
(2, '8 h 45', 'Briefing de présentation des épreuves', 'Rendez-vous à côté de la bergerie.', 2, 'fr'),
(3, '9 h 15', 'Départ Cross', 'Trois Départs différents, selon l\'âge des enfants.', 3, 'fr'),
(4, '9 h 30', 'Ravitaillement', 'Pour reprendre des forces !', 4, 'fr'),
(5, '10 h 00', 'Début des 4 épreuves', '- Mini course d\'orientation\n- Quizz\n- Parcours acrobatique\n- Tir à la carabine', 5, 'fr'),
(6, '12 h 00', 'Départ Biathlon / VTT', 'Vtt et tir à la carabine', 6, 'fr'),
(7, '13 h 00', 'Repas champêtre', 'Repas convivial servi sur des grandes tables sous les arbres.\nAu menu : Pasta party', 7, 'fr'),
(8, '14 h 30', 'Remise des prix', 'Rendez-vous devant le podium', 8, 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `Reglement`
--

CREATE TABLE `Reglement` (
  `id_reglement` int(10) NOT NULL,
  `id_cat_reglement` int(10) NOT NULL,
  `texte` mediumtext NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Reglement`
--

INSERT INTO `Reglement` (`id_reglement`, `id_cat_reglement`, `texte`, `langue`) VALUES
(1, 1, 'L’adulte accompagnant devra avoir plus de 16 ans.', 'fr'),
(2, 1, 'L’accueil des participants se fera au départ de la piste du Camp Romain pour les vérifications administratives et techniques.', 'fr'),
(3, 1, 'La remise des dossards se fera uniquement sur présentation des deux certificats médicaux.', 'fr'),
(4, 1, '<strong>La non présentation des certificats médicaux entraine la mise hors course, sans remboursement possible.</strong>', 'fr'),
(5, 1, 'Un briefing de présentation des épreuves aura lieu avant le démarrage des épreuves.\nLors du briefing, seront précisés les points suivants :\n- Organisation du départ et déroulement des épreuves\n- Rappel des consignes de sécurité durant les épreuves\n- Remise de la feuille de route\n- Questions', 'fr'),
(6, 1, 'Le dépannage entre concurrents est autorisé et l’assistance est obligatoire en cas d’accident.', 'fr'),
(7, 1, 'Temps maximum éliminatoire:\n- Cross : 20 minutes\n- Epreuves : 30 minutes\n- VTT : 1 h 30 minutes', 'fr'),
(8, 2, 'Chaque équipe devra se tenir dans les itinéraires balisés et respecter la nature et les plantations autour de soi.', 'fr'),
(9, 2, 'Des poubelles sont réparties tout au long des parcours. Il est indispensable de ne rien laisser derrière soi.', 'fr'),
(10, 2, 'Le non respect de l’environnement pourra entraîner des points de pénalité.', 'fr'),
(11, 3, 'L’organisation ne peut être tenue responsable de tout incident matériel des concurrents.', 'fr'),
(12, 4, 'Tout abandon d’un équipier est définitif et entraîne automatiquement la mise hors course de l’équipe.', 'fr'),
(13, 4, 'L’équipe qui abandonne doit prévenir immédiatement un membre de l’organisation.', 'fr'),
(14, 5, 'Les équipes absentes le jour de l’épreuve ne pourront prétendre au remboursement des frais d’inscription.', 'fr'),
(15, 5, 'Les équipes en retard au départ ne pourront prétendre à une régularisation de leur temps de course.', 'fr'),
(16, 5, 'Toute équipe ne respectant pas le règlement ne pourra prendre le départ qu’après régularisation de sa situation.', 'fr'),
(17, 5, 'Le temps perdu sur l’heure du départ théorique ne sera pas décompté.', 'fr'),
(18, 6, 'Toute situation en désaccord avec le présent règlement entraîne la mise hors course immédiate', 'fr'),
(19, 6, 'Le non-respect des recommandations et consignes de courses délivrées par les organisateurs (zone interdite, itinéraire obligatoire non respecté, …) entraîne la mise hors course immédiate!!!', 'fr'),
(20, 6, 'L’attitude incorrecte vis à vis de l’organisation, des autres concurrents, des sites traversés entraînent la mise hors course immédiate!!!', 'fr'),
(21, 6, 'Le non-respect du port du casque en VTT entraîne la mise hors course immédiate.', 'fr'),
(22, 7, 'La participation au raid implique l’acceptation totale et sans réserve du présent règlement.', 'fr'),
(23, 8, 'Pas de report en cas de pluie.', 'fr'),
(24, 8, 'L’organisation se réserve le droit de toute modification ou annulation en fonction des conditions météorologiques ou de tout autre évènement indépendant de sa volonté.', 'fr'),
(25, 9, 'Chaque équipe doit se munir du matériel nécessaire à la bonne pratique de l’épreuve.', 'fr'),
(26, 10, '1 VTT et casque par personne', 'fr'),
(27, 10, '1 sac à dos avec un minimum de ravitaillement (eau, barre céréale, vêtement ...)', 'fr'),
(28, 10, '1 paire de chaussures type baskets', 'fr'),
(29, 10, '1 short ou jogging', 'fr'),
(30, 10, '1 t-shirt', 'fr'),
(31, 11, 'un pantalon pour la course d’orientation', 'fr'),
(32, 11, 'envisager un k-way en cas de légère pluie', 'fr'),
(33, 11, 'une casquette en cas de grand soleil', 'fr'),
(34, 12, 'Un parc VTT sera à disposition des coureurs au niveau de la bergerie.', 'fr'),
(35, 12, 'Prévoir un cadenas pour éventuellement accrocher son VTT aux barrières métalliques.', 'fr'),
(36, 13, 'La sécurité active du raid sera assurée par : \n- un responsable de sécurité\n- des signaleurs au niveau des intersections.\n- Un médecin urgentiste rattaché à un poste de premiers secours', 'fr'),
(37, 13, 'En cas d’accident\n- un concurrent doit toujours rester avec le blessé en attendant les secours.\n- Le co-équipier est responsable de l’accidenté jusqu’à l’arrivée des secours.', 'fr'),
(38, 14, 'Le classement s’établit au total de points obtenus à chaque épreuve déduction faite des pénalités éventuelles. Chacune des épreuves aura la même valeur en nombre de points.', 'fr'),
(39, 14, 'Un prix sera distribué aux trois premières équipes de chaque catégorie.', 'fr'),
(40, 15, 'J’autorise l’association ROURAID à me photographier et me filmer dans le cadre de la manifestation et accepte l’utilisation et l’exploitation non commerciale de mon image dans le cadre de la promotion de l’association.', 'fr'),
(41, 16, '<strong>Assurance :</strong>\nL’organisation possède une assurance responsabilité civile. Cependant, chaque concurrent  doit avoir souscrit à une assurance responsabilité civile comprenant une « individuelle accident » (en cas de dommages causés à soi-même). Chacun devra fournir en outre un <strong>certificat médical d’aptitude à la pratique d’un raid nature en compétition comprenant VTT et course à pied</strong>, daté de moins de 3 ans. Les certificats médicaux seront rendus à l’issus du raid sur votre demande.', 'fr'),
(42, 16, '<strong>Inscription :</strong> \nL’épreuve est limitée à 100 équipes soit 200 participants. Les participants devront s’inscrire via le site – onglet « Participer ». votre inscription sera validée après paiement <strong>et remise le jour du raid de vos certificats médicaux</strong>.', 'fr'),
(43, 16, '<strong>L’inscription comprend :</strong>\n- l’inscription au Raid\n- les ravitaillements\n- le repas du dimanche midi\n- un dossard et un T-shirt', 'fr'),
(44, 16, 'Forfait : \nEn cas d’annulation de votre inscription, veillez à nous en informer le plus rapidement possible. Les demandes de remboursement engendrent des couts pour l’association, le remboursement sera possible sur présentation d’un justificatif jusqu’à 10 jours avant le raid, c’est-à-dire jusqu’au 04 mai 2017.', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `Repas`
--

CREATE TABLE `Repas` (
  `id_repas` int(11) NOT NULL,
  `nb_repas` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `id_membre` int(10) NOT NULL,
  `ref_commande` varchar(20) NOT NULL,
  `paiement` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Repas`
--

INSERT INTO `Repas` (`id_repas`, `nb_repas`, `date_commande`, `id_membre`, `ref_commande`, `paiement`) VALUES
(1, 2, '2017-04-25', 1, 'RP3ZDS1U4XMOF3QQ3PMH', 'ok'),
(2, 1, '2017-04-25', 1, '4C6A6GEKME38DI3GPUAZ', 'ok'),
(3, 1, '2017-04-26', 2, 'H4XX1MXRH82O16FJNTR2', 'ok'),
(4, 1, '2017-04-26', 4, '4Q6KNYDSKRWYKQNG7Q6T', 'ok'),
(5, 2, '2019-10-15', 6, 'WNFHXZ1NTU2DU6VCSCWD', 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `Resultats`
--

CREATE TABLE `Resultats` (
  `id_resultats` int(10) NOT NULL,
  `dossard` int(4) NOT NULL,
  `equipe_nom` varchar(40) NOT NULL,
  `cat_sexe` varchar(40) NOT NULL,
  `adulte_nom` varchar(20) NOT NULL,
  `adulte_prenom` varchar(20) NOT NULL,
  `enfant_nom` varchar(20) NOT NULL,
  `enfant_prenom` varchar(20) NOT NULL,
  `enfant_naissance` int(4) NOT NULL,
  `classement_cross` int(4) NOT NULL,
  `point_cross` int(4) NOT NULL,
  `classement_vtt` int(4) NOT NULL,
  `point_vtt` int(4) NOT NULL,
  `classement_parcours` int(4) NOT NULL,
  `point_parcours` int(4) NOT NULL,
  `point_co` int(4) NOT NULL,
  `point_tir` int(4) NOT NULL,
  `point_quizz` int(4) NOT NULL,
  `total_point` int(4) NOT NULL,
  `total_classement` int(4) NOT NULL,
  `annee_raid` year(4) NOT NULL,
  `id_equipe` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Sponsor`
--

CREATE TABLE `Sponsor` (
  `id_sponsor` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `nom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Sponsor`
--

INSERT INTO `Sponsor` (`id_sponsor`, `url`, `nom`) VALUES
(1, 'logorouret.png', 'Mairie du Rouret'),
(2, 'logoadresse.png', 'Agence immobilière l\'adresse'),
(3, 'logogolle.png', 'Société Gollé'),
(4, 'logosna.png', 'Société SNA Prosperi'),
(5, 'logovsao.png', 'VSA Orientation'),
(6, 'logocarrefour.png', 'Carrefour Market Opio'),
(7, 'logopghm06.png', 'PGHM 06'),
(8, 'logoalpsolution.png', 'Société Alp solution');

-- --------------------------------------------------------

--
-- Structure de la table `Tarif`
--

CREATE TABLE `Tarif` (
  `id_tarif` int(10) NOT NULL,
  `tarif_normal` int(5) NOT NULL,
  `reduction` int(1) NOT NULL,
  `tarif_repas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Tarif`
--

INSERT INTO `Tarif` (`id_tarif`, `tarif_normal`, `reduction`, `tarif_repas`) VALUES
(1, 28, 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `v2Biathlon`
--

CREATE TABLE `v2Biathlon` (
  `id_biathlon` int(11) NOT NULL,
  `id_equipe` int(3) NOT NULL,
  `biathlon_chrono` time NOT NULL,
  `biathlon_penalite` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `v2Co`
--

CREATE TABLE `v2Co` (
  `id_co` int(10) NOT NULL,
  `id_equipe` int(10) NOT NULL,
  `nb_balise` int(2) NOT NULL,
  `bonus` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `v2Cross`
--

CREATE TABLE `v2Cross` (
  `id_cross` int(10) NOT NULL,
  `id_equipe` int(10) NOT NULL,
  `niveau_course` int(1) NOT NULL,
  `ordre_arrivee` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `v2Parcours`
--

CREATE TABLE `v2Parcours` (
  `id_parcours` int(10) NOT NULL,
  `id_equipe` int(10) NOT NULL,
  `parcours_chrono` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `v2Quizz`
--

CREATE TABLE `v2Quizz` (
  `id_quizz` int(10) NOT NULL,
  `id_equipe` int(10) NOT NULL,
  `point_quizz` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `v2Tir`
--

CREATE TABLE `v2Tir` (
  `id_tir` int(10) NOT NULL,
  `id_equipe` int(10) NOT NULL,
  `tir_enfant` int(3) NOT NULL,
  `tir_adulte` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `Cat_reglement`
--
ALTER TABLE `Cat_reglement`
  ADD PRIMARY KEY (`id_cat_reglement`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `Epreuve`
--
ALTER TABLE `Epreuve`
  ADD PRIMARY KEY (`id_epreuve`);

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `Info_raid`
--
ALTER TABLE `Info_raid`
  ADD PRIMARY KEY (`id_info_raid`);

--
-- Index pour la table `Membre`
--
ALTER TABLE `Membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- Index pour la table `Presentation`
--
ALTER TABLE `Presentation`
  ADD PRIMARY KEY (`id_presentation`);

--
-- Index pour la table `Programme`
--
ALTER TABLE `Programme`
  ADD PRIMARY KEY (`id_programme`);

--
-- Index pour la table `Reglement`
--
ALTER TABLE `Reglement`
  ADD PRIMARY KEY (`id_reglement`),
  ADD KEY `id_cat_reglement` (`id_cat_reglement`);

--
-- Index pour la table `Repas`
--
ALTER TABLE `Repas`
  ADD PRIMARY KEY (`id_repas`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `Resultats`
--
ALTER TABLE `Resultats`
  ADD PRIMARY KEY (`id_resultats`);

--
-- Index pour la table `Sponsor`
--
ALTER TABLE `Sponsor`
  ADD PRIMARY KEY (`id_sponsor`);

--
-- Index pour la table `Tarif`
--
ALTER TABLE `Tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Index pour la table `v2Biathlon`
--
ALTER TABLE `v2Biathlon`
  ADD PRIMARY KEY (`id_biathlon`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `v2Co`
--
ALTER TABLE `v2Co`
  ADD PRIMARY KEY (`id_co`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `v2Cross`
--
ALTER TABLE `v2Cross`
  ADD PRIMARY KEY (`id_cross`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `v2Parcours`
--
ALTER TABLE `v2Parcours`
  ADD PRIMARY KEY (`id_parcours`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `v2Quizz`
--
ALTER TABLE `v2Quizz`
  ADD PRIMARY KEY (`id_quizz`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `v2Tir`
--
ALTER TABLE `v2Tir`
  ADD PRIMARY KEY (`id_tir`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Cat_reglement`
--
ALTER TABLE `Cat_reglement`
  MODIFY `id_cat_reglement` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `id_commentaire` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Epreuve`
--
ALTER TABLE `Epreuve`
  MODIFY `id_epreuve` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `id_equipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Info_raid`
--
ALTER TABLE `Info_raid`
  MODIFY `id_info_raid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Membre`
--
ALTER TABLE `Membre`
  MODIFY `id_membre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `Presentation`
--
ALTER TABLE `Presentation`
  MODIFY `id_presentation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `Programme`
--
ALTER TABLE `Programme`
  MODIFY `id_programme` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Reglement`
--
ALTER TABLE `Reglement`
  MODIFY `id_reglement` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `Repas`
--
ALTER TABLE `Repas`
  MODIFY `id_repas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Resultats`
--
ALTER TABLE `Resultats`
  MODIFY `id_resultats` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT pour la table `Sponsor`
--
ALTER TABLE `Sponsor`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Tarif`
--
ALTER TABLE `Tarif`
  MODIFY `id_tarif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `v2Biathlon`
--
ALTER TABLE `v2Biathlon`
  MODIFY `id_biathlon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `v2Co`
--
ALTER TABLE `v2Co`
  MODIFY `id_co` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `v2Cross`
--
ALTER TABLE `v2Cross`
  MODIFY `id_cross` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `v2Parcours`
--
ALTER TABLE `v2Parcours`
  MODIFY `id_parcours` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `v2Quizz`
--
ALTER TABLE `v2Quizz`
  MODIFY `id_quizz` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `v2Tir`
--
ALTER TABLE `v2Tir`
  MODIFY `id_tir` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
