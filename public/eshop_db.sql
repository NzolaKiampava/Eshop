-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Nov-2022 às 21:05
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
-- Estrutura da tabela `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `url_address` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_url` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `blogs`
--

INSERT INTO `blogs` (`id`, `url_address`, `title`, `post`, `image`, `date`, `user_url`) VALUES
(7, 'ecommmerce-websites-of-the-world', 'Ecommerce Websites Of The World', 'ecommmerce websites of the worldh, jsgdsjkgdsgd, hkahakdhka , hkahdakheub, haiadhi.hoafo', 'uploads/rUv6l4xHryAdWfVnQA1yidx1tEAM6TiRtEXVR7YiocxlLJC0ndWikUgxyKIe.jpg', '2022-08-19 02:06:05', 'scbk9tqol1u1424pi7krurqe2gq'),
(9, 'personal-computers', 'Personal Computers', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'uploads/dkM1MW7EalFqjbBZeUWhGrSVpKoqAHVCJnW3Mc5fPui8xMSxSMcyONlsfhmE.jpg', '2022-08-19 02:11:33', 'scbk9tqol1u1424pi7krurqe2gq'),
(14, 'long-blog-post-test-2', 'Long Blog Post Test 3', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.\r\nLorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.', 'uploads/oH6FGFe9gWV71ajn8NtyEx0X8UY3cHROuz1rJTcBZU0rUdEMcESRmDxJohrN.jpg', '2022-08-25 21:48:12', 'scbk9tqol1u1424pi7krurqe2gq'),
(17, 'welcome-to-eshopper-new-way-to-make-your-business', 'Welcome To Eshopper - New Way To Make Your Business', 'this awesome,this awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesomethis awesome', 'uploads/Hwz5U9QcPliwHSmER0KAnC6eQQZeqQD76XBBltRyof52WiyHhph4UcPqfTRR.jpg', '2022-10-01 19:19:16', 'scbk9tqol1u1424pi7krurqe2gq');

-- --------------------------------------------------------

--
-- Estrutura da tabela `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `brands`
--

INSERT INTO `brands` (`id`, `brand`, `disabled`, `views`) VALUES
(1, 'Oodmolly', 0, 0),
(2, 'Albiro', 0, 0),
(3, 'Acne', 0, 0),
(4, 'Lenovo', 0, 0),
(5, 'other', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `category`, `disabled`, `parent`, `views`) VALUES
(12, 'Food', 0, 0, 7),
(13, 'Clothes', 0, 0, 1),
(14, 'Fruits', 0, 0, 14),
(17, 'Juices', 0, 21, 7),
(18, 'Nike', 0, 13, 2),
(21, 'Drink', 0, 0, 6),
(22, 'Meat', 0, 12, 5),
(23, 'Computers', 0, 0, 38),
(24, 'Another Categorys', 0, 0, 21),
(26, 'Electrodomestico', 0, 0, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `date`) VALUES
(6, 'Nzola Kiampava', 'nzolakiampava@gmail.com', 'Debugging', 'debugging process', '2022-10-01 17:05:25');

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
(1, 'fi3a1mk8753es7kurm86lmo0b6', 'scbk9tqol1u1424pi7krurqe2gq', 'Mainga / Viana', 132, 'Angola', 'Luanda', '00121', 0, 0, '923789234', '783873782', '2022-10-30 20:25:35');

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
(1, 1, 1, 'Debugging', 122, 122, 52),
(2, 1, 1, 'IPhone', 10, 10, 47),
(3, 2, 1, 'Lenovo Tablet', 12, 12, 30),
(4, 3, 1, 'DELL CORE I3', 14300, 14300, 7),
(5, 4, 1, 'Portatil', 1930, 1930, 10),
(6, 5, 1, 'Pc Gamer', 230, 230, 9),
(7, 6, 1, 'Tablet', 122, 122, 15),
(8, 7, 1, 'Frango', 11221, 11221, 12),
(9, 8, 1, 'Cuca', 239, 239, 13),
(10, 9, 1, 'Debugging', 122, 122, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `row` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
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

INSERT INTO `products` (`id`, `user_url`, `description`, `category`, `brand`, `price`, `quantity`, `image`, `image2`, `image3`, `image4`, `date`, `slag`) VALUES
(1, 'scbk9tqol1u1424pi7krurqe2gq', 'Carne De Vaca', 22, 1, '121212', 2, 'uploads/RgosYgv3I2Xz0K7624s5CSuaNLSgOhHHWfDn6GZvx88EeQnOtzKzPgNYAZfv.jpg', 'uploads/cTyqHUSY90uVYAEuifS5PFrZYDjB2NosYfynifFlxkw2YOQSc5JgEygWwJwP.jpg', 'uploads/wvjcRki8PLwd9SaDkG2dAZSEj4P8eIShbW5hm5eJl99LVnKNDWXndXBU35a9.jpg', 'uploads/YimkvOyqhmroVRwKjJ0WDwAIRTNRg0aVyqQzTYLmJJ5glWnX5oZxger9zx4u.jpg', '2022-07-19 16:31:08', 'carne-de-vaca'),
(2, 'scbk9tqol1u1424pi7krurqe2gq', 'Apple', 14, 3, '120', 21, 'uploads/vF2DKPxg0ZJqAL1BjxfNc8OLgD7ff81ALJW7Hzgw3HEVFKJwNLV8gf4ljPjl.jpg', 'uploads/djnePOQXnr45GddIgSFeCXbRwfY6z0X79IKIRPnQz1Sn1RdN8j5ploopAY4D.jpg', 'uploads/wKLDPVeruwbmZ7qQ3r9EYMEHyQUyTwTNEPJynDvg0R1dF2I3iA9CwMEGAIkv.jpg', 'uploads/HMzYaTO85oTKDL59my8ja4N5Kip0sTIwiP7h37mw2L0buSW2QT3ioQ7G4eBl.jpg', '2022-07-20 16:02:04', 'apple'),
(3, 'scbk9tqol1u1424pi7krurqe2gq', 'Caldo', 12, 1, '120', 0, 'uploads/AO1z9jCZhKgvvtv0VPZExlCIuKjga7pkCcjIBIcvfg0bC2HHSb2MZ77IENWj.jpg', 'uploads/SXQT4RmceQsRAou56OC8ZKc7EzIDUyTBd4XqPPCYwyPYEkOB2rUoX8y2RvEi.jpg', 'uploads/bUt7zlqkjqWRghMIqyJ5A8FeL3sDMgsUCIWd8MxOx0lgR2jmJ91hgRNV5jOq.jpg', 'uploads/LWNc3cYfaLSUasT7PEKBbWLae9SsliLgHkEk1sVLQrLs5thq7pvcaT0vTIKr.jpg', '2022-07-26 21:07:10', 'caldo'),
(6, 'scbk9tqol1u1424pi7krurqe2gq', 'PC Corei5', 23, 4, '24300', 4, 'uploads/2Wr6Wg7sVcYHx8vZlRGNUNWK0mptKIk6nzadnJOjvzNcyDcbqTmFdKk5FdjH.jpg', 'uploads/F7oFlcavYlRFpxSm5jcDCSmvs47f8sAdhBhcATRL6LP3feFpvqOcnGhgErbo.jpg', 'uploads/smMejFj1eqj93jiRWc8gupWmy51bYovVW5LthLE0r5fyVPRDOi0RDlPJmbAq.jpg', 'uploads/Dnmdq6IHtO58dFTD7UsiJURzB8pGbP9LQXWizc7WgUUVyPaJoEWYetbkLf5z.jpg', '2022-08-19 02:34:02', 'pc-corei5-910km-ram-4gb-hd-500-38847'),
(7, 'scbk9tqol1u1424pi7krurqe2gq', 'DELL CORE I3', 23, 2, '14300', 3, 'uploads/FMV7vA67MHGndoOB6dqb8UqxRnVKoR7dnajTo0h7nVu9LDDYmxzxL3RFW8tl.jpg', 'uploads/fNEmEi7Inxkb4ylXA1ZP8E5TqFWoItmzIqedeV7Be6a9OFDszDyE0kAuCqc5.jpg', 'uploads/NvN4NFyXctOZhGYiiVjcbYhG4Ady8PFwb42yYIGmQZpPqKxFxKEXWPel1ID4.jpg', 'uploads/qQdyNZktzKcBChMtQHM8biy7hY4mIOQU6OTcUIyu40Vv6D8O0uWEX3mMgkq2.jpg', '2022-08-19 02:35:49', 'dell-core-i3'),
(8, 'scbk9tqol1u1424pi7krurqe2gq', 'Servidor', 24, 2, '1210', 2, 'uploads/Vi2p7YxPdD2U0U2vi57fO7VEoE40vuR6nCcTeZizejr4nsW9csEfPraAIvdn.jpg', '', '', '', '2022-09-04 18:35:47', 'servidor'),
(9, 'scbk9tqol1u1424pi7krurqe2gq', 'Pc Gamer', 23, 1, '230', 0, 'uploads/4x3NyMeKSeC5j3iPotINNQ8TXm1ldWEJpdrrMAMFI3f1XbmTsoWVvlF7YR8R.jpg', '', '', '', '2022-09-04 18:36:29', 'pc-gamer'),
(10, 'scbk9tqol1u1424pi7krurqe2gq', 'Portatil', 23, 3, '1930', 0, 'uploads/9Lb7qeTzrGuBkwUcvYrwVdomfZeIeLqKy3TBQJE6Nov8k4b8kBREJON0lt6k.jpg', 'uploads/Yf0pvMOdaabl7x0Qn996F52OfkSeRrvtqEMNU2AFNGOH4oO2dIbnNM79XqXU.jpg', '', '', '2022-09-04 18:37:11', 'portatil'),
(12, 'scbk9tqol1u1424pi7krurqe2gq', 'Frango', 12, 3, '11221', 2, 'uploads/YlekDGsGg9c3A1sVaql8WyZuOMLSrBSfDIKQ9Ob3ZAt6PMpjxLH626FVxtAu.jpg', 'uploads/OEbs16FnBJB6y2s1EW9dM19kwbmzXXGBNs3wcKAmtw1fXINDQuNJBVCxqCJD.jpg', '', '', '2022-09-04 22:15:43', 'frango'),
(13, 'scbk9tqol1u1424pi7krurqe2gq', 'Cuca', 21, 2, '239', 3, 'uploads/RMLgBS9876cMOStwQri9cxd8OAcgf8t92NHrZYYsndNTmeThSlz3yGz0nEA1.jpg', '', '', '', '2022-09-04 23:45:45', 'cuca'),
(15, 'scbk9tqol1u1424pi7krurqe2gq', 'Tablet', 23, 2, '122', 0, 'uploads/KDpa6rSQkaSeALon0rWAexIORY8Jclv2cCLwRnwgA4m9kOb1EtzQHQyOqcdH.jpg', '', '', '', '2022-09-12 03:37:01', 'tablet'),
(30, 'scbk9tqol1u1424pi7krurqe2gq', 'Lenovo Tablet', 14, 4, '12', 0, 'uploads/OjES3xUnS7nBSIw3CVtrMfdblp0t6MlHmmCpfi4YxFrC4WrXj1FqYKLEcoUE.jpg', '', '', '', '2022-09-15 01:19:18', 'teste'),
(47, 'scbk9tqol1u1424pi7krurqe2gq', 'IPhone', 26, 3, '10', 0, 'uploads/1ad38Oqb2uVCAqa5JSgg6OI2qWAN5N6U352Wtdxol68kbuWVIpaXqswYv00X.jpg', '', '', '', '2021-09-16 00:17:33', 'dude'),
(49, 'scbk9tqol1u1424pi7krurqe2gq', 'Testing', 22, 4, '120', 7, 'uploads/AN1GNL5KFqFWCStcoBFPXUjXAMzkv71hpyYh0UWviOkXngv74toWhv030GOb.jpg', '', '', '', '2022-09-21 02:22:38', 'testing'),
(52, 'scbk9tqol1u1424pi7krurqe2gq', 'Debugging', 13, 5, '122', 0, 'uploads/WlECb8YKUrpu3fwb8EUwkdYXfeqFQOIp70jLPG2TMj7iX1mO0fB4sM2xfW7c.jpg', '', '', '', '2022-09-23 02:11:27', 'debugging');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(30) DEFAULT NULL,
  `value` varchar(2040) DEFAULT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `setting`, `value`, `type`) VALUES
(1, 'phone_number', '(+244) 924 598 849', ''),
(2, 'email', 'info@eshop.com', ''),
(3, 'facebook_link', 'https://www.facebook.com', ''),
(4, 'linkedin_link', 'https://www.linkedin.com', ''),
(5, 'twitter_link', 'https://www.twitter.com', ''),
(6, 'google_plus_link', 'https://www.googleplus.com', ''),
(7, 'website_link', 'https://www.eshop.com.ao', ''),
(8, 'youtube_link', '', ''),
(9, 'contact_info', 'E-Shopper Inc.\r\n935 W. Webster Ave New Streets Chicago, IL 60614, NY\r\nNewyork USA\r\nMobile: +2346 17 38 93\r\nFax: 1-714-252-0026\r\nEmail: info@e-shopper.com', 'textarea');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `header1_text` varchar(45) NOT NULL,
  `header2_text` varchar(45) DEFAULT NULL,
  `text` varchar(124) DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `image` varchar(600) DEFAULT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `slider_images`
--

INSERT INTO `slider_images` (`id`, `header1_text`, `header2_text`, `text`, `link`, `image`, `image2`, `disabled`) VALUES
(1, 'E-SHOP Red Apple', 'Study Eating Our Delicious Fruit', 'This is the new stock fruit of our company', 'http://localhost/eshop/public/product_details/apple', 'uploads/K9Tcioqe3BklXo2w9JtV6unadHDexRpHi8YK80wavtoddaielPHhXWnuAvpg.jpg', NULL, 0),
(2, 'E-Shopper Meat', 'Buy And Save Money,  Just For  USD100', 'E-shopper is awesome ecommerce website platform', 'http://localhost/eshop/public/product_details/carne-de-vaca', 'uploads/tRjjTBuF1yBWavHUSeVQ33iPT2vejciqMBpqYWuBBSX5d0ta0qfPqGHaaFMa.jpg', NULL, 0),
(3, 'CORE I10', 'Compra Antes Q Acabe', 'Bem rápido esse mambo yha', 'http://localhost/eshop/public/product_details/pc-corei5-910km-ram-4gb-hd-500-38847', 'uploads/wc3HoWIKCKMywib2vxzpdhVBsm1CUoVlNPPoM3pwr22ZmahRYCpEy8l1Rj5J.jpg', NULL, 0);

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
  `rank` varchar(8) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `date`, `rank`, `image`) VALUES
(1, 'scbk9tqol1u1424pi7krurqe2gq', 'Nzola Kiampava', 'nzolakiampava@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', '2022-04-10 03:37:17', 'admin', 'uploads/eshop-817-ui-divya.jpg'),
(272, '1gsm1sm09hegr49', 'Jordan', 'jordan@gmail.com', '4554f6fc1a2e2f6bdc63b0162bf0ca0650368dd4', '2022-10-30 00:17:48', 'customer', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `title` (`title`),
  ADD KEY `image` (`image`),
  ADD KEY `user_url` (`user_url`);

--
-- Índices para tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`brand`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `views` (`views`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `parent` (`parent`),
  ADD KEY `views` (`views`);

--
-- Índices para tabela `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `subject` (`subject`),
  ADD KEY `email` (`email`);

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
-- Índices para tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `user_url` (`user_url`),
  ADD KEY `brand` (`brand`);

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
-- AUTO_INCREMENT de tabela `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
