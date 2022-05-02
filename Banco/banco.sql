-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Maio-2022 às 20:13
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlepausa`
--

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `dadosdousuarioview`

--
CREATE DATABASE IF NOT EXISTS controlepausa;

CREATE TABLE `dadosdousuarioview` (
                                      `idUsuario` int(11)
    ,`nomeUsuario` varchar(300)
    ,`senha` varchar(600)
    ,`idTipoUsuario` int(11)
    ,`nomeCompleto` varchar(350)
    ,`nomeTipoUsuario` varchar(300)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `dadosregistrospausas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `dadosregistrospausas` (
                                        `idRegistroPausas` int(11)
    ,`idUsuario` int(11)
    ,`nomeUsuario` varchar(300)
    ,`nomeCompleto` varchar(350)
    ,`idTipoPausa` int(11)
    ,`nomeTipoPausas` varchar(300)
    ,`tempoLimite` time
    ,`horarioInicio` time
    ,`horarioTermino` time
    ,`dataRegistro` date
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registropausas`
--

CREATE TABLE `registropausas` (
                                  `idRegistroPausas` int(11) NOT NULL,
                                  `idUsuario` int(11) DEFAULT NULL,
                                  `idTipoPausa` int(11) DEFAULT NULL,
                                  `horarioInicio` time DEFAULT NULL,
                                  `horarioTermino` time DEFAULT NULL,
                                  `dataRegistro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopausas`
--

CREATE TABLE `tipopausas` (
                              `idTipoPausas` int(11) NOT NULL,
                              `nomeTipoPausas` varchar(300) DEFAULT NULL,
                              `tempoLimite` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE `tipousuario` (
                               `idTipoUsuario` int(11) NOT NULL,
                               `nomeTipoUsuario` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
                           `idUsuario` int(11) NOT NULL,
                           `nomeUsuario` varchar(300) DEFAULT NULL,
                           `senha` varchar(600) DEFAULT NULL,
                           `idTipoUsuario` int(11) DEFAULT NULL,
                           `nomeCompleto` varchar(350) NOT NULL,
                           `token` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--


-- --------------------------------------------------------

--
-- Estrutura para vista `dadosdousuarioview`
--
DROP TABLE IF EXISTS `dadosdousuarioview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dadosdousuarioview`  AS SELECT `u`.`idUsuario` AS `idUsuario`, `u`.`nomeUsuario` AS `nomeUsuario`, `u`.`senha` AS `senha`, `u`.`idTipoUsuario` AS `idTipoUsuario`, `u`.`nomeCompleto` AS `nomeCompleto`, `tpu`.`nomeTipoUsuario` AS `nomeTipoUsuario` FROM (`usuario` `u` join `tipousuario` `tpu` on(`tpu`.`idTipoUsuario` = `u`.`idTipoUsuario`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `dadosregistrospausas`
--
DROP TABLE IF EXISTS `dadosregistrospausas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dadosregistrospausas`  AS SELECT `rp`.`idRegistroPausas` AS `idRegistroPausas`, `rp`.`idUsuario` AS `idUsuario`, `u`.`nomeUsuario` AS `nomeUsuario`, `u`.`nomeCompleto` AS `nomeCompleto`, `rp`.`idTipoPausa` AS `idTipoPausa`, `tpp`.`nomeTipoPausas` AS `nomeTipoPausas`, `tpp`.`tempoLimite` AS `tempoLimite`, `rp`.`horarioInicio` AS `horarioInicio`, `rp`.`horarioTermino` AS `horarioTermino`, `rp`.`dataRegistro` AS `dataRegistro` FROM ((`registropausas` `rp` join `tipopausas` `tpp` on(`tpp`.`idTipoPausas` = `rp`.`idTipoPausa`)) join `usuario` `u` on(`u`.`idUsuario` = `rp`.`idUsuario`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `registropausas`
--
ALTER TABLE `registropausas`
    ADD PRIMARY KEY (`idRegistroPausas`),
  ADD KEY `FK_registroPausas_2` (`idTipoPausa`),
  ADD KEY `FK_registroPausas_3` (`idUsuario`);

--
-- Índices para tabela `tipopausas`
--
ALTER TABLE `tipopausas`
    ADD PRIMARY KEY (`idTipoPausas`);

--
-- Índices para tabela `tipousuario`
--
ALTER TABLE `tipousuario`
    ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
    ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_usuario_2` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `registropausas`
--
ALTER TABLE `registropausas`
    MODIFY `idRegistroPausas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT de tabela `tipopausas`
--
ALTER TABLE `tipopausas`
    MODIFY `idTipoPausas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tipousuario`
--
ALTER TABLE `tipousuario`
    MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
    MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `registropausas`
--
ALTER TABLE `registropausas`
    ADD CONSTRAINT `FK_registroPausas_2` FOREIGN KEY (`idTipoPausa`) REFERENCES `tipopausas` (`idTipoPausas`),
  ADD CONSTRAINT `FK_registroPausas_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
    ADD CONSTRAINT `FK_usuario_2` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
