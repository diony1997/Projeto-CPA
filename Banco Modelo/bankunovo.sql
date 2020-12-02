-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Dez-2020 às 20:38
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bankunovo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `ra` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL,
  `email` varchar(60) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `bloco` varchar(15) NOT NULL,
  `dtnascimento` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `semestre` int(11) NOT NULL,
  `senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_resp`
--

CREATE TABLE `aluno_resp` (
  `alunora` int(11) NOT NULL,
  `idPergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `campus` varchar(60) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `escola` varchar(60) NOT NULL,
  `vertical` varchar(60) NOT NULL,
  `escola_aim` varchar(60) NOT NULL,
  `nivel` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `modalidade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `tcc` int(11) NOT NULL,
  `estagio` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `id` int(11) NOT NULL,
  `conteudo` varchar(300) NOT NULL,
  `tipo` int(11) NOT NULL,
  `idDisciplina` int(11) DEFAULT NULL,
  `idProfessor` int(11) DEFAULT NULL,
  `idCurso` int(11) NOT NULL,
  `dataInicial` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE `resposta` (
  `idPergunta` int(11) NOT NULL,
  `blocoTurma` varchar(15) NOT NULL,
  `cont` int(11) NOT NULL DEFAULT 0,
  `valor` int(11) NOT NULL DEFAULT 0,
  `nulos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` varchar(8) NOT NULL,
  `senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `senha`) VALUES
('admin', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ra`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `aluno_ibfk_1` (`idCurso`);

--
-- Índices para tabela `aluno_resp`
--
ALTER TABLE `aluno_resp`
  ADD PRIMARY KEY (`alunora`,`idPergunta`),
  ADD KEY `aluno_resp_ibfk_2` (`idPergunta`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `disciplina_ibfk_1` (`idCurso`),
  ADD KEY `disciplina_ibfk_2` (`idProfessor`);

--
-- Índices para tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_ibfk_1` (`idCurso`),
  ADD KEY `pergunta_ibfk_2` (`idDisciplina`),
  ADD KEY `pergunta_ibfk_3` (`idProfessor`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`idPergunta`,`blocoTurma`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1232;

--
-- AUTO_INCREMENT de tabela `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`id`);

--
-- Limitadores para a tabela `aluno_resp`
--
ALTER TABLE `aluno_resp`
  ADD CONSTRAINT `aluno_resp_ibfk_1` FOREIGN KEY (`alunora`) REFERENCES `aluno` (`ra`),
  ADD CONSTRAINT `aluno_resp_ibfk_2` FOREIGN KEY (`idPergunta`) REFERENCES `pergunta` (`id`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `pergunta_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `pergunta_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `pergunta_ibfk_3` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`idPergunta`) REFERENCES `pergunta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
