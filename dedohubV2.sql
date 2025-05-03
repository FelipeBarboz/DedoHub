-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/05/2025 às 05:08
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
-- Banco de dados: `dedohub`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `path`) VALUES
(2, 'Massa', 'minhanossa@gmail.com', '$2y$10$0LdM9QcuoqH7KI8WvonDkON4qnHx53RwVF1Go4pJjTpcSfVqJKbJC', '2025-04-22 01:30:40', NULL),
(3, 'Refletxx', 'dmsakldasj@gmail.com', '$2y$10$A5Qb4mTATV8rp29qpIsqiebwhLq9hpWGhdZJglch1YH8ZbFe8hRi.', '2025-04-23 01:26:09', NULL),
(4, 'Dedinho', 'dedo@gmail.com', '$2y$10$0FVdbf/mPDqhXVGegL5moeZwvZ4ggFJJMuB3zSUvhHa4JoVicBlMm', '2025-04-23 01:26:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `filename`, `uploaded_at`, `created_at`, `path`, `thumbnail`, `description`) VALUES
(4, 2, 'Penis', 'uploads/videos/6809994b6758f_Desktop 2025.04.06 - 14.48.06.03.mp4', '2025-04-24 01:52:11', '2025-04-24 01:52:11', NULL, 'uploads/thumbnails/6809994b6775e_Screenshot 2025-03-28 233616.png', NULL),
(5, 2, 'Penissss', 'uploads/videos/68157d9485120_Desktop 2025.04.06 - 14.48.06.03.mp4', '2025-05-03 02:21:08', '2025-05-03 02:21:08', NULL, 'uploads/thumbnails/68157d94852f2_Screenshot 2025-04-06 143205.png', NULL),
(6, 2, 'Kohagi merece a morte', 'uploads/videos/68158135039dc_Desktop 2025.04.06 - 14.48.06.03.mp4', '2025-05-03 02:36:37', '2025-05-03 02:36:37', NULL, 'uploads/thumbnails/6815813503bb5_Screenshot 2025-03-28 233616.png', NULL),
(7, 2, 'Penis penianos', 'uploads/videos/68158413b51be_Desktop 2025.04.06 - 14.48.06.03.mp4', '2025-05-03 02:48:51', '2025-05-03 02:48:51', NULL, 'uploads/thumbnails/68158413b533f_Screenshot 2025-03-28 233616.png', 'Amo penis');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
