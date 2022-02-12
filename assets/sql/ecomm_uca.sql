-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-02-2022 a las 00:39:27
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecomm_uca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `id` int(10) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `imagen`, `link`) VALUES
(1, 'https://www.softub.ch/wp-content/uploads/Black-Friday-Sale.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_usuario`, `fecha`) VALUES
(1, 4, '2021-11-12 08:15:45'),
(2, 5, '2021-11-12 08:15:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_productos`
--

CREATE TABLE `carrito_productos` (
  `id` int(11) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `id_atributo` int(10) NOT NULL,
  `id_carrito` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito_productos`
--

INSERT INTO `carrito_productos` (`id`, `id_producto`, `id_atributo`, `id_carrito`, `cantidad`) VALUES
(1, 1, 7, 2, 3),
(2, 2, 4, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'pelotas'),
(2, 'remeras'),
(3, 'pantalones'),
(4, 'calzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'pendiente'),
(2, 'aprobado'),
(3, 'rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_estado` int(10) NOT NULL,
  `envio` varchar(60) NOT NULL,
  `envio_nombre` varchar(60) NOT NULL,
  `envio_direccion` varchar(255) NOT NULL,
  `envio_dni` int(10) NOT NULL,
  `envio_telefono` varchar(60) NOT NULL,
  `pago_titular` varchar(60) NOT NULL,
  `pago_tarjeta` varchar(20) NOT NULL,
  `pago_expiracion` varchar(5) NOT NULL,
  `pago_cvc` int(3) NOT NULL,
  `importe` float NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `id_estado`, `envio`, `envio_nombre`, `envio_direccion`, `envio_dni`, `envio_telefono`, `pago_titular`, `pago_tarjeta`, `pago_expiracion`, `pago_cvc`, `importe`, `fecha`) VALUES
(1, 4, 2, 'retiro', 'Julia Perez', 'local', 42223123, '1124598866', 'Enzo Perez', '1234-2223-4223-1231', '12/24', 123, 10000, '2021-11-12 08:09:32'),
(2, 5, 1, 'a domicilio', 'Carlos Gomez', 'Las Heras 1233', 28939088, '1125448866', 'Carlos Gomez', '1231-4211-4112-4444', '12/25', 422, 7500, '2021-11-12 08:10:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_producto`
--

CREATE TABLE `pedidos_producto` (
  `id` int(10) NOT NULL,
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `id_atributo` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos_producto`
--

INSERT INTO `pedidos_producto` (`id`, `id_pedido`, `id_producto`, `id_atributo`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 2, 1, 1500),
(2, 1, 2, 2, 1, 9999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio` float NOT NULL,
  `detalles` varchar(1050) NOT NULL,
  `descuento` int(10) DEFAULT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_categoria`, `nombre`, `precio`, `detalles`, `descuento`, `stock`) VALUES
(1, 1, 'Pelota Adidas', 1500, 'Pelota de Fútbol futsal GOL DE ORO STAR | Nº4 Material: cuero sintetico vulcanizado Color:naranja, blanco, amarillo peso reglamentario: 400gr Tamaño:nº4 gajos pegados tipo de pique: medio pique circunferencia: 65 cm', 1249, 40),
(2, 4, 'Botines Futsal Nike', 9999, 'Sistema de atado de cordones, exterior textil Speedskin, tejido ultraelástico, suela de TPU para terreno firme, color del artículo: Red / Core Black / Solar Red, número de artículo: FY3298', NULL, 20),
(3, 2, 'Remera Estampada Adidas Retro', 5499, 'Corte holgado, cuello redondo acanalado, tejido de punto jersey 100 % algodón, tacto suave, better Cotton Initiative.', 4999, 20),
(4, 2, 'Remera Seleccion Colombia', 10999, 'La remera oficial de la selección de Colombia', 7999, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_atributo`
--

CREATE TABLE `producto_atributo` (
  `id` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_atributo`
--

INSERT INTO `producto_atributo` (`id`, `id_producto`, `nombre`) VALUES
(1, 1, 'F5'),
(2, 1, 'F7'),
(3, 1, 'F11'),
(4, 2, 'Rojos'),
(5, 3, 'S'),
(6, 3, 'M'),
(7, 3, 'L'),
(8, 3, 'XL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id`, `id_producto`, `imagen`) VALUES
(1, 1, 'assets/img/pelota1.jpeg'),
(2, 1, 'assets/img/pelota2.jpeg'),
(3, 1, 'assets/img/pelota3.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `usertype` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `usertype`) VALUES
(1, 'joacovillamediana@gmail.com', '12345678', 'Joaquin Villamediana', 2),
(2, 'juannocetiachaval50@gmail.com', 'asdaa12', 'Juan Noceti', 2),
(3, 'valentinschiaffino@gmail.com', '199233', 'Valentin Schiaffino', 2),
(4, 'enzoperez@gmail.com', 'hola123', 'Enzo Perez', 2),
(5, 'carlosgomez@gmail.com', 'carlitos33', 'Carlos Gomez', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_atributo` (`id_atributo`),
  ADD KEY `id_carrito` (`id_carrito`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedidos_producto`
--
ALTER TABLE `pedidos_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_atributo` (`id_atributo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `producto_atributo`
--
ALTER TABLE `producto_atributo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos_producto`
--
ALTER TABLE `pedidos_producto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto_atributo`
--
ALTER TABLE `producto_atributo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD CONSTRAINT `carrito_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `carrito_productos_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `producto_atributo` (`id`),
  ADD CONSTRAINT `carrito_productos_ibfk_3` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `pedidos_producto`
--
ALTER TABLE `pedidos_producto`
  ADD CONSTRAINT `pedidos_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `pedidos_producto_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `producto_atributo` (`id_producto`),
  ADD CONSTRAINT `pedidos_producto_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `producto_atributo`
--
ALTER TABLE `producto_atributo`
  ADD CONSTRAINT `producto_atributo_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `producto_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
