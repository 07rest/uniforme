-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19-Nov-2024 às 12:00
-- Versão do servidor: 8.0.33-0ubuntu0.20.04.2
-- versão do PHP: 7.4.3-4ubuntu2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetouniforme`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Alunos`
--

CREATE TABLE `Alunos` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sala` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Extraindo dados da tabela `Alunos`
--

INSERT INTO `Alunos` (`id`, `nome`, `sala`) VALUES
(57, 'Matheus Oliveira', '3 B Des'),
(58, 'Renan Martins', '3 B Des'),
(59, 'Daniel Seubert', '3 B Des'),
(60, 'Anabel Souza', '3 B Des'),
(61, 'Barbara Maciel', '3 B Des'),
(62, 'Clara Muller', '3 B Des'),
(63, 'Arthur Carlos', '3 B Des'),
(64, 'Maria Gabrielli', '2 B Humanas'),
(65, 'Carlos Emanoel', '2 B Humanas'),
(66, 'Claudia Martins', '2 B Humanas'),
(67, 'Otavio Carmelo', '2 B Humanas'),
(68, 'Noah tigren', '2 B Humanas'),
(69, 'Carlinhos Maia', '2 B Humanas'),
(70, 'Marcos Souza', '2 B Humanas'),
(71, 'Benjamin Jawordi', '1 A Exatas'),
(72, 'Renan Cavernoso', '1 A Exatas'),
(73, 'Maria Isabel', '1 A Exatas'),
(74, 'Elizabeth Segunda', '1 A Exatas'),
(75, 'Elizabeth Terceira', '1 A Exatas'),
(76, 'Antonio Marcos', '1 A Exatas'),
(77, 'Neymar Junior', '1 A Exatas'),
(78, 'Cristiano Ronaldo', '1 A Exatas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(6, 'aparecida', 'aparecida@gmail.com', '123', 1),
(10, '', '', '', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Alunos`
--
ALTER TABLE `Alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Alunos`
--
ALTER TABLE `Alunos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
