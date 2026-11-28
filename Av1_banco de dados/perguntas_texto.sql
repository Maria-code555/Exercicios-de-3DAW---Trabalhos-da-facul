-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2026 às 07:04
-- Versão do servidor: 10.11.19-MariaDB
-- Versão do PHP: 8.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `av1_bd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas_texto`
--

CREATE TABLE `perguntas_texto` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(500) NOT NULL,
  `resposta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas_texto`
--

INSERT INTO `perguntas_texto` (`id`, `pergunta`, `resposta`) VALUES
(1, 'Qual a cor do cavalo branco de napoleão', 'Rosa!!!'),
(2, 'GTA6 ta demais?', 'Simmm');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `perguntas_texto`
--
ALTER TABLE `perguntas_texto`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
