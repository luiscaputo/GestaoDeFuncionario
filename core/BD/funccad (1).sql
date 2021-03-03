-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02-Mar-2021 às 21:17
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funccad`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `idFunc` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idFunc` (`idFunc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(30) NOT NULL,
  `idPerson` int(11) NOT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idPerson` (`idPerson`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contract`
--

DROP TABLE IF EXISTS `contract`;
CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPerson` int(11) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `typeContratct` varchar(100) NOT NULL,
  `statusContract` varchar(100) NOT NULL,
  `entranceCompany` date NOT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPerson` (`idPerson`),
  KEY `idDepart` (`idDepart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departament`
--

DROP TABLE IF EXISTS `departament`;
CREATE TABLE IF NOT EXISTS `departament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `departament`
--

INSERT INTO `departament` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Anderson', '2021-02-24 15:26:12', '2021-02-24 15:26:12'),
(9, 'Luis Afonso Caputo', '2021-02-24 16:13:07', '2021-02-24 16:13:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `function`
--

DROP TABLE IF EXISTS `function`;
CREATE TABLE IF NOT EXISTS `function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idDepart` (`idDepart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `idPerson` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nif` varchar(14) NOT NULL,
  `birthDate` date NOT NULL,
  `sex` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  `qtdSon` int(11) NOT NULL,
  `studentLevel` varchar(200) NOT NULL,
  `profition` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `howToMetedTheCompany` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `person`
--

INSERT INTO `person` (`idPerson`, `name`, `nif`, `birthDate`, `sex`, `status`, `qtdSon`, `studentLevel`, `profition`, `address`, `howToMetedTheCompany`, `createdAt`, `updatedAt`) VALUES
(1, 'LuÃ­s Afonso Caputo', '006989589LA042', '2002-04-20', 'Masculino', 'Solteiro', 0, 'Pre-SuperioiSuperior', 'Desenvolvedor de Sistema', 'Morro bento, Av.21 de Janeiro, Rua Nelson Mandela', 'Conheci por meio de um amigo', '2021-02-24 16:33:41', '2021-02-24 16:33:41'),
(2, 'Madalena Cesar Gunza', '006989589LA042', '2002-04-20', 'Masculino', 'Solteiro', 0, 'Pre-SuperioiSuperior', 'Desenvolvedor de Sistema', 'Morro bento, Av.21 de Janeiro, Rua Nelson Mandela', 'Conheci por meio de um amigo', '2021-02-24 22:37:47', '2021-02-24 22:37:47'),
(3, 'Madalena Cesar Gunza', '006989589LA042', '2002-04-20', 'Masculino', 'Solteiro', 0, 'Pre-SuperioiSuperior', 'Desenvolvedor de Sistema', 'Morro bento, Av.21 de Janeiro, Rua Nelson Mandela', 'Conheci por meio de um amigo', '2021-02-25 18:06:53', '2021-02-25 18:06:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `persondepart`
--

DROP TABLE IF EXISTS `persondepart`;
CREATE TABLE IF NOT EXISTS `persondepart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPerson` int(11) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idPerson` (`idPerson`),
  KEY `idDepart` (`idDepart`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personfunction`
--

DROP TABLE IF EXISTS `personfunction`;
CREATE TABLE IF NOT EXISTS `personfunction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPerson` int(11) NOT NULL,
  `idFunc` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idPerson` (`idPerson`),
  KEY `idFunc` (`idFunc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`idPerson`) REFERENCES `person` (`idPerson`),
  ADD CONSTRAINT `contract_ibfk_2` FOREIGN KEY (`idDepart`) REFERENCES `departament` (`id`);

--
-- Limitadores para a tabela `personfunction`
--
ALTER TABLE `personfunction`
  ADD CONSTRAINT `personfunction_ibfk_1` FOREIGN KEY (`idPerson`) REFERENCES `person` (`idPerson`),
  ADD CONSTRAINT `personfunction_ibfk_2` FOREIGN KEY (`idFunc`) REFERENCES `function` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
