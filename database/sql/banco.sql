-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
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
  `data_nasc` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cliente_municipio` (`municipio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.cliente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `nome`, `telefone`, `cpf`, `email`, `municipio_id`, `data_nasc`) VALUES
	(63, 'Josias', '99890808', '000-000-000-05', 'josiasiasiasiasias@gmail.com', 3, '1989-08-20');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela db_tai_aula_2020.locacao
CREATE TABLE IF NOT EXISTS `locacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `veiculo_id` int(11) DEFAULT NULL,
  `data_retirada` date DEFAULT NULL,
  `hora_retirada` time DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  `hora_devolucao` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__cliente` (`cliente_id`),
  KEY `FK_locacao_veiculo` (`veiculo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.locacao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `locacao` DISABLE KEYS */;
INSERT INTO `locacao` (`id`, `cliente_id`, `veiculo_id`, `data_retirada`, `hora_retirada`, `data_devolucao`, `hora_devolucao`) VALUES
	(3, 63, 2, '2019-05-10', '13:51:00', '2020-07-21', '17:21:00');
/*!40000 ALTER TABLE `locacao` ENABLE KEYS */;

-- Copiando estrutura para tabela db_tai_aula_2020.multa
CREATE TABLE IF NOT EXISTS `multa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `veiculo_id` int(11) NOT NULL,
  `locacao_id` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `data_multa` date DEFAULT NULL,
  `hora_multa` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__cliente` (`cliente_id`),
  KEY `FK__veiculo` (`veiculo_id`),
  KEY `FK__locacao` (`locacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.multa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `multa` DISABLE KEYS */;
/*!40000 ALTER TABLE `multa` ENABLE KEYS */;

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

-- Copiando dados para a tabela db_tai_aula_2020.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `ativo`) VALUES
	(1, 'Jonas', 'Pimba', '123', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela db_tai_aula_2020.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL DEFAULT '0',
  `tipo_veiculo` varchar(50) NOT NULL DEFAULT '0',
  `fabricante` varchar(50) NOT NULL DEFAULT '0',
  `modelo` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_veiculo_cliente` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_tai_aula_2020.veiculo: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` (`id`, `cliente_id`, `placa`, `tipo_veiculo`, `fabricante`, `modelo`) VALUES
	(2, 63, 'KEK-5555', 'Automóvel', 'General Motors', 'Celta');
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
