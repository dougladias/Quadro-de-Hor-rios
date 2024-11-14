-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2024 às 02:42
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
-- Banco de dados: `formulario_login_increver-se`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas`
--

INSERT INTO `aulas` (`id`, `curso_id`, `nome`) VALUES
(34, 18, 'ARA0097 - Engenharia de Software'),
(35, 18, 'ARA0062 - Desenv. Web em Html5, Css, Javascript e Php'),
(36, 18, 'ARA0002 - Pensamento Computacional'),
(37, 18, 'ARA0063 - Fundamentos de Redes de Computadores');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas_cadastradas`
--

CREATE TABLE `aulas_cadastradas` (
  `id` int(11) NOT NULL,
  `curso_nome` varchar(255) DEFAULT NULL,
  `curso_cor` varchar(7) DEFAULT NULL,
  `aula_nome` varchar(255) DEFAULT NULL,
  `aula_periodo` varchar(50) DEFAULT NULL,
  `sala_nome` varchar(255) DEFAULT NULL,
  `sala_andar` int(11) DEFAULT NULL,
  `sala_capacidade` int(11) DEFAULT NULL,
  `professor_nome` varchar(255) DEFAULT NULL,
  `publico` varchar(255) DEFAULT NULL,
  `modalidade` varchar(255) DEFAULT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fim` time DEFAULT NULL,
  `dia_semana` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas_cadastradas`
--

INSERT INTO `aulas_cadastradas` (`id`, `curso_nome`, `curso_cor`, `aula_nome`, `aula_periodo`, `sala_nome`, `sala_andar`, `sala_capacidade`, `professor_nome`, `publico`, `modalidade`, `horario_inicio`, `horario_fim`, `dia_semana`) VALUES
(6, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0097 - ENGENHARIA DE SOFTWARE', 'NOTURNO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'SEMIPRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(7, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0002 - PENSAMENTO COMPUTACIONAL', 'NOTURNO', 'B_305', 3, 35, 'MAURO GIL', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(9, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(10, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0062 - DESENV. WEB EM HTML5, CSS, JAVASCRIPT E PHP', 'MATUTINO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(12, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0097 - ENGENHARIA DE SOFTWARE', 'NOTURNO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'SEMIPRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(13, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0002 - PENSAMENTO COMPUTACIONAL', 'NOTURNO', 'B_305', 3, 35, 'MAURO GIL', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(28, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(37, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(39, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(42, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0097 - ENGENHARIA DE SOFTWARE', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '22:00:00', '2024-11-13'),
(43, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0097 - ENGENHARIA DE SOFTWARE', 'NOTURNO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'SEMIPRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(44, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0002 - PENSAMENTO COMPUTACIONAL', 'NOTURNO', 'B_305', 3, 35, 'MAURO GIL', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(45, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(46, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0062 - DESENV. WEB EM HTML5, CSS, JAVASCRIPT E PHP', 'MATUTINO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(47, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0097 - ENGENHARIA DE SOFTWARE', 'NOTURNO', 'info_7 ', 1, 35, 'BARBARA MUNHÃO', 'CALOUROS', 'SEMIPRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(48, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0002 - PENSAMENTO COMPUTACIONAL', 'NOTURNO', 'B_305', 3, 35, 'MAURO GIL', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13'),
(50, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000', 'ARA0063 - FUNDAMENTOS DE REDES DE COMPUTADORES', 'NOTURNO', 'info_7 ', 1, 35, 'ENILDA CACERES', 'CALOUROS', 'PRESENCIAL', '19:00:00', '23:59:00', '2024-11-13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `cor`) VALUES
(18, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '#ff0000');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pendente','ativo') DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `email`, `password`, `status`) VALUES
(11, 'Douglas', 'douglasdias@texte.com', 'robinho*13', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`) VALUES
(32, 'ENILDA CACERES'),
(33, 'BARBARA MUNHÃO'),
(34, 'MAURO GIL');

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `andar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `salas`
--

INSERT INTO `salas` (`id`, `nome`, `capacidade`, `andar`) VALUES
(14, 'b_202', 30, '2°'),
(15, 'info_7 ', 35, '1°'),
(16, 'B_305', 35, '3°');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `aulas_cadastradas`
--
ALTER TABLE `aulas_cadastradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `aulas_cadastradas`
--
ALTER TABLE `aulas_cadastradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
