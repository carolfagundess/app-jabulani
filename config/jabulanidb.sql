-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/07/2026 às 05:08
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
  `registroCriado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `descricao`, `local`, `dataEvento`, `registroCriado`) VALUES
(2, 'Festival Jabulani', 'O maior evento de confraternização anual com música e networking.', 'Parque da Cidade', '2026-08-20', '2026-06-05 01:22:47'),
(3, 'Hackathon Dev Jabulani', 'Maratona de programação de 48 horas focada em soluções web.', 'Laboratório de Tecnologia da informação', '2026-09-10', '2026-06-05 01:22:47'),
(4, 'Palestra: Segurança em Banco de Dados', 'Dicas essenciais para proteger suas consultas SQL contra ataques.', 'Sala 200', '2026-10-05', '2026-06-05 01:22:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `registroCriado` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipoUsuario` varchar(20) NOT NULL DEFAULT 'participante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `email`, `senha`, `registroCriado`, `tipoUsuario`) VALUES
(1, 'admin_teste', 'admin@teste.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '2026-06-18 01:11:50', 'admin'),
(2, 'pablo', 'pablo@gmail.com', '$2y$10$aQyBq1exK/MR3.IXGvX0VOeH8Ho9ZHNNT9Kp.xBXDgOxCeMn2drD6', '2026-06-28 17:38:12', 'admin'),
(3, 'teste', 'teste@gmail.com', '$2y$10$l.0MFXRa4thd2x2yVQz48unRlNOhVIZLDU4sJeX7NXpTYwz5sfJTS', '2026-06-28 18:00:38', 'participante'),
(4, 'pablotheves', 'pablotheves20@gmail.com', '$2y$10$XsI1dtgRUXXl.H9gtVMWIeazuZsnLEsnDxaiWZTxz/5IEs5QXBvW6', '2026-06-29 00:08:45', 'participante');

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
(1, 4, 2, '2026-07-01 02:34:07'),
(2, 4, 3, '2026-07-01 02:40:19'),
(3, 4, 4, '2026-07-01 02:50:10'),
(4, 3, 2, '2026-07-01 02:56:34'),
(5, 3, 3, '2026-07-01 02:57:05'),
(6, 3, 4, '2026-07-01 02:57:15');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarioseventos`
--
ALTER TABLE `usuarioseventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
