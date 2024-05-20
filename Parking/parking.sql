-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 02:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cedula`, `nombre`, `apellido`) VALUES
(12345, 'Maryi', 'Torres'),
(37238, 'JUAN', 'FELIPE'),
(73827, 'Fernando', 'Rado'),
(73872, 'manolo', 'Rodriguez'),
(87632, 'dayana', 'Rodriguez'),
(291287, 'Jhon', 'Vaquiro'),
(382782, 'Victor', 'Perez'),
(389238, 'Paola', 'Bulla'),
(783728, 'alex', 'Perez'),
(837827, 'roxana', 'Rado'),
(3090039, 'alex', 'Vaquiro'),
(21211122, 'dina', 'Rado'),
(93287397, 'Luis', 'Torres'),
(98374893, 'Camilo', 'Andrade');

-- --------------------------------------------------------

--
-- Table structure for table `registros_vehiculos`
--

CREATE TABLE `registros_vehiculos` (
  `id_registro` int(11) NOT NULL,
  `id_vehi` int(11) DEFAULT NULL,
  `placa_anterior` varchar(10) DEFAULT NULL,
  `modelo_anterior` varchar(20) DEFAULT NULL,
  `fecha_inicio_anterior` date DEFAULT NULL,
  `hora_inicio_anterior` time DEFAULT NULL,
  `fecha_salida_anterior` date DEFAULT NULL,
  `hora_salida_anterior` time DEFAULT NULL,
  `fk_tipo_anterior` int(11) DEFAULT NULL,
  `cedula_anterior` int(11) DEFAULT NULL,
  `fk_tiempo_anterior` int(11) DEFAULT NULL,
  `placa_actual` varchar(10) DEFAULT NULL,
  `modelo_actual` varchar(20) DEFAULT NULL,
  `fecha_inicio_actual` date DEFAULT NULL,
  `hora_inicio_actual` time DEFAULT NULL,
  `fecha_salida_actual` date DEFAULT NULL,
  `hora_salida_actual` time DEFAULT NULL,
  `fk_tipo_actual` int(11) DEFAULT NULL,
  `cedula_actual` int(11) DEFAULT NULL,
  `fk_tiempo_actual` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registros_vehiculos`
--

INSERT INTO `registros_vehiculos` (`id_registro`, `id_vehi`, `placa_anterior`, `modelo_anterior`, `fecha_inicio_anterior`, `hora_inicio_anterior`, `fecha_salida_anterior`, `hora_salida_anterior`, `fk_tipo_anterior`, `cedula_anterior`, `fk_tiempo_anterior`, `placa_actual`, `modelo_actual`, `fecha_inicio_actual`, `hora_inicio_actual`, `fecha_salida_actual`, `hora_salida_actual`, `fk_tipo_actual`, `cedula_actual`, `fk_tiempo_actual`, `fecha_actualizacion`) VALUES
(1, 23, 'JHH788', 'GX', '2024-02-29', '14:08:00', NULL, NULL, 3, NULL, 1, 'JHH799', 'GX', '2024-02-29', '14:08:00', NULL, NULL, 3, NULL, 1, '2024-03-12 01:16:31'),
(2, 19, 'QUI780', 'Ford', '2023-10-07', '19:08:00', NULL, NULL, 1, NULL, 1, 'QUI780', 'Ford', '2023-10-07', '19:08:00', NULL, NULL, 1, NULL, 2, '2024-03-12 01:17:24'),
(3, 19, 'QUI780', 'Ford', '2023-10-07', '19:08:00', NULL, NULL, 1, NULL, 2, 'QUI780', 'Ford', '2023-10-07', '07:08:00', NULL, NULL, 1, NULL, 2, '2024-03-12 01:18:15'),
(4, 19, 'QUI780', 'Ford', '2023-10-07', '07:08:00', NULL, NULL, 1, NULL, 2, 'QUI780', 'Ford', '2023-10-30', '07:08:00', NULL, NULL, 1, NULL, 2, '2024-03-12 01:18:45'),
(5, 26, 'QHH890', 'GX', '2023-03-12', '07:09:00', NULL, NULL, 3, NULL, 1, 'QHH890', 'GX', '2024-03-12', '07:09:00', NULL, NULL, 3, NULL, 1, '2024-03-12 18:38:55'),
(6, 27, 'AAA187', 'Suzuki', '2024-02-12', '21:44:00', NULL, NULL, 2, 389238, 2, 'AAA187', 'Suzuki', '2024-03-12', '21:44:00', NULL, NULL, 2, 389238, 2, '2024-03-12 18:39:55'),
(7, 25, 'JKI902', 'Ford', '2023-10-31', '15:08:00', NULL, NULL, 1, 73827, 2, 'JKI902', 'Ford', '2023-10-31', '15:08:00', NULL, NULL, 2, 73827, 2, '2024-03-12 19:11:01'),
(8, 29, 'WHT673', 'Chevrolet', '2023-10-10', '04:54:00', NULL, NULL, 1, NULL, 1, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 1, NULL, 1, '2024-03-14 15:32:20'),
(9, 29, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 1, NULL, 1, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 1, NULL, 2, '2024-03-14 15:32:42'),
(10, 29, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 1, NULL, 2, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 3, NULL, 2, '2024-03-14 15:32:56'),
(11, 29, 'WHT673', 'Chevrolet', '2024-03-14', '04:54:00', NULL, NULL, 3, NULL, 2, 'WHT673', 'Chevrolet', '2023-10-14', '04:54:00', NULL, NULL, 3, NULL, 2, '2024-03-14 15:47:50'),
(12, 39, 'SEX069', 'Suzuki', '2024-03-26', '22:40:00', NULL, NULL, 2, NULL, 1, 'SEX069', 'Suzuki', '2024-03-26', '22:16:00', NULL, NULL, 2, NULL, 1, '2024-03-15 21:38:49'),
(13, 45, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 2, NULL, 1, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 3, NULL, 1, '2024-03-18 12:50:32'),
(14, 44, 'HJY895', 'GX', '2024-03-18', '21:00:00', NULL, NULL, 1, NULL, 1, 'HJY895', 'GX', '2024-03-18', '21:00:00', NULL, NULL, 3, NULL, 1, '2024-03-18 12:50:41'),
(15, 45, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 3, NULL, 1, 'WQT679', 'GX', '2023-10-01', '18:45:00', NULL, NULL, 3, NULL, 1, '2024-03-18 12:52:01'),
(16, 45, 'WQT679', 'GX', '2023-10-01', '18:45:00', NULL, NULL, 3, NULL, 1, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 3, NULL, 1, '2024-03-18 12:52:15'),
(17, 45, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 3, NULL, 1, 'WQT679', 'GX', '2023-10-01', '06:45:00', NULL, NULL, 1, NULL, 1, '2024-03-18 16:06:24'),
(18, 43, 'JOH999', 'Hero', '2024-03-18', '02:32:00', NULL, NULL, 2, NULL, 1, 'JOH999', 'Hero', '2024-03-18', '02:32:00', NULL, NULL, 2, NULL, 1, '2024-03-18 16:10:47'),
(19, 46, 'KIL122', 'Suzuki', '2024-03-18', '06:07:00', NULL, NULL, 2, NULL, 1, 'KIL122', 'Suzuki', '2024-03-18', '06:07:00', NULL, NULL, 2, NULL, 2, '2024-03-18 16:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `tiempo`
--

CREATE TABLE `tiempo` (
  `id_tiempo` int(11) NOT NULL,
  `servicio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiempo`
--

INSERT INTO `tiempo` (`id_tiempo`, `servicio`) VALUES
(1, 'horas'),
(2, 'meses');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_tarifa`
--

CREATE TABLE `tipo_tarifa` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `costo_mensual` int(11) DEFAULT NULL,
  `costo_hora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_tarifa`
--

INSERT INTO `tipo_tarifa` (`id_tipo`, `tipo`, `costo_mensual`, `costo_hora`) VALUES
(1, 'Carro', 80000, 4000),
(2, 'Moto', 50000, 2000),
(3, 'Bicicleta', 50000, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehi` int(11) NOT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fk_tipo` int(11) DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL,
  `fk_tiempo` int(11) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT 1,
  `fecha_salida` date DEFAULT NULL,
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehi`, `placa`, `modelo`, `fecha_inicio`, `hora_inicio`, `fk_tipo`, `cedula`, `fk_tiempo`, `visible`, `fecha_salida`, `hora_salida`) VALUES
(39, 'SEX069', 'Suzuki', '2024-03-26', '22:16:00', 2, NULL, 1, 1, NULL, NULL),
(40, 'SHP341', 'Ferrari', '2024-03-21', '08:41:00', 1, 12345, 2, 1, NULL, NULL),
(43, 'JOH999', 'Hero', '2024-03-18', '02:32:00', 2, NULL, 1, 2, NULL, NULL),
(44, 'HJY895', 'GX', '2024-03-18', '21:00:00', 3, NULL, 1, 1, NULL, NULL),
(45, 'WQT679', 'GX', '2023-10-01', '06:45:00', 1, NULL, 1, 1, NULL, NULL),
(46, 'KIL122', 'Suzuki', '2024-03-18', '06:07:00', 2, NULL, 2, 1, NULL, NULL),
(47, 'ASO099', 'Ferrari', '2023-10-31', '08:30:00', 1, NULL, 1, 1, NULL, NULL);

--
-- Triggers `vehiculos`
--
DELIMITER $$
CREATE TRIGGER `vehiculo_update_trigger` AFTER UPDATE ON `vehiculos` FOR EACH ROW BEGIN
    INSERT INTO registros_vehiculos (
        id_vehi,
        placa_anterior,
        modelo_anterior,
        fecha_inicio_anterior,
        hora_inicio_anterior,
        fecha_salida_anterior,
        hora_salida_anterior,
        fk_tipo_anterior,
        cedula_anterior,
        fk_tiempo_anterior,
        placa_actual,
        modelo_actual,
        fecha_inicio_actual,
        hora_inicio_actual,
        fecha_salida_actual,
        hora_salida_actual,
        fk_tipo_actual,
        cedula_actual,
        fk_tiempo_actual
    ) VALUES (
        OLD.id_vehi,
        OLD.placa,
        OLD.modelo,
        OLD.fecha_inicio,
        OLD.hora_inicio,
        OLD.fecha_salida,
        OLD.hora_salida,
        OLD.fk_tipo,
        OLD.cedula,
        OLD.fk_tiempo,
        NEW.placa,
        NEW.modelo,
        NEW.fecha_inicio,
        NEW.hora_inicio,
        NEW.fecha_salida,
        NEW.hora_salida,
        NEW.fk_tipo,
        NEW.cedula,
        NEW.fk_tiempo
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vehi_salida`
--

CREATE TABLE `vehi_salida` (
  `id_salida` int(11) NOT NULL,
  `placa_salida` varchar(10) DEFAULT NULL,
  `modelo_salida` varchar(20) DEFAULT NULL,
  `fecha_inicio_sal` date DEFAULT NULL,
  `hora_inicio_sal` time DEFAULT NULL,
  `fecha_salida_sal` date DEFAULT NULL,
  `hora_salida_sal` time DEFAULT NULL,
  `fk_tipo_salida` int(11) DEFAULT NULL,
  `cedula_salida` int(11) DEFAULT NULL,
  `fk_tiempo_salida` int(11) DEFAULT NULL,
  `pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehi_salida`
--

INSERT INTO `vehi_salida` (`id_salida`, `placa_salida`, `modelo_salida`, `fecha_inicio_sal`, `hora_inicio_sal`, `fecha_salida_sal`, `hora_salida_sal`, `fk_tipo_salida`, `cedula_salida`, `fk_tiempo_salida`, `pago`) VALUES
(23, 'WHT673', 'Ferrari', '2024-02-12', '16:44:00', '2024-03-14', '10:28:59', 1, NULL, 1, 4000),
(25, 'kuy077', 'Suzuki', '2023-10-19', '07:13:00', '2024-03-14', '11:24:07', 1, NULL, 1, 14128741),
(26, 'KJI899', 'Hero', '2024-03-14', '02:03:00', '2024-03-14', '11:32:48', 2, NULL, 1, 18993),
(27, 'JHF53J', 'Hero', '2024-03-14', '11:37:00', '2024-03-14', '11:37:18', 2, NULL, 1, 10),
(29, 'QUI759', 'Hero', '2023-10-01', '15:23:00', '2024-03-18', '06:52:37', 2, 21211122, 2, 8094987),
(30, 'WHT677', 'Chevrolet', '2023-10-18', '19:00:00', '2024-03-18', '11:06:41', 1, NULL, 1, 14560445);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `registros_vehiculos`
--
ALTER TABLE `registros_vehiculos`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_vehi` (`id_vehi`),
  ADD KEY `fk_tipo_anterior` (`fk_tipo_anterior`),
  ADD KEY `cedula_anterior` (`cedula_anterior`),
  ADD KEY `fk_tiempo_anterior` (`fk_tiempo_anterior`),
  ADD KEY `fk_tipo_actual` (`fk_tipo_actual`),
  ADD KEY `cedula_actual` (`cedula_actual`),
  ADD KEY `fk_tiempo_actual` (`fk_tiempo_actual`);

--
-- Indexes for table `tiempo`
--
ALTER TABLE `tiempo`
  ADD PRIMARY KEY (`id_tiempo`);

--
-- Indexes for table `tipo_tarifa`
--
ALTER TABLE `tipo_tarifa`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehi`),
  ADD KEY `fk_tipo` (`fk_tipo`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `fk_tiempo` (`fk_tiempo`);

--
-- Indexes for table `vehi_salida`
--
ALTER TABLE `vehi_salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `fk_tipo_salida` (`fk_tipo_salida`),
  ADD KEY `cedula_salida` (`cedula_salida`),
  ADD KEY `fk_tiempo_salida` (`fk_tiempo_salida`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registros_vehiculos`
--
ALTER TABLE `registros_vehiculos`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tiempo`
--
ALTER TABLE `tiempo`
  MODIFY `id_tiempo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_tarifa`
--
ALTER TABLE `tipo_tarifa`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `vehi_salida`
--
ALTER TABLE `vehi_salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registros_vehiculos`
--
ALTER TABLE `registros_vehiculos`
  ADD CONSTRAINT `registros_vehiculos_ibfk_1` FOREIGN KEY (`id_vehi`) REFERENCES `vehiculos` (`id_vehi`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_2` FOREIGN KEY (`fk_tipo_anterior`) REFERENCES `tipo_tarifa` (`id_tipo`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_3` FOREIGN KEY (`cedula_anterior`) REFERENCES `cliente` (`cedula`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_4` FOREIGN KEY (`fk_tiempo_anterior`) REFERENCES `tiempo` (`id_tiempo`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_5` FOREIGN KEY (`fk_tipo_actual`) REFERENCES `tipo_tarifa` (`id_tipo`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_6` FOREIGN KEY (`cedula_actual`) REFERENCES `cliente` (`cedula`),
  ADD CONSTRAINT `registros_vehiculos_ibfk_7` FOREIGN KEY (`fk_tiempo_actual`) REFERENCES `tiempo` (`id_tiempo`);

--
-- Constraints for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`fk_tipo`) REFERENCES `tipo_tarifa` (`id_tipo`),
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`),
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`fk_tiempo`) REFERENCES `tiempo` (`id_tiempo`);

--
-- Constraints for table `vehi_salida`
--
ALTER TABLE `vehi_salida`
  ADD CONSTRAINT `vehi_salida_ibfk_1` FOREIGN KEY (`fk_tipo_salida`) REFERENCES `tipo_tarifa` (`id_tipo`),
  ADD CONSTRAINT `vehi_salida_ibfk_2` FOREIGN KEY (`cedula_salida`) REFERENCES `cliente` (`cedula`),
  ADD CONSTRAINT `vehi_salida_ibfk_3` FOREIGN KEY (`fk_tiempo_salida`) REFERENCES `tiempo` (`id_tiempo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
