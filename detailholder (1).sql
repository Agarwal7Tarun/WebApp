-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detailholder`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL DEFAULT 0,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `category`, `quantity`, `image`) VALUES
(0, 6, 'Fire & Blood', 10, '', 2, 'Fire_&_Blood.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL DEFAULT 0,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL DEFAULT 0,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`) VALUES
(3, 'Fire & Blood', 10, 'Fiction Fantasy', 'Fire_&_Blood.jpg'),
(5, 'A Clash Of Kings', 12, 'Fiction Fantasy', 'A_Clash_Of_Kings(Book2).jpg'),
(6, 'A Strom Of Swords', 18, 'Fiction Fantasy', 'A_Strom_Of_Swords(Book3).jpg'),
(7, 'A Feast For Crows', 18, 'Fiction Fantasy', 'A_Feast_For_Crows(Book4).jpg'),
(8, 'A Dance Of Dragon', 20, 'Fiction Fantasy', 'A_Dance_With_Dragons(Book5).jpg'),
(9, 'A Knight Of Seven Kingdoms', 28, 'Fiction Fantasy', 'A_Knight_Of_The_Seven_Kingdom.jpg'),
(10, 'Harry Potter and the Philosopher\'s Stone', 8, 'Fantasy Adventure', 'The_Philosophers_Stone.jpg'),
(11, 'Harry Potter and the Chamber of Secrets', 8, 'Fantasy Adventure', 'Chamber_of_Secrets.jpg'),
(12, 'Harry Potter and the Prisoner of Azkaban', 8, 'Fantasy Adventure', 'Prisoner_of_Azkaban.jpg'),
(13, 'Harry Potter and the Goblet of Fire', 8, 'Fantasy Adventure', 'Goblet_Of_Fire.jpg'),
(14, 'Harry Potter and the Order of the Phoenix', 8, 'Fantasy Adventure', 'Order_Of_The_Phoenix.jpg'),
(15, 'Harry Potter and the Half-Blood Prince', 8, 'Fantasy Adventure', 'Half_Blood_Prince.jpg'),
(16, 'Harry Potter and the Deathly Hallows', 16, 'Fantasy Adventure', 'The_Deathly_Hallows.jpg'),
(17, 'The Lord of the Rings - Special Edition', 50, 'High Fantasy', 'The_Lord_Of_The_Rings.jpg'),
(18, 'Looking For Alaska - John Green', 23, 'Young Adult Fiction', 'Looking_For_Alaska.jpg'),
(19, 'The Fault in Our Stars - John Green', 12, 'Young Adult Fiction', 'The_Fault_In_Our_Stars.jpg'),
(20, 'Harry Potter and The Cursed Child', 24, 'Fantasy Adventure', 'Cursed_Child.jpg'),
(22, 'Game Of Thrones', 12, 'Fiction', 'A_Game_Of_Thrones(Book1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `email`, `address`, `password`, `created_at`, `user_type`) VALUES
(1, 'Admin', 'Admin', '9803198488', 'admin@test.com', 'Admin Demo', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '2024-10-05 14:01:25', 'admin'),
(102, 'Cust', 'Demo', '5685256985', 'cust@test.com', 'Demo', 'bc516777aed5e1beacae7b286ed9f2f9', '2024-10-05 14:24:52', 'user'),
(103, 'Cust', 'Demo', '5181518584', 'cust1@test.com', 'Basantpur', 'bc516777aed5e1beacae7b286ed9f2f9', '2024-10-05 14:38:15', 'user'),
(104, 'Tarun', 'Agarwal', '9803198488', 'agarwaltarun777@gmail.com', 'Basantpur', '68eacb97d86f0c4621fa2b0e17cabd8c', '2024-10-05 14:47:53', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
