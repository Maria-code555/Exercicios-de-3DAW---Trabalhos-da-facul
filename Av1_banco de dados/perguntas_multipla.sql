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
-- Estrutura para tabela `perguntas_multipla`
--

CREATE TABLE `perguntas_multipla` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(650) NOT NULL,
  `letraA` varchar(450) NOT NULL,
  `letraB` varchar(450) NOT NULL,
  `letraC` varchar(450) NOT NULL,
  `letraD` varchar(450) NOT NULL,
  `correta` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas_multipla`
--

INSERT INTO `perguntas_multipla` (`id`, `pergunta`, `letraA`, `letraB`, `letraC`, `letraD`, `correta`) VALUES
(1, 'Qual a cor do cavalo branco de napoleão', 'Branco?', 'Preto?', 'Rosa com glitter?', 'Verde?', 'C'),
(2, 'O que vc acha da sabrina carpinteira?', 'Divonicaaaa?', 'Linda?', 'Perfeita?', 'Bafonica?', 'A');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `perguntas_multipla`
--
ALTER TABLE `perguntas_multipla`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
