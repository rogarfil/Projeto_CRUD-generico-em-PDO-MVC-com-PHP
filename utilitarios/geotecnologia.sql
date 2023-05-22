-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Abr-2023 às 23:24
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `geotecnologia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtor`
--

CREATE TABLE `produtor` (
  `idProdutor` int(11) NOT NULL,
  `nomeProdutor` varchar(100) NOT NULL,
  `cpfProdutor` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtor`
--

INSERT INTO `produtor` (`idProdutor`, `nomeProdutor`, `cpfProdutor`) VALUES
(1, 'Carlos Braga', '88225967062'),
(2, 'Joaquim Maia', '69307485011'),
(3, 'Antonio Castro', '44772065008'),
(4, 'João Ferreira', '66133440015'),
(5, 'Mario Gomes', '45765379036'),
(6, 'Pedro Souza', '95175983008'),
(7, 'Pedro Cabral', '13579086421');

-- --------------------------------------------------------

--
-- Estrutura da tabela `propriedade`
--

CREATE TABLE `propriedade` (
  `idPropriedade` int(11) NOT NULL,
  `nomePropriedade` varchar(100) NOT NULL,
  `cadastroRural` varchar(43) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `propriedade`
--

INSERT INTO `propriedade` (`idPropriedade`, `nomePropriedade`, `cadastroRural`) VALUES
(1, 'Fazenda da Serra', 'Geo52985523'),
(2, 'Princesinha do Lago', 'Geo25465623'),
(3, '3 Irmão', 'Geo93865623'),
(4, 'Céu Azul', 'Geo96586623'),
(5, 'Prosperidade', 'Geo98423623'),
(6, 'Fortuna', 'Geo86248623'),
(7, 'Encantada', 'Geo45678323');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `senhaUsuario` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `senhaUsuario`) VALUES
(1, 'Admin', '$2y$10$kci8MvmjXWUU62eQJum5Z.mj55eyUB.vqkGK0tqhK8X8Yr7K7vQYa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtor`
--
ALTER TABLE `produtor`
  ADD PRIMARY KEY (`idProdutor`),
  ADD KEY `idProdutor` (`idProdutor`);

--
-- Índices para tabela `propriedade`
--
ALTER TABLE `propriedade`
  ADD PRIMARY KEY (`idPropriedade`),
  ADD KEY `idPropriedade` (`idPropriedade`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtor`
--
ALTER TABLE `produtor`
  MODIFY `idProdutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `propriedade`
--
ALTER TABLE `propriedade`
  MODIFY `idPropriedade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
