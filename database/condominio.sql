-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2023 às 14:10
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `condominio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autorizacao_agenda`
--

CREATE TABLE `autorizacao_agenda` (
  `id` int(11) NOT NULL,
  `id_pessoa_autoriza` int(11) DEFAULT NULL,
  `id_pessoa_entrada` int(11) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `hora_data` varchar(20) DEFAULT NULL,
  `tipo_autorizacao_agenda` varchar(10) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_portaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `condominio`
--

CREATE TABLE `condominio` (
  `id` int(11) NOT NULL,
  `lote_numero` int(11) DEFAULT NULL,
  `quadra` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `condominio`
--

INSERT INTO `condominio` (`id`, `lote_numero`, `quadra`) VALUES
(1, 1, 'A'),
(2, 2, 'A'),
(3, 3, 'A'),
(4, 4, 'A'),
(5, 5, 'A'),
(6, 6, 'A'),
(7, 7, 'A'),
(8, 8, 'A'),
(9, 9, 'A'),
(10, 10, 'A'),
(11, 11, 'A'),
(12, 12, 'A'),
(13, 13, 'A'),
(14, 14, 'A'),
(15, 15, 'A'),
(16, 16, 'A'),
(17, 18, 'A'),
(18, 19, 'A'),
(19, 20, 'A'),
(20, 99999999, 'ABCDE'),
(21, 88888888, 'ABCDE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `correio`
--

CREATE TABLE `correio` (
  `id` int(11) NOT NULL,
  `id_portaria` int(11) DEFAULT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  `tipo_encomenda` varchar(20) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `id_portaria` int(11) DEFAULT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  `tipo_movimentacao` varchar(10) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_autorizacao_agenda` int(11) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `estado` varchar(150) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `tipo_pessoa` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `telefone`, `email`, `cpf_cnpj`, `rua`, `cidade`, `estado`, `cep`, `pais`, `tipo_pessoa`, `active`) VALUES
(1, 'Luis', '16999644875', 'serafinilf@gmail.com', '11111111111', '11', 'Taquaritinga', 'São Paulo', '15903080', 'Brasil', 1, 1),
(2, 'Carlos', '169898989898', 'carlos@carlos.com.br', '11122211112', '2', 'Matão', 'São Paulo', '15990000', 'Brasil', 1, 1),
(3, 'Cleonice', '1699999999999', 'cleotaqua@cleo.com.br', '33322211145', '23', 'Taquaritinga', 'São Paulo', '15900000', 'Brasil', 1, 1),
(4, 'Maria', '21444445415', 'maria@maria.com', '14514514556', 'rua alameda', 'Matão', 'São Paulo', '15990000', 'Brasil', 6, 1),
(5, 'Roberto', '01644445415', 'roberton@roberto.com', '14514514556', 'Avenida da Saudade', 'Itanhaem', 'São Paulo', '15990000', 'Brasil', 2, 1),
(6, 'Inacio', '22444445415', 'inacion@inacio.com', '14514514556', 'rua alameda', 'Matão', 'São Paulo', '15990000', 'Brasil', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `portaria`
--

CREATE TABLE `portaria` (
  `id` int(11) NOT NULL,
  `portaria_nome` varchar(50) DEFAULT NULL,
  `id_pessoa_funcionario` int(11) DEFAULT NULL,
  `turno_trabalho` varchar(10) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `portaria`
--

INSERT INTO `portaria` (`id`, `portaria_nome`, `id_pessoa_funcionario`, `turno_trabalho`, `active`) VALUES
(1, 'Central', 3, 'A', 1),
(2, 'Por do Sol', 2, 'B', 1),
(3, 'Saida_Norte', 1, 'C', 1),
(4, 'Saida_Leste', 3, 'A', 1),
(5, 'Nascente', 1, 'C', 1),
(6, 'Nascer', 1, 'A', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pessoa`
--

CREATE TABLE `tipo_pessoa` (
  `id` int(11) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipo_pessoa`
--

INSERT INTO `tipo_pessoa` (`id`, `tipo`) VALUES
(1, 'FUNCIONÁRIO'),
(2, 'ADMINISTRADOR'),
(3, 'VISITANTE'),
(4, 'SERVIÇOS_GERAIS'),
(5, 'OFICIAL'),
(6, 'MORADOR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `cor` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `autorizacao_agenda`
--
ALTER TABLE `autorizacao_agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_entrada` (`id_pessoa_entrada`),
  ADD KEY `fk_pessoa_autoriza` (`id_pessoa_autoriza`),
  ADD KEY `fk_veiculo_agenda` (`id_veiculo`),
  ADD KEY `fk_portaria_entrada` (`id_portaria`);

--
-- Índices para tabela `condominio`
--
ALTER TABLE `condominio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `correio`
--
ALTER TABLE `correio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_encomenda` (`id_pessoa`),
  ADD KEY `fk_id_portaria_correio` (`id_portaria`);

--
-- Índices para tabela `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_lote` (`id_pessoa`),
  ADD KEY `fk_lote_condominio` (`id_lote`);

--
-- Índices para tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_movimentacao` (`id_pessoa`),
  ADD KEY `fk_id_portaria_movimentacao` (`id_portaria`),
  ADD KEY `fk__autorazacao_agenda` (`id_autorizacao_agenda`),
  ADD KEY `fk_local_acesso` (`id_local`),
  ADD KEY `fk_veiculo` (`id_veiculo`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_pessoa` (`tipo_pessoa`);

--
-- Índices para tabela `portaria`
--
ALTER TABLE `portaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_funcionario` (`id_pessoa_funcionario`);

--
-- Índices para tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pessoa_veiculo` (`id_pessoa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `autorizacao_agenda`
--
ALTER TABLE `autorizacao_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `condominio`
--
ALTER TABLE `condominio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `correio`
--
ALTER TABLE `correio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `portaria`
--
ALTER TABLE `portaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `autorizacao_agenda`
--
ALTER TABLE `autorizacao_agenda`
  ADD CONSTRAINT `fk_pessoa_autoriza` FOREIGN KEY (`id_pessoa_autoriza`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `fk_pessoa_entrada` FOREIGN KEY (`id_pessoa_entrada`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `fk_portaria_entrada` FOREIGN KEY (`id_portaria`) REFERENCES `portaria` (`id`),
  ADD CONSTRAINT `fk_veiculo_agenda` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`);

--
-- Limitadores para a tabela `correio`
--
ALTER TABLE `correio`
  ADD CONSTRAINT `fk_id_portaria_correio` FOREIGN KEY (`id_portaria`) REFERENCES `portaria` (`id`),
  ADD CONSTRAINT `fk_pessoa_encomenda` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`);

--
-- Limitadores para a tabela `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `fk_lote_condominio` FOREIGN KEY (`id_lote`) REFERENCES `condominio` (`id`),
  ADD CONSTRAINT `fk_pessoa_lote` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`);

--
-- Limitadores para a tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `fk__autorazacao_agenda` FOREIGN KEY (`id_autorizacao_agenda`) REFERENCES `autorizacao_agenda` (`id`),
  ADD CONSTRAINT `fk_id_portaria_movimentacao` FOREIGN KEY (`id_portaria`) REFERENCES `portaria` (`id`),
  ADD CONSTRAINT `fk_local_acesso` FOREIGN KEY (`id_local`) REFERENCES `lote` (`id`),
  ADD CONSTRAINT `fk_pessoa_movimentacao` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `fk_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`);

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_tipo_pessoa` FOREIGN KEY (`tipo_pessoa`) REFERENCES `tipo_pessoa` (`id`);

--
-- Limitadores para a tabela `portaria`
--
ALTER TABLE `portaria`
  ADD CONSTRAINT `fk_pessoa_funcionario` FOREIGN KEY (`id_pessoa_funcionario`) REFERENCES `pessoa` (`id`);

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_pessoa_veiculo` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
