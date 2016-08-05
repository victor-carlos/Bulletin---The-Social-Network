-- phpMyAdmin SQL Dump
-- version 4.6.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2016 at 02:48 PM
-- Server version: 5.6.30-1
-- PHP Version: 5.6.22-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u438118853_bltm`
--

-- --------------------------------------------------------

--
-- Table structure for table `amigo`
--

CREATE TABLE `amigo` (
  `id` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_amigo` int(255) NOT NULL,
  `endereco_amigo` varchar(255) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `comentario` varchar(512) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_publicacao` int(255) NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversa`
--

CREATE TABLE `conversa` (
  `id` int(255) NOT NULL,
  `endereco_de` varchar(255) NOT NULL,
  `endereco_para` varchar(255) NOT NULL,
  `mensagem` varchar(2000) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `visto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(255) NOT NULL,
  `nome_foto` varchar(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_publicacao` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marcacao`
--

CREATE TABLE `marcacao` (
  `id` int(255) NOT NULL,
  `marcacao` tinyint(1) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_publicacao` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notificacao`
--

CREATE TABLE `notificacao` (
  `id` int(255) NOT NULL,
  `id_publicacao` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_amigo` int(255) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `data_notificacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publicacao`
--

CREATE TABLE `publicacao` (
  `id` int(255) NOT NULL,
  `cor` varchar(11) NOT NULL,
  `texto` varchar(524) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `local` varchar(255) NOT NULL,
  `nome_foto` varchar(255) NOT NULL,
  `nome_video` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `dt_nasc` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `interesses` varchar(255) NOT NULL,
  `sobre` varchar(4096) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `foto_capa` varchar(255) NOT NULL,
  `linguagem` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(255) NOT NULL,
  `nome_video` int(255) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visto`
--

CREATE TABLE `visto` (
  `id` int(255) NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `id_publicacao` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversa`
--
ALTER TABLE `conversa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `marcacao`
--
ALTER TABLE `marcacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visto`
--
ALTER TABLE `visto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amigo`
--
ALTER TABLE `amigo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conversa`
--
ALTER TABLE `conversa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marcacao`
--
ALTER TABLE `marcacao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visto`
--
ALTER TABLE `visto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
