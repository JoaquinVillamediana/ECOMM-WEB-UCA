-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.23 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ecomm
CREATE DATABASE IF NOT EXISTS `ecomm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecomm`;

-- Dumping structure for table ecomm.banner
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.banner: ~0 rows (approximately)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `imagen`, `link`) VALUES
	(1, 'https://www.softub.ch/wp-content/uploads/Black-Friday-Sale.jpg', NULL);
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

-- Dumping structure for table ecomm.carrito
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `envio` tinyint DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `dni` int DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.carrito: ~3 rows (approximately)
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` (`id`, `id_usuario`, `envio`, `nombre`, `direccion`, `telefono`, `dni`, `fecha`) VALUES
	(1, 4, 0, '', '', '', 0, '2021-11-12 08:15:45'),
	(2, 5, 0, '', '', '', 0, '2021-11-12 08:15:53'),
	(6, 6, 0, 'ENVIO TESTddd', 'Luís Sáenz Peña 724', '1131334144', 43725441, '2022-02-15 18:45:31');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;

-- Dumping structure for table ecomm.carrito_productos
CREATE TABLE IF NOT EXISTS `carrito_productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_atributo` int NOT NULL,
  `id_carrito` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_atributo` (`id_atributo`),
  KEY `id_carrito` (`id_carrito`),
  CONSTRAINT `carrito_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `carrito_productos_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `producto_atributo` (`id`),
  CONSTRAINT `carrito_productos_ibfk_3` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.carrito_productos: ~3 rows (approximately)
/*!40000 ALTER TABLE `carrito_productos` DISABLE KEYS */;
INSERT INTO `carrito_productos` (`id`, `id_producto`, `id_atributo`, `id_carrito`, `cantidad`) VALUES
	(1, 1, 7, 2, 3),
	(2, 2, 4, 2, 1),
	(3, 1, 1, 6, 1),
	(11, 1, 3, 6, 1);
/*!40000 ALTER TABLE `carrito_productos` ENABLE KEYS */;

-- Dumping structure for table ecomm.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.categoria: ~5 rows (approximately)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nombre`) VALUES
	(1, 'pelotas'),
	(2, 'remeras'),
	(3, 'pantalones'),
	(4, 'calzado'),
	(5, 'cateogriaxd');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Dumping structure for table ecomm.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.estados: ~3 rows (approximately)
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` (`id`, `nombre`) VALUES
	(1, 'pendiente'),
	(2, 'aprobado'),
	(3, 'rechazado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;

-- Dumping structure for table ecomm.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_estado` int NOT NULL,
  `envio` varchar(60) NOT NULL,
  `envio_nombre` varchar(60) NOT NULL,
  `envio_direccion` varchar(255) NOT NULL,
  `envio_dni` int NOT NULL,
  `envio_telefono` varchar(60) NOT NULL,
  `pago_titular` varchar(60) NOT NULL,
  `pago_tarjeta` varchar(20) NOT NULL,
  `pago_expiracion` varchar(5) NOT NULL,
  `pago_cvc` int NOT NULL,
  `importe` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.pedidos: ~2 rows (approximately)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`, `id_usuario`, `id_estado`, `envio`, `envio_nombre`, `envio_direccion`, `envio_dni`, `envio_telefono`, `pago_titular`, `pago_tarjeta`, `pago_expiracion`, `pago_cvc`, `importe`, `fecha`) VALUES
	(3, 6, 1, '0', 'ENVIO TESTddd', 'Luís Sáenz Peña 724', 43725441, '1131334144', 'dddddddd', '1234-1234-1234-1234', '12/12', 123, 3000, '2022-02-15 22:29:07'),
	(4, 6, 1, '0', 'ENVIO TESTddd', 'Luís Sáenz Peña 724', 43725441, '1131334144', 'dddddddd', '1234-1234-1234-1234', '12/12', 123, 3000, '2022-02-15 22:29:21');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Dumping structure for table ecomm.pedidos_producto
CREATE TABLE IF NOT EXISTS `pedidos_producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_atributo` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_atributo` (`id_atributo`),
  CONSTRAINT `pedidos_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `pedidos_producto_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `producto_atributo` (`id_producto`),
  CONSTRAINT `pedidos_producto_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.pedidos_producto: ~0 rows (approximately)
/*!40000 ALTER TABLE `pedidos_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos_producto` ENABLE KEYS */;

-- Dumping structure for table ecomm.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_categoria` int NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio` float NOT NULL,
  `detalles` varchar(1050) NOT NULL,
  `descuento` int DEFAULT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.producto: ~3 rows (approximately)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `id_categoria`, `nombre`, `precio`, `detalles`, `descuento`, `stock`) VALUES
	(1, 1, 'Pelota Adidas', 1500, 'Pelota de Fútbol futsal GOL DE ORO STAR | Nº4 Material: cuero sintetico vulcanizado Color:naranja, blanco, amarillo peso reglamentario: 400gr Tamaño:nº4 gajos pegados tipo de pique: medio pique circunferencia: 67 cm', 1400, 40),
	(2, 4, 'Botines Futsal Nike', 9999, 'Sistema de atado de cordones, exterior textil Speedskin, tejido ultraelástico, suela de TPU para terreno firme, color del artículo: Red / Core Black / Solar Red, número de artículo: FY3298', NULL, 20),
	(3, 2, 'Remera Estampada Adidas Retro', 5499, 'Corte holgado, cuello redondo acanalado, tejido de punto jersey 100 % algodón, tacto suave, better Cotton Initiative.', NULL, 20);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Dumping structure for table ecomm.producto_atributo
CREATE TABLE IF NOT EXISTS `producto_atributo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `producto_atributo_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.producto_atributo: ~8 rows (approximately)
/*!40000 ALTER TABLE `producto_atributo` DISABLE KEYS */;
INSERT INTO `producto_atributo` (`id`, `id_producto`, `nombre`) VALUES
	(1, 1, 'F5'),
	(2, 1, 'F7'),
	(3, 1, 'F11'),
	(4, 2, 'Rojos'),
	(5, 3, 'S'),
	(6, 3, 'M'),
	(7, 3, 'L'),
	(8, 3, 'XL');
/*!40000 ALTER TABLE `producto_atributo` ENABLE KEYS */;

-- Dumping structure for table ecomm.producto_imagenes
CREATE TABLE IF NOT EXISTS `producto_imagenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `producto_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.producto_imagenes: ~5 rows (approximately)
/*!40000 ALTER TABLE `producto_imagenes` DISABLE KEYS */;
INSERT INTO `producto_imagenes` (`id`, `id_producto`, `imagen`) VALUES
	(1, 1, 'assets/img/pelota1.jpeg'),
	(2, 1, 'assets/img/pelota2.jpeg'),
	(3, 1, 'assets/img/pelota3.jpeg'),
	(4, 2, 'assets/img/botinesfutsal1.jpeg'),
	(5, 3, 'assets/img/adidasretro1.jpeg');
/*!40000 ALTER TABLE `producto_imagenes` ENABLE KEYS */;

-- Dumping structure for table ecomm.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `usertype` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ecomm.usuarios: ~7 rows (approximately)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `usertype`) VALUES
	(1, 'joacovillamediana@gmail.com', '12345678', 'Joaquin Villamediana', 0),
	(2, 'juannocetiachaval50@gmail.com', 'asdaa12', 'Juan Noceti', 0),
	(3, 'valentinschiaffino@gmail.com', '199233', 'Valentin Schiaffino', 0),
	(4, 'enzoperez@gmail.com', 'hola123', 'Enzo Perez', 1),
	(5, 'carlosgomez@gmail.com', 'carlitos33', 'Carlos Gomez', 1),
	(6, 'valenschg@gmail.com', 'hola1234', 'Valentín Schiaffino', 2),
	(7, 'asdasd@asd.com', 'asdasdasdasd', 'asdasdasd', 2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
