-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 oct. 2023 à 09:53
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `adminci4`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int UNSIGNED NOT NULL,
  `acc_num` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acc_num` (`acc_num`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `id_user`, `acc_num`) VALUES
(16, 36, '7875485798342'),
(26, 37, '2348987435704'),
(46, 68, '90000234221'),
(49, 71, '2376857'),
(50, 30, '2343555657'),
(51, 47, '2343555657'),
(57, 77, '324354'),
(58, 48, '5765789789'),
(59, 78, '38294657'),
(60, 79, '234445435');

-- --------------------------------------------------------

--
-- Structure de la table `bank_codes`
--

DROP TABLE IF EXISTS `bank_codes`;
CREATE TABLE IF NOT EXISTS `bank_codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_code` smallint NOT NULL,
  `agency_code` smallint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cemac_zone` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `cemac_zone`) VALUES
(1, 'AF', 'Afghanistan', 0),
(2, 'AX', 'Iles Aland', 0),
(3, 'AL', 'Albanie', 0),
(4, 'DZ', 'Algérie', 0),
(5, 'AS', 'Samoa américaines', 0),
(6, 'AD', 'Andorre', 0),
(7, 'AO', 'Angola', 0),
(8, 'AI', 'Anguilla', 0),
(9, 'AQ', 'Antarctique', 0),
(10, 'AG', 'Antigua-et-Barbuda', 0),
(11, 'AR', 'Argentine', 0),
(12, 'AM', 'Arménie', 0),
(13, 'AW', 'Aruba', 0),
(14, 'AU', 'Australie', 0),
(15, 'AT', 'Autriche', 0),
(16, 'AZ', 'Azerbaïdjan', 0),
(17, 'BS', 'Bahamas', 0),
(18, 'BH', 'Bahreïn', 0),
(19, 'BD', 'Bangladesh', 0),
(20, 'BB', 'Barbade', 0),
(21, 'BY', 'Biélorussie', 0),
(22, 'BE', 'Belgique', 0),
(23, 'BZ', 'Belize', 0),
(24, 'BJ', 'Bénin', 0),
(25, 'BM', 'Bermudes', 0),
(26, 'BT', 'Bhoutan', 0),
(27, 'BO', 'Bolivie', 0),
(28, 'BQ', 'Bonaire, Saint-Eustache et Saba', 0),
(29, 'BA', 'Bosnie Herzégovine', 0),
(30, 'BW', 'Botswana', 0),
(31, 'BV', 'Île Bouvet', 0),
(32, 'BR', 'Brésil', 0),
(33, 'IO', 'Territoire britannique de l\'océan Indien', 0),
(34, 'BN', 'Brunei Darussalam', 0),
(35, 'BG', 'Bulgarie', 0),
(36, 'BF', 'Burkina Faso', 0),
(37, 'BI', 'Burundi', 0),
(38, 'KH', 'Cambodge', 0),
(39, 'CM', 'Cameroun', 1),
(40, 'CA', 'Canada', 0),
(41, 'CV', 'Cap-Vert', 0),
(42, 'KY', 'Îles Caïmans', 0),
(43, 'CF', 'République centrafricaine', 1),
(44, 'TD', 'Tchad', 1),
(45, 'CL', 'Chili', 0),
(46, 'CN', 'Chine', 0),
(47, 'CX', 'Ile de noël', 0),
(48, 'CC', 'Îles Cocos (Keeling)', 0),
(49, 'CO', 'Colombie', 0),
(50, 'KM', 'Comores', 0),
(51, 'CG', 'Congo', 1),
(52, 'CD', 'Congo, République démocratique du Congo', 0),
(53, 'CK', 'Îles Cook', 0),
(54, 'CR', 'Costa Rica', 0),
(55, 'CI', 'Côte d\'Ivoire', 0),
(56, 'HR', 'Croatie', 0),
(57, 'CU', 'Cuba', 0),
(58, 'CW', 'Curacao', 0),
(59, 'CY', 'Chypre', 0),
(60, 'CZ', 'République Tchèque', 0),
(61, 'DK', 'Danemark', 0),
(62, 'DJ', 'Djibouti', 0),
(63, 'DM', 'Dominique', 0),
(64, 'DO', 'République dominicaine', 0),
(65, 'EC', 'Equateur', 0),
(66, 'EG', 'Egypte', 0),
(67, 'SV', 'Salvador', 0),
(68, 'GQ', 'Guinée Équatoriale', 1),
(69, 'ER', 'Érythrée', 0),
(70, 'EE', 'Estonie', 0),
(71, 'ET', 'Ethiopie', 0),
(72, 'FK', 'Îles Falkland (Malvinas)', 0),
(73, 'FO', 'Îles Féroé', 0),
(74, 'FJ', 'Fidji', 0),
(75, 'FI', 'Finlande', 0),
(76, 'FR', 'France', 0),
(77, 'GF', 'Guyane Française', 0),
(78, 'PF', 'Polynésie française', 0),
(79, 'TF', 'Terres australes françaises', 0),
(80, 'GA', 'Gabon', 1),
(81, 'GM', 'Gambie', 0),
(82, 'GE', 'Géorgie', 0),
(83, 'DE', 'Allemagne', 0),
(84, 'GH', 'Ghana', 0),
(85, 'GI', 'Gibraltar', 0),
(86, 'GR', 'Grèce', 0),
(87, 'GL', 'Groenland', 0),
(88, 'GD', 'Grenade', 0),
(89, 'GP', 'Guadeloupe', 0),
(90, 'GU', 'Guam', 0),
(91, 'GT', 'Guatemala', 0),
(92, 'GG', 'Guernesey', 0),
(93, 'GN', 'Guinée', 0),
(94, 'GW', 'Guinée-Bissau', 0),
(95, 'GY', 'Guyane', 0),
(96, 'HT', 'Haïti', 0),
(97, 'HM', 'Îles Heard et McDonald', 0),
(98, 'VA', 'Saint-Siège (État de la Cité du Vatican)', 0),
(99, 'HN', 'Honduras', 0),
(100, 'HK', 'Hong Kong', 0),
(101, 'HU', 'Hongrie', 0),
(102, 'IS', 'Islande', 0),
(103, 'IN', 'Inde', 0),
(104, 'ID', 'Indonésie', 0),
(105, 'IR', 'Iran (République islamique d', 0),
(106, 'IQ', 'Irak', 0),
(107, 'IE', 'Irlande', 0),
(108, 'IM', 'île de Man', 0),
(109, 'IL', 'Israël', 0),
(110, 'IT', 'Italie', 0),
(111, 'JM', 'Jamaïque', 0),
(112, 'JP', 'Japon', 0),
(113, 'JE', 'Jersey', 0),
(114, 'JO', 'Jordan', 0),
(115, 'KZ', 'Kazakhstan', 0),
(116, 'KE', 'Kenya', 0),
(117, 'KI', 'Kiribati', 0),
(118, 'KP', 'République populaire démocratique de Corée', 0),
(119, 'KR', 'Corée, République de', 0),
(120, 'XK', 'Kosovo', 0),
(121, 'KW', 'Koweit', 0),
(122, 'KG', 'Kirghizistan', 0),
(123, 'LA', 'République démocratique populaire lao', 0),
(124, 'LV', 'Lettonie', 0),
(125, 'LB', 'Liban', 0),
(126, 'LS', 'Lesotho', 0),
(127, 'LR', 'Libéria', 0),
(128, 'LY', 'Jamahiriya arabe libyenne', 0),
(129, 'LI', 'Liechtenstein', 0),
(130, 'LT', 'Lituanie', 0),
(131, 'LU', 'Luxembourg', 0),
(132, 'MO', 'Macao', 0),
(133, 'MK', 'Macédoine, ancienne République yougoslave de', 0),
(134, 'MG', 'Madagascar', 0),
(135, 'MW', 'Malawi', 0),
(136, 'MY', 'Malaisie', 0),
(137, 'MV', 'Maldives', 0),
(138, 'ML', 'Mali', 0),
(139, 'MT', 'Malte', 0),
(140, 'MH', 'Iles Marshall', 0),
(141, 'MQ', 'Martinique', 0),
(142, 'MR', 'Mauritanie', 0),
(143, 'MU', 'Ile Maurice', 0),
(144, 'YT', 'Mayotte', 0),
(145, 'MX', 'Mexique', 0),
(146, 'FM', 'Micronésie, États fédérés de', 0),
(147, 'MD', 'Moldova, République de', 0),
(148, 'MC', 'Monaco', 0),
(149, 'MN', 'Mongolie', 0),
(150, 'ME', 'Monténégro', 0),
(151, 'MS', 'Montserrat', 0),
(152, 'MA', 'Maroc', 0),
(153, 'MZ', 'Mozambique', 0),
(154, 'MM', 'Myanmar', 0),
(155, 'NA', 'Namibie', 0),
(156, 'NR', 'Nauru', 0),
(157, 'NP', 'Népal', 0),
(158, 'NL', 'Pays-Bas', 0),
(159, 'AN', 'Antilles néerlandaises', 0),
(160, 'NC', 'Nouvelle Calédonie', 0),
(161, 'NZ', 'Nouvelle-Zélande', 0),
(162, 'NI', 'Nicaragua', 0),
(163, 'NE', 'Niger', 0),
(164, 'NG', 'Nigeria', 0),
(165, 'NU', 'Niue', 0),
(166, 'NF', 'ile de Norfolk', 0),
(167, 'MP', 'Îles Mariannes du Nord', 0),
(168, 'NO', 'Norvège', 0),
(169, 'OM', 'Oman', 0),
(170, 'PK', 'Pakistan', 0),
(171, 'PW', 'Palau', 0),
(172, 'PS', 'Territoire palestinien, occupé', 0),
(173, 'PA', 'Panama', 0),
(174, 'PG', 'Papouasie Nouvelle Guinée', 0),
(175, 'PY', 'Paraguay', 0),
(176, 'PE', 'Pérou', 0),
(177, 'PH', 'Philippines', 0),
(178, 'PN', 'Pitcairn', 0),
(179, 'PL', 'Pologne', 0),
(180, 'PT', 'Le Portugal', 0),
(181, 'PR', 'Porto Rico', 0),
(182, 'QA', 'Qatar', 0),
(183, 'RE', 'Réunion', 0),
(184, 'RO', 'Roumanie', 0),
(185, 'RU', 'Fédération Russe', 0),
(186, 'RW', 'Rwanda', 0),
(187, 'BL', 'Saint Barthélemy', 0),
(188, 'SH', 'Sainte-Hélène', 0),
(189, 'KN', 'Saint-Christophe-et-Niévès', 0),
(190, 'LC', 'Sainte-Lucie', 0),
(191, 'MF', 'Saint Martin', 0),
(192, 'PM', 'Saint-Pierre-et-Miquelon', 0),
(193, 'VC', 'Saint-Vincent-et-les-Grenadines', 0),
(194, 'WS', 'Samoa', 0),
(195, 'SM', 'Saint Marin', 0),
(196, 'ST', 'Sao Tomé et Principe', 0),
(197, 'SA', 'Arabie Saoudite', 0),
(198, 'SN', 'Sénégal', 0),
(199, 'RS', 'Serbie', 0),
(200, 'CS', 'Serbie et Monténégro', 0),
(201, 'SC', 'les Seychelles', 0),
(202, 'SL', 'Sierra Leone', 0),
(203, 'SG', 'Singapour', 0),
(204, 'SX', 'St Martin', 0),
(205, 'SK', 'Slovaquie', 0),
(206, 'SI', 'Slovénie', 0),
(207, 'SB', 'Iles Salomon', 0),
(208, 'SO', 'Somalie', 0),
(209, 'ZA', 'Afrique du Sud', 0),
(210, 'GS', 'Géorgie du Sud et îles Sandwich du Sud', 0),
(211, 'SS', 'Soudan du sud', 0),
(212, 'ES', 'Espagne', 0),
(213, 'LK', 'Sri Lanka', 0),
(214, 'SD', 'Soudan', 0),
(215, 'SR', 'Suriname', 0),
(216, 'SJ', 'Svalbard et Jan Mayen', 0),
(217, 'SZ', 'Swaziland', 0),
(218, 'SE', 'Suède', 0),
(219, 'CH', 'Suisse', 0),
(220, 'SY', 'République arabe syrienne', 0),
(221, 'TW', 'Taiwan, Province de Chine', 0),
(222, 'TJ', 'Tadjikistan', 0),
(223, 'TZ', 'Tanzanie, République-Unie de', 0),
(224, 'TH', 'Thaïlande', 0),
(225, 'TL', 'Timor-Leste', 0),
(226, 'TG', 'Aller', 0),
(227, 'TK', 'Tokelau', 0),
(228, 'TO', 'Tonga', 0),
(229, 'TT', 'Trinité-et-Tobago', 0),
(230, 'TN', 'Tunisie', 0),
(231, 'TR', 'Turquie', 0),
(232, 'TM', 'Turkménistan', 0),
(233, 'TC', 'îles Turques-et-Caïques', 0),
(234, 'TV', 'Tuvalu', 0),
(235, 'UG', 'Ouganda', 0),
(236, 'UA', 'Ukraine', 0),
(237, 'AE', 'Emirats Arabes Unis', 0),
(238, 'GB', 'Royaume-Uni', 0),
(239, 'US', 'Etats-Unis', 0),
(240, 'UM', 'Îles mineures éloignées des États-Unis', 0),
(241, 'UY', 'Uruguay', 0),
(242, 'UZ', 'Ouzbékistan', 0),
(243, 'VU', 'Vanuatu', 0),
(244, 'VE', 'Venezuela', 0),
(245, 'VN', 'Viet Nam', 0),
(246, 'VG', 'Îles Vierges britanniques', 0),
(247, 'VI', 'Îles Vierges américaines, États-Unis', 0),
(248, 'WF', 'Wallis et Futuna', 0),
(249, 'EH', 'Sahara occidental', 0),
(250, 'YE', 'Yémen', 0),
(251, 'ZM', 'Zambie', 0),
(252, 'ZW', 'Zimbabwe', 0);

-- --------------------------------------------------------

--
-- Structure de la table `demands`
--

DROP TABLE IF EXISTS `demands`;
CREATE TABLE IF NOT EXISTS `demands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status_id` int NOT NULL DEFAULT '2',
  `created_by` int NOT NULL,
  `dobt` date NOT NULL,
  `doet` date NOT NULL,
  `bc_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bcnum` int NOT NULL,
  `bc_formula` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `stay_purpose` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `visa_scan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passport_scan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ticket_scan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `over_scan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passport_num` varchar(300) DEFAULT NULL,
  `passport_date` date DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demands`
--

INSERT INTO `demands` (`id`, `status_id`, `created_by`, `dobt`, `doet`, `bc_type`, `bcnum`, `bc_formula`, `destination`, `stay_purpose`, `comment`, `visa_scan`, `passport_scan`, `ticket_scan`, `over_scan`, `passport_num`, `passport_date`, `status_date`, `created_at`, `modified_at`, `modified_by`) VALUES
(1, 4, 36, '2023-06-08', '2023-06-15', 'Gold', 2365, 'F1', 'France/Bordeaux', 'Membre Equipages', '', '1685719821_ca826a602d4da5457c76.jpg', '1685719821_3e9bb84b78d9907f72db.png', '1685719821_cbb64d0b48139b2fee73.pdf', NULL, '894745ZTW48', '2025-06-12', '2023-08-02 12:12:38', '2023-06-02 00:00:00', '2023-06-02 15:30:21', 3),
(2, 5, 37, '2023-06-08', '2023-06-15', 'Privilège', 2365, '', 'France/Bordeaux', '', NULL, '1685720259_4a376cd67ff9a2b85baf.jpg', '1685720259_386d827881b159e2d52b.png', '1685720259_968af875c9787c93589d.pdf', NULL, NULL, NULL, NULL, '2023-06-02 00:00:00', '2023-06-02 15:37:39', 3),
(3, 5, 37, '2023-06-08', '2023-06-15', 'Gold', 2365, '', 'France/Bordeaux', '', NULL, '1685720287_2a1873dfacfe290105b3.jpg', '1685720287_2e35cf1fa56d012925c1.png', '1685720287_1083d73d4867ef892f2d.pdf', NULL, NULL, NULL, NULL, '2023-06-02 00:00:00', '2023-06-02 15:38:07', 3),
(4, 5, 5, '2023-06-08', '2023-06-15', 'Elite', 2365, '', 'France/Bordeaux', '', NULL, '1685720543_6742cca633326d7fff7a.jpg', '1685720543_28158c0827691e5a1165.png', '1685720543_8eb9ebbe031c2ae907fe.pdf', NULL, NULL, NULL, NULL, '2023-06-02 10:42:23', '2023-06-02 15:42:23', 3),
(5, 3, 36, '2023-06-08', '2023-06-15', 'Elite', 2365, '', 'France/Bordeaux', '', ' image passeport no lisible', '1685720603_1972fe612c4218df6e34.jpg', '1685720603_ee34c5ce0b567fd71a4c.png', '1685720603_f7abddfdccb32135fd18.pdf', NULL, NULL, NULL, '2023-07-21 15:54:24', '2023-06-02 10:43:23', '2023-06-02 15:43:23', 3),
(7, 5, 37, '2023-05-23', '2023-06-04', 'Gold', 2345, '', 'FR', '', NULL, '1685721822_041ccfd72425b6d9957e.png', '1685721822_88631c9647f8260858d1.jpg', '1685721822_04d322859bc47eb45931.pdf', NULL, NULL, NULL, '2023-06-07 09:52:30', '2023-06-02 11:03:42', '2023-06-02 16:03:42', 3),
(8, 3, 47, '2023-05-08', '2023-06-08', 'Privilège', 4596, '', 'NG', '', '', '1685841738_cd55429a13b5aaf9e77c.pdf', '1685841738_fbb2750b5e062486b0a7.jpg', '1685841738_8d97bed7c9bdd477e7de.jpg', NULL, NULL, NULL, '2023-07-21 15:46:36', '2023-06-03 20:22:18', '2023-06-04 01:22:18', 3),
(9, 2, 36, '2023-06-02', '2023-06-13', 'Privilège', 2345, 'F1', 'FR', 'Fonctionnaire Etat', NULL, '1686034219_b32714af37f957c482eb.pdf', '1686034219_01c602a059f38425efa3.png', '1686034219_620fd518e193be465b77.jpg', NULL, '345645YTU48', '2024-10-31', '2023-07-31 09:25:20', '2023-06-06 01:50:19', '2023-06-06 06:50:19', 36),
(10, 2, 47, '2023-06-02', '2023-06-09', 'Elite', 2345, '', 'DZ', '', '- fichier illisible\r\n- pass expiré', '1686850629_f9bff50ce3baf477226a.pdf', '1686850629_5141f5919bf185b67348.png', '1686850629_c5dcd80204d310c9a7ca.jpg', NULL, NULL, NULL, '2023-08-10 13:45:56', '2023-06-15 18:37:09', '2023-06-15 17:37:09', 3),
(12, 3, 36, '2023-06-01', '2023-06-21', 'Privilège', 3245, 'F1', 'AO', 'O4', '- Scan du passeport non lisible\r\n- Scan du Permis de travail manquant\r\n- Scan du livre', '1687186877_13636066805267a4907f.jpg', '1687186877_368dad3dcaaa055dbb39.png', '1687186877_f0de72669bd66c8c837a.pdf', NULL, '34BZV45ARU48', '2025-06-10', '2023-07-21 16:09:57', '2023-06-19 16:01:17', '2023-06-19 15:01:17', 36),
(15, 2, 47, '2023-06-18', '2023-06-30', 'Gold', 8754, '', 'GH', '', NULL, '1687337348_d09071bc87d16211f3a1.pdf', '1687337348_b6c56f51e6333d1f54cc.png', '1687337348_3e647c7e5986420f7e5a.jpg', NULL, NULL, NULL, NULL, '2023-06-21 09:49:08', '2023-06-21 08:49:08', 67),
(21, 2, 47, '2023-06-29', '2023-07-08', 'Privilège', 5567, 'F2', 'GA', 'Mission Diplômatique', '', NULL, NULL, NULL, NULL, '344345YTU47', '2023-07-05', '2023-07-21 15:28:23', '2023-07-04 14:43:46', '2023-07-04 13:43:46', 3),
(22, 2, 47, '2023-07-06', '2023-07-13', 'Privilège', 3465, 'F3', 'GB', 'Etudiant', NULL, NULL, NULL, NULL, NULL, '344345YTU45', '2024-07-12', NULL, '2023-07-12 11:18:55', '2023-07-12 10:18:55', 76),
(23, 2, 77, '2023-07-12', '2023-07-20', 'Privilège', 4654, 'F2', 'Angola', 'Formation, Stage, Mission ou alternance', NULL, NULL, NULL, NULL, NULL, '344345YTU48', '2025-10-18', NULL, '2023-07-18 08:48:57', '2023-07-18 07:48:57', 77),
(24, 4, 48, '2023-07-29', '2023-07-31', 'Elite', 7645, 'F3', 'États-Unis', 'Formation, Stage, Mission ou alternance', 'Documents manquants :\r\n- fiche de travail à l&#039;étranger;\r\n- billet d&#039;avion;\r\n- Cachet d&#039;entrée.', NULL, NULL, NULL, NULL, '3543YITY567', '2024-06-27', '2023-08-21 17:55:57', '2023-07-27 10:48:49', '2023-07-27 09:48:49', 3),
(25, 3, 78, '2023-07-13', '2023-11-30', 'Elite', 2354, 'F2', 'Maroc', 'Maladie', 'Les documents suivants sont manquants :\r\n- scan du visa\r\n- scan du passeport\r\n-scan du billet d&#039;avion', NULL, NULL, NULL, NULL, '384745ZTU48', '2025-10-28', '2023-07-28 17:38:45', '2023-07-28 15:07:23', '2023-07-28 14:07:23', 3),
(26, 2, 79, '2023-08-03', '2023-08-25', 'Privilège', 3456, 'F2', 'Canada', 'Mission Diplômatique', NULL, NULL, NULL, NULL, NULL, '344349YTU48', '2024-10-24', NULL, '2023-08-02 12:02:37', '2023-08-02 11:02:37', 79),
(27, 2, 36, '2023-08-19', '2023-09-10', 'Gold', 3456, 'F1', 'IO', 'O5', NULL, NULL, NULL, NULL, NULL, '340245YTU47', '2023-11-24', NULL, '2023-08-18 16:33:37', '2023-08-18 15:33:37', 36),
(29, 2, 36, '2023-08-18', '2023-09-01', 'Privilège', 3478, 'F2', 'KH', 'O6', NULL, NULL, NULL, NULL, NULL, '3543YFTY567', '2023-11-25', NULL, '2023-08-18 17:10:58', '2023-08-18 16:10:58', 36),
(30, 2, 36, '2023-08-18', '2023-08-27', 'Elite', 4326, 'F3', 'CO', 'O4', NULL, NULL, NULL, NULL, NULL, '344R65YTU45', '2023-11-25', NULL, '2023-08-18 17:20:09', '2023-08-18 16:20:09', 36),
(31, 2, 36, '2023-08-19', '2023-09-10', 'Elite', 2437, 'F2', 'BM', 'O7', NULL, NULL, NULL, NULL, NULL, '5689', '2023-12-09', NULL, '2023-08-18 17:22:36', '2023-08-18 16:22:36', 36),
(32, 2, 36, '2023-08-21', '2023-09-30', 'Elite', 2341, 'F3', 'AI', 'O7', NULL, NULL, NULL, NULL, NULL, '34R245ZTU48', '2023-11-29', NULL, '2023-08-21 12:30:33', '2023-08-21 11:30:33', 36),
(33, 2, 36, '2023-08-21', '2023-10-08', 'Elite', 3745, 'F3', 'BW', 'O5', NULL, NULL, NULL, NULL, NULL, '34RG45ZTU48', '2023-12-10', NULL, '2023-08-21 15:16:26', '2023-08-21 14:16:26', 36),
(34, 2, 36, '2023-08-21', '2023-11-11', 'Elite', 2387, 'F3', 'CI', 'O3', NULL, NULL, NULL, NULL, NULL, '2345', '2023-12-17', NULL, '2023-08-21 15:52:49', '2023-08-21 14:52:49', 36),
(36, 3, 36, '2023-08-31', '2023-10-28', 'Privilège', 1287, 'F4', 'DM', 'O4', 'Il manque la lettre d&#039;autorisation', NULL, NULL, NULL, NULL, '3RG345YTU47', '2023-12-15', '2023-08-21 17:40:29', '2023-08-21 16:24:32', '2023-08-21 15:24:32', 3),
(37, 2, 36, '2023-08-31', '2024-02-28', 'Privilège', 967, 'F2', 'BO', 'O4', NULL, NULL, NULL, NULL, NULL, '3543YTFS567', '2023-12-30', NULL, '2023-08-21 16:37:36', '2023-08-21 15:37:36', 36),
(38, 2, 36, '2023-09-02', '2023-10-26', 'Privilège', 7665, 'F2', 'CK', 'O3', NULL, NULL, NULL, NULL, NULL, '344XC5YTU45', '2023-12-19', NULL, '2023-08-21 16:45:54', '2023-08-21 15:45:54', 36),
(39, 2, 36, '2023-08-28', '2023-09-20', 'Gold', 3487, 'F1', 'BS', 'O5', NULL, NULL, NULL, NULL, NULL, '344745ZFU48', '2023-12-10', NULL, '2023-08-28 09:16:16', '2023-08-28 08:16:16', 36);

-- --------------------------------------------------------

--
-- Structure de la table `file_uploads`
--

DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE IF NOT EXISTS `file_uploads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `demand_id` int NOT NULL,
  `doc_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `uploaded_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demand_id` (`demand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `file_uploads`
--

INSERT INTO `file_uploads` (`id`, `demand_id`, `doc_type`, `file_type`, `file_name`, `uploaded_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'Visa', 'pdf', '1685841738_cd55429a13b5aaf9e77c.pdf', '2023-07-11 15:41:54', '2023-07-11 15:41:54', '2023-07-11 15:41:54'),
(2, 8, 'Passeport', 'jpg', '1685841738_fbb2750b5e062486b0a7.jpg', '2023-07-11 15:41:54', '2023-07-11 15:41:54', '2023-07-11 15:41:54'),
(3, 8, 'Billet d\'avion', 'jpg', '1685841738_8d97bed7c9bdd477e7de.jpg', '2023-07-11 15:41:54', '2023-07-11 15:41:54', '2023-07-11 15:41:54'),
(4, 9, 'Visa', 'pdf', '1686034219_b32714af37f957c482eb.pdf', '2023-07-12 08:02:28', '2023-07-12 08:02:28', '2023-07-12 08:02:28'),
(9, 9, 'Permis de Mission', 'pdf', '1690380445_028745dd16fa4e02b37a.pdf', '2023-07-26 15:07:25', '2023-07-26 15:07:25', '2023-07-26 15:07:25'),
(12, 24, 'Passeport', 'png', '1690454108_bad6bd46981c66a0d1c1.png', '2023-07-27 11:35:08', '2023-07-27 11:35:08', '2023-07-27 11:35:08'),
(13, 25, 'Passeport', 'png', '1690553806_827ac440af1b5f552f7c.png', '2023-07-28 15:16:46', '2023-07-28 15:16:46', '2023-07-28 15:16:46'),
(14, 25, 'Visa ou équivalent', 'jpg', '1690553829_1dede8094085798d0a7a.jpg', '2023-07-28 15:17:09', '2023-07-28 15:17:09', '2023-07-28 15:17:09'),
(15, 9, 'Image cachet d\'entrée', 'jpg', '1690974645_ee10d59ebdfca604ee96.jpg', '2023-08-02 12:10:45', '2023-08-02 12:10:45', '2023-08-02 12:10:45'),
(16, 9, 'permission de travail à l&#039;étranger', 'jpg', '1690974668_c13f0003bdc4ec62a9b0.jpg', '2023-08-02 12:11:08', '2023-08-02 12:11:08', '2023-08-02 12:11:08'),
(17, 27, 'Visa ou équivalent', 'jpg', '1692372818_73a7ed0dde6addd23a46.jpg', '2023-08-18 16:33:38', '2023-08-18 16:33:38', '2023-08-18 16:33:38'),
(18, 27, 'Passeport', 'jpg', '1692372818_b4cef82854a9c123bcac.jpg', '2023-08-18 16:33:38', '2023-08-18 16:33:38', '2023-08-18 16:33:38'),
(19, 27, 'Titre de Voyage', 'png', '1692372818_497ecb176b57928f9783.png', '2023-08-18 16:33:38', '2023-08-18 16:33:38', '2023-08-18 16:33:38'),
(20, 31, 'Visa ou équivalent', 'jpg', '1692375756_f3cda5b0198140968ed1.jpg', '2023-08-18 17:22:36', '2023-08-18 17:22:36', '2023-08-18 17:22:36'),
(21, 31, 'Passeport', 'pdf', '1692375756_56a921d502a4402ded84.pdf', '2023-08-18 17:22:36', '2023-08-18 17:22:36', '2023-08-18 17:22:36'),
(22, 31, 'Titre de Voyage', 'jpg', '1692375756_2642a4d3af4ad41d03e0.jpg', '2023-08-18 17:22:36', '2023-08-18 17:22:36', '2023-08-18 17:22:36'),
(23, 32, 'Visa ou équivalent', 'jpg', '1692617434_d221e0ac044c0b20e1a5.jpg', '2023-08-21 12:30:34', '2023-08-21 12:30:34', '2023-08-21 12:30:34'),
(24, 32, 'Passeport', 'pdf', '1692617434_21b0c0b2037563236acb.pdf', '2023-08-21 12:30:34', '2023-08-21 12:30:34', '2023-08-21 12:30:34'),
(25, 32, 'Titre de Voyage', 'png', '1692617434_7b824e58f20d7583439e.png', '2023-08-21 12:30:34', '2023-08-21 12:30:34', '2023-08-21 12:30:34'),
(26, 33, 'Visa ou équivalent', 'jpg', '1692627386_cc16ce500d492a351d86.jpg', '2023-08-21 15:16:26', '2023-08-21 15:16:26', '2023-08-21 15:16:26'),
(27, 33, 'Passeport', 'jpg', '1692627386_19beeb4f40d4162839ec.jpg', '2023-08-21 15:16:26', '2023-08-21 15:16:26', '2023-08-21 15:16:26'),
(28, 33, 'Titre de Voyage', 'pdf', '1692627386_8c6786ed97eba54f5d1c.pdf', '2023-08-21 15:16:26', '2023-08-21 15:16:26', '2023-08-21 15:16:26'),
(32, 35, 'Visa ou équivalent', 'jpg', '1692631066_89fa43f55837086ac684.jpg', '2023-08-21 16:17:46', '2023-08-21 16:17:46', '2023-08-21 16:17:46'),
(33, 35, 'Passeport', 'jpg', '1692631066_bedbbd39b5653cd1d5a4.jpg', '2023-08-21 16:17:46', '2023-08-21 16:17:46', '2023-08-21 16:17:46'),
(34, 35, 'Titre de Voyage', 'jpg', '1692631066_47d285bad95aeec49d31.jpg', '2023-08-21 16:17:46', '2023-08-21 16:17:46', '2023-08-21 16:17:46'),
(35, 36, 'Visa ou équivalent', 'pdf', '1692631472_777a976eb4017db6f4f7.pdf', '2023-08-21 16:24:32', '2023-08-21 16:24:32', '2023-08-21 16:24:32'),
(36, 36, 'Passeport', 'pdf', '1692631472_ea0af810e16de884242b.pdf', '2023-08-21 16:24:32', '2023-08-21 16:24:32', '2023-08-21 16:24:32'),
(37, 36, 'Titre de Voyage', 'jpg', '1692631472_bfd62c99c22352cc0bb1.jpg', '2023-08-21 16:24:32', '2023-08-21 16:24:32', '2023-08-21 16:24:32'),
(38, 37, 'Visa ou équivalent', 'pdf', '1692632256_82a57be949a69bf9df29.pdf', '2023-08-21 16:37:36', '2023-08-21 16:37:36', '2023-08-21 16:37:36'),
(39, 37, 'Passeport', 'pdf', '1692632256_54ed405470f200a94767.pdf', '2023-08-21 16:37:36', '2023-08-21 16:37:36', '2023-08-21 16:37:36'),
(40, 37, 'Titre de Voyage', 'jpg', '1692632257_57a94cc1629b57665968.jpg', '2023-08-21 16:37:37', '2023-08-21 16:37:37', '2023-08-21 16:37:37'),
(41, 38, 'Visa ou équivalent', 'png', '1692632754_42d364a39db2cae46aa0.png', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(42, 38, 'Passeport', 'jpg', '1692632754_0fd4c29f57e95c80da1e.jpg', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(43, 38, 'Titre de Voyage', 'pdf', '1692632754_0ed53471cb63a880f968.pdf', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(44, 38, 'Autres fichiers1', 'jpg', '1692632754_22ac6e1c043d7a30e115.jpg', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(45, 38, 'Autres fichiers2', 'jpg', '1692632754_0f0e2ae9669123d9c7a7.jpg', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(46, 38, 'Autres fichiers3', 'png', '1692632754_bfeac2af13a8645ed206.png', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(47, 38, 'Autres fichiers4', 'png', '1692632754_1cf02f895bda45455e2a.png', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(48, 38, 'Autres fichiers5', 'png', '1692632754_ebc662fdcfbe7421b754.png', '2023-08-21 16:45:54', '2023-08-21 16:45:54', '2023-08-21 16:45:54'),
(49, 39, 'Visa ou équivalent', 'jpg', '1693210576_03ad3eb17346d2cc6bad.jpg', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16'),
(50, 39, 'Passeport', 'pdf', '1693210576_f3afe713fb063b842a65.pdf', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16'),
(51, 39, 'Titre de Voyage', 'jpg', '1693210576_0a20b6b0e31890e7fa10.jpg', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16'),
(52, 39, 'Autres documents1', 'jpg', '1693210576_c3084ebbe22830eff2f1.jpg', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16'),
(53, 39, 'Autres documents2', 'jpg', '1693210576_72be7cff2ba1b04ec22b.jpg', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16'),
(54, 39, 'Autres documents3', 'jpg', '1693210576_6b7bd40fd087daa51f28.jpg', '2023-08-28 09:16:16', '2023-08-28 09:16:16', '2023-08-28 09:16:16');

-- --------------------------------------------------------

--
-- Structure de la table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `dooc` datetime NOT NULL,
  `doid` date NOT NULL,
  `incident_entity` varchar(100) NOT NULL,
  `gross_loss` varchar(100) NOT NULL,
  `recovery` varchar(100) NOT NULL,
  `control_action` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-05-20-124016', 'App\\Database\\Migrations\\Users', 'default', 'App', 1685336552, 1),
(2, '2021-05-20-124435', 'App\\Database\\Migrations\\Session', 'default', 'App', 1685336552, 1),
(3, '2021-05-20-125608', 'App\\Database\\Migrations\\UserRole', 'default', 'App', 1685336553, 1),
(4, '2021-05-20-125818', 'App\\Database\\Migrations\\UserAccess', 'default', 'App', 1685336553, 1),
(5, '2021-05-20-130307', 'App\\Database\\Migrations\\UserMenu', 'default', 'App', 1685336553, 1),
(6, '2021-05-20-130307', 'App\\Database\\Migrations\\UserSubmenu', 'default', 'App', 1685336553, 1),
(7, '2021-05-24-100652', 'App\\Database\\Migrations\\User', 'default', 'App', 1685336553, 1),
(8, '2021-05-25-102709', 'App\\Database\\Migrations\\UserMenuCategory', 'default', 'App', 1685336553, 1),
(9, '2023-06-01-114708', 'App\\Database\\Migrations\\CustomerDemand', 'default', 'App', 1685723513, 2),
(10, '2023-06-02-161803', 'App\\Database\\Migrations\\Status', 'default', 'App', 1685723513, 2),
(11, '2023-06-02-163252', 'App\\Database\\Migrations\\Demands', 'default', 'App', 1689261254, 3),
(12, '2023-07-10-170034', 'App\\Database\\Migrations\\Incidents', 'default', 'App', 1689262772, 4),
(13, '2023-07-11-143321', 'App\\Database\\Migrations\\Services', 'default', 'App', 1689262773, 4);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `services` varchar(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ci_session:be9phqie9thm7ct9ljd452herh1hnb4r', '::1', '2023-10-16 09:25:43', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639373434373432363b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:hk9hrvjb8nfhpn4h2r69a32i1515s9dn', '::1', '2023-09-25 11:02:24', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639353633393733313b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3440676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:92pbkaig8ch79stedju7j6u9h4pbvqsf', '::1', '2023-09-28 14:14:55', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639353931303438333b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:acrd0d63oft8182qovbr5if8vmmmrd35', '::1', '2023-09-14 16:41:37', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343730393639323b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:ikgo69l09b9pdsu8uj4fdlqvurbnqs11', '::1', '2023-09-15 09:36:43', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343737303539353b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:6a65lnngv6cddocq1kvcb1nk334178eo', '::1', '2023-08-16 18:17:17', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323230393438303b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:9qesdja1mt6ckubctj0nlq2u7m8l1bla', '::1', '2023-08-17 07:20:23', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323235363731323b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a31353a226a65726f6c4061646d696e2e636f6d223b726f6c657c733a313a2232223b69734c6f67676564496e7c623a313b),
('ci_session:afo0vtmlcm1bs1gldubk4n301d4akja8', '::1', '2023-08-17 10:02:17', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323236363231353b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:r09cuiraosdk97nukkdcilhckdemkvko', '::1', '2023-08-17 14:05:02', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323238313030363b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:m0vfmk4ev6frq36eetrrk0cv9lunggjg', '::1', '2023-08-18 07:34:53', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323334343038323b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:g6tirjijg2ajesial3fiphe5dq821lij', '::1', '2023-08-18 16:54:01', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323337373439383b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b),
('ci_session:jgp645fcu9hdbtqfn5uno15bp4nh37u6', '::1', '2023-08-18 15:34:46', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323337323834343b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a31353a226a65726f6c4061646d696e2e636f6d223b726f6c657c733a313a2232223b69734c6f67676564496e7c623a313b),
('ci_session:jhtimtq3ugcgqfabgt8qketka4pijrp4', '::1', '2023-08-21 11:31:01', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323631373433333b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:gesls6l9osb345puvja3vpb6tkovqktq', '::1', '2023-08-21 15:46:13', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323633323532393b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:7vhfdrathmu7g882v927urvsh2cha10e', '::1', '2023-08-21 16:56:16', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323633363635353b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a31353a226a65726f6c4061646d696e2e636f6d223b726f6c657c733a313a2232223b69734c6f67676564496e7c623a313b),
('ci_session:6cbl6slekt48odocuqumgruhqikbvv1e', '::1', '2023-08-22 07:12:10', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323638383332313b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:v8lun7dkrgc6bp0oq3t3dcptf8dhl319', '::1', '2023-08-24 10:20:09', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323837323430373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:ebopmvmd14v6mv0fgv1jgpqg9q8jtoab', '::1', '2023-08-24 11:04:20', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323837353035373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:o41qh2homuoj1bp6uro1c6ob2068dd06', '::1', '2023-08-24 11:04:39', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323837353037373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:5err31p8tncqoc48tc81dvm8dfdj0o9j', '::1', '2023-08-24 14:05:22', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323838343634313b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:6il51ocjohibqeu8e2m622bgjshfs68h', '::1', '2023-08-24 14:21:50', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323838363233363b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:96557h3pl1vhleq5a9j60ibu489d4aho', '::1', '2023-08-24 18:27:10', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323930313335323b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:hem2oann0qsvd5pa6kbfvjlmttu0ihne', '::1', '2023-08-24 18:10:03', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323839393232333b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:kblmlb3hb1lrehmro5uvvk2m49c1eeup', '::1', '2023-08-24 18:29:08', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323930303537343b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:e8i6cii9f4ti6usoforh3uarlibuhq0q', '::1', '2023-08-25 11:04:04', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323936303430373b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3440676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:khdv4lr1shoe86s87tp7agll82h36d1c', '::1', '2023-08-25 11:04:51', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323936313337363b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a31353a226a65726f6c4061646d696e2e636f6d223b726f6c657c733a313a2232223b69734c6f67676564496e7c623a313b),
('ci_session:1d02iqlgee6j3f47e8oq1pkvsgdmir5k', '::1', '2023-08-25 15:15:50', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639323937363534393b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:n0775gvnosssjqs3je23hqhmlb3pfbhq', '::1', '2023-08-28 11:42:48', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333232323732323b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:9qb2bn4cuuk1ipm7sfbur04n11n5a662', '::1', '2023-08-28 11:43:24', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333232323938343b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:41fic3o2f0og2ia7k0eeenr8a07003fk', '::1', '2023-08-28 16:11:04', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333233393035373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:k92c5tj70190nb4nq6uek6oa7v9kij73', '::1', '2023-08-28 16:30:35', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333234303233333b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:pma7rv4murn81aau7qsh5hfn8bag23in', '127.0.0.1', '2023-08-28 16:14:07', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333233393234323b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:2mda0m039i2cfbe8rj8vmmkkkm21n5mm', '::1', '2023-08-29 08:23:38', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333239373431313b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:uguaq8833si0uhqj4bkqgdgjaeld7vdd', '::1', '2023-08-29 10:11:13', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333330333835393b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:4ds930sjblu6g5ufq88ie7dkr1br30pg', '::1', '2023-08-29 11:25:02', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333330373334313b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b),
('ci_session:l3c6edkomooeg7oc4erm3k8ii5grtvhk', '::1', '2023-08-29 14:56:04', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333332303334383b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3440676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:73a4pfs0jviufar5lfbafbloaeucdo5n', '::1', '2023-08-29 15:28:59', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333332323732373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:16jm2g20ui8snkbub26o7f8an2h4090k', '::1', '2023-08-30 07:07:20', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333337393233353b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:ol1h1pvebc37lnkhoq4pr1qei3kna60t', '::1', '2023-08-30 16:32:32', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333431313732323b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f686f6d65223b757365726e616d657c733a32323a2272707463686974656d626f3240676d61696c2e636f6d223b726f6c657c733a313a2233223b69734c6f67676564496e7c623a313b),
('ci_session:o777g3sp8dj3cggqacd4busor8tiok2n', '::1', '2023-08-31 13:05:37', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333438363832303b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:j7ehjfi1974gr353egfggq4ja88tvte8', '::1', '2023-09-01 15:38:49', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333538323437313b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:90dbdo1li6mh2ghvf5hkvptefb39smai', '::1', '2023-09-04 15:38:37', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639333834313931373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:maa680jvargci5jpllvfp1no0p7cp5vm', '::1', '2023-09-12 10:29:01', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343531333831313b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:34u11n0fe6poh4l9e9duk6b3c1thqc7j', '::1', '2023-09-12 18:22:01', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343534323238363b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:mac5j05c2o116gegfi8erv7mbisgck96', '::1', '2023-09-12 18:16:27', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343534313235363b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:2ud6i89na6h1sf6rmol7kroca8qeb9ig', '::1', '2023-09-13 11:46:26', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343630343735373b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:sopllpiv0ije1lcev2n2nboiao52bvqn', '::1', '2023-09-13 15:27:05', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343631383832333b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:mf1skq7solqj7e15khh6mglkjam7c5ge', '::1', '2023-09-14 08:43:05', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343638303938323b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:s7m8u9arirbi1njoece5lsk4747trhrq', '::1', '2023-09-14 12:35:02', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343639343930303b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b),
('ci_session:vat02m7s7v2uikbhh3j3m3us0vifpo6v', '::1', '2023-09-14 14:36:09', 0x5f5f63695f6c6173745f726567656e65726174657c693a313639343730323136383b5f63695f70726576696f75735f75726c7c733a32373a22687474703a2f2f6c6f63616c686f73742f696e6465782e7068702f223b);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `st_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `status`, `st_order`) VALUES
(2, 'En cours de<br/> traitement', 1),
(3, 'En suspend pour<br/> compléments', 2),
(4, 'Validée', 3),
(5, 'Clôturée', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `wphone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `link_code` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `code_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `link` (`link_code`),
  KEY `cde_date` (`code_date`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `wphone`, `link_code`, `code_date`, `is_active`, `password`, `role`, `created_at`, `activated_at`, `updated_at`) VALUES
(1, 'Developer Tester', 'tester@mail.io', '', '', NULL, 1, '$2y$10$xwvTG9nHUDY73KVXfukLS.M3FwXsFRgcFmF4SoC7qryTr1W0wXxiq', 1, '2023-05-29 12:03:08', NULL, '2023-05-29 21:19:54'),
(3, 'Jerry Rollins', 'jerol@admin.com', '', 'r9DAKfJ6W0APw1ZZpOf5', '2023-08-29 16:27:17', 1, '$2y$10$/RBPDUEE9WDJHUqWHC7oxe.jlgVH0Lw5/TcVc1.xlmUM5Cq4nBvvG', 2, '2023-05-29 12:16:16', NULL, '2023-08-29 16:27:17'),
(4, 'Cedrick TATI MANDAHYLLA', 'tati.mandahylla@gmx.com', '', '', NULL, 1, '$2y$10$ztxgImBV/0sGukEQ3FeofOFGzpszn3PWHLN5l3DJ6wBsUWAM0MRqC', 1, '2023-05-29 05:58:21', NULL, '2023-06-04 04:22:01'),
(5, 'TCHITEMBO Romain Paul', 'rptchitembo@gmail.com', '00242057896765', '', NULL, 0, '$2y$10$vh7zt.H1PPTl8/oEIi58o.VxCVRBLXwPv/4YDEfJMlYbH8w62iube', 3, '2023-05-31 05:57:31', NULL, '2023-06-04 04:23:34'),
(36, 'TCHITEMBO Romain Paul 2', 'rptchitembo2@gmail.com', '00242057896767', '', NULL, 1, '$2y$10$iFFtRaXld37/XtKNkbncz.zvB3sot.wgl6zUQG4SbeVGmGyTF9f1G', 3, '2023-05-31 06:27:55', NULL, '2023-06-04 00:00:00'),
(37, 'Aymards KIMIKA', 'aykim@gmail.com', '0024206752656', NULL, NULL, 0, '$2y$10$OxYwAX1MyFIbVp73XAuNyu4qYPYog9srzyeuCoRQN80Ceez33yVNO', 3, '2023-06-03 10:31:41', NULL, '2023-06-04 04:31:41'),
(47, 'TCHITEMBO Jean-Paul', 'tchitjean@gmail.com', '00242056896766', NULL, NULL, 0, '$2y$10$VVlGTAJqjfe.A./LeljqOuoHmjTjKotgSGI9O8bdX9UPFS1qIY5pK', 2, '2023-06-09 05:43:17', NULL, '2023-06-09 11:43:17'),
(48, 'TCHITEMBO Romain Paul 4', 'rptchitembo4@gmail.com', '00242057896768', NULL, NULL, 1, '$2y$10$cfKfVEb80QB2hW75HwtKu.sEkpn1FqbpMXlPPMBlrZPAlsdwcohNy', 3, '2023-06-12 05:41:08', '2023-06-12 09:57:26', '2023-06-12 11:41:08'),
(68, 'ennasmi mouhcine', 'en.mouhcine@gmail.com', '00242067003560', 'voMRRs0tZUhhuDt8iAPP', '2023-06-16 11:15:32', 1, '$2y$10$C4UwwyimEM8oEDBjurfcHeGtDh0MlM9RNtU9A5Qc0AWulQl8Zl32W', 3, '2023-06-16 11:15:32', NULL, '2023-06-16 11:15:32'),
(77, 'TCHITEMBO Romain Paul 6', 'cedrick-marc.mandahylla@creditducongo.com', '+242057896768', 'NXZPnNScRhUwnN5lNMJ8', '2023-07-18 08:48:57', 1, '$2y$10$wlg.gNU30KJ0Ux3ozhSD4OTEs83dhmp5VLmw/JNaThqEKrvoRvlMK', 3, '2023-07-18 08:48:57', '2023-07-18 08:50:47', '2023-07-18 08:48:57'),
(78, 'BOUMIN Roland', 'lartdecoder@gmail.com', '056453898', '8ArWkRc4FUNNKOyapfLC', '2023-07-28 15:07:23', 1, '$2y$10$OwJ1Q1xT.2Hv/yT02H2qEOomd2F0tzGT8x9/f3RUMRhP9U0.XmlI.', 3, '2023-07-28 15:07:23', '2023-07-28 15:08:21', '2023-07-28 15:07:23'),
(79, 'BIMBA Paul André', 'rptchitembo66@gmail.com', '+242057894768', 'HYVITjNZgS2QPlFyV7Qp', '2023-08-02 12:02:37', 0, '$2y$10$/pof3Q.bzkzroN0oSugg9uYg85TPR6pPwKhD2eoTicteD4bdPdhjy', 3, '2023-08-02 12:02:37', NULL, '2023-08-02 12:02:37');

-- --------------------------------------------------------

--
-- Structure de la table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int UNSIGNED NOT NULL,
  `menu_category_id` int UNSIGNED NOT NULL,
  `menu_id` int UNSIGNED NOT NULL,
  `submenu_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_access`
--

INSERT INTO `user_access` (`id`, `role_id`, `menu_category_id`, `menu_id`, `submenu_id`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 0, 1, 0),
(3, 1, 2, 0, 0),
(4, 1, 0, 2, 0),
(5, 1, 3, 0, 0),
(6, 1, 0, 3, 0),
(7, 1, 0, 4, 0),
(12, 3, 0, 5, 0),
(11, 3, 1, 0, 0),
(13, 1, 4, 0, 0),
(14, 1, 0, 6, 0),
(19, 3, 0, 6, 0),
(16, 3, 4, 0, 0),
(20, 3, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_category` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` text NOT NULL,
  `parent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu_category`, `title`, `url`, `icon`, `parent`) VALUES
(1, 1, 'Dashboard', 'home', 'home', 0),
(2, 2, 'Users', 'users', 'user', 0),
(3, 3, 'Menu Management', 'menuManagement', 'command', 0),
(4, 3, 'CRUD Generator', 'crudGenerator', 'code', 0),
(6, 4, 'Demande', 'customer/demand', 'clipboard', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_menu_category`
--

DROP TABLE IF EXISTS `user_menu_category`;
CREATE TABLE IF NOT EXISTS `user_menu_category` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_menu_category`
--

INSERT INTO `user_menu_category` (`id`, `menu_category`) VALUES
(1, 'Common Page'),
(2, 'Settings'),
(3, 'Developers'),
(4, 'Customer page');

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`) VALUES
(1, 'Administrateur'),
(2, 'Banquier'),
(3, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `user_submenu`
--

DROP TABLE IF EXISTS `user_submenu`;
CREATE TABLE IF NOT EXISTS `user_submenu` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
