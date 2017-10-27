

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autores_id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `autores_id`, `categoria`) VALUES
(1, 'El nacimiento de los Estados Unidos ', 1, 'Historia'),
(2, 'El Renacimiento no conocido', 2, 'Arte'),
(3, 'Historia de Rumania', 1, 'Historia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;





--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autores`
--

INSERT INTO `autores` (`id`, `nombre`) VALUES
(1, 'Carlos Sanchez'),
(2, 'Felisa Minguez');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;