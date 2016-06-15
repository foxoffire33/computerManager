-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 18 apr 2016 om 15:02
-- Serverversie: 5.5.31
-- PHP-versie: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `releaz_computer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('customer', '10', 1458826828),
('customer', '11', 1458826886),
('customer', '12', 1458827047),
('customer', '13', 1460977086),
('customer', '4', NULL),
('customer', '8', 1458824556),
('customer', '9', 1458826702);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1458809331, 1458809331),
('customer', 1, NULL, NULL, NULL, 1458809331, 1458809331),
('DownloadOwnInvoice', 2, NULL, 'isOwner', NULL, 1458809331, 1458809331),
('guest', 1, NULL, NULL, NULL, 1458809331, 1458809331),
('login', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageBrand', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageComputerModel', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageComputerSummary', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageCustomer', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageInvoice', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageInvoiceRule', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageInvoiceRuleType', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageLog', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageUser', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('manageVat', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('passwordReset', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('staticPageView', 2, NULL, NULL, NULL, 1458809331, 1458809331),
('viewOwnComputer', 2, NULL, 'isOwner', NULL, 1458809331, 1458809331);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'customer'),
('customer', 'DownloadOwnInvoice'),
('customer', 'guest'),
('guest', 'login'),
('admin', 'manageBrand'),
('admin', 'manageComputerModel'),
('admin', 'manageComputerSummary'),
('viewOwnComputer', 'manageComputerSummary'),
('admin', 'manageCustomer'),
('admin', 'manageInvoice'),
('DownloadOwnInvoice', 'manageInvoice'),
('admin', 'manageInvoiceRule'),
('admin', 'manageInvoiceRuleType'),
('admin', 'manageLog'),
('admin', 'manageUser'),
('admin', 'manageVat'),
('guest', 'passwordReset'),
('guest', 'staticPageView'),
('customer', 'viewOwnComputer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isOwner', 'O:34:"frontend\\components\\db\\IsOwnerRule":3:{s:4:"name";s:7:"isOwner";s:9:"createdAt";i:1458809331;s:9:"updatedAt";i:1458809331;}', 1458809331, 1458809331);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `zipcode` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `webpage` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `brand`
--

INSERT INTO `brand` (`id`, `name`, `country`, `address`, `zipcode`, `city`, `email`, `phone`, `webpage`, `created_at`, `updated_at`) VALUES
(1, 'Onbekend', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-22 15:03:56', '2016-03-22 15:03:56'),
(2, 'Asus', '', '', '', '', '', '', '', '2016-04-18 12:45:06', '2016-04-18 12:45:06'),
(3, 'Apple', '', '', '', '', '', '', '', '2016-04-18 12:53:57', '2016-04-18 12:53:57');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `computer_model`
--

CREATE TABLE IF NOT EXISTS `computer_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `brand_id_model_fk` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `computer_model`
--

INSERT INTO `computer_model` (`id`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Onbekend', '2016-03-22 15:03:56', '2016-03-22 15:03:56'),
(2, 2, 'V3-M2NC61P', '2016-04-18 12:45:27', '2016-04-18 12:45:27'),
(3, 3, 'I pad G3', '2016-04-18 12:54:16', '2016-04-18 12:54:16');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `computer_summary`
--

CREATE TABLE IF NOT EXISTS `computer_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` smallint(1) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `serial_number` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customer_id_computer_fk` (`customer_id`),
  KEY `model_id_fk` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden geëxporteerd voor tabel `computer_summary`
--

INSERT INTO `computer_summary` (`id`, `name`, `customer_id`, `type`, `model_id`, `serial_number`, `created_at`, `updated_at`) VALUES
(11, 'Riemke''s computer', 11, 0, 2, '9BPBAU003084', '2016-04-18 12:50:08', '2016-04-18 12:50:08'),
(12, 'mijn ipad', 11, 0, 3, 'nog geen', '2016-04-18 12:54:35', '2016-04-18 12:54:35');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `adres` varchar(128) DEFAULT NULL,
  `zipcode` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `iban` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customer_user_id_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`id`, `name`, `adres`, `zipcode`, `city`, `email`, `phone`, `iban`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Riemke, Bakker', 'Schoolstraat 25', '9781JL', 'Bedum', 'riemke_bakker@hotmail.com', '0503012404', '', NULL, '2016-04-18 12:44:10', '2016-04-18 12:44:10');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `reference` varchar(128) DEFAULT NULL,
  `invoice_number` varchar(128) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `payed` tinyint(1) DEFAULT '0',
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customer_id_invoice_fk` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice_rule`
--

CREATE TABLE IF NOT EXISTS `invoice_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `vat_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `invoice_id_fk` (`invoice_id`),
  KEY `type_id_fk` (`type_id`),
  KEY `vat_id_fk` (`vat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice_rule_type`
--

CREATE TABLE IF NOT EXISTS `invoice_rule_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `invoice_rule_type`
--

INSERT INTO `invoice_rule_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Reparatie', '2016-03-23 10:28:10', '2016-03-23 10:28:10'),
(2, 'Onderhoud', '2016-04-18 12:58:00', '2016-04-18 12:58:00'),
(3, 'Op locatie', '2016-04-18 12:58:18', '2016-04-18 12:58:18'),
(4, 'Vervoer', '2016-04-18 12:58:25', '2016-04-18 12:58:25');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computer_id` int(11) DEFAULT NULL,
  `type` smallint(1) DEFAULT NULL,
  `event_datetime` datetime DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `computer_id_log_fk` (`computer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintenance_request`
--

CREATE TABLE IF NOT EXISTS `maintenance_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computer_id` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `description` text,
  `date_done` date DEFAULT NULL,
  `date_apointment` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `compuster_id_fk` (`computer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Gegevens worden geëxporteerd voor tabel `maintenance_request`
--

INSERT INTO `maintenance_request` (`id`, `computer_id`, `status`, `description`, `date_done`, `date_apointment`, `created_at`, `updated_at`) VALUES
(25, 11, 2, 'Ik heb onlangs onze computer bij jullie gebracht', '2015-07-28', '2015-07-14', '2016-04-18 12:53:13', '2016-04-18 12:53:41'),
(26, 12, 0, 'Kun jij toevallig ook mijn I-pad opschonen zodat hij weer wat sneller wordt?\r\nIk wil hem wel komen brengen.', NULL, NULL, '2016-04-18 12:55:13', '2016-04-18 12:55:13');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1458655412),
('m130524_201442_init', 1458655432),
('m140506_102106_rbac_init', 1458723400),
('m160302_130128_createDB', 1458655432),
('m160322_135434_defaultData', 1458655436);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, '', '$2y$13$Xu/ouAgWNdMrJMDs0a/G6.lS4sumddy6aFPMSmETJ3a.uG2.2GaBO', '-rOe6y74F8zFoEcM5THFlH-DwyZXcx7k_1458827330', 'reinierdlp@gmail.com', 10, 0, 1458827330),
(13, '', '$2y$13$jBigmgDvWD7Z8lsr51USn.wpWbxhFLugkbPWsMG7Hk6W9FQ84lzKi', NULL, 'reinierdlp@live.nl', 10, 1460977086, 1460977236),
(14, '', 'kjlkj', '', 'riemke_bakker@hotmail.com', 10, 1460977086, 1460977236);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vat`
--

CREATE TABLE IF NOT EXISTS `vat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `procentage` smallint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `vat`
--

INSERT INTO `vat` (`id`, `name`, `procentage`, `created_at`, `updated_at`) VALUES
(1, '21% Btw', 21, '2016-03-23 10:28:01', '2016-03-24 11:27:23');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `computer_model`
--
ALTER TABLE `computer_model`
  ADD CONSTRAINT `brand_id_model_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `computer_summary`
--
ALTER TABLE `computer_summary`
  ADD CONSTRAINT `customer_id_computer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `model_id_fk` FOREIGN KEY (`model_id`) REFERENCES `computer_model` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `customer_id_invoice_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `invoice_rule`
--
ALTER TABLE `invoice_rule`
  ADD CONSTRAINT `invoice_id_fk` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `type_id_fk` FOREIGN KEY (`type_id`) REFERENCES `invoice_rule_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `vat_id_fk` FOREIGN KEY (`vat_id`) REFERENCES `vat` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `computer_id_log_fk` FOREIGN KEY (`computer_id`) REFERENCES `computer_summary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `maintenance_request`
--
ALTER TABLE `maintenance_request`
  ADD CONSTRAINT `compuster_id_fk` FOREIGN KEY (`computer_id`) REFERENCES `computer_summary` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
