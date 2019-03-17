-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Set-2018 às 21:45
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transportadora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhao`
--

CREATE TABLE `caminhao` (
  `idcaminhao` bigint(20) NOT NULL,
  `placa` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chassi` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `ano` int(11) NOT NULL,
  `peso` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `caminhao`
--

INSERT INTO `caminhao` (`idcaminhao`, `placa`, `modelo`, `chassi`, `ano`, `peso`) VALUES
(2, 'troca', 'troca', 'troca', 1998, 1),
(3, 'asd-565', 'asdsadas', 'asdas222603', 2005, 3.7),
(5, 'afg-742', 'lala', 'sapoka', 200, 0),
(6, 'FLP-666', 'Lalaldsaok', 'dad51a5das1', 2015, 2.7),
(7, 'cmd-578', 'towner', 'sdas1c89asd9a', 2016, 2.7),
(8, 'fo', 'foo', 'sada', 239, 0),
(9, 'tst-123', 'lalaokok', 'sdaf5616ad5s1fa', 2015, 1.4),
(10, '5', '5', '5', 5, 5),
(11, '4141', '141', '14', 41, 14),
(12, 'ASDA', 'AD', 'ASD', 12, 222),
(13, 'ASD-555', 'teste', 'afd8614df81ds92', 2010, 2.8),
(14, 'BRO-777', 'Teste', 'afd8614df81ds92', 123, 0),
(15, 'ASD-565', 'Alsplasdplsda', 'afd8614df81ds92', 2015, 2.5),
(16, 'ASD-555', 'Asdsadas', 'afd8614df81ds92', 2016, 0),
(17, 'BRO-777', 'Teste', 'afd8614df81ds92', 123, 3.7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE `motorista` (
  `idmotorista` bigint(20) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`idmotorista`, `nome`, `idade`, `sexo`, `cpf`, `telefone`) VALUES
(1, 'testealterado', 555, 'Masculino', '7', '7'),
(3, '1', 22, 'Masculino', '000', '000'),
(4, '1', 20, 'Masculino', '000', '000'),
(5, '1', 4, 'Masculino', '33', '33'),
(6, '1', 1, 'Feminino', '1', '1'),
(7, '1', 25, 'Masculino', '666', '666'),
(8, 'felipe', 123, 'Masculino', '2131', '2131'),
(9, '1', 10, 'Masculino', '10', '10'),
(10, 'Feeelipe', 50, 'Masculino', '4545454', '20202'),
(11, 'Feeelipe Popoviche             ', 20, 'Feminino', '000', '6666'),
(12, 'Felipe', 20, 'Masculino', '1', '998872771'),
(13, 'Feeelipasdae', 32, 'Masculino', '1', 'sadasd2'),
(14, 'Felipe', 26, 'Masculino', '1', '998872771'),
(15, 'Dspfkda', 45, 'Masculino', '1', 'asda65656'),
(16, 'Felipe', 10, 'Masculino', '1', '051998872771'),
(17, 'Felipe', 45, 'Masculino', '1', '99887-2771'),
(18, 'Felipe', 22, 'Masculino', '871.887.590-49', '99887-2771'),
(19, 'Felipe', 21, 'Masculino', '871.887.590-49', '(051) 99887-277'),
(20, 'Teste', 22, 'Masculino', '871.887.590-49', '051998872771'),
(21, 'Alterado', 45, 'Feminino', '871.887.590-49', '(051) 99887-277');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caminhao`
--
ALTER TABLE `caminhao`
  ADD PRIMARY KEY (`idcaminhao`);

--
-- Indexes for table `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`idmotorista`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caminhao`
--
ALTER TABLE `caminhao`
  MODIFY `idcaminhao` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `motorista`
--
ALTER TABLE `motorista`
  MODIFY `idmotorista` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
