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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_tai_aula_2020.municipio
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `estado` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_tai_aula_2020.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO db_tai_aula_2020.usuario (nome, login, senha, ativo) VALUES ('Jackson', 'admin', 'admin', '1');


-- Exportação de dados foi desmarcado.

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

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
