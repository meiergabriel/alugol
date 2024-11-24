-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/11/2024 às 11:06
-- Versão do servidor: 10.4.34-MariaDB
-- Versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `admin_gabriel-teste-nao-apagar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `campo_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `status_pagamento` enum('pendente','confirmado','cancelado') DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valor_total` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `campo_id`, `title`, `data_inicio`, `data_fim`, `status_pagamento`, `criado_em`, `atualizado_em`, `valor_total`) VALUES
(18, 4, 'tests 123', '2024-10-31 20:18:00', '2024-10-31 22:18:00', 'confirmado', '2024-10-31 19:48:55', '2024-11-01 14:11:19', 160.00),
(19, 4, 'Horario do Paulo', '2024-10-31 17:30:00', '2024-10-31 18:00:00', 'pendente', '2024-10-31 19:55:02', '2024-10-31 19:55:02', 0.00),
(20, 6, 'teste 123', '2024-10-31 17:06:00', '2024-10-31 20:09:00', 'confirmado', '2024-10-31 20:06:18', '2024-10-31 20:47:22', 0.00),
(21, 4, 'testwe', '2024-10-31 07:09:00', '2024-10-31 10:07:00', 'confirmado', '2024-10-31 20:07:20', '2024-10-31 21:02:16', 237.33),
(22, 4, 'tesdt23', '2024-10-31 13:19:00', '2024-10-31 16:18:00', 'pendente', '2024-10-31 20:49:02', '2024-11-01 14:10:49', 238.67),
(24, 4, 'teste 222', '2024-10-31 19:03:00', '2024-10-31 20:04:00', 'pendente', '2024-10-31 21:02:34', '2024-10-31 21:02:34', 0.00),
(25, 8, 'teste 123', '2024-10-31 20:00:00', '2024-10-31 22:00:00', 'confirmado', '2024-10-31 22:19:12', '2024-10-31 22:19:12', 0.00),
(29, 8, '123', '2024-10-24 00:00:00', '2024-10-24 01:00:00', 'pendente', '2024-10-31 22:25:16', '2024-10-31 22:25:16', 0.00),
(30, 8, '123', '2024-10-24 00:00:00', '2024-10-24 01:00:00', 'pendente', '2024-10-31 22:25:17', '2024-10-31 22:25:17', 0.00),
(31, 8, '123', '2024-10-24 00:00:00', '2024-10-24 01:00:00', 'pendente', '2024-10-31 22:25:18', '2024-10-31 22:25:18', 0.00),
(32, 8, '123', '2024-10-16 00:00:00', '2024-10-16 01:00:00', 'confirmado', '2024-10-31 22:44:21', '2024-10-31 22:44:21', 0.00),
(33, 4, 'teste', '2024-11-02 08:00:00', '2024-11-02 09:00:00', 'pendente', '2024-11-01 13:56:40', '2024-11-01 14:08:33', 80.00),
(34, 4, 'teste', '2024-11-01 12:00:00', '2024-11-01 13:00:00', 'confirmado', '2024-11-01 13:59:07', '2024-11-01 13:59:07', 80.00),
(35, 4, 'teste', '2024-11-01 00:00:00', '2024-10-28 01:00:00', 'pendente', '2024-11-01 14:16:55', '2024-11-01 14:16:55', 1840.00),
(36, 9, 'Horario do guilherme', '2024-11-01 17:04:00', '2024-11-01 19:17:00', 'pendente', '2024-11-02 00:35:43', '2024-11-02 00:35:54', 110.83),
(37, 5, 'Maicon', '2024-11-11 18:00:00', '2024-11-11 19:00:00', 'pendente', '2024-11-07 22:32:32', '2024-11-07 22:32:32', 100.00),
(38, 4, 'Horario do cleiton', '2024-11-03 17:00:00', '2024-11-03 19:00:00', 'confirmado', '2024-11-08 17:57:02', '2024-11-08 17:57:02', 160.00),
(39, 10, 'Horario do robson', '2024-11-03 10:30:00', '2024-11-03 11:30:00', NULL, '2024-11-08 19:02:25', '2024-11-08 19:05:30', 90.00),
(40, 10, 'Horario do junior', '2024-11-17 17:00:00', '2024-11-17 19:00:00', 'confirmado', '2024-11-08 19:02:44', '2024-11-08 19:02:44', 180.00),
(41, 10, 'horario do paulo', '2024-11-07 09:00:00', '2024-11-07 11:00:00', NULL, '2024-11-08 19:02:58', '2024-11-08 19:04:54', 180.00),
(42, 10, 'horario da maria', '2024-11-07 11:30:00', '2024-11-07 12:30:00', 'confirmado', '2024-11-08 19:03:12', '2024-11-08 19:05:36', 90.00),
(43, 10, 'horario do maycon', '2024-11-06 11:00:00', '2024-11-06 12:00:00', NULL, '2024-11-08 19:03:28', '2024-11-08 19:04:43', 90.00),
(44, 10, 'horario do thomaz', '2024-11-04 10:00:00', '2024-11-04 11:00:00', 'pendente', '2024-11-08 19:03:49', '2024-11-08 19:03:49', 90.00),
(45, 10, 'horario do ribamar', '2024-11-03 09:00:00', '2024-11-03 10:00:00', 'confirmado', '2024-11-08 19:04:05', '2024-11-08 19:04:05', 90.00),
(46, 10, 'horario do junior', '2024-11-04 21:00:00', '2024-11-04 22:00:00', 'pendente', '2024-11-08 19:04:21', '2024-11-08 19:04:21', 90.00),
(47, 10, 'horario do lucas', '2024-11-05 10:00:00', '2024-11-05 11:00:00', 'confirmado', '2024-11-08 19:04:38', '2024-11-08 19:04:38', 90.00),
(48, 5, 'horario do pedro', '2024-11-08 15:00:00', '2024-11-08 16:00:00', 'confirmado', '2024-11-09 00:25:12', '2024-11-09 00:25:12', 100.00),
(50, 10, 'teste 123', '2024-11-09 17:30:00', '2024-11-09 19:30:00', 'confirmado', '2024-11-09 00:28:42', '2024-11-09 00:28:42', 180.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `campos`
--

CREATE TABLE `campos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagens` text DEFAULT NULL,
  `dias_funcionamento` varchar(255) DEFAULT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fim` time DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor_por_hora` decimal(10,2) DEFAULT NULL,
  `google_maps_script` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `campos`
--

INSERT INTO `campos` (`id`, `nome`, `descricao`, `imagens`, `dias_funcionamento`, `horario_inicio`, `horario_fim`, `usuario_id`, `valor_por_hora`, `google_maps_script`) VALUES
(4, 'Campo do Gabriel', 'Este Ã© o campo do Gabriel teste de ediÃ§Ã£o Teste 2', 'grama-sintetica-para-campo-society-preco-1.jpg', 'Segunda,TerÃ§a,Quarta,Quinta,SÃ¡bado,Domingo', '06:00:00', '21:00:00', 17, 80.00, NULL),
(5, 'Campo do Junior', 'DescriÃ§Ã£o do campo do junior', 'quadra-de-futebol-society.jpg', 'Segunda,Quarta,Sexta,Domingo', '07:00:00', '00:00:00', 24, 100.00, NULL),
(6, 'Campo de areia do Gabriel', 'Este Ã© o campo de areia do Gabriel', 'campo-de-jogo-com-areia-e-trave-para-futebol-de-areia_97889-864.avif', 'Sexta,SÃ¡bado,Domingo', '08:00:00', '09:30:00', 17, 75.00, NULL),
(8, 'Campo do Gabriel Completo', 'DescriÃ§Ã£o do Campo do Gabriel Completo', 'IMG_6510.jpg', 'TerÃ§a,Quarta,Quinta,Sexta,SÃ¡bado,Domingo', '05:00:00', '23:00:00', 17, 90.00, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3617.018245015115!2d-53.46355622462586!3d-24.965493877860833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f3d438aa6189a9%3A0xe4af68a926e9c54f!2sWeb%20Thomaz%20Neg%C3%B3cios%20Digitais!5e0!3m2!1spt-BR!2sbr!4v1730406289813!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(9, 'Campo Do Menon', 'DescriÃ§Ã£o', 'Caminhao.jpg', 'TerÃ§a,Quinta,Sexta', '00:34:00', '04:40:00', 17, 50.00, ''),
(10, 'Cristal Campo SintÃ©tico 1', 'Este campo Ã© o espaÃ§o ideal para partidas e treinos de futebol, combinando qualidade e conforto em um ambiente bem cuidado e seguro.', 'campogpt.webp', 'Segunda,TerÃ§a,Quarta,Quinta,Sexta,SÃ¡bado,Domingo', '08:00:00', '23:30:00', 17, 90.00, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14470.10880935509!2d-53.49569972792531!3d-24.948171599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f3d14dc07bed17%3A0x480e6fb8f2ff5d91!2sCristal%20Campo%20Sint%C3%A9tico!5e0!3m2!1spt-BR!2sbr!4v1731092428164!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `created_at`, `updated_at`, `telefone`) VALUES
(17, 'Gabriel Teste Admin', 'testesuporte@webthomaz.com', '$2y$10$hKQD0M/aHrZ9qqTRLE4vmeY0Fr8mvKBkCQn5RA4KwvWw0.Edf9SgS', '2024-10-25 16:52:29', '2024-11-08 19:14:29', '+554599229750'),
(23, 'Gabriel', 'gabriel@gmail', '$2y$10$Nwopp.i7Wfhtb7Cx/NBAz.QIhAWgKkXr7muEu3h4vpTktM66HK5s.', '2024-10-26 00:40:23', '2024-10-26 00:40:41', '666'),
(24, 'Junior', 'junior@junin.com.br', '$2y$10$nkoaCz1s951LkXc6Bt7/o.9uo3YSahx6MZD.TjyCALksFLNgHRkma', '2024-10-29 20:33:30', '2024-10-30 16:52:37', '4598989898989');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campo_id` (`campo_id`);

--
-- Índices de tabela `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `campos`
--
ALTER TABLE `campos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`campo_id`) REFERENCES `campos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `campos`
--
ALTER TABLE `campos`
  ADD CONSTRAINT `campos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
