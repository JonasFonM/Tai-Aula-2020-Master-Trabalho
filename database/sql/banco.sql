-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para db_tai_aula_2020
CREATE DATABASE IF NOT EXISTS `db_tai_aula_2020` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_tai_aula_2020`;

-- Copiando estrutura para tabela db_tai_aula_2020.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cliente_municipio` (`municipio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.cliente: 8 rows
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `nome`, `telefone`, `cpf`, `email`, `municipio_id`) VALUES
	(1, 'Jackson', '84 8800-5500', '555.000.555-11', 'exemplo@gmail.com', 2),
	(2, 'Maria', '84 9900-5500', '000.555.000-55', 'exemplo2@gmail.com', 1),
	(3, 'Luiz Macedo', '49 8855-1055', '44455501099', 'luizmacedo@gmail.com', 3),
	(4, 'João Macedo', '84 98855-5501', '55501055588', 'lordjoao1@gmail.com', 1),
	(37, 'Joãozinho dos Teclados', '49 88998899', '000.555.444-99', 'joaozinhodosteclados@gmail.com', 3),
	(51, 'Chiquinha ', '49 88998899', '000.555.444-99', 'chiquinhachavina@gmail.com', 1),
	(54, 'aaaa', '84 98855-5501', '379.404.144-53', 'lordjoao1@gmail.com', 2),
	(55, 'Marcos', '84 98855-5501', 'aa', 'lordjoao2@gmail.com', 3);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela db_tai_aula_2020.municipio
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `estado` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.municipio: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` (`id`, `nome`, `uf`, `estado`) VALUES
	(1, 'Xanxerê', 'SC', 'Santa Catarina'),
	(2, 'Natal', 'RN', 'Rio Grande do Norte'),
	(3, 'Chapecó', 'SC', 'Santa Catarina');
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;

-- Copiando estrutura para tabela db_tai_aula_2020.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `ativo`) VALUES
	(1, 'Jackson', 'admin', 'admin', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
