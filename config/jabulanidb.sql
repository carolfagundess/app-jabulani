-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/07/2026 às 16:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jabulanidb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `local` varchar(255) DEFAULT NULL,
  `dataEvento` date DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `registroCriado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `descricao`, `local`, `dataEvento`, `banner`, `registroCriado`) VALUES
(1, 'Jogo da Copa', 'Jogo do Brasil x Haiti', 'Bar do zé', '2026-06-17', NULL, '2026-06-18 00:05:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tipoUsuario` enum('admin','participante') DEFAULT 'participante',
  `senha` varchar(255) NOT NULL,
  `registroCriado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `email`, `telefone`, `foto`, `tipoUsuario`, `senha`, `registroCriado`) VALUES
(2, 'carol_admin', 'carolina@admin', '', NULL, 'admin', '$2y$10$CmCC3CifPYw1ecFua8td8.pGWX7D4fD12ZkS7qGYGRlr0akeNICEW', '2026-06-18 22:56:16'),
(7, 'Carol Fagundes', 'carolina@fagundes', '5199999999', NULL, 'participante', '$2y$10$9/NfyEdR0F0qFRrcLmwFHeqb8UE6lei2bklwazapV64RbwlS5OdiG', '2026-07-01 12:40:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarioseventos`
--

CREATE TABLE `usuarioseventos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idEvento` int(11) DEFAULT NULL,
  `registroCriado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarioseventos`
--

INSERT INTO `usuarioseventos` (`id`, `idUsuario`, `idEvento`, `registroCriado`) VALUES
(1, 7, 1, '2026-07-01 12:43:15');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nomeUsuario` (`nomeUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuarioseventos`
--
ALTER TABLE `usuarioseventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEvento` (`idEvento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarioseventos`
--
ALTER TABLE `usuarioseventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `usuarioseventos`
--
ALTER TABLE `usuarioseventos`
  ADD CONSTRAINT `usuarioseventos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarioseventos_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
