-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 06. 19:07
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `gyumizoli`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2025_02_01_014033_create_products_table', 1),
(4, '2025_02_01_014034_create_orders_table', 1),
(5, '2025_02_01_014938_create_personal_access_tokens_table', 1),
(6, '2025_02_09_162044_add_banning_to_users_table', 1),
(7, '2025_02_20_175945_add_admin_to_users', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `customers_name` varchar(255) NOT NULL,
  `customers_phone` varchar(255) NOT NULL,
  `customers_email` varchar(255) NOT NULL,
  `delivery_date` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `payment_method` enum('card','cash') NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `promotion` tinyint(1) NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `stock` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `promotion`, `discount_price`, `category`, `unit`, `stock`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Alma', 'Friss, ropogós alma', 200, 0, NULL, 'Gyümölcs', 'kg', 100.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(2, 'Körte', 'Zamatos és ízletes körte', 250, 1, 200, 'Gyümölcs', 'kg', 80.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(3, 'Banán', 'Édes banán', 150, 0, NULL, 'Gyümölcs', 'kg', 120.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(4, 'Narancs', 'Frissítő narancs', 180, 1, 160, 'Gyümölcs', 'kg', 90.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(5, 'Kiwi', 'Friss kiwi', 300, 0, NULL, 'Gyümölcs', 'db', 70.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(6, 'Mango', 'Érett, lédús mango', 350, 1, 300, 'Gyümölcs', 'kg', 60.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(7, 'Ananász', 'Árnyalt, édes ananász', 400, 0, NULL, 'Gyümölcs', 'db', 50.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(8, 'Szőlő', 'Friss, zamatos szőlő', 220, 1, 200, 'Gyümölcs', 'kg', 110.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(9, 'Citrom', 'Friss citrom, magas C-vitamin tartalom', 120, 0, NULL, 'Gyümölcs', 'kg', 130.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(10, 'Dinnye', 'Édes, lédús dinnye', 500, 1, 450, 'Gyümölcs', 'db', 40.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(11, 'Paradicsom', 'Érett és zamatos paradicsom', 350, 0, NULL, 'Zöldség', 'kg', 60.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(12, 'Uborka', 'Friss és ropogós uborka', 280, 1, 250, 'Zöldség', 'kg', 50.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(13, 'Paprika', 'Édes paprika, többféle színben', 400, 0, NULL, 'Zöldség', 'kg', 40.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(14, 'Hagyma', 'Friss fehér hagyma', 150, 1, 130, 'Zöldség', 'kg', 200.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(15, 'Karalábé', 'Finom karalábé, szezonális', 220, 0, NULL, 'Zöldség', 'kg', 30.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(16, 'Brokkoli', 'Tápanyagban gazdag brokkoli', 300, 1, 270, 'Zöldség', 'kg', 45.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(17, 'Karfiol', 'Friss karfiol, egészséges választás', 320, 0, NULL, 'Zöldség', 'kg', 50.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(18, 'Spenót', 'Friss spenót levelek', 180, 1, 160, 'Zöldség', 'kg', 55.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(19, 'Zeller', 'Friss zeller, ideális salátákhoz', 250, 0, NULL, 'Zöldség', 'kg', 70.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(20, 'Retek', 'Élénk színű retek', 100, 1, 90, 'Zöldség', 'kg', 80.00, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `login_counter` int(11) NOT NULL DEFAULT 0,
  `banning_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `birth_date`, `remember_token`, `admin`, `login_counter`, `banning_time`, `created_at`, `updated_at`) VALUES
(1, 'Mihucza Gergő', 'mihucza@example.com', NULL, '$2y$10$VmEWvy9gQGGBZqQzXKYEGOEIUfq5xXO0ziEliLJfGL2gsG/vfz7Li', '1234567890', 'Révay utca 1, Budapest', '2004-11-08', NULL, 1, 0, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17'),
(2, 'Bőgér Bence', 'boger@example.com', NULL, '$2y$10$VmEWvy9gQGGBZqQzXKYEGOEIUfq5xXO0ziEliLJfGL2gsG/vfz7Li', '0987654321', 'Révay utca 2, Debrecen', '2002-11-02', NULL, 1, 0, NULL, '2025-04-06 17:07:17', '2025-04-06 17:07:17');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
