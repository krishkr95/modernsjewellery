-- =============================================================================
-- Modern Jewellery House - Production Database Dump for Hostinger / MySQL
-- Generated: 2026-10-13 05:42:22
-- Target: MySQL 5.7+ / MySQL 8.0+ / MariaDB 10.3+
-- =============================================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';
SET NAMES utf8mb4;

-- -----------------------------------------------------------------------------
-- Table structure for table `migrations`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_08_000001_create_roles_and_permissions_tables', 1),
(5, '2026_10_08_000002_create_catalog_tables', 1),
(6, '2026_10_08_000003_create_inventory_tables', 1),
(7, '2026_10_08_000004_create_carts_and_wishlists_tables', 1),
(8, '2026_10_08_000005_create_addresses_and_coupons_tables', 1),
(9, '2026_10_08_000006_create_orders_payments_refunds_tables', 1),
(10, '2026_10_08_000007_create_reviews_tables', 1),
(11, '2026_10_08_000008_create_content_and_support_tables', 1),
(12, '2026_10_08_000009_create_settings_and_activity_logs_tables', 1),
(13, '2026_10_08_132344_add_phase3_fields_to_products_and_create_recently_viewed', 1),
(14, '2026_10_08_153624_add_phase4_fields_to_orders_and_payments', 1),
(15, '2026_10_09_000001_add_phase5_admin_fields', 1),
(16, '2026_10_11_030835_make_user_id_nullable_and_add_customer_fields_to_reviews_table', 1),
(17, '2026_10_11_055034_add_3d_model_settings_to_products_table', 1);

-- -----------------------------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `sessions`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` text NULL DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `cache`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `cache_locks`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `jobs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` bigint(20) NOT NULL,
  `reserved_at` bigint(20) NULL DEFAULT NULL,
  `available_at` bigint(20) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `job_batches`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` bigint(20) NOT NULL,
  `pending_jobs` bigint(20) NOT NULL,
  `failed_jobs` bigint(20) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text NULL DEFAULT NULL,
  `cancelled_at` bigint(20) NULL DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `finished_at` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `failed_jobs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `roles`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `roles`
INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SUPER_ADMIN', 'super-admin', 'Complete authority over Maison settings, roles, financial records, and operations.', '2026-10-13 03:39:38', '2026-10-13 03:39:38'),
(2, 'ADMIN', 'admin', 'Maison administrator with catalog, inventory, order, and customer oversight.', '2026-10-13 03:39:38', '2026-10-13 03:39:38'),
(3, 'MANAGER', 'manager', 'Store manager controlling inventory replenishment, promotions, and customer service.', '2026-10-13 03:39:38', '2026-10-13 03:39:38'),
(4, 'STAFF', 'staff', 'Concierge and boutique staff managing order fulfillment and customer inquiries.', '2026-10-13 03:39:38', '2026-10-13 03:39:38'),
(5, 'CUSTOMER', 'customer', 'Distinguished private client of Modern Jewellery House.', '2026-10-13 03:39:38', '2026-10-13 03:39:38');

-- -----------------------------------------------------------------------------
-- Table structure for table `role_user`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `role_user`
INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-10-13 03:39:40', '2026-10-13 03:39:40'),
(2, 2, 5, '2026-10-13 03:39:40', '2026-10-13 03:39:40');

-- -----------------------------------------------------------------------------
-- Table structure for table `users`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) NULL DEFAULT NULL,
  `phone` varchar(255) NULL DEFAULT NULL,
  `avatar` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `phone`, `avatar`, `status`, `last_login_at`, `deleted_at`) VALUES
(1, 'Alexander Vance', 'admin@modernjewelleryhouse.com', NULL, '$2y$12$HUn4xVvPs3N6LeFJv51LXuDtl4KTeV2T6jN2uWC4MDWOJbPCnSLxa', NULL, '2026-10-13 03:39:39', '2026-10-13 03:39:39', 1, '+1 (212) 555-0198', NULL, 'active', '2026-10-13 03:39:39', NULL),
(2, 'Elena Rostova', 'elena@modernjewelleryhouse.com', NULL, '$2y$12$F5jUmShookxxDsFw9AdR0edZjTi7abFnW6hvMImud.e5E.sfbJ7AK', NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', 5, '+1 (415) 555-0142', NULL, 'active', '2026-10-13 03:39:40', NULL);

-- -----------------------------------------------------------------------------
-- Table structure for table `categories`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NULL DEFAULT NULL,
  `image_path` varchar(255) NULL DEFAULT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `image_path`, `sort_order`, `is_active`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Rings', 'rings', 'Sculptural solitaires, ceremonial bands, and statement cocktail rings fashioned in 18k gold and platinum.', NULL, 1, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(2, NULL, 'Necklaces', 'necklaces', 'Delicate diamond colliers, bespoke pendants, and cascade chains calibrated for timeless grace.', NULL, 2, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(3, NULL, 'Earrings', 'earrings', 'Architectural drops, pavé huggies, and high jewellery chandeliers capturing every facet of light.', NULL, 3, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(4, NULL, 'Bracelets', 'bracelets', 'Rigid cuff bracelets, articulated tennis ribbons, and sculptural chains engineered for subtle presence.', NULL, 4, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(5, NULL, 'High Jewellery', 'high-jewellery', 'One-of-a-kind masterworks handcrafted by master lapidaries with rare untreated gemstones.', NULL, 5, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL);

-- -----------------------------------------------------------------------------
-- Table structure for table `collections`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) NULL DEFAULT NULL,
  `description` text NULL DEFAULT NULL,
  `cover_image` varchar(255) NULL DEFAULT NULL,
  `banner_image` varchar(255) NULL DEFAULT NULL,
  `is_featured` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `collections`
INSERT INTO `collections` (`id`, `name`, `slug`, `subtitle`, `description`, `cover_image`, `banner_image`, `is_featured`, `is_active`, `sort_order`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Heritage Noir', 'heritage-noir', 'Bold contrasts in blackened platinum and emerald-cut solitaire diamonds', 'A nocturnal dialogue between shadow and luminescence, designed for the modern connoisseur.', NULL, NULL, 1, 1, 1, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(2, 'L\'Aura Eternelle', 'laura-eternelle', 'Fluid curves in warm 18k yellow gold and river pearls', 'Organic contours echoing classical antiquity through a minimalist contemporary sensibility.', NULL, NULL, 1, 1, 2, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL),
(3, 'Solitaire Lumière', 'solitaire-lumiere', 'Purist diamond solitaires cut to ideal optical symmetry', 'The purest expression of light, featuring conflict-free diamonds set in whisper-thin bezel and prongs.', NULL, NULL, 1, 1, 3, NULL, NULL, '2026-10-13 03:39:40', '2026-10-13 03:39:40', NULL);

-- -----------------------------------------------------------------------------
-- Table structure for table `products`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `collection_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `tagline` varchar(255) NULL DEFAULT NULL,
  `short_description` text NULL DEFAULT NULL,
  `description` text NULL DEFAULT NULL,
  `metal_type` varchar(255) NULL DEFAULT NULL,
  `gemstone_type` varchar(255) NULL DEFAULT NULL,
  `base_price` decimal(12,2) NOT NULL,
  `compare_at_price` decimal(12,2) NULL DEFAULT NULL,
  `cost_price` decimal(12,2) NULL DEFAULT NULL,
  `is_featured` bigint(20) NOT NULL DEFAULT '0',
  `is_new_arrival` bigint(20) NOT NULL DEFAULT '0',
  `is_bestseller` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `status` varchar(255) NOT NULL DEFAULT 'published',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `badge` varchar(255) NULL DEFAULT NULL,
  `purity` varchar(255) NULL DEFAULT NULL,
  `weight` varchar(255) NULL DEFAULT NULL,
  `stone` text NULL DEFAULT NULL,
  `certification` varchar(255) NULL DEFAULT NULL,
  `certificate_number` varchar(255) NULL DEFAULT NULL,
  `certificate_file` varchar(255) NULL DEFAULT NULL,
  `dimensions` varchar(255) NULL DEFAULT NULL,
  `occasion` varchar(255) NULL DEFAULT NULL,
  `available_sizes` text NULL DEFAULT NULL,
  `3d_model_url` varchar(255) NULL DEFAULT NULL,
  `3d_model_provider` varchar(255) NULL DEFAULT 'model-viewer',
  `3d_model_enabled` bigint(20) NOT NULL DEFAULT '0',
  `rating` decimal(12,2) NOT NULL DEFAULT '4.9',
  `reviews_count` bigint(20) NOT NULL DEFAULT '14',
  `viewer_type` varchar(255) NULL DEFAULT 'model-viewer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `products`
INSERT INTO `products` (`id`, `category_id`, `collection_id`, `name`, `slug`, `sku`, `tagline`, `short_description`, `description`, `metal_type`, `gemstone_type`, `base_price`, `compare_at_price`, `cost_price`, `is_featured`, `is_new_arrival`, `is_bestseller`, `is_active`, `status`, `published_at`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`, `badge`, `purity`, `weight`, `stone`, `certification`, `certificate_number`, `certificate_file`, `dimensions`, `occasion`, `available_sizes`, `3d_model_url`, `3d_model_provider`, `3d_model_enabled`, `rating`, `reviews_count`, `viewer_type`) VALUES
(1, 1, 3, 'The Aurelia Solitaire Diamond Ring', 'aurelia-solitaire-diamond-ring', 'MJH-RNG-001', 'A 2.15ct cushion-cut brilliant diamond seated in sculptural 18k yellow gold', 'Cast in warm 18k gold with a knife-edge band and hidden pavé gallery for unmatched scintillation.', 'The Aurelia Solitaire is hand-forged in our atelier, centering a GIA-certified 2.15-carat cushion brilliant diamond of F colour and VVS1 clarity. The whisper-thin knife-edge shank creates the illusion that the diamond floats weightlessly above the finger, illuminated from beneath by a concealed platinum under-halo.', '18k Yellow Gold & Platinum', 'Natural Diamond (2.15ct, F / VVS1)', 14800, 16500, NULL, 1, 0, 1, 1, 'published', '2026-10-13 03:39:41', 'The Aurelia Solitaire Diamond Ring | Modern Jewellery House', 'Cast in warm 18k gold with a knife-edge band and hidden pavé gallery for unmatched scintillation.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(2, 2, 1, 'Étoile Cascade Diamond Collier', 'etoile-cascade-diamond-collier', 'MJH-NCK-002', 'Graduated emerald-cut diamonds articulating along the collarbone', 'An articulated line of 42 emerald-cut diamonds totaling 9.40 carats in solid 18k white gold.', 'Articulated with seamless mechanical precision, the Étoile Cascade necklace rests against the neckline like liquid light. Each diamond has been hand-selected for matching depth ratio and table percentage, culminating in a drop of architectural elegance.', '18k White Gold', 'Emerald-Cut Diamonds (9.40ct total)', 28500, NULL, NULL, 1, 1, 0, 1, 'published', '2026-10-13 03:39:41', 'Étoile Cascade Diamond Collier | Modern Jewellery House', 'An articulated line of 42 emerald-cut diamonds totaling 9.40 carats in solid 18k white gold.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(3, 4, 2, 'Paloma Sculptural Gold Cuff', 'paloma-sculptural-gold-cuff', 'MJH-BRC-003', 'Hand-satinized heavy 18k yellow gold with fluted taper edges', 'Bold contemporary minimalism with an ergonomic hinged clasp and brushed silk finish.', 'Substantial yet feather-light on the wrist, the Paloma Cuff is hand-sculpted in solid 18k gold. The exterior features a hand-hammered satin finish while the interior is polished to a mirror gleam, offering an intimate tactile sensation throughout the day.', '18k Yellow Gold', 'None (Pure 18k Solid Gold)', 8900, NULL, NULL, 1, 1, 1, 1, 'published', '2026-10-13 03:39:41', 'Paloma Sculptural Gold Cuff | Modern Jewellery House', 'Bold contemporary minimalism with an ergonomic hinged clasp and brushed silk finish.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(4, 3, 1, 'Verdant Empress Colombian Emerald Drops', 'verdant-empress-emerald-drops', 'MJH-EAR-004', 'Matched Muzo Colombian emeralds framed by trapeze-cut diamonds', 'Unheated 4.80ct total emeralds radiating deep forest hue in 18k yellow gold bezels.', 'Culled from the fabled Muzo mines of Colombia, these emeralds possess the elusive “jardin” inner glow that defines true gemstone royalty. Accented with step-cut trapeze diamonds, they swing with graceful movement while remaining impeccably poised.', '18k Yellow Gold & Platinum', 'Colombian Emerald (4.80ct) & Diamonds (1.20ct)', 19200, 21000, NULL, 1, 0, 0, 1, 'published', '2026-10-13 03:39:41', 'Verdant Empress Colombian Emerald Drops | Modern Jewellery House', 'Unheated 4.80ct total emeralds radiating deep forest hue in 18k yellow gold bezels.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(5, 4, 3, 'Sovereign Diamond Tennis Bracelet', 'sovereign-diamond-tennis-bracelet', 'MJH-BRC-005', 'A continuous stream of bezel-set round brilliant diamonds in 18k white gold', '5.50 carats of VS1 diamonds engineered with a dual-safety concealed clasp.', 'A cornerstone piece reimagined. Rather than traditional prongs, each diamond is encased in a low-profile hexagonal bezel that prevents snagging and maximizes everyday wearability without losing an ounce of brilliance.', '18k White Gold', 'Round Brilliant Diamonds (5.50ct total)', 11400, 12800, NULL, 0, 1, 1, 1, 'published', '2026-10-13 03:39:41', 'Sovereign Diamond Tennis Bracelet | Modern Jewellery House', '5.50 carats of VS1 diamonds engineered with a dual-safety concealed clasp.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(6, 2, 2, 'Celestial Baroque Pearl Drop Pendant', 'celestial-baroque-pearl-pendant', 'MJH-NCK-006', 'Australian South Sea baroque pearl capped with 18k fluted gold and diamonds', 'A luminous 15mm natural pearl on an adjustable 20-inch diamond-cut wheat chain.', 'No two baroque pearls are identical. This piece honors natural asymmetry with an iridescent pearl hand-selected for its mirror-like orient luster, crowned by a starburst cap set with micro-pavé diamonds.', '18k Yellow Gold', 'South Sea Pearl (15mm) & Diamonds (0.35ct)', 5800, NULL, NULL, 0, 1, 0, 1, 'published', '2026-10-13 03:39:41', 'Celestial Baroque Pearl Drop Pendant | Modern Jewellery House', 'A luminous 15mm natural pearl on an adjustable 20-inch diamond-cut wheat chain.', '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 14, 'model-viewer'),
(7, 1, NULL, 'The Della Ring', 'the-della-ring', 'BS-RNG-0101', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Della Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt White Gold, Diamonds', NULL, 16564, 22085, NULL, 1, 1, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, '18K', '2.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.6, 12, 'model-viewer'),
(8, 1, NULL, 'The Ricarda Ring', 'the-ricarda-ring', 'BS-RNG-0102', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Ricarda Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Two-Tone Gold, Diamonds', NULL, 24180, 28450, NULL, 1, 0, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '2.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.7, 19, 'model-viewer'),
(9, 1, NULL, 'The Danita Ring', 'the-danita-ring', 'BS-RNG-0103', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Danita Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose Gold, Diamonds', NULL, 21650, 26000, NULL, 1, 0, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '3', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 26, 'model-viewer'),
(10, 1, NULL, 'The Euphemia Ring', 'the-euphemia-ring', 'BS-RNG-0104', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Euphemia Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '22Kt Yellow Gold', NULL, 18420, 20466, NULL, 1, 1, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '22K', '3.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 33, 'model-viewer'),
(11, 1, NULL, 'The Mirabella Band', 'the-mirabella-band', 'BS-RNG-0105', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Mirabella Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold', NULL, 23100, 25666, NULL, 1, 0, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '3.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 40, 'model-viewer'),
(12, 1, NULL, 'The Carlotta Ring', 'the-carlotta-ring', 'BS-RNG-0106', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Carlotta Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose Gold, Diamonds', NULL, 19850, 24812, NULL, 1, 0, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '3.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.6, 47, 'model-viewer'),
(13, 1, NULL, 'The Valeria Pavé Ring', 'the-valeria-pave-ring', 'BS-RNG-0107', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Valeria Pavé Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Diamonds', NULL, 27400, 34250, NULL, 1, 1, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '4', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.7, 54, 'model-viewer'),
(14, 1, NULL, 'The Aurelia Pearl Ring', 'the-aurelia-pearl-ring', 'BS-RNG-0108', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Aurelia Pearl Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Fresh Pearl', NULL, 31200, 39000, NULL, 1, 0, 1, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '4.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 61, 'model-viewer'),
(15, 1, NULL, 'The Signet Enamel Ring', 'the-signet-enamel-ring', 'BS-RNG-0109', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Signet Enamel Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Black Enamel', NULL, 52054, 57837, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '4.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 68, 'model-viewer'),
(16, 1, NULL, 'The Onyx Duo Ring', 'the-onyx-duo-ring', 'BS-RNG-0110', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Onyx Duo Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose Gold, Black Onyx', NULL, 19420, 24275, NULL, 1, 1, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '4.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 75, 'model-viewer'),
(17, 1, NULL, 'The Grand Pavé Cluster', 'the-grand-pave-cluster', 'BS-RNG-0111', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Grand Pavé Cluster, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt White Gold, 1.2ct Diamonds', NULL, 61400, 76750, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.6, 82, 'model-viewer'),
(18, 1, NULL, 'The Twin Infinity Ring', 'the-twin-infinity-ring', 'BS-RNG-0112', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Twin Infinity Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Two-Tone Gold', NULL, 15129, 16810, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '5.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.7, 89, 'model-viewer'),
(19, 1, NULL, 'The Classic Comfort Band', 'the-classic-comfort-band', 'BS-RNG-0113', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Classic Comfort Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '22Kt Yellow Gold', NULL, 14560, 16177, NULL, 1, 1, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '22K', '5.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 96, 'model-viewer'),
(20, 1, NULL, 'The Geometric Open Band', 'the-geometric-open-band', 'BS-RNG-0114', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Geometric Open Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold', NULL, 24800, 31000, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '5.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 103, 'model-viewer'),
(21, 1, NULL, 'The Triangle Solitaire Ring', 'the-triangle-solitaire-ring', 'BS-RNG-0115', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Triangle Solitaire Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose Gold, Diamond', NULL, 18900, 23625, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '6', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 110, 'model-viewer'),
(22, 1, NULL, 'The Bold Domed Gold Band', 'the-bold-domed-gold-band', 'BS-RNG-0116', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Bold Domed Gold Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '22Kt Yellow Gold', NULL, 46700, 51888, NULL, 1, 1, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '22K', '6.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.6, 117, 'model-viewer'),
(23, 1, NULL, 'The Full Eternity Band', 'the-full-eternity-band', 'BS-RNG-0117', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Full Eternity Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt White Gold, Diamonds', NULL, 48200, 60250, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '6.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.7, 124, 'model-viewer'),
(24, 1, NULL, 'The Rectangular Silhouette Ring', 'the-rectangular-silhouette-ring', 'BS-RNG-0118', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Rectangular Silhouette Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold', NULL, 16400, 18222, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '6.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 131, 'model-viewer'),
(25, 1, NULL, 'The Ceramic Fusion Ring', 'the-ceramic-fusion-ring', 'BS-RNG-0119', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Ceramic Fusion Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Black Ceramic', NULL, 28900, 36125, NULL, 1, 1, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '7', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 138, 'model-viewer'),
(26, 1, NULL, 'The Baron Diamond Signet', 'the-baron-diamond-signet', 'BS-RNG-0120', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Baron Diamond Signet, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Pavé Diamonds', NULL, 58400, 64888, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '7.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.9, 145, 'model-viewer'),
(27, 1, NULL, 'The Criss Cross Diamond Band', 'the-criss-cross-diamond-band', 'BS-RNG-0121', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Criss Cross Diamond Band, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose Gold, Diamonds', NULL, 36800, 46000, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '7.5', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.6, 152, 'model-viewer'),
(28, 1, NULL, 'The Marquise Crown Ring', 'the-marquise-crown-ring', 'BS-RNG-0122', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Marquise Crown Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Marquise Diamond', NULL, 32100, 40125, NULL, 1, 1, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '7.75', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.7, 159, 'model-viewer'),
(29, 1, NULL, 'The Bypass Twirl Ring', 'the-bypass-twirl-ring', 'BS-RNG-0123', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Bypass Twirl Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Yellow Gold, Diamonds', NULL, 22500, 28125, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '8', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 166, 'model-viewer'),
(30, 1, NULL, 'The Splendour Multi-Row Ring', 'the-splendour-multi-row-ring', 'BS-RNG-0124', 'Certified Hallmark 18Kt / 22Kt Gold', 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.', 'Discover exceptional brilliance with The Splendour Multi-Row Ring, inspired by contemporary Indian architectural forms and timeless heirloom motifs.', '18Kt Rose & White Gold, Diamonds', NULL, 75800, 94750, NULL, 1, 0, 0, 1, 'published', NULL, NULL, NULL, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL, NULL, '18K', '8.25', NULL, 'BIS Hallmarked & SGL Certified', NULL, NULL, NULL, NULL, NULL, NULL, 'model-viewer', 0, 4.8, 173, 'model-viewer');

-- -----------------------------------------------------------------------------
-- Table structure for table `product_variants`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `metal_color` varchar(255) NULL DEFAULT NULL,
  `size` varchar(255) NULL DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `compare_at_price` decimal(12,2) NULL DEFAULT NULL,
  `weight_grams` decimal(12,2) NULL DEFAULT NULL,
  `diamond_carat` decimal(12,2) NULL DEFAULT NULL,
  `is_default` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `product_variants`
INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `title`, `metal_color`, `size`, `price`, `compare_at_price`, `weight_grams`, `diamond_carat`, `is_default`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'MJH-RNG-001-2AA8', 'Size 6 / 18k Yellow Gold', 'Yellow Gold', '6', 14800, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(2, 1, 'MJH-RNG-001-F524', 'Size 7 / 18k Yellow Gold', 'Yellow Gold', '7', 14800, NULL, NULL, NULL, 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(3, 1, 'MJH-RNG-001-A10F', 'Size 6 / Platinum 950', 'Platinum', '6', 15600, NULL, NULL, NULL, 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(4, 2, 'MJH-NCK-002-63FF', '16-Inch Choker Length', 'White Gold', '16\"', 28500, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(5, 2, 'MJH-NCK-002-319B', '18-Inch Standard Collar', 'White Gold', '18\"', 31200, NULL, NULL, NULL, 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(6, 3, 'MJH-BRC-003-D99E', 'Small (15.5cm wrist)', 'Yellow Gold', 'S', 8900, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(7, 3, 'MJH-BRC-003-61B5', 'Medium (17cm wrist)', 'Yellow Gold', 'M', 9200, NULL, NULL, NULL, 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(8, 4, 'MJH-EAR-004-3227', 'One Size / Post & French Clip', 'Yellow Gold', 'Standard', 19200, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(9, 5, 'MJH-BRC-005-9BD7', '7-Inch Length', 'White Gold', '7\"', 11400, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(10, 6, 'MJH-NCK-006-1A40', 'Adjustable 18-20 Inch Chain', 'Yellow Gold', '20\"', 5800, NULL, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(11, 7, 'BS-RNG-0101-SZ14', 'Size 14 - 18Kt White Gold, Diamonds', 'Yellow Gold', '14', 16564, 22085, NULL, NULL, 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL),
(12, 8, 'BS-RNG-0102-SZ14', 'Size 14 - 18Kt Two-Tone Gold, Diamonds', 'Yellow Gold', '14', 24180, 28450, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(13, 9, 'BS-RNG-0103-SZ14', 'Size 14 - 18Kt Rose Gold, Diamonds', 'Yellow Gold', '14', 21650, 26000, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(14, 10, 'BS-RNG-0104-SZ14', 'Size 14 - 22Kt Yellow Gold', 'Yellow Gold', '14', 18420, 20466, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(15, 11, 'BS-RNG-0105-SZ14', 'Size 14 - 18Kt Yellow Gold', 'Yellow Gold', '14', 23100, 25666, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(16, 12, 'BS-RNG-0106-SZ14', 'Size 14 - 18Kt Rose Gold, Diamonds', 'Yellow Gold', '14', 19850, 24812, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(17, 13, 'BS-RNG-0107-SZ14', 'Size 14 - 18Kt Yellow Gold, Diamonds', 'Yellow Gold', '14', 27400, 34250, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(18, 14, 'BS-RNG-0108-SZ14', 'Size 14 - 18Kt Yellow Gold, Fresh Pearl', 'Yellow Gold', '14', 31200, 39000, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(19, 15, 'BS-RNG-0109-SZ14', 'Size 14 - 18Kt Yellow Gold, Black Enamel', 'Yellow Gold', '14', 52054, 57837, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(20, 16, 'BS-RNG-0110-SZ14', 'Size 14 - 18Kt Rose Gold, Black Onyx', 'Yellow Gold', '14', 19420, 24275, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(21, 17, 'BS-RNG-0111-SZ14', 'Size 14 - 18Kt White Gold, 1.2ct Diamonds', 'Yellow Gold', '14', 61400, 76750, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(22, 18, 'BS-RNG-0112-SZ14', 'Size 14 - 18Kt Two-Tone Gold', 'Yellow Gold', '14', 15129, 16810, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(23, 19, 'BS-RNG-0113-SZ14', 'Size 14 - 22Kt Yellow Gold', 'Yellow Gold', '14', 14560, 16177, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(24, 20, 'BS-RNG-0114-SZ14', 'Size 14 - 18Kt Yellow Gold', 'Yellow Gold', '14', 24800, 31000, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(25, 21, 'BS-RNG-0115-SZ14', 'Size 14 - 18Kt Rose Gold, Diamond', 'Yellow Gold', '14', 18900, 23625, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(26, 22, 'BS-RNG-0116-SZ14', 'Size 14 - 22Kt Yellow Gold', 'Yellow Gold', '14', 46700, 51888, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(27, 23, 'BS-RNG-0117-SZ14', 'Size 14 - 18Kt White Gold, Diamonds', 'Yellow Gold', '14', 48200, 60250, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(28, 24, 'BS-RNG-0118-SZ14', 'Size 14 - 18Kt Yellow Gold', 'Yellow Gold', '14', 16400, 18222, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(29, 25, 'BS-RNG-0119-SZ14', 'Size 14 - 18Kt Yellow Gold, Black Ceramic', 'Yellow Gold', '14', 28900, 36125, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(30, 26, 'BS-RNG-0120-SZ14', 'Size 14 - 18Kt Yellow Gold, Pavé Diamonds', 'Yellow Gold', '14', 58400, 64888, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(31, 27, 'BS-RNG-0121-SZ14', 'Size 14 - 18Kt Rose Gold, Diamonds', 'Yellow Gold', '14', 36800, 46000, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(32, 28, 'BS-RNG-0122-SZ14', 'Size 14 - 18Kt Yellow Gold, Marquise Diamond', 'Yellow Gold', '14', 32100, 40125, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(33, 29, 'BS-RNG-0123-SZ14', 'Size 14 - 18Kt Yellow Gold, Diamonds', 'Yellow Gold', '14', 22500, 28125, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL),
(34, 30, 'BS-RNG-0124-SZ14', 'Size 14 - 18Kt Rose & White Gold, Diamonds', 'Yellow Gold', '14', 75800, 94750, NULL, NULL, 1, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42', NULL);

-- -----------------------------------------------------------------------------
-- Table structure for table `product_images`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `variant_id` bigint(20) NULL DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) NULL DEFAULT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `is_primary` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `product_images`
INSERT INTO `product_images` (`id`, `product_id`, `variant_id`, `image_path`, `alt_text`, `sort_order`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', 'The Aurelia Solitaire Diamond Ring editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(2, 1, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', 'The Aurelia Solitaire Diamond Ring on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(3, 2, NULL, 'assets/images/etoile-cascade-diamond-collier-1.jpg', 'Étoile Cascade Diamond Collier editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(4, 2, NULL, 'assets/images/etoile-cascade-diamond-collier-2.jpg', 'Étoile Cascade Diamond Collier on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(5, 3, NULL, 'assets/images/paloma-sculptural-gold-cuff-1.jpg', 'Paloma Sculptural Gold Cuff editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(6, 3, NULL, 'assets/images/paloma-sculptural-gold-cuff-2.jpg', 'Paloma Sculptural Gold Cuff on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(7, 4, NULL, 'assets/images/verdant-empress-emerald-drops-1.jpg', 'Verdant Empress Colombian Emerald Drops editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(8, 4, NULL, 'assets/images/verdant-empress-emerald-drops-2.jpg', 'Verdant Empress Colombian Emerald Drops on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(9, 5, NULL, 'assets/images/sovereign-diamond-tennis-bracelet-1.jpg', 'Sovereign Diamond Tennis Bracelet editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(10, 5, NULL, 'assets/images/sovereign-diamond-tennis-bracelet-2.jpg', 'Sovereign Diamond Tennis Bracelet on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(11, 6, NULL, 'assets/images/celestial-baroque-pearl-pendant-1.jpg', 'Celestial Baroque Pearl Drop Pendant editorial studio front view', 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(12, 6, NULL, 'assets/images/celestial-baroque-pearl-pendant-2.jpg', 'Celestial Baroque Pearl Drop Pendant on-model perspective and craftsmanship detail', 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(13, 7, NULL, 'assets/images/collection-rings.jpg', NULL, 0, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(14, 7, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 1, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(15, 8, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(16, 8, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(17, 9, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(18, 9, NULL, 'assets/images/rings_fork.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(19, 10, NULL, 'assets/images/rings_fork.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(20, 10, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(21, 11, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(22, 11, NULL, 'assets/images/collection-rings.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(23, 12, NULL, 'assets/images/collection-rings.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(24, 12, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(25, 13, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(26, 13, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(27, 14, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(28, 14, NULL, 'assets/images/rings_fork.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(29, 15, NULL, 'assets/images/rings_fork.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(30, 15, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(31, 16, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(32, 16, NULL, 'assets/images/collection-rings.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(33, 17, NULL, 'assets/images/collection-rings.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(34, 17, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(35, 18, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(36, 18, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(37, 19, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(38, 19, NULL, 'assets/images/rings_fork.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(39, 20, NULL, 'assets/images/rings_fork.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(40, 20, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(41, 21, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(42, 21, NULL, 'assets/images/collection-rings.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(43, 22, NULL, 'assets/images/collection-rings.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(44, 22, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(45, 23, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(46, 23, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(47, 24, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(48, 24, NULL, 'assets/images/rings_fork.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(49, 25, NULL, 'assets/images/rings_fork.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(50, 25, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42');
INSERT INTO `product_images` (`id`, `product_id`, `variant_id`, `image_path`, `alt_text`, `sort_order`, `is_primary`, `created_at`, `updated_at`) VALUES
(51, 26, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(52, 26, NULL, 'assets/images/collection-rings.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(53, 27, NULL, 'assets/images/collection-rings.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(54, 27, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(55, 28, NULL, 'assets/images/aurelia-solitaire-diamond-ring-1.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(56, 28, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(57, 29, NULL, 'assets/images/aurelia-solitaire-diamond-ring-2.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(58, 29, NULL, 'assets/images/rings_fork.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(59, 30, NULL, 'assets/images/rings_fork.jpg', NULL, 0, 1, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(60, 30, NULL, 'assets/images/wish_flower_ring.jpg', NULL, 1, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42');

-- -----------------------------------------------------------------------------
-- Table structure for table `product_videos`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `product_videos`;
CREATE TABLE `product_videos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `video_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) NULL DEFAULT NULL,
  `title` varchar(255) NULL DEFAULT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `inventory`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_variant_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `reserved_quantity` bigint(20) NOT NULL DEFAULT '0',
  `low_stock_threshold` bigint(20) NOT NULL DEFAULT '2',
  `allow_backorder` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `inventory`
INSERT INTO `inventory` (`id`, `product_variant_id`, `quantity`, `reserved_quantity`, `low_stock_threshold`, `allow_backorder`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(2, 2, 2, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(3, 3, 1, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(4, 4, 2, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(5, 5, 1, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(6, 6, 4, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(7, 7, 3, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(8, 8, 1, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(9, 9, 5, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(10, 10, 3, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(11, 11, 10, 0, 2, 0, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(12, 12, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(13, 13, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(14, 14, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(15, 15, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(16, 16, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(17, 17, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(18, 18, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(19, 19, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(20, 20, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(21, 21, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(22, 22, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(23, 23, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(24, 24, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(25, 25, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(26, 26, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(27, 27, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(28, 28, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(29, 29, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(30, 30, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(31, 31, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(32, 32, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(33, 33, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42'),
(34, 34, 10, 0, 2, 0, '2026-10-13 03:39:42', '2026-10-13 03:39:42');

-- -----------------------------------------------------------------------------
-- Table structure for table `inventory_movements`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `inventory_movements`;
CREATE TABLE `inventory_movements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventory_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `quantity_change` bigint(20) NOT NULL,
  `previous_quantity` bigint(20) NOT NULL,
  `new_quantity` bigint(20) NOT NULL,
  `reference_type` varchar(255) NULL DEFAULT NULL,
  `reference_id` bigint(20) NULL DEFAULT NULL,
  `reason` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `carts`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `session_id` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `coupon_code` varchar(255) NULL DEFAULT NULL,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `cart_items`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_variant_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '1',
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `custom_engraving` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `wishlists`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'My Wishlist',
  `share_token` varchar(255) NULL DEFAULT NULL,
  `is_public` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `wishlist_items`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `wishlist_items`;
CREATE TABLE `wishlist_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wishlist_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_variant_id` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `addresses`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'shipping',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company` varchar(255) NULL DEFAULT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NULL DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'US',
  `phone` varchar(255) NOT NULL,
  `is_default` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `coupons`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` decimal(12,2) NOT NULL,
  `min_order_amount` decimal(12,2) NULL DEFAULT NULL,
  `max_discount_amount` decimal(12,2) NULL DEFAULT NULL,
  `usage_limit` bigint(20) NULL DEFAULT NULL,
  `usage_limit_per_user` bigint(20) NULL DEFAULT '1',
  `times_used` bigint(20) NOT NULL DEFAULT '0',
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `applicable_products` text NULL DEFAULT NULL,
  `applicable_categories` text NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `coupons`
INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_order_amount`, `max_discount_amount`, `usage_limit`, `usage_limit_per_user`, `times_used`, `starts_at`, `expires_at`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `applicable_products`, `applicable_categories`) VALUES
(1, 'MAISON10', 'percentage', 10, 1000, 2000, 100, 1, 0, NULL, NULL, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41', NULL, NULL, NULL);

-- -----------------------------------------------------------------------------
-- Table structure for table `coupon_usages`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `coupon_usages`;
CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `discount_applied` decimal(12,2) NOT NULL,
  `used_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `order_items`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NULL DEFAULT NULL,
  `product_variant_id` bigint(20) NULL DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_title` varchar(255) NULL DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '1',
  `subtotal` decimal(12,2) NOT NULL,
  `custom_engraving` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `refunds`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `refunds`;
CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `payment_id` bigint(20) NULL DEFAULT NULL,
  `refund_number` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'requested',
  `processed_by` bigint(20) NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `review_images`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `review_images`;
CREATE TABLE `review_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `review_id` bigint(20) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `banners`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NULL DEFAULT NULL,
  `tagline` varchar(255) NULL DEFAULT NULL,
  `cta_text` varchar(255) NULL DEFAULT NULL,
  `cta_link` varchar(255) NULL DEFAULT NULL,
  `image_desktop` varchar(255) NOT NULL,
  `image_mobile` varchar(255) NULL DEFAULT NULL,
  `placement` varchar(255) NOT NULL DEFAULT 'home_hero',
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `banners`
INSERT INTO `banners` (`id`, `title`, `subtitle`, `tagline`, `cta_text`, `cta_link`, `image_desktop`, `image_mobile`, `placement`, `sort_order`, `is_active`, `starts_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, 'The Architecture of Radiance', 'High jewellery meticulously crafted for modern legacy.', 'AUTUMN / WINTER MAISON COLLECTION', 'Explore Fine Jewellery', 'http://127.0.0.1:8000/fine-jewellery', 'assets/images/hero-luxury.jpg', NULL, 'home_hero', 1, 1, NULL, NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(2, 'Complimentary worldwide insured courier & bespoke gift presentation with every commission.', NULL, NULL, 'Read Our Guarantees', '#', '', NULL, 'announcement', 1, 1, NULL, NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41');

-- -----------------------------------------------------------------------------
-- Table structure for table `pages`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NULL DEFAULT NULL,
  `content` text NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT 'default',
  `is_published` bigint(20) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `faqs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL DEFAULT 'General',
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `faqs`
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Craftsmanship', 'How are Modern Jewellery House diamonds sourced?', 'Every diamond selected by our gemological directors is strictly conflict-free, adhering to the highest standards of the Kimberley Process and accompanied by GIA grading certificates.', 1, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(2, 'Craftsmanship', 'What precious metals are used in your creations?', 'We forge solely in certified recycled 18-karat gold (yellow, rose, white) and 950 purity platinum, ensuring enduring structural integrity and hypoallergenic wear.', 2, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(3, 'Concierge & Delivery', 'How are creations shipped and insured?', 'All shipments travel via armored courier with comprehensive door-to-door transit insurance and require an adult signature upon white-glove arrival.', 3, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(4, 'Services', 'Do you provide bespoke engraving and sizing?', 'Yes. Complimentary laser or hand engraving is offered on eligible rings and pendants. Sizing adjustments are performed with pleasure within 60 days of delivery.', 4, 1, '2026-10-13 03:39:41', '2026-10-13 03:39:41');

-- -----------------------------------------------------------------------------
-- Table structure for table `notifications`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `settings`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NULL DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `description` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `settings`
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'brand_name', 'Modern Jewellery House', 'branding', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(2, 'brand_tagline', 'Contemporary Fine Jewellery & Haute Horlogerie', 'branding', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(3, 'concierge_phone', '+1 (800) 492-9180', 'contact', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(4, 'concierge_email', 'concierge@modernjewelleryhouse.com', 'contact', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(5, 'currency_symbol', '$', 'localization', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41'),
(6, 'currency_code', 'USD', 'localization', 'string', NULL, '2026-10-13 03:39:41', '2026-10-13 03:39:41');

-- -----------------------------------------------------------------------------
-- Table structure for table `admin_activity_logs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `admin_activity_logs`;
CREATE TABLE `admin_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity_type` varchar(255) NULL DEFAULT NULL,
  `entity_id` bigint(20) NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` text NULL DEFAULT NULL,
  `details` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `recently_viewed_products`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `recently_viewed_products`;
CREATE TABLE `recently_viewed_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `session_id` varchar(255) NULL DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `viewed_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `orders`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PAYMENT_PENDING',
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `subtotal` decimal(12,2) NOT NULL,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) NULL DEFAULT NULL,
  `shipping_fee` decimal(12,2) NOT NULL DEFAULT '0',
  `tax_amount` decimal(12,2) NOT NULL DEFAULT '0',
  `total_amount` decimal(12,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_method` varchar(255) NOT NULL DEFAULT 'Complimentary Insured Courier',
  `tracking_number` varchar(255) NULL DEFAULT NULL,
  `customer_notes` text NULL DEFAULT NULL,
  `admin_notes` text NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `razorpay_order_id` varchar(255) NULL DEFAULT NULL,
  `razorpay_payment_id` varchar(255) NULL DEFAULT NULL,
  `razorpay_signature` varchar(255) NULL DEFAULT NULL,
  `pincode` varchar(255) NULL DEFAULT NULL,
  `expected_delivery_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `payments`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'razorpay',
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `gateway_transaction_id` varchar(255) NULL DEFAULT NULL,
  `gateway_payload` text NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gateway_order_id` varchar(255) NULL DEFAULT NULL,
  `gateway_signature` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for table `reviews`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `order_id` bigint(20) NULL DEFAULT NULL,
  `rating` bigint(20) NOT NULL,
  `title` varchar(255) NULL DEFAULT NULL,
  `comment` text NOT NULL,
  `is_verified_buyer` bigint(20) NOT NULL DEFAULT '0',
  `is_approved` bigint(20) NOT NULL DEFAULT '0',
  `approved_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_featured` bigint(20) NOT NULL DEFAULT '0',
  `customer_name` varchar(255) NULL DEFAULT NULL,
  `customer_email` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
