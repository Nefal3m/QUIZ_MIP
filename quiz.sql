-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Set-2023 às 00:44
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quiz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

DROP TABLE IF EXISTS `participantes`;
CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
CREATE TABLE IF NOT EXISTS `perguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(50) NOT NULL,
  `pergunta` text NOT NULL,
  `opcao1` varchar(255) NOT NULL,
  `opcao2` varchar(255) NOT NULL,
  `opcao3` varchar(255) NOT NULL,
  `opcao4` varchar(255) NOT NULL,
  `resposta_correta` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

DROP TABLE IF EXISTS `respostas`;
CREATE TABLE IF NOT EXISTS `respostas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `participante_id` int NOT NULL,
  `pergunta_id` int NOT NULL,
  `resposta_dada` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `participante_id` (`participante_id`),
  KEY `pergunta_id` (`pergunta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
