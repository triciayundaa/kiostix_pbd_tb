-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2026 pada 15.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbd_tb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `atraksi`
--

CREATE TABLE `atraksi` (
  `id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `category_id` varchar(36) NOT NULL,
  `city_id` varchar(36) NOT NULL,
  `country_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `atraksi`
--

INSERT INTO `atraksi` (`id`, `title`, `slug`, `banner_image`, `price`, `status`, `category_id`, `city_id`, `country_id`) VALUES
('037311fa-5cbe-4d2b-91ea-5e99db81c5de', 'Gardens by the Bay', 'gardens-by-the-bay', 'https://picsum.photos/id/29/600/400', 350000.00, 'Active', '2021bef4-05c3-412f-9bf2-e114001db015', 'd42bf524-2d84-472f-aa52-82b1b1507911', '68e96574-fcc1-42a7-a34b-db10198acafa'),
('21792cfb-161a-478b-902b-ff8f3ff3d68a', 'Waterbom Bali', 'waterbom-bali', 'https://picsum.photos/id/12/600/400', 300000.00, 'Active', '62816c44-a1a0-4c97-8bc4-e70a114a22e7', 'ct3', 'c2'),
('21efe436-3eab-4cc8-a9e6-c6dfa2653336', 'Candi Borobudur Tour', 'candi-borobudur-tour', 'https://picsum.photos/id/13/600/400', 150000.00, 'Active', '59f9ccd2-cbb1-4f7c-b1cd-0139a9b86c4f', '11376a9c-4309-48e5-bda9-8cf13037a375', 'c2'),
('3234d9ec-938a-4527-8a73-6001cb1cca1c', 'Universal Studios Japan', 'universal-studios-japan', 'https://picsum.photos/id/57/600/400', 1150000.00, 'Active', 'cat2', '3204fae3-4653-4d49-9f7d-792459272939', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('38775725-9b8b-4100-9c36-8a96fafcbbc8', 'The Queen Mary Ticket', 'the-queen-mary-ticket', 'https://picsum.photos/id/88/600/400', 621064.00, 'Active', 'cat1', 'ct1', 'c4a6cf00-fd6f-4362-aa19-18ffd604df37'),
('43bef5e9-2aa6-4a78-a6ea-1d2a15f3c064', 'Fushimi Inari Shrine Tour', 'fushimi-inari-shrine-tour', 'https://picsum.photos/id/58/600/400', 350000.00, 'Active', '59f9ccd2-cbb1-4f7c-b1cd-0139a9b86c4f', '9bbfd4c8-2ee6-4464-8a95-e8f663256d63', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('49bc9ff6-e33d-4fbc-81a6-043cdc7aa9f1', 'S.E.A. Aquarium', 's-e-a-aquarium', 'https://picsum.photos/id/49/600/400', 450000.00, 'Active', 'cat1', 'daa9ec99-e149-4f18-ae5d-d72f92ff056f', '68e96574-fcc1-42a7-a34b-db10198acafa'),
('4ae1fd9e-bb1c-471b-ab35-217d540b7970', 'Universal Studios Singapore', 'universal-studios-singapore', 'https://picsum.photos/id/28/600/400', 950000.00, 'Active', 'cat2', 'daa9ec99-e149-4f18-ae5d-d72f92ff056f', '68e96574-fcc1-42a7-a34b-db10198acafa'),
('5321a0e5-39a1-4276-9985-80d6f70ab032', 'Taman Pintar Yogyakarta', 'taman-pintar-yogyakarta', 'https://picsum.photos/id/14/600/400', 75000.00, 'Active', '62816c44-a1a0-4c97-8bc4-e70a114a22e7', '11376a9c-4309-48e5-bda9-8cf13037a375', 'c2'),
('588d44df-fbf9-4a0e-9f23-886de8042649', 'Rinjani Trekking 2 Days', 'rinjani-trekking-2-days', 'https://picsum.photos/id/74/600/400', 750000.00, 'Active', '2021bef4-05c3-412f-9bf2-e114001db015', '7d54592f-670d-400f-a4cd-942186849881', 'c2'),
('5d542c11-a843-41f0-8cfe-72d3bc81ef0b', 'Gili Trawangan Snorkeling', 'gili-trawangan-snorkeling', 'https://picsum.photos/id/65/600/400', 150000.00, 'Active', 'cat2', '7d54592f-670d-400f-a4cd-942186849881', 'c2'),
('8e95dd2f-8e8e-48c2-9b72-a58a3dfb0be0', 'Universal Orlando Resort Ticket', 'universal-orlando-resort-ticket', 'https://picsum.photos/id/104/600/400', 5276376.00, 'Active', 'cat2', 'ct2', 'c4a6cf00-fd6f-4362-aa19-18ffd604df37'),
('91546191-1c5b-49d0-8f30-b905d1adffee', 'Dunia Fantasi (Dufan)', 'dunia-fantasi-dufan-', 'https://picsum.photos/id/17/600/400', 225000.00, 'Active', 'cat2', '001d57e7-d5c1-4263-b751-3bbe3f21e3f7', 'c2'),
('a0da0a95-8684-40fd-bf80-7faff9d8f856', 'Garuda Wisnu Kencana (GWK)', 'garuda-wisnu-kencana-gwk-', 'https://picsum.photos/id/11/600/400', 125000.00, 'Active', '59f9ccd2-cbb1-4f7c-b1cd-0139a9b86c4f', 'ct3', 'c2'),
('ac216788-1d50-40fa-80ee-0e7f3ffcca38', 'Tokyo Disneyland', 'tokyo-disneyland', 'https://picsum.photos/id/54/600/400', 1200000.00, 'Active', '62816c44-a1a0-4c97-8bc4-e70a114a22e7', 'e7351423-acad-4086-95c1-411f0e932da6', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('aec04f2f-3dff-4ff8-8f3f-b8741eda7ab4', 'Trans Studio Bandung', 'trans-studio-bandung', 'https://picsum.photos/id/15/600/400', 200000.00, 'Active', 'cat2', '6aa0ea4f-7a6b-49fa-b230-a0e80049b6dc', 'c2'),
('b31542b9-6a8a-4a6b-9ec1-6a76284ba9fc', 'San Diego Zoo Safari Park', 'san-diego-zoo-safari-park', 'https://picsum.photos/id/119/600/400', 1965040.00, 'Active', '2021bef4-05c3-412f-9bf2-e114001db015', '6c3e9201-7ed5-4c78-9059-c69655fff665', 'c4a6cf00-fd6f-4362-aa19-18ffd604df37'),
('bd8aafc6-0ab0-4e3d-8593-cfb1bbcbab28', 'Mount Fuji Day Trip', 'mount-fuji-day-trip', 'https://picsum.photos/id/59/600/400', 850000.00, 'Active', '2021bef4-05c3-412f-9bf2-e114001db015', 'e7351423-acad-4086-95c1-411f0e932da6', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('c496e4e8-02b1-444a-a103-373a15522888', 'Kawah Putih Ciwidey', 'kawah-putih-ciwidey', 'https://picsum.photos/id/16/600/400', 50000.00, 'Active', '2021bef4-05c3-412f-9bf2-e114001db015', '6aa0ea4f-7a6b-49fa-b230-a0e80049b6dc', 'c2'),
('d144e20e-b46d-41bf-97fe-a4b3463e356a', 'Bali Safari & Marine Park', 'bali-safari-marine-park', 'https://picsum.photos/id/10/600/400', 250000.00, 'Active', 'cat2', 'ct3', 'c2'),
('f91d2c84-79ab-4ca7-b4ad-131783ff38fc', 'Seaworld Ancol', 'seaworld-ancol', 'https://picsum.photos/id/18/600/400', 110000.00, 'Active', 'cat1', '001d57e7-d5c1-4263-b751-3bbe3f21e3f7', 'c2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` varchar(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `ticket_id` varchar(36) NOT NULL,
  `schedule_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `quantity`, `user_id`, `ticket_id`, `schedule_id`) VALUES
('c65f9c23-dcb0-42cd-8123-8a3c42be1c4b', 2, '87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', 'a1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
('2021bef4-05c3-412f-9bf2-e114001db015', 'Nature'),
('59f9ccd2-cbb1-4f7c-b1cd-0139a9b86c4f', 'Culture'),
('62816c44-a1a0-4c97-8bc4-e70a114a22e7', 'Entertainment'),
('cat1', 'Attraction'),
('cat2', 'Adventure'),
('cat3', 'Transport'),
('cat4', 'Eat & Drink'),
('cat5', 'Shopping');

-- --------------------------------------------------------

--
-- Struktur dari tabel `city`
--

CREATE TABLE `city` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`) VALUES
('001d57e7-d5c1-4263-b751-3bbe3f21e3f7', 'Jakarta', 'c2'),
('11376a9c-4309-48e5-bda9-8cf13037a375', 'Yogyakarta', 'c2'),
('3204fae3-4653-4d49-9f7d-792459272939', 'Osaka', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('6aa0ea4f-7a6b-49fa-b230-a0e80049b6dc', 'Bandung', 'c2'),
('6c3e9201-7ed5-4c78-9059-c69655fff665', 'San Diego', 'c4a6cf00-fd6f-4362-aa19-18ffd604df37'),
('7d54592f-670d-400f-a4cd-942186849881', 'Lombok', 'c2'),
('9bbfd4c8-2ee6-4464-8a95-e8f663256d63', 'Kyoto', 'b3701b60-0f97-4042-9597-db57b7d8f008'),
('ct1', 'Los Angeles', 'c1'),
('ct2', 'Orlando', 'c1'),
('ct3', 'Bali', 'c2'),
('ct4', 'Singapore', 'c3'),
('ct5', 'Kuala Lumpur', 'c4'),
('d42bf524-2d84-472f-aa52-82b1b1507911', 'Marina Bay', '68e96574-fcc1-42a7-a34b-db10198acafa'),
('daa9ec99-e149-4f18-ae5d-d72f92ff056f', 'Sentosa', '68e96574-fcc1-42a7-a34b-db10198acafa'),
('e7351423-acad-4086-95c1-411f0e932da6', 'Tokyo', 'b3701b60-0f97-4042-9597-db57b7d8f008');

-- --------------------------------------------------------

--
-- Struktur dari tabel `country`
--

CREATE TABLE `country` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
('68e96574-fcc1-42a7-a34b-db10198acafa', 'Singapura'),
('b3701b60-0f97-4042-9597-db57b7d8f008', 'Jepang'),
('c1', 'USA'),
('c2', 'Indonesia'),
('c3', 'Singapore'),
('c4', 'Malaysia'),
('c4a6cf00-fd6f-4362-aa19-18ffd604df37', 'Mancanegara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `category_id` varchar(36) NOT NULL,
  `venue_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-05-08-105236', 'App\\Database\\Migrations\\CreateInitialTables', 'default', 'App', 1778237642, 1),
(2, '2026-05-08-112256', 'App\\Database\\Migrations\\AddNegaraKotaToUser', 'default', 'App', 1778239404, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` varchar(36) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `pay_status` varchar(50) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `platform_fee` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `voucher_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `order_no`, `pay_status`, `payment_method`, `sub_total`, `platform_fee`, `grand_total`, `created_at`, `user_id`, `voucher_id`) VALUES
('1afce900-48d7-41a5-963b-ee9558d08094', 'ORD-D849064F', 'Paid', 'QR Payment', 5276376.00, 3000.00, 5279376.00, '2026-05-09 08:29:26', '87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', NULL),
('2873d959-48cf-4131-9922-5215b4e1738f', 'ORD-D1AFA27F', 'Paid', 'QR Payment', 350000.00, 3000.00, 353000.00, '2026-05-09 12:29:04', '87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', NULL),
('7b431790-e7af-4710-9178-b8507e42d1de', 'ORD-25AC326A', 'Paid', 'Sinarmas', 5276376.00, 3000.00, 5279376.00, '2026-05-09 08:12:52', '87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', NULL),
('a29f809d-d184-4da4-aa5a-8a33520071f6', 'ORD-BDF8F1AA', 'Paid', 'Sinarmas', 621064.00, 3000.00, 624064.00, '2026-05-09 09:53:27', '87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_item`
--

CREATE TABLE `order_item` (
  `id` varchar(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `visit_date` date DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `order_id` varchar(36) NOT NULL,
  `ticket_id` varchar(36) NOT NULL,
  `schedule_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_item`
--

INSERT INTO `order_item` (`id`, `quantity`, `price`, `visit_date`, `visit_time`, `order_id`, `ticket_id`, `schedule_id`) VALUES
('142ffaa9-e5d9-4dde-86e6-99dd82da49a7', 1, 5276376.00, '2026-05-09', NULL, '1afce900-48d7-41a5-963b-ee9558d08094', 'a2', NULL),
('22377fd2-d99d-4b37-aa5d-c2a82d78a26a', 1, 350000.00, '2026-05-16', NULL, '2873d959-48cf-4131-9922-5215b4e1738f', '2f54dc91-d4cd-403e-9d7c-9111f3dfa85b', NULL),
('618ca403-9b0b-4407-83f4-6cb042adf80a', 1, 621064.00, '2026-05-11', NULL, 'a29f809d-d184-4da4-aa5a-8a33520071f6', 'a1', NULL),
('9249e35e-8cbd-4f8c-9806-359b63e04ea0', 1, 5276376.00, '2026-05-09', NULL, '7b431790-e7af-4710-9178-b8507e42d1de', 'a2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `participant`
--

CREATE TABLE `participant` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_handphone` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `order_id` varchar(36) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id` varchar(36) NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `event_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `started_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `event_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_handphone` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `negara` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `password`, `no_handphone`, `tanggal_lahir`, `gender`, `negara`, `kota`) VALUES
('87a6af6c-35a1-4aa4-b74c-cc6f106e3aeb', 'Annisa Revalina Harahap', 'arir6772@gmail.com', 'qwerty', '+6182281995001', '2026-05-08', 'Perempuan', 'Djibouti', 'Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `venue`
--

CREATE TABLE `venue` (
  `id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `city_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
--

CREATE TABLE `voucher` (
  `id` varchar(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `atraksi`
--
ALTER TABLE `atraksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
