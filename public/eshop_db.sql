-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Ago-2022 às 17:10
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eshop_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `category`, `disabled`, `parent`) VALUES
(12, 'Food', 0, 0),
(13, 'Clothes', 0, 0),
(14, 'Fruits', 0, 0),
(16, 'Bags', 0, 0),
(17, 'Juices', 0, 21),
(18, 'Nike', 1, 13),
(21, 'Drink', 0, 0),
(22, 'Meat', 0, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(20) DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `countries`
--

INSERT INTO `countries` (`id`, `country`, `disabled`) VALUES
(1, 'Angola', 0),
(2, 'Brazil', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `sessionid` varchar(60) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `delivery_address` varchar(1024) DEFAULT NULL,
  `total` double NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `shipping` double DEFAULT NULL,
  `home_phone` varchar(20) NOT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `sessionid`, `user_url`, `delivery_address`, `total`, `country`, `state`, `zip`, `tax`, `shipping`, `home_phone`, `mobile_phone`, `date`) VALUES
(1, '1dsneh10g4ihsg79qo9p20q4g1', 'scbk9tqol1u1424pi7krurqe2gq', 'Huambo / huambo 2', 121332, 'Angola', 'Luanda', '190280', 0, 0, '999888777', '999666777', '2022-07-20 17:45:16'),
(2, '1dsneh10g4ihsg79qo9p20q4g1', 'scbk9tqol1u1424pi7krurqe2gq', 'Huambo / huambo 2', 121332, 'Angola', 'Luanda', '190280', 0, 0, '999888777', '999666777', '2022-07-20 19:01:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `orderid` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL,
  `productid` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `order_details`
--

INSERT INTO `order_details` (`id`, `orderid`, `qty`, `description`, `amount`, `total`, `productid`) VALUES
(1, 1, 1, 'Apple', 120, 120, 2),
(2, 1, 1, 'Carne De Vaca', 121212, 121212, 1),
(3, 2, 1, 'Apple', 120, 120, 2),
(4, 2, 1, 'Carne De Vaca', 121212, 121212, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `image3` varchar(500) DEFAULT NULL,
  `image4` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `user_url`, `description`, `category`, `price`, `quantity`, `image`, `image2`, `image3`, `image4`, `date`, `slag`) VALUES
(1, 'scbk9tqol1u1424pi7krurqe2gq', 'Carne De Vaca', 22, '121212', 1, 'uploads/RgosYgv3I2Xz0K7624s5CSuaNLSgOhHHWfDn6GZvx88EeQnOtzKzPgNYAZfv.jpg', 'uploads/cTyqHUSY90uVYAEuifS5PFrZYDjB2NosYfynifFlxkw2YOQSc5JgEygWwJwP.jpg', 'uploads/wvjcRki8PLwd9SaDkG2dAZSEj4P8eIShbW5hm5eJl99LVnKNDWXndXBU35a9.jpg', 'uploads/YimkvOyqhmroVRwKjJ0WDwAIRTNRg0aVyqQzTYLmJJ5glWnX5oZxger9zx4u.jpg', '2022-07-19 16:31:08', 'carne-de-vaca'),
(2, 'scbk9tqol1u1424pi7krurqe2gq', 'Apple', 14, '120', 21, 'uploads/vF2DKPxg0ZJqAL1BjxfNc8OLgD7ff81ALJW7Hzgw3HEVFKJwNLV8gf4ljPjl.jpg', 'uploads/djnePOQXnr45GddIgSFeCXbRwfY6z0X79IKIRPnQz1Sn1RdN8j5ploopAY4D.jpg', 'uploads/wKLDPVeruwbmZ7qQ3r9EYMEHyQUyTwTNEPJynDvg0R1dF2I3iA9CwMEGAIkv.jpg', 'uploads/HMzYaTO85oTKDL59my8ja4N5Kip0sTIwiP7h37mw2L0buSW2QT3ioQ7G4eBl.jpg', '2022-07-20 16:02:04', 'apple'),
(3, 'scbk9tqol1u1424pi7krurqe2gq', 'Caldo', 12, '120', 1, 'uploads/AO1z9jCZhKgvvtv0VPZExlCIuKjga7pkCcjIBIcvfg0bC2HHSb2MZ77IENWj.jpg', 'uploads/SXQT4RmceQsRAou56OC8ZKc7EzIDUyTBd4XqPPCYwyPYEkOB2rUoX8y2RvEi.jpg', 'uploads/bUt7zlqkjqWRghMIqyJ5A8FeL3sDMgsUCIWd8MxOx0lgR2jmJ91hgRNV5jOq.jpg', 'uploads/6VL7vIQ4vT1XGvlCcUdUXew1359AMAfBiIQn3OTIGr4axyJFCtztSJWiSBiQ.jpg', '2022-07-26 21:07:10', 'caldo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(30) DEFAULT NULL,
  `value` varchar(2040) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `setting`, `value`) VALUES
(1, 'phone_number', '(+244) 924 598 849'),
(2, 'email', 'info@eshop.com'),
(3, 'facebook_link', 'https://www.facebook.com'),
(4, 'linkedin_link', 'https://www.linkedin.com'),
(5, 'twitter_link', 'https://www.twitter.com'),
(6, 'google_plus_link', 'https://www.googleplus.com'),
(7, 'website_link', 'https://www.eshop.com.ao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `header1_text` varchar(30) NOT NULL,
  `header2_text` varchar(30) DEFAULT NULL,
  `text` varchar(124) DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `image` varchar(600) DEFAULT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `states`
--

INSERT INTO `states` (`id`, `parent`, `state`, `disabled`) VALUES
(1, 1, 'Luanda', 0),
(2, 1, 'Huambo', 0),
(3, 2, 'Rio de Janeiro', 0),
(4, 2, 'São Paulo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `url_address` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date` datetime NOT NULL,
  `rank` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `date`, `rank`) VALUES
(1, 'scbk9tqol1u1424pi7krurqe2gq', 'NZOLA', 'nzolakiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', '2022-04-10 03:37:17', 'admin'),
(2, 'p7ee5009bpnlk27jmdi', 'Antonio', 'jordan@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', '2022-04-19 01:35:28', 'customer');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `parent` (`parent`);

--
-- Índices para tabela `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`sessionid`),
  ADD KEY `userid` (`user_url`),
  ADD KEY `date` (`date`);

--
-- Índices para tabela `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `description` (`description`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slag` (`slag`),
  ADD KEY `date` (`date`),
  ADD KEY `quantity` (`quantity`),
  ADD KEY `price` (`price`),
  ADD KEY `category` (`category`),
  ADD KEY `description` (`description`),
  ADD KEY `user_url` (`user_url`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting` (`setting`);

--
-- Índices para tabela `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Índices para tabela `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
