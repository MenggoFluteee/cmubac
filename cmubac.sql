/*
 Navicat Premium Data Transfer

 Source Server         : localserver
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : cmubac

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 22/03/2025 16:50:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_codes
-- ----------------------------
DROP TABLE IF EXISTS `account_codes`;
CREATE TABLE `account_codes`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account_codes
-- ----------------------------
INSERT INTO `account_codes` VALUES (1, '50201010 00', 'Traveling Expenses - Local', '2025-02-12 10:41:27', '2025-03-04 16:54:22');
INSERT INTO `account_codes` VALUES (2, '50201020 00', 'Traveling Expenses - Foreign', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (3, '50202010 00', 'Training Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (4, '50202020 00', 'Scholarship Grants/Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (5, '50203010 01', 'ICT Office Supplies', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (6, '50203010 02', 'Office Supplies Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (7, '50203020 00', 'Accountable Forms Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (8, '50203090 00', 'Fuel, Oil and Lubricants Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (9, '50203990 00', 'Other Supplies and Materials Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (10, '50204010 00', 'Water Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (11, '50204020 00', 'Electricity Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (12, '50205010 00', 'Postage and Courier Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (13, '50205020 01', 'Telephone Expenses - Mobile', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (14, '50205020 01', 'Mobile', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (15, '50205030 00', 'Internet Subscription Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (16, '50205040 00', 'Cable, Satellite, Telegraph and Radio Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (17, '50207020 00', 'Research, Exploration and Development Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (18, '50210030 00', 'Extraordinary and Miscellaneous Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (19, '50211990 00', 'Other Professional Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (20, '50212020 00', 'Janitorial Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (21, '50212030 00', 'Security Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (22, '50212990 99', 'Other General Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (23, '50213040 02', 'Repairs and Maintenance- School Buildings', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (24, '50213040 99', 'Repairs and Maintenance- Other Structures', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (25, '50213050 02', 'Repairs and Maintenance- Office Equipment', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (26, '50213050 03', 'Repairs and Maintenance- ICT Equipment', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (27, '50213050 99', 'Repairs and Maintenance- Other Machinery and Equipment', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (28, '50213060 01', 'Repairs and Maintenance- Motor Vehicles', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (29, '50214990 00', 'Subsidies - Others', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (30, '50215020 00', 'Fidelity Bond Premiums', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (31, '50215030 00', 'Insurance Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (32, '50299010 00', 'Advertising Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (33, '50299020 00', 'Printing and Publication Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (34, '50299030 00', 'Representation Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (35, '50299060 00', 'Membership Dues and Contributions to ', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (36, '50299990 99', 'Other Maintenance and Operating Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (37, '50203040 00', 'Animal/Zoological Supplies Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (38, '50203080 00', 'Medical, Dental and Laboratory Supplies Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (39, '50203100 00', 'Agricultural and Marine Supplies Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (40, '50203210 00', 'Semi-Expendable Machinery and Equipment Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (41, '50203220 00', 'Semi-Expendable Furniture, Fixtures and Books Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (42, '50206010 01', 'Awards/Rewards Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (43, '50206010 02', 'Rewards and Incentives', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (44, '50206020 00', 'Prizes', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (45, '50211010 00', 'Legal Services', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (46, '50213050 14', 'Repairs and Maintenance - Technical and Scientific Equipment', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (47, '50215010 01', 'Taxes, Duties and Licenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (48, '50299070 99', 'Other Subscription Expenses', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (49, '50213050 04', 'Repairs and Maintenance- Agricultural and Forestry Equipment', '2025-02-12 10:41:27', '2025-02-12 10:41:27');
INSERT INTO `account_codes` VALUES (53, 'Sample', 'Sample', '2025-03-22 10:44:38', '2025-03-22 10:44:38');

-- ----------------------------
-- Table structure for budget_allocations
-- ----------------------------
DROP TABLE IF EXISTS `budget_allocations`;
CREATE TABLE `budget_allocations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `college_office_unit_id` bigint UNSIGNED NOT NULL,
  `whole_budget_id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `allocated_by` bigint UNSIGNED NOT NULL,
  `account_code_id` bigint UNSIGNED NOT NULL,
  `date_allocated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `budget_allocations_college_office_unit_id_foreign`(`college_office_unit_id` ASC) USING BTREE,
  INDEX `budget_allocations_whole_budget_id_foreign`(`whole_budget_id` ASC) USING BTREE,
  INDEX `budget_allocations_allocated_by_foreign`(`allocated_by` ASC) USING BTREE,
  INDEX `budget_allocations_account_code_id_foreign`(`account_code_id` ASC) USING BTREE,
  CONSTRAINT `budget_allocations_account_code_id_foreign` FOREIGN KEY (`account_code_id`) REFERENCES `account_codes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `budget_allocations_allocated_by_foreign` FOREIGN KEY (`allocated_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `budget_allocations_college_office_unit_id_foreign` FOREIGN KEY (`college_office_unit_id`) REFERENCES `college_office_units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `budget_allocations_whole_budget_id_foreign` FOREIGN KEY (`whole_budget_id`) REFERENCES `whole_budgets` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of budget_allocations
-- ----------------------------
INSERT INTO `budget_allocations` VALUES (1, 2, 1, 5000000, 3, 6, '2025-02-13 06:02:34', '2025-02-13 06:02:34', '2025-02-13 06:02:34');
INSERT INTO `budget_allocations` VALUES (2, 2, 2, 5000000, 3, 5, '2025-02-14 05:04:16', '2025-02-14 05:04:16', '2025-02-14 05:04:16');
INSERT INTO `budget_allocations` VALUES (4, 10, 1, 250000, 3, 6, '2025-02-27 06:10:20', '2025-02-27 06:10:20', '2025-02-27 06:10:20');
INSERT INTO `budget_allocations` VALUES (5, 2, 1, 300000, 3, 6, '2025-02-27 06:33:30', '2025-02-27 06:33:30', '2025-02-27 06:33:30');
INSERT INTO `budget_allocations` VALUES (6, 2, 1, 150000, 3, 6, '2025-03-04 16:37:12', '2025-03-04 16:37:12', '2025-03-04 16:37:12');
INSERT INTO `budget_allocations` VALUES (7, 2, 14, 1000000, 3, 6, '2025-03-04 17:05:47', '2025-03-04 17:05:47', '2025-03-04 17:05:47');
INSERT INTO `budget_allocations` VALUES (8, 2, 15, 1000000, 3, 6, '2025-03-12 13:18:33', '2025-03-12 13:18:33', '2025-03-12 13:18:33');
INSERT INTO `budget_allocations` VALUES (9, 2, 16, 500000, 3, 6, '2025-03-12 13:25:36', '2025-03-12 13:25:36', '2025-03-12 13:25:36');
INSERT INTO `budget_allocations` VALUES (10, 2, 15, 600000, 3, 41, '2025-03-12 13:52:37', '2025-03-12 13:52:37', '2025-03-12 13:52:37');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for canvass_items
-- ----------------------------
DROP TABLE IF EXISTS `canvass_items`;
CREATE TABLE `canvass_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `canvass_id` bigint UNSIGNED NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `file_attachment_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `canvass_items_canvas_id_foreign`(`canvass_id` ASC) USING BTREE,
  CONSTRAINT `canvass_items_canvas_id_foreign` FOREIGN KEY (`canvass_id`) REFERENCES `canvasses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of canvass_items
-- ----------------------------

-- ----------------------------
-- Table structure for canvasses
-- ----------------------------
DROP TABLE IF EXISTS `canvasses`;
CREATE TABLE `canvasses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_tin_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `approval_status` bigint NOT NULL,
  `submission_status` bigint NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `canvasses_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `canvasses_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `canvasses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `canvasses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of canvasses
-- ----------------------------
INSERT INTO `canvasses` VALUES (1, 'Request For Quotation', '(NP - Small Value) Below 50K', 'Sample', 'Sample', '09846512', 'Sample', 0, 0, 5, NULL, '2025-02-20 06:10:07', '2025-02-20 06:10:07');
INSERT INTO `canvasses` VALUES (2, 'Request For Quotation', '(NP - Small Value) Above 500K', 'Acer', 'Valencia City', '0912-345-6789', '984-516-512-789', 0, 0, 5, NULL, '2025-02-20 07:28:15', '2025-02-20 07:28:15');
INSERT INTO `canvasses` VALUES (3, 'Request For Quotation', '(NP - Small Value) Below 50K', 'Convenience Store', 'Lumbo, Musuan, Maramag', '0658-406-6846', '684-068-468-043', 0, 0, 5, NULL, '2025-02-20 07:29:10', '2025-02-20 07:29:10');
INSERT INTO `canvasses` VALUES (4, 'Request For Quotation', '(Shopping)', 'Sample', 'Sample', '0570-684-0846', '684-068-454-312', 0, 0, 5, NULL, '2025-02-20 07:36:28', '2025-02-20 07:36:28');

-- ----------------------------
-- Table structure for college_office_unit_categories
-- ----------------------------
DROP TABLE IF EXISTS `college_office_unit_categories`;
CREATE TABLE `college_office_unit_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of college_office_unit_categories
-- ----------------------------
INSERT INTO `college_office_unit_categories` VALUES (1, 'GAS', NULL, NULL);
INSERT INTO `college_office_unit_categories` VALUES (2, 'RESEARCH', NULL, NULL);
INSERT INTO `college_office_unit_categories` VALUES (3, 'HEID', NULL, NULL);
INSERT INTO `college_office_unit_categories` VALUES (4, 'AUXILLIARY', NULL, NULL);

-- ----------------------------
-- Table structure for college_office_units
-- ----------------------------
DROP TABLE IF EXISTS `college_office_units`;
CREATE TABLE `college_office_units`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `acronym` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `college_office_unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `college_office_unit_image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `college_office_units_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `college_office_units_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `college_office_unit_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of college_office_units
-- ----------------------------
INSERT INTO `college_office_units` VALUES (1, 'COA', 'College of Agriculture', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (2, 'CISC', 'College of Information Sciences and Computing', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (3, 'COEd', 'College of Education', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (4, 'COE', 'College of Engineering', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (5, 'CON', 'College of Nursing', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (6, 'OP', 'Office of President', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (7, 'OUPD', 'Office of the University Planning and Development', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (8, 'OUL', 'Legal Office', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (9, 'OSAS', 'Office of Student Affairs and Services', 4, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (10, 'OUA', 'Accounting Office', 1, NULL, NULL, '2025-03-04 16:50:32');
INSERT INTO `college_office_units` VALUES (11, 'OFMS', 'Office of Financial Management Service', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (12, 'OUR', 'Registrar\'s Office', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (13, 'OUGS', 'General Service - Common Supply', 4, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (14, 'OUS', 'Supply Office', 4, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (15, 'PTGC', 'PTGC', 4, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (16, 'UH', 'University Hospital', 4, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (17, 'CEBREM', 'CEBREM', 2, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (18, 'NPRDC', 'NPRDC', 2, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (19, 'RDE', 'RDE Congress', 2, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (20, 'SDD', 'SOFTWARE DEVELOPMENT DEPARTMENT', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (21, 'CFES', 'College of Forestry and Environmental Science', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (22, 'CAS', 'College of Arts and Sciences', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (23, 'CVM', 'College of Vet Med', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (24, 'CBM', 'College of Business Management', 3, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (25, 'OUBM', 'Budget Office', 1, NULL, NULL, NULL);
INSERT INTO `college_office_units` VALUES (27, 'BAC', 'Office of Budget and Awards Committee', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for item_categories
-- ----------------------------
DROP TABLE IF EXISTS `item_categories`;
CREATE TABLE `item_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item_categories
-- ----------------------------
INSERT INTO `item_categories` VALUES (1, 'ALCOHOL OR ACETONE BASED ANTISEPTICS', '502030000', 'ALCOHOL OR ACETONE BASED ANTISEPTICS', NULL, '2025-02-27 02:15:44');
INSERT INTO `item_categories` VALUES (2, 'ARTS AND CRAFTS EQUIPMENT AND ACCESSORIES AND SUPPLIES', '502030000', 'ARTS AND CRAFTS EQUIPMENT AND ACCESSORIES AND SUPPLIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (3, 'AUDIO AND VISUAL EQUIPMENT AND SUPPLIES', '502030000', 'AUDIO AND VISUAL EQUIPMENT AND SUPPLIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (4, 'BATTERIES AND CELLS AND ACCESSORIES', '502030000', 'BATTERIES AND CELLS AND ACCESSORIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (5, 'CLEANING EQUIPMENT AND SUPPLIES', '502030000', 'CLEANING EQUIPMENT AND SUPPLIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (6, 'COLOR COMPOUNDS AND DISPERSION', '502030000', 'COLOR COMPOUNDS AND DISPERSION', NULL, NULL);
INSERT INTO `item_categories` VALUES (7, 'CONSUMER ELECTRONICS', '502030000', 'CONSUMER ELECTRONICS', NULL, NULL);
INSERT INTO `item_categories` VALUES (8, 'FACE MASK', '502030000', 'FACE MASK', NULL, NULL);
INSERT INTO `item_categories` VALUES (9, 'FILMS', '502030000', 'FILMS', NULL, NULL);
INSERT INTO `item_categories` VALUES (10, 'FIRE FIGHTING EQUIPMENT', '502030000', 'FIRE FIGHTING EQUIPMENT', NULL, NULL);
INSERT INTO `item_categories` VALUES (11, 'FLAG OR ACCESSORIES', '502030000', 'FLAG OR ACCESSORIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (12, 'FURNITURE AND FURNISHINGS', '502030000', 'FURNITURE AND FURNISHINGS', NULL, NULL);
INSERT INTO `item_categories` VALUES (13, 'HEAT AND VENTILATION AND AIR CIRCULATION', '502030000', 'HEAT AND VENTILATION AND AIR CIRCULATION', NULL, NULL);
INSERT INTO `item_categories` VALUES (14, 'INFORMATION AND COMMUNICATION TECHNOLOGY (ICT) EQUIPMENT AND DEVICES AND ACCESSORIES', '502030000', 'INFORMATION AND COMMUNICATION TECHNOLOGY (ICT) EQUIPMENT AND DEVICES AND ACCESSORIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (15, 'LIGHTING AND FIXTURES AND ACCESSORIES', '502030000', 'LIGHTING AND FIXTURES AND ACCESSORIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (16, 'MANUFACTURING COMPONENTS AND SUPPLIES', '502030000', 'MANUFACTURING COMPONENTS AND SUPPLIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (17, 'MEASURING AND OBSERVING AND TESTING EQUIPMENT', '502030000', 'MEASURING AND OBSERVING AND TESTING EQUIPMENT', NULL, NULL);
INSERT INTO `item_categories` VALUES (18, 'OFFICE EQUIPMENT AND ACCESSORIES AND SUPPLIES', '502030000', 'OFFICE EQUIPMENT AND ACCESSORIES AND SUPPLIES', NULL, NULL);
INSERT INTO `item_categories` VALUES (19, 'PAPER MATERIALS AND PRODUCTS', '502030000', 'PAPER MATERIALS AND PRODUCTS', NULL, NULL);
INSERT INTO `item_categories` VALUES (20, 'PERFUMES OR COLOGNES OR FRAGRANCE', '502030000', 'PERFUMES OR COLOGNES OR FRAGRANCE', NULL, NULL);
INSERT INTO `item_categories` VALUES (21, 'PESTICIDES OR PEST REPELLENTS', '502030000', 'PESTICIDES OR PEST REPELLENTS', NULL, NULL);
INSERT INTO `item_categories` VALUES (22, 'PRINTED PUBLICATIONS', '502030000', 'PRINTED PUBLICATIONS', NULL, NULL);
INSERT INTO `item_categories` VALUES (23, 'PRINTER OR FACSIMILE OR PHOTOCOPIER SUPPLIES (CONSUMABLES)', '502030000', 'PRINTER OR FACSIMILE OR PHOTOCOPIER SUPPLIES (CONSUMABLES)', NULL, NULL);
INSERT INTO `item_categories` VALUES (24, 'SOFTWARE', '502030000', 'SOFTWARE', NULL, NULL);
INSERT INTO `item_categories` VALUES (25, 'University Hospital Medicine', '502030000', 'University Hospital Medicine', NULL, NULL);
INSERT INTO `item_categories` VALUES (26, 'MEDICINE AND MEDICAL EQUIPMENTS', '502030000', 'MEDICINE AND MEDICAL EQUIPMENTS', NULL, NULL);

-- ----------------------------
-- Table structure for item_prices
-- ----------------------------
DROP TABLE IF EXISTS `item_prices`;
CREATE TABLE `item_prices`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` bigint UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `year` int NOT NULL,
  `is_active` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_prices_item_id_foreign`(`item_id` ASC) USING BTREE,
  CONSTRAINT `item_prices_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 263 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item_prices
-- ----------------------------
INSERT INTO `item_prices` VALUES (18, 1, 72.03, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (19, 2, 443.51, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (20, 3, 43.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (21, 4, 45.16, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (22, 5, 10.26, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (23, 6, 27.57, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (24, 7, 55.54, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (25, 8, 71.04, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (26, 9, 27.57, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (27, 10, 55.54, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (28, 11, 71.04, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (29, 12, 27.57, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (30, 13, 56.83, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (31, 14, 71.04, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (32, 15, 200.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (33, 16, 29340.51, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (34, 17, 20602.3, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (35, 18, 25.45, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (36, 19, 22.78, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (37, 20, 108.44, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (38, 21, 155, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (39, 22, 32.29, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (40, 23, 51.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (41, 24, 29.71, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (42, 25, 11.6, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (43, 26, 67.17, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (44, 27, 173.74, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (45, 28, 58.13, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (46, 29, 384.72, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (47, 30, 175.61, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (48, 31, 53.34, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (49, 32, 2841.7, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (50, 33, 86.28, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (51, 34, 106.35, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (52, 35, 161.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (53, 36, 73.63, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (54, 37, 114.96, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (55, 38, 54.25, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (56, 39, 35.76, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (57, 40, 9115.24, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (58, 41, 1544.85, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (59, 42, 436.97, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (60, 43, 1420.85, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (61, 44, 353.77, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (62, 45, 423.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (63, 46, 423.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (64, 47, 1517.72, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (65, 48, 1378.22, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (66, 49, 1937.52, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (67, 50, 1119.89, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (68, 51, 30793.65, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (69, 52, 52648.88, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (70, 53, 3744.58, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (71, 54, 189.7, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (72, 55, 52635.96, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (73, 56, 58125.6, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (74, 57, 201.1, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (75, 58, 3275.02, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (76, 59, 93.91, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (77, 60, 255.63, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (78, 61, 77.18, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (79, 62, 45.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (80, 63, 29.51, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (81, 64, 24.16, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (82, 65, 69.15, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (83, 66, 150.48, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (84, 67, 27.77, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (85, 68, 21.96, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (86, 69, 28.03, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (87, 70, 82.74, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (88, 71, 24.75, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (89, 72, 20.33, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (90, 73, 11842.12, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (91, 74, 322.78, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (92, 75, 292.83, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (93, 76, 40.95, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (94, 77, 11.63, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (95, 78, 19.38, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (96, 79, 41.33, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (97, 80, 74.92, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (98, 81, 16.77, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (99, 82, 39.4, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (100, 83, 181.2, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (101, 84, 103.1, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (102, 85, 540.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (103, 86, 1030.76, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (104, 87, 1313.51, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (105, 88, 1167.42, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (106, 89, 37.87, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (107, 90, 537.19, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (108, 91, 636.8, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (109, 92, 17.98, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (110, 93, 117.54, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (111, 94, 112.03, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (112, 95, 13.82, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (113, 96, 17.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (114, 97, 335.84, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (115, 98, 361.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (116, 99, 248.75, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (117, 100, 309.36, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (118, 101, 1183.18, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (119, 102, 471.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (120, 103, 514.09, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (121, 104, 83.96, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (122, 105, 38.64, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (123, 106, 10.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (124, 107, 10.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (125, 108, 10.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (126, 109, 11.99, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (127, 110, 11.99, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (128, 111, 11.99, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (129, 112, 10.95, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (130, 113, 24.17, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (131, 114, 23248.95, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (132, 115, 11547.62, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (133, 116, 55.53, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (134, 117, 293.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (135, 118, 191.17, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (136, 119, 167.92, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (137, 120, 49.58, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (138, 121, 81.38, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (139, 122, 245.42, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (140, 123, 860.89, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (141, 124, 57.77, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (142, 125, 96.35, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (143, 126, 103.98, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (144, 127, 1174.14, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (145, 128, 2451.61, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (146, 129, 46.03, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (147, 130, 73.63, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (148, 131, 64.58, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (149, 132, 17.44, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (150, 133, 265.54, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (151, 134, 289.34, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (152, 135, 171.07, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (153, 136, 197.37, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (154, 137, 43.25, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (155, 138, 191.53, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (156, 139, 113.89, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (157, 140, 154.7, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (158, 141, 41.98, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (159, 142, 124, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (160, 143, 105.67, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (161, 144, 173.09, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (162, 145, 46.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (163, 146, 8628.42, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (164, 147, 1398.89, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (165, 148, 1463.47, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (166, 149, 1069.51, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (167, 150, 1108.26, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (168, 151, 288.02, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (169, 152, 300.81, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (170, 153, 300.81, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (171, 154, 300.81, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (172, 155, 1059.18, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (173, 156, 1302.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (174, 157, 1130.22, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (175, 158, 1308.47, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (176, 159, 1094.05, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (177, 160, 1300.72, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (178, 161, 1023.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (179, 162, 1023.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (180, 163, 1023.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (181, 164, 1914.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (182, 165, 1074.68, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (183, 166, 1323.97, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (184, 167, 2447.73, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (185, 168, 1884.56, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (186, 169, 1884.56, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (187, 170, 1884.56, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (188, 171, 520.55, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (189, 172, 520.55, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (190, 173, 502.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (191, 174, 502.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (192, 175, 527.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (193, 176, 527.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (194, 177, 1220.64, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (195, 178, 1220.64, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (196, 179, 1220.64, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (197, 180, 1608.14, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (198, 181, 1663.68, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (199, 182, 1663.68, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (200, 183, 1663.68, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (201, 184, 2257.86, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (202, 185, 581.26, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (203, 186, 581.26, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (204, 187, 581.26, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (205, 188, 962.3, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (206, 189, 96.17, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (207, 190, 96.8, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (208, 191, 1016.55, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (209, 192, 4430.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (210, 193, 6212.98, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (211, 194, 6924.7, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (212, 195, 5669.18, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (213, 196, 9584.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (214, 197, 9584.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (215, 198, 9584.27, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (216, 199, 16642.01, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (217, 200, 4271.59, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (218, 201, 9570.06, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (219, 202, 5157.68, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (220, 203, 4469.21, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (221, 204, 3239.53, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (222, 205, 3598.62, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (223, 206, 3598.62, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (224, 207, 3598.62, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (225, 208, 5583.93, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (226, 209, 3968.04, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (227, 210, 7232.12, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (228, 211, 10753.24, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (229, 212, 4182.46, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (230, 213, 13548.43, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (231, 214, 3548.24, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (232, 215, 3655.45, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (233, 216, 3655.45, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (234, 217, 3655.45, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (235, 218, 9691.48, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (236, 219, 12150.83, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (237, 220, 12150.83, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (238, 221, 12150.83, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (239, 222, 4271.59, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (240, 223, 5046.59, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (241, 224, 5046.59, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (242, 225, 5046.59, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (243, 226, 5375.97, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (244, 227, 6945.36, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (245, 228, 6945.36, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (246, 229, 6945.36, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (247, 230, 5161.55, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (248, 231, 5812.56, 2025, 1, NULL, NULL);
INSERT INTO `item_prices` VALUES (255, 378, 8800, 2025, 1, '2025-03-10 13:47:01', '2025-03-10 13:47:01');
INSERT INTO `item_prices` VALUES (256, 384, 10000, 2025, 1, '2025-03-11 13:40:27', '2025-03-11 13:40:27');
INSERT INTO `item_prices` VALUES (257, 289, 0, 2025, 0, '2025-03-11 17:09:11', '2025-03-11 17:09:44');
INSERT INTO `item_prices` VALUES (258, 289, 15, 2025, 0, '2025-03-11 17:09:44', '2025-03-11 17:10:09');
INSERT INTO `item_prices` VALUES (259, 289, 20, 2025, 1, '2025-03-11 17:10:09', '2025-03-11 17:10:09');
INSERT INTO `item_prices` VALUES (260, 250, 0, 2025, 1, '2025-03-11 17:26:56', '2025-03-11 17:26:56');
INSERT INTO `item_prices` VALUES (261, 387, 22020, 2025, 1, '2025-03-12 13:47:58', '2025-03-12 13:47:58');
INSERT INTO `item_prices` VALUES (262, 388, 5500, 2025, 1, '2025-03-13 13:16:39', '2025-03-13 13:16:39');

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` bigint NOT NULL,
  `is_psdbm` bigint NOT NULL,
  `item_category_id` bigint UNSIGNED NULL DEFAULT NULL,
  `account_code_id` bigint UNSIGNED NULL DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `is_psdbm_approved` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `items_item_category_id_foreign`(`item_category_id` ASC) USING BTREE,
  INDEX `items_account_code_id_foreign`(`account_code_id` ASC) USING BTREE,
  INDEX `items_added_by_foreign`(`added_by` ASC) USING BTREE,
  INDEX `items_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `items_account_code_id_foreign` FOREIGN KEY (`account_code_id`) REFERENCES `account_codes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `items_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `items_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 389 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 'ALCOHOL, Ethyl, 500 mL', '12191601-AL-E04', 'ALCOHOL, Ethyl, 500 mL', 'bottle', 1, 1, 1, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (2, 'ALCOHOL, Ethyl, 1 Gallon', '12191601-AL-E03', 'ALCOHOL, Ethyl, 1 Gallon', 'gallon', 1, 1, 1, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (3, 'CLEARBOOK, A4 size', '60121413-CB-P01', 'CLEARBOOK, A4 size', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (4, 'CLEARBOOK, Legal size', '60121413-CB-P02', 'CLEARBOOK, Legal size', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (5, 'ERASER, plastic/rubber', '60121534-ER-P01', 'ERASER, plastic/rubber', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (6, 'SIGN PEN, Extra Fine Tip, Black', '60121524-SP-G01', 'SIGN PEN, Extra Fine Tip, Black', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (7, 'SIGN PEN, Fine Tip, Black', '60121524-SP-G04', 'SIGN PEN, Fine Tip, Black', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (8, 'SIGN PEN, Medium Tip, Black', '60121524-SP-G07', 'SIGN PEN, Medium Tip, Black', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, '2025-03-11 17:30:23');
INSERT INTO `items` VALUES (9, 'SIGN PEN, Extra Fine Tip, Blue', '60121524-SP-G02', 'SIGN PEN, Extra Fine Tip, Blue', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (10, 'SIGN PEN, Fine Tip, Blue', '60121524-SP-G05', 'SIGN PEN, Fine Tip, Blue', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (11, 'SIGN PEN, Medium Tip, Blue', '60121524-SP-G08', 'SIGN PEN, Medium Tip, Blue', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (12, 'SIGN PEN, Extra Fine Tip, Red', '60121524-SP-G03', 'SIGN PEN, Extra Fine Tip, Red', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (13, 'SIGN PEN, Fine Tip, Red', '60121524-SP-G06', 'SIGN PEN, Fine Tip, Red', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (14, 'SIGN PEN, Medium Tip, Red', '60121524-SP-G09', 'SIGN PEN, Medium Tip, Red', 'piece', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (15, 'WRAPPING PAPER', '60121124-WR-P01', 'WRAPPING PAPER', 'pack', 1, 1, 2, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (16, 'DOCUMENT CAMERA', '45121517-DO-C03', 'DOCUMENT CAMERA', 'unit', 1, 1, 3, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (17, 'MULTIMEDIA PROJECTOR', '45111609-MM-P01', 'MULTIMEDIA PROJECTOR', 'unit', 1, 1, 3, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (18, 'BATTERY, dry cell, size AA', '26111702-BT-A02', 'BATTERY, dry cell, size AA', 'pack', 1, 1, 4, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (19, 'BATTERY, dry cell, size AAA', '26111702-BT-A01', 'BATTERY, dry cell, size AAA', 'pack', 1, 1, 4, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (20, 'AIR FRESHENER', '47131812-AF-A01', 'AIR FRESHENER', 'can', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (21, 'BROOM (Walis Tambo)', '47131604-BR-S01', 'BROOM (Walis Tambo)', 'piece', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (22, 'BROOM (Walis Ting-ting)', '47131604-BR-T01', 'BROOM (Walis Ting-ting)', 'piece', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (23, 'CLEANER, Toilet Bowl and Urinal', '47131829-TB-C01', 'CLEANER, Toilet Bowl and Urinal', 'bottle', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (24, 'CLEANSER, Scouring Powder', '47131805-CL-P01', 'CLEANSER, Scouring Powder', 'plastic container', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (25, 'DETERGENT BAR', '47131811-DE-B02', 'DETERGENT BAR', 'piece', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (26, 'DETERGENT POWDER, all purpose', '47131811-DE-P02', 'DETERGENT POWDER, all purpose', 'pouch', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (27, 'DISINFECTANT SPRAY', '47131803-DS-A01', 'DISINFECTANT SPRAY', 'can', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (28, 'DUST PAN', '47131601-DU-P01', 'DUST PAN', 'piece', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (29, 'FLOOR WAX, paste type, red', '47131802-FW-P03', 'FLOOR WAX, paste type, red', 'can', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (30, 'FURNITURE CLEANER', '47131830-FC-A01', 'FURNITURE CLEANER', 'can', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (31, 'HAND SOAP, liquid, 500mL', '73101612-HS-L01', 'HAND SOAP, liquid, 500mL', 'bottle', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (32, 'MOP BUCKET', '47121804-MP-B01', 'MOP BUCKET', 'unit', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (33, 'RAGS', '47131501-RG-C01', 'RAGS', 'kilo', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (34, 'SCOURING PAD', '47131602-SC-N01', 'SCOURING PAD', 'pack', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (35, 'TRASHBAG, XXL size', '47121701-TB-P04', 'TRASHBAG, XXL size', 'roll/pack', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (36, 'TRASHBAG, Large size', '47121701-TB-P05', 'TRASHBAG, Large size', 'roll/pack', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (37, 'TRASHBAG, XL size', '47121701-TB-P06', 'TRASHBAG, XL size', 'roll/pack', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (38, 'WASTEBASKET', '47121702-WB-P01', 'WASTEBASKET', 'piece', 1, 1, 5, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (39, 'INK, for stamp pad', '12171703-SI-P01', 'INK, for stamp pad', 'bottle', 1, 1, 6, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (40, 'DIGITAL VOICE RECORDER', '52161535-DV-R02', 'DIGITAL VOICE RECORDER', 'unit', 1, 1, 7, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (41, 'ACETATE', '13111203-AC-F01', 'ACETATE', 'roll', 1, 1, 9, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (42, 'CARBON FILM, Legal size', '13111201-CF-P02', 'CARBON FILM, Legal size', 'box', 1, 1, 9, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (43, 'FIRE EXTINGUISHER, dry chemical', '46191601-FE-M01', 'FIRE EXTINGUISHER, dry chemical', 'unit', 1, 1, 10, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (44, 'PHILIPPINE NATIONAL FLAG', '55121905-PH-F01', 'PHILIPPINE NATIONAL FLAG', 'piece', 1, 1, 11, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (45, 'MONOBLOC CHAIR, beige', '56101504-CM-B01', 'MONOBLOC CHAIR, beige', 'piece', 1, 1, 12, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (46, 'MONOBLOC CHAIR, white', '56101504-CM-W01', 'MONOBLOC CHAIR, white', 'piece', 1, 1, 12, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (47, 'ELECTRIC FAN, ceiling mount, orbit type', '40101604-EF-C01', 'ELECTRIC FAN, ceiling mount, orbit type', 'unit', 1, 1, 13, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (48, 'ELECTRIC FAN, industrial, ground type', '40101604-EF-G01', 'ELECTRIC FAN, industrial, ground type', 'unit', 1, 1, 13, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (49, 'ELECTRIC FAN, stand type', '40101604-EF-S01', 'ELECTRIC FAN, stand type', 'unit', 1, 1, 13, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (50, 'ELECTRIC FAN, wall mount', '40101604-EF-W01', 'ELECTRIC FAN, wall mount', 'unit', 1, 1, 13, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (51, 'DESKTOP, for Basic Users', '43211507-DSK003', 'DESKTOP, for Basic Users', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (52, 'DESKTOP, for Mid-Range Users', '43211507-DSK004', 'DESKTOP, for Mid-Range Users', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (53, 'EXTERNAL HARD DRIVE', '43201827-HD-X02', 'EXTERNAL HARD DRIVE', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (54, 'FLASH DRIVE', '43202010-FD-U04', 'FLASH DRIVE', 'piece', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (55, 'LAPTOP COMPUTER, for Mid-range Users', '43211503-LAP004', 'LAPTOP COMPUTER, for Mid-range Users', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (56, 'LAPTOP COMPUTER, Lightweight', '43211503-LAP003', 'LAPTOP COMPUTER, Lightweight', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (57, 'COMPUTER MOUSE, Wireless', '43211708-MO-O02', 'COMPUTER MOUSE, Wireless', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (58, 'PRINTER, Laser, Monochrome', '43212105-PR-L01', 'PRINTER, Laser, Monochrome', 'unit', 1, 1, 14, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (59, 'LIGHT-EMITTING DIODE (LED) LIGHT BULB, 7 watts', '39101628-LB-L01', 'LIGHT-EMITTING DIODE (LED) LIGHT BULB, 7 watts', 'piece', 1, 1, 15, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (60, 'LIGHT-EMITTING DIODE (LED) LINEAR TUBE, 18 watts', '39101628-LT-L01', 'LIGHT-EMITTING DIODE (LED) LINEAR TUBE, 18 watts', 'piece', 1, 1, 15, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (61, 'GLUE, all-purpose', '31201610-GL-J02', 'GLUE, all-purpose', 'bottle', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (62, 'STAPLE WIRE, heavy duty (binder type), 23/13', '31151804-SW-H01', 'STAPLE WIRE, heavy duty (binder type), 23/13', 'box', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (63, 'STAPLE WIRE, standard', '31151804-SW-S01', 'STAPLE WIRE, standard', 'box', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (64, 'TAPE, electrical', '31201502-TA-E02', 'TAPE, electrical', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (65, 'TAPE, masking, 24mm', '31201503-TA-M01', 'TAPE, masking, 24mm', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (66, 'TAPE, masking, 48 mm', '31201503-TA-M02', 'TAPE, masking, 48 mm', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (67, 'TAPE, packaging, 48 mm', '31201517-TA-P01', 'TAPE, packaging, 48 mm', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (68, 'TAPE, transparent, 24mm', '31201512-TA-T01', 'TAPE, transparent, 24mm', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (69, 'TAPE, transparent, 48 mm', '31201512-TA-T02', 'TAPE, transparent, 48 mm', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (70, 'TWINE, plastic', '31151507-TW-P01', 'TWINE, plastic', 'roll', 1, 1, 16, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (71, 'RULER, plastic, 450mm', '41111604-RU-P02', 'RULER, plastic, 450mm', 'piece', 1, 1, 17, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (72, 'BLADE, for general purpose cutter/utility knife', '44121612-BL-H01', 'BLADE, for general purpose cutter/utility knife', 'tube', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (73, 'BINDING AND PUNCHING MACHINE', '44101602-PB-M01', 'BINDING AND PUNCHING MACHINE', 'unit', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (74, 'BINDING RING/COMB, plastic, 32 mm', '44122037-RB-P10', 'BINDING RING/COMB, plastic, 32 mm', 'bundle', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (75, 'CALCULATOR, Compact', '44101807-CA-C01', 'CALCULATOR, Compact', 'unit', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (76, 'CHALK, white enamel', '44121710-CH-W01', 'CHALK, white enamel', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (77, 'CLIP, backfold, 19mm', '44122105-BF-C01', 'CLIP, backfold, 19mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (78, 'CLIP, backfold, 25mm', '44122105-BF-C02', 'CLIP, backfold, 25mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (79, 'CLIP, backfold, 32mm', '44122105-BF-C03', 'CLIP, backfold, 32mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (80, 'CLIP, backfold, 50mm', '44122105-BF-C04', 'CLIP, backfold, 50mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (81, 'CORRECTION TAPE', '44121801-CT-R02', 'CORRECTION TAPE', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (82, 'CUTTER/UTILITY KNIFE, for general purpose', '44121612-CU-H01', 'CUTTER/UTILITY KNIFE, for general purpose', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (83, 'DATA FILE BOX', '44111515-DF-B01', 'DATA FILE BOX', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (84, 'DATA FOLDER', '44122011-DF-F01', 'DATA FOLDER', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (85, 'DATER STAMP', '44103202-DS-M01', 'DATER STAMP', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (86, 'ENVELOPE, Documentary, A4', '44121506-EN-D01', 'ENVELOPE, Documentary, A4', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (87, 'ENVELOPE, Documentary, legal,', '44121506-EN-D02', 'ENVELOPE, Documentary, legal,', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (88, 'ENVELOPE, Expanding, Kraft', '44121506-EN-X01', 'ENVELOPE, Expanding, Kraft', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (89, 'ENVELOPE, Expanding, Plastic', '44121506-EN-X02', 'ENVELOPE, Expanding, Plastic', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (90, 'ENVELOPE, Mailing', '44121506-EN-M02', 'ENVELOPE, Mailing', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (91, 'ENVELOPE, Mailing, with window', '44121504-EN-W02', 'ENVELOPE, Mailing, with window', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (92, 'ERASER, felt, for blackboard/whiteboard', '44111912-ER-B01', 'ERASER, felt, for blackboard/whiteboard', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (93, 'FASTENER', '44122118-FA-P01', 'FASTENER', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (94, 'FILE ORGANIZER, expanding, plastic, legal', '44111515-FO-X01', 'FILE ORGANIZER, expanding, plastic, legal', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (95, 'FILE TAB DIVIDER, A4', '44122018-FT-D01', 'FILE TAB DIVIDER, A4', 'set', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (96, 'FILE TAB DIVIDER, Legal', '44122018-FT-D02', 'FILE TAB DIVIDER, Legal', 'set', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (97, 'FOLDER, Fancy with slide, A4', '44122011-FO-F01', 'FOLDER, Fancy with slide, A4', 'bundle', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (98, 'FOLDER, Fancy with slide, legal', '44122011-FO-F02', 'FOLDER, Fancy with slide, legal', 'bundle', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (99, 'FOLDER, L-type, A4', '44122011-FO-L01', 'FOLDER, L-type, A4', 'pack', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (100, 'FOLDER, L-type, Legal', '44122011-FO-L02', 'FOLDER, L-type, Legal', 'pack', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (101, 'FOLDER, pressboard', '44122027-FO-P01', 'FOLDER, pressboard', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (102, 'FOLDER with tab, A4', '44122011-FO-T01', 'FOLDER with tab, A4', 'pack', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (103, 'FOLDER with tab, Legal', '44122011-FO-T02', 'FOLDER with tab, Legal', 'pack', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (104, 'INDEX TAB', '44122008-IT-T01', 'INDEX TAB', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (105, 'MARKER, Flourescent', '44121716-MA-F01', 'MARKER, Flourescent', 'set', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (106, 'MARKER, Permanent, Black', '44121708-MP-B01', 'MARKER, Permanent, Black', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (107, 'MARKER, Permanent, Blue', '44121708-MP-B02', 'MARKER, Permanent, Blue', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (108, 'MARKER, Permanent, Red', '44121708-MP-B03', 'MARKER, Permanent, Red', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (109, 'MARKER, Whiteboard, Black', '44121708-MW-B01', 'MARKER, Whiteboard, Black', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (110, 'MARKER, Whiteboard, Blue', '44121708-MW-B02', 'MARKER, Whiteboard, Blue', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (111, 'MARKER, Whiteboard, Red', '44121708-MW-B03', 'MARKER, Whiteboard, Red', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (112, 'PAPER CLIP, vinly/plastic coated, 33mm', '44122104-PC-G01', 'PAPER CLIP, vinly/plastic coated, 33mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (113, 'PAPER CLIP, vinly/plastic coated, jumbo, 50mm', '44122104-PC-J02', 'PAPER CLIP, vinly/plastic coated, jumbo, 50mm', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (114, 'PAPER SHREDDER', '44101603-PS-M02', 'PAPER SHREDDER', 'unit', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (115, 'PAPER TRIMMER/CUTTING MACHINE', '44101601-PT-M02', 'PAPER TRIMMER/CUTTING MACHINE', 'unit', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (116, 'PENCIL, lead/graphite, with eraser', '44121706-PE-L01', 'PENCIL, lead/graphite, with eraser', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (117, 'PENCIL SHARPENER', '44121619-PS-M01', 'PENCIL SHARPENER', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (118, 'PUNCHER, paper, heavy duty', '44101602-PU-P01', 'PUNCHER, paper, heavy duty', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (119, 'RUBBER BAND No. 18', '44122101-RU-B01', 'RUBBER BAND No. 18', 'box', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (120, 'STAMP PAD, felt', '44121905-SP-F01', 'STAMP PAD, felt', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (121, 'SCISSORS, symmetrical/asymmetrical', '44121618-SS-S01', 'SCISSORS, symmetrical/asymmetrical', 'pair', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (122, 'STAPLER, standard type', '44121615-ST-S01', 'STAPLER, standard type', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (123, 'STAPLER, heavy duty (binder)', '44121615-ST-B01', 'STAPLER, heavy duty (binder)', 'unit', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (124, 'STAPLE REMOVER, plier-type', '44121613-SR-P02', 'STAPLE REMOVER, plier-type', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (125, 'TAPE DISPENSER, table top', '44121605-TD-T01', 'TAPE DISPENSER, table top', 'piece', 1, 1, 18, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (126, 'CARTOLINA, assorted colors', '14111525-CA-A01', 'CARTOLINA, assorted colors', 'pack', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (127, 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 241mm', '14111506-CF-L11', 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 241mm', 'box', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (128, 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 378mm', '14111506-CF-L12', 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 378mm', 'box', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (129, 'NOTEPAD, stick-on, 50mm x 76mm', '14111514-NP-S02', 'NOTEPAD, stick-on, 50mm x 76mm', 'pad', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (130, 'NOTEPAD, stick-on, 76mm x 100mm', '14111514-NP-S04', 'NOTEPAD, stick-on, 76mm x 100mm', 'pad', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (131, 'NOTEPAD, stick-on, 76mm x 76mm', '14111514-NP-S03', 'NOTEPAD, stick-on, 76mm x 76mm', 'pad', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (132, 'STENO NOTEBOOK', '14111514-NB-S02', 'STENO NOTEBOOK', 'piece', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (133, 'PAPER, MULTICOPY A4', '14111507-PP-M01', 'PAPER, MULTICOPY A4', 'ream', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (134, 'PAPER, MULTICOPY LEGAL', '14111507-PP-M02', 'PAPER, MULTICOPY LEGAL', 'ream', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (135, 'PAPER, MULTIPURPOSE A4', '14111507-PP-C01', 'PAPER, MULTIPURPOSE A4', 'ream', 1, 1, 19, 6, 1, 1, 1, NULL, '2025-03-11 16:59:49');
INSERT INTO `items` VALUES (136, 'PAPER, MULTIPURPOSE LEGAL', '14111507-PP-C02', 'PAPER, MULTIPURPOSE LEGAL', 'ream', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (137, 'PAD PAPER, ruled', '14111531-PP-R01', 'PAD PAPER, ruled', 'pad', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (138, 'PAPER, parchment', '14111503-PA-P01', 'PAPER, parchment', 'box', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (139, 'RECORD BOOK, 300 PAGES', '14111531-RE-B01', 'RECORD BOOK, 300 PAGES', 'book', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (140, 'RECORD BOOK, 500 PAGES', '14111531-RE-B02', 'RECORD BOOK, 500 PAGES', 'book', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (141, 'TISSUE, INTERFOLDED PAPER TOWEL', '14111704-TT-P04', 'TISSUE, INTERFOLDED PAPER TOWEL', 'pack', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (142, 'TOILET TISSUE PAPER, 2 ply', '14111704-TT-P02', 'TOILET TISSUE PAPER, 2 ply', 'pack', 1, 1, 19, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (143, 'HAND SANITIZER', '53131626-HS-S01', 'HAND SANITIZER', 'bottle', 1, 1, 20, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (144, 'INSECTICIDE', '10191509-IN-A01', 'INSECTICIDE', 'can', 1, 1, 21, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (145, 'HANDBOOK ON PHILIPPINE GOVERNMENT PROCUREMENT', '55101524-RA-H01', 'HANDBOOK ON PHILIPPINE GOVERNMENT PROCUREMENT', 'book', 1, 1, 22, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (146, 'DRUM CARTRIDGE, BROTHER DR-3455, Black', '44103109-BR-D05', 'DRUM CARTRIDGE, BROTHER DR-3455, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (147, 'INK CARTRIDGE, CANON CL-741, Colored', '44103105-CA-C04', 'INK CARTRIDGE, CANON CL-741, Colored', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (148, 'INK CARTRIDGE, CANON CL-811, Colored', '44103105-CA-C02', 'INK CARTRIDGE, CANON CL-811, Colored', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (149, 'INK CARTRIDGE, CANON PG-740, Black', '44103105-CA-B04', 'INK CARTRIDGE, CANON PG-740, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (150, 'INK CARTRIDGE, CANON PG-810, Black', '44103105-CA-B02', 'INK CARTRIDGE, CANON PG-810, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (151, 'INK CARTRIDGE, EPSON C13T664100 (T6641), Black', '44103105-EP-B17', 'INK CARTRIDGE, EPSON C13T664100 (T6641), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (152, 'INK CARTRIDGE, EPSON C13T664200 (T6642), Cyan', '44103105-EP-C17', 'INK CARTRIDGE, EPSON C13T664200 (T6642), Cyan', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (153, 'INK CARTRIDGE, EPSON C13T664300 (T6643), Magenta', '44103105-EP-M17', 'INK CARTRIDGE, EPSON C13T664300 (T6643), Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (154, 'INK CARTRIDGE, EPSON C13T664400 (T6644), Yellow', '44103105-EP-Y17', 'INK CARTRIDGE, EPSON C13T664400 (T6644), Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (155, 'INK CARTRIDGE, HP C2P04AA (HP62), Black', '44103105-HP-B40', 'INK CARTRIDGE, HP C2P04AA (HP62), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (156, 'INK CARTRIDGE, HP C2P06AA (HP62), Tri-color', '44103105-HP-T40', 'INK CARTRIDGE, HP C2P06AA (HP62), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (157, 'INK CARTRIDGE, HP C9351AA (HP21), Black', '44103105-HP-B09', 'INK CARTRIDGE, HP C9351AA (HP21), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (158, 'INK CARTRIDGE, HP C9352AA (HP22), Tri-color', '44103105-HP-T10', 'INK CARTRIDGE, HP C9352AA (HP22), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (159, 'INK CARTRIDGE, HP CC640WA (HP60), Black', '44103105-HP-B17', 'INK CARTRIDGE, HP CC640WA (HP60), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (160, 'INK CARTRIDGE, HP CC643WA (HP60), Tri-color', '44103105-HP-T17', 'INK CARTRIDGE, HP CC643WA (HP60), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (161, 'INK CARTRIDGE, HP CD972AA (HP920XL), Cyan', '44103105-HX-C40', 'INK CARTRIDGE, HP CD972AA (HP920XL), Cyan', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (162, 'INK CARTRIDGE, HP CD973AA (HP920XL), Magenta', '44103105-HX-M40', 'INK CARTRIDGE, HP CD973AA (HP920XL), Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (163, 'INK CARTRIDGE, HP CD974AA (HP920XL), Yellow', '44103105-HX-Y40', 'INK CARTRIDGE, HP CD974AA (HP920XL), Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (164, 'INK CARTRIDGE, HP CD975AA (HP920XL), Black', '44103105-HX-B40', 'INK CARTRIDGE, HP CD975AA (HP920XL), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (165, 'INK CARTRIDGE, HP CH561WA (HP61), Black', '44103105-HP-B20', 'INK CARTRIDGE, HP CH561WA (HP61), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (166, 'INK CARTRIDGE, HP CH562WA (HP61), Tri-color', '44103105-HP-T20', 'INK CARTRIDGE, HP CH562WA (HP61), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (167, 'INK CARTRIDGE, HP CN045AA (HP950XL), Black', '44103105-HX-B43', 'INK CARTRIDGE, HP CN045AA (HP950XL), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (168, 'INK CARTRIDGE, HP CN046AA (HP951XL), Cyan', '44103105-HX-C43', 'INK CARTRIDGE, HP CN046AA (HP951XL), Cyan', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (169, 'INK CARTRIDGE, HP CN047AA (HP951XL), Magenta', '44103105-HX-M43', 'INK CARTRIDGE, HP CN047AA (HP951XL), Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (170, 'INK CARTRIDGE, HP CN048AA (HP951XL), Yellow', '44103105-HX-Y43', 'INK CARTRIDGE, HP CN048AA (HP951XL), Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (171, 'INK CARTRIDGE, HP CN692AA (HP704), Black', '44103105-HP-B36', 'INK CARTRIDGE, HP CN692AA (HP704), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (172, 'INK CARTRIDGE, HP CN693AA (HP704), Tri-color', '44103105-HP-T36', 'INK CARTRIDGE, HP CN693AA (HP704), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (173, 'INK CARTRIDGE, HP CZ107AA (HP678), Black', '44103105-HP-B33', 'INK CARTRIDGE, HP CZ107AA (HP678), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (174, 'INK CARTRIDGE, HP CZ108AA (HP678), Tri-color', '44103105-HP-T33', 'INK CARTRIDGE, HP CZ108AA (HP678), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (175, 'INK CARTRIDGE, HP F6V26AA (HP680), Tri-color', '44103105-HP-T43', 'INK CARTRIDGE, HP F6V26AA (HP680), Tri-color', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (176, 'INK CARTRIDGE, HP F6V27AA (HP680), Black', '44103105-HP-B43', 'INK CARTRIDGE, HP F6V27AA (HP680), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (177, 'INK CARTRIDGE, HP L0S51AA (HP955), Cyan Original', '44103105-HP-C50', 'INK CARTRIDGE, HP L0S51AA (HP955), Cyan Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (178, 'INK CARTRIDGE, HP L0S54AA (HP955), Magenta Original', '44103105-HP-M50', 'INK CARTRIDGE, HP L0S54AA (HP955), Magenta Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (179, 'INK CARTRIDGE, HP L0S57AA (HP955), Yellow Original', '44103105-HP-Y50', 'INK CARTRIDGE, HP L0S57AA (HP955), Yellow Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (180, 'INK CARTRIDGE, HP L0S60AA (HP955), Black Original', '44103105-HP-B50', 'INK CARTRIDGE, HP L0S60AA (HP955), Black Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (181, 'INK CARTRIDGE, HP L0S63AA (HP955XL), Cyan Original', '44103105-HX-C48', 'INK CARTRIDGE, HP L0S63AA (HP955XL), Cyan Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (182, 'INK CARTRIDGE, HP L0S66AA (HP955XL), Magenta', '44103105-HX-M48', 'INK CARTRIDGE, HP L0S66AA (HP955XL), Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (183, 'INK CARTRIDGE, HP L0S69AA (HP955XL), Yellow', '44103105-HX-Y48', 'INK CARTRIDGE, HP L0S69AA (HP955XL), Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (184, 'INK CARTRIDGE, HP L0S72AA (HP955XL), Black Original', '44103105-HX-B48', 'INK CARTRIDGE, HP L0S72AA (HP955XL), Black Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (185, 'INK CARTRIDGE, HP T6L89AA (HP905), Cyan Original', '44103105-HP-C51', 'INK CARTRIDGE, HP T6L89AA (HP905), Cyan Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (186, 'INK CARTRIDGE, HP T6L93AA (HP905), Magenta Original', '44103105-HP-M51', 'INK CARTRIDGE, HP T6L93AA (HP905), Magenta Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (187, 'INK CARTRIDGE, HP T6L97AA (HP905), Yellow Original', '44103105-HP-Y51', 'INK CARTRIDGE, HP T6L97AA (HP905), Yellow Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (188, 'INK CARTRIDGE, HP T6M01AA (HP905), Black Original', '44103105-HP-B51', 'INK CARTRIDGE, HP T6M01AA (HP905), Black Original', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (189, 'RIBBON CARTRIDGE, EPSON C13S015516 (#8750), Black', '44103112-EP-R05', 'RIBBON CARTRIDGE, EPSON C13S015516 (#8750), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (190, 'RIBBON CARTRIDGE, EPSON C13S015632, Black', '44103112-EP-R13', 'RIBBON CARTRIDGE, EPSON C13S015632, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (191, 'RIBBON CARTRIDGE, EPSON C13S015531 (S015086)', '44103112-EP-R07', 'RIBBON CARTRIDGE, EPSON C13S015531 (S015086)', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (192, 'TONER CARTRIDGE, BROTHER TN-3320, Black', '44103103-BR-B09', 'TONER CARTRIDGE, BROTHER TN-3320, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (193, 'TONER CARTRIDGE, BROTHER TN-3350, Black', '44103103-BR-B11', 'TONER CARTRIDGE, BROTHER TN-3350, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (194, 'TONER CARTRIDGE, BROTHER TN-3478, Black', '44103103-BR-B15', 'TONER CARTRIDGE, BROTHER TN-3478, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (195, 'TONER CARTRIDGE, BROTHER TN-456 Black, High Yield', '44103103-BR-B16', 'TONER CARTRIDGE, BROTHER TN-456 Black, High Yield', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (196, 'TONER CARTRIDGE, BROTHER TN-456 Cyan, High Yield', '44103103-BR-C03', 'TONER CARTRIDGE, BROTHER TN-456 Cyan, High Yield', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (197, 'TONER CARTRIDGE, BROTHER TN-456 Magenta, High Yield', '44103103-BR-M03', 'TONER CARTRIDGE, BROTHER TN-456 Magenta, High Yield', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (198, 'TONER CARTRIDGE, BROTHER TN-456 Yellow, High Yield', '44103103-BR-Y03', 'TONER CARTRIDGE, BROTHER TN-456 Yellow, High Yield', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (199, 'TONER CARTRIDGE, CANON CRG-324 II', '44103103-CA-B00', 'TONER CARTRIDGE, CANON CRG-324 II', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (200, 'TONER CARTRIDGE, HP CB435A, Black', '44103103-HP-B12', 'TONER CARTRIDGE, HP CB435A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (201, 'TONER CARTRIDGE, HP CE255A, Black', '44103103-HP-B18', 'TONER CARTRIDGE, HP CE255A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (202, 'TONER CARTRIDGE, HP CE278A, Black', '44103103-HP-B21', 'TONER CARTRIDGE, HP CE278A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (203, 'TONER CARTRIDGE, HP CE285A (HP85A), Black', '44103103-HP-B22', 'TONER CARTRIDGE, HP CE285A (HP85A), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (204, 'TONER CARTRIDGE, HP CE310A, Black', '44103103-HP-B23', 'TONER CARTRIDGE, HP CE310A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (205, 'TONER CARTRIDGE, HP CE311A, Cyan', '44103103-HP-C23', 'TONER CARTRIDGE, HP CE311A, Cyan', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (206, 'TONER CARTRIDGE, HP CE312A, Yellow', '44103103-HP-Y23', 'TONER CARTRIDGE, HP CE312A, Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (207, 'TONER CARTRIDGE, HP CE313A, Magenta', '44103103-HP-M23', 'TONER CARTRIDGE, HP CE313A, Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (208, 'TONER CARTRIDGE, HP CE505A, Black', '44103103-HP-B28', 'TONER CARTRIDGE, HP CE505A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (209, 'TONER CARTRIDGE, HP CF217A (HP17A), Black LaserJet', '44103103-HP-B52', 'TONER CARTRIDGE, HP CF217A (HP17A), Black LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (210, 'TONER CARTRIDGE, HP CF226A (HP26A), Black LaserJet', '44103103-HP-B53', 'TONER CARTRIDGE, HP CF226A (HP26A), Black LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (211, 'TONER CARTRIDGE, HP CF281A (HP81A), Black LaserJet', '44103103-HP-B56', 'TONER CARTRIDGE, HP CF281A (HP81A), Black LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (212, 'TONER CARTRIDGE, HP CF283A (HP83A), LaserJet Black', '44103103-HP-B57', 'TONER CARTRIDGE, HP CF283A (HP83A), LaserJet Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (213, 'TONER CARTRIDGE, HP CF287A (HP87), Black', '44103103-HP-B58', 'TONER CARTRIDGE, HP CF287A (HP87), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (214, 'TONER CARTRIDGE, HP CF350A, Black Laserjet', '44103103-HP-B60', 'TONER CARTRIDGE, HP CF350A, Black Laserjet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (215, 'TONER CARTRIDGE, HP CF351A, Cyan Laserjet', '44103103-HP-C60', 'TONER CARTRIDGE, HP CF351A, Cyan Laserjet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (216, 'TONER CARTRIDGE, HP CF352A, Yellow Laserjet', '44103103-HP-Y60', 'TONER CARTRIDGE, HP CF352A, Yellow Laserjet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (217, 'TONER CARTRIDGE, HP CF353A, Magenta Laserjet', '44103103-HP-M60', 'TONER CARTRIDGE, HP CF353A, Magenta Laserjet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (218, 'TONER CARTRIDGE, HP CF360A (HP508A), Black LaserJet', '44103103-HP-B61', 'TONER CARTRIDGE, HP CF360A (HP508A), Black LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (219, 'TONER CARTRIDGE, HP CF361A (HP508A), Cyan LaserJet', '44103103-HP-C61', 'TONER CARTRIDGE, HP CF361A (HP508A), Cyan LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (220, 'TONER CARTRIDGE, HP CF362A (HP508A), Yellow LaserJet', '44103103-HP-Y61', 'TONER CARTRIDGE, HP CF362A (HP508A), Yellow LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (221, 'TONER CARTRIDGE, HP CF363A (HP508A), Magenta LaserJet', '44103103-HP-M61', 'TONER CARTRIDGE, HP CF363A (HP508A), Magenta LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (222, 'TONER CARTRIDGE, HP CF400A (HP201A), Black LaserJet', '44103103-HP-B62', 'TONER CARTRIDGE, HP CF400A (HP201A), Black LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (223, 'TONER CARTRIDGE, HP CF401A (HP201A), Cyan LaserJet', '44103103-HP-C62', 'TONER CARTRIDGE, HP CF401A (HP201A), Cyan LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (224, 'TONER CARTRIDGE, HP CF402A (HP201A), Yellow LaserJet', '44103103-HP-Y62', 'TONER CARTRIDGE, HP CF402A (HP201A), Yellow LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (225, 'TONER CARTRIDGE, HP CF403A (HP201A), Magenta LaserJet', '44103103-HP-M62', 'TONER CARTRIDGE, HP CF403A (HP201A), Magenta LaserJet', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (226, 'TONER CARTRIDGE, HP CF410A (HP410A), Black', '44103103-HP-B63', 'TONER CARTRIDGE, HP CF410A (HP410A), Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (227, 'TONER CARTRIDGE, HP CF411A (HP410A), Cyan', '44103103-HP-C63', 'TONER CARTRIDGE, HP CF411A (HP410A), Cyan', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (228, 'TONER CARTRIDGE, HP CF412A (HP410A), Yellow', '44103103-HP-Y63', 'TONER CARTRIDGE, HP CF412A (HP410A), Yellow', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (229, 'TONER CARTRIDGE, HP CF413A (HP410A), Magenta', '44103103-HP-M63', 'TONER CARTRIDGE, HP CF413A (HP410A), Magenta', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (230, 'TONER CARTRIDGE, HP Q2612A, Black', '44103103-HP-B34', 'TONER CARTRIDGE, HP Q2612A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (231, 'TONER CARTRIDGE, HP Q7553A, Black', '44103103-HP-B48', 'TONER CARTRIDGE, HP Q7553A, Black', 'cart', 1, 1, 23, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (232, 'Business function specific software', '43231513-SFT-001', 'Business function specific software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (233, 'Finance accounting and enterprise resource planning ERP so', '43231602-SFT-002', 'Finance accounting and enterprise resource planning ERP so', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (234, 'Computer game or entertainment software', '43232004-SFT-003', 'Computer game or entertainment software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (235, 'Content authoring and editing software', '43232107-SFT-004', 'Content authoring and editing software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (236, 'Content management software', '43232202-SFT-005', 'Content management software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (237, 'Data management and query software', '43232304-SFT-006', 'Data management and query software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (238, 'Development software', '43232402-SFT-007', 'Development software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (239, 'Educational or reference software', '43232505-SFT-008', 'Educational or reference software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (240, 'Industry specific software', '43232603-SFT-009', 'Industry specific software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (241, 'Information exchange software', '43233501-SFT-016', 'Information exchange software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (242, 'Network applications software', '43232701-SFT-010', 'Network applications software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (243, 'Network management software', '43232802-SFT-011', 'Network management software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (244, 'Networking software', '43232905-SFT-012', 'Networking software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (245, 'Operating environment software', '43233004-SFT-013', 'Operating environment software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (246, 'Security and protection software', '43233205-SFT-014', 'Security and protection software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (247, 'Utility and device driver software', '43233405-SFT-015', 'Utility and device driver software', 'license', 1, 1, 24, 6, 1, 1, 1, NULL, NULL);
INSERT INTO `items` VALUES (249, 'A3 Paper, 70gsm', '', 'A3 Paper, 70gsm', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (250, 'Hi Brite Imp Book, Paper 70 AF 100 25x38, Size: 635x965mm, Basic Weight: 100gsm, No. of Sheets: 250 sheets/ream', 'DF-123123', 'Hi Brite Imp Book, Paper 70 AF 100 25x38, Size: 635x965mm, Basic Weight: 100gsm, No. of Sheets: 250 sheets/ream', 'ream', 0, 0, 2, 6, 1, 0, NULL, NULL, '2025-03-11 17:26:56');
INSERT INTO `items` VALUES (251, 'Adhesive tape 2\" width', '', 'Adhesive tape 2\" width', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (252, 'Aluminum Duct Tape, 2 inches', '', 'Aluminum Duct Tape, 2 inches', ' roll ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (253, 'Ballpen, Black (0.5 mm)', '', 'Ballpen, Black (0.5 mm)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (254, 'Ballpen, Blue  (0.5 mm)', '', 'Ballpen, Blue  (0.5 mm)', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (255, 'Ballpen, Red  (0.5 mm)', '', 'Ballpen, Red  (0.5 mm)', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (256, 'Ballpen,Green  (0.5 mm)', '', 'Ballpen,Green  (0.5 mm)', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (257, 'Blueprint paper,Copyer Diazo Paper (Amonia Process) 107 cm x 46 meters, 42 in. x 50 yds', '', 'Blueprint paper,Copyer Diazo Paper (Amonia Process) 107 cm x 46 meters, 42 in. x 50 yds', ' rolls ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (258, 'Board Paper assorted color long', '', 'Board Paper assorted color long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (259, 'Bookends holder (big),metal', '', 'Bookends holder (big),metal', ' box ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (260, 'Bookpaper, white, short 70gsm', '', 'Bookpaper, white, short 70gsm', 'ream', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (261, 'Bookpaper,Blue Multi Color Copy (Long)', '', 'Bookpaper,Blue Multi Color Copy (Long)', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (262, 'Bookpaper,Green, Multi Color Copy (Long)', '', 'Bookpaper,Green, Multi Color Copy (Long)', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (263, 'Bookpaper,Pink, Multi Color Copy (Long)', '', 'Bookpaper,Pink, Multi Color Copy (Long)', 'ream', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (264, 'Bookpaper,Yellow, Multi Color Copy (Long)', '', 'Bookpaper,Yellow, Multi Color Copy (Long)', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (265, 'Cartolina paper, Dark Green', '', 'Cartolina paper, Dark Green', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (266, 'Cartolina paper, Dark Yellow', '', 'Cartolina paper, Dark Yellow', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (267, 'Cartolina paper, White', '', 'Cartolina paper, White', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (268, 'Cartolina paper,black', '', 'Cartolina paper,black', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (269, 'Cartolina paper,Dark blue', '', 'Cartolina paper,Dark blue', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (270, 'Cartolina paper,Dark Orange', '', 'Cartolina paper,Dark Orange', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (271, 'Cartolina paper,light orange imported', '', 'Cartolina paper,light orange imported', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (272, 'Cartolina paper,red', '', 'Cartolina paper,red', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (273, 'Cartolina, Light Blue, thick Substance120', '', 'Cartolina, Light Blue, thick Substance120', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (274, 'Cartolina, Light Green, thick Substance120', '', 'Cartolina, Light Green, thick Substance120', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (275, 'Cartolina, Light Yellow, thick Substance120', '', 'Cartolina, Light Yellow, thick Substance120', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (276, 'Cartolina, white, thick Substance120', '', 'Cartolina, white, thick Substance120', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (277, 'Certificate holder (short)', '', 'Certificate holder (short)', 'pc', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (278, 'Certificate holder (A4)', '', 'Certificate holder (A4)', ' box ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (279, 'Certificate Paper (Long,)', '', 'Certificate Paper (Long,)', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (280, 'Certificate Paper(short)', '', 'Certificate Paper(short)', ' ream ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (281, 'Certificate Paper Laid Specialty Paper work', '', 'Certificate Paper Laid Specialty Paper work', ' pack ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (282, 'Class Record (College)', '', 'Class Record (College)', ' piece ', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (283, 'Colored Chalk', '', 'Colored Chalk', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (284, 'COR Computer Continuos Forms, 3 ply, 9 1/2\"x5.5\" S20, 500 sets/box', '', 'COR Computer Continuos Forms, 3 ply, 9 1/2\"x5.5\" S20, 500 sets/box', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (285, 'Corks sheets , 2x3', '', 'Corks sheets , 2x3', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (286, 'Cutter, heavy duty', '', 'Cutter, heavy duty', 'pcs', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (287, 'Data File Box, w/cover (Big)', '', 'Data File Box, w/cover (Big)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (288, 'Diploma Jacket (11.0x8.50) Logo: Gold Diameter: 3.5\" ', '', 'Diploma Jacket (11.0x8.50) Logo: Gold Diameter: 3.5\" ', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (289, 'Data Folder, made of chipboard, taglia', 'DF-123123', 'Data Folder, made of chipboard, taglia', 'piece', 0, 0, 18, 6, 1, 0, NULL, NULL, '2025-03-11 17:09:11');
INSERT INTO `items` VALUES (290, 'Engineers field notebook', '', 'Engineers field notebook', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (291, 'FC arch file folder, 2 ring, 3 horizontal, blue', '', 'FC arch file folder, 2 ring, 3 horizontal, blue', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (292, 'Felt Paper BLUE', '', 'Felt Paper BLUE', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (293, 'Felt Paper RED', '', 'Felt Paper RED', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (294, 'Felt Paper YELLOW', '', 'Felt Paper YELLOW', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (295, 'Finger Moistener', '', 'Finger Moistener', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (296, 'Folder (tagboard, long)', '', 'Folder (tagboard, long)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (297, 'Folder with metal tab expanded, green', '', 'Folder with metal tab expanded, green', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (298, 'Folder with metal tab expanded, maroon', '', 'Folder with metal tab expanded, maroon', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (299, 'Frames  for Certificates (8x11 black)', '', 'Frames  for Certificates (8x11 black)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (300, 'Green Colored premium cloth book binding repair tape 15 yard', '', 'Green Colored premium cloth book binding repair tape 15 yard', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (301, 'Glue ,(118ml)', '', 'Glue ,(118ml)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (302, 'Glue Gun, heavy duty', '', 'Glue Gun, heavy duty', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (303, 'Glue Stick, small', '', 'Glue Stick, small', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (304, 'Gluegun Stick, Jumbo', '', 'Gluegun Stick, Jumbo', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (305, 'HP Bright white inkjet paper C6036A 24\"', '', 'HP Bright white inkjet paper C6036A 24\"', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (306, 'HP Bright white inkjet paper C6036A 36\"', '', 'HP Bright white inkjet paper C6036A 36\"', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (307, 'HP natural Tracing Paper 24\"', '', 'HP natural Tracing Paper 24\"', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (308, 'HP natural Tracing Paper 36\"', '', 'HP natural Tracing Paper 36\"', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (309, 'ILLUSTRATION BOARD, (30\"x40\")', '', 'ILLUSTRATION BOARD, (30\"x40\")', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (310, 'Labelling tape, white', '', 'Labelling tape, white', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (311, 'Laid  Paper,short,20\'s,85gsm(Certification)', '', 'Laid  Paper,short,20\'s,85gsm(Certification)', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (312, 'Laid Paper,long, 20\'s,85gsm,green', '', 'Laid Paper,long, 20\'s,85gsm,green', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (313, 'Laid Paper,Long,20\'s,85gsm,white', '', 'Laid Paper,Long,20\'s,85gsm,white', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (314, 'Laid Paper,short,20\'s,85gsm,beige', '', 'Laid Paper,short,20\'s,85gsm,beige', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (315, 'Laid Paper,short,20\'s,85gsm,green', '', 'Laid Paper,short,20\'s,85gsm,green', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (316, 'Laid Paper,short,20\'s,85gsm,light yellow', '', 'Laid Paper,short,20\'s,85gsm,light yellow', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (317, 'Laid Paper,short,20\'s,85gsm,mint green', '', 'Laid Paper,short,20\'s,85gsm,mint green', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (318, 'Laminating Film,12 inches x 50 mtrs', '', 'Laminating Film,12 inches x 50 mtrs', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (319, 'Laminating Pouches 222 x286 x150, 100/box short size', '', 'Laminating Pouches 222 x286 x150, 100/box short size', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (320, 'Manila Paper', '', 'Manila Paper', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (321, 'Morocco Paper, green 10s long', '', 'Morocco Paper, green 10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (322, 'Morocco Paper, red  10s long', '', 'Morocco Paper, red  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (323, 'Morocco Paper, white  10s long', '', 'Morocco Paper, white  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (324, 'Morocco Paper,apple green  10s long', '', 'Morocco Paper,apple green  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (325, 'Morocco Paper,blue  10s long', '', 'Morocco Paper,blue  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (326, 'Morocco Paper,Dark Blue  10s long', '', 'Morocco Paper,Dark Blue  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (327, 'Morocco Paper,maroon  10s long', '', 'Morocco Paper,maroon  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (328, 'Morocco Paper,Orange  10s long', '', 'Morocco Paper,Orange  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (329, 'Morocco Paper,Yellow  10s long', '', 'Morocco Paper,Yellow  10s long', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (330, 'Notarial Seal-Gold#24Globe:Note: 40each per bx', '', 'Notarial Seal-Gold#24Globe:Note: 40each per bx', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (331, 'OIL, for general purpose lubricant, 120 mL ', '', 'OIL, for general purpose lubricant, 120 mL ', 'bottle', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (332, 'PENCIL, mechanical, for 0.5mm lead', '', 'PENCIL, mechanical, for 0.5mm lead', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (333, 'Photo Paper, 8.5\" x 13\", 20 sheets', '', 'Photo Paper, 8.5\" x 13\", 20 sheets', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (334, 'Photo Paper, A4, premium, 20 sheets', '', 'Photo Paper, A4, premium, 20 sheets', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (335, 'Press folder w/o tab,long,glossy green)', '', 'Press folder w/o tab,long,glossy green)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (336, 'PUSH PIN, flat head type, assorted colors, 100 pieces per case', '', 'PUSH PIN, flat head type, assorted colors, 100 pieces per case', 'case', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (337, 'Puncher,paper,heavy duty,with three hole guide', '', 'Puncher,paper,heavy duty,with three hole guide', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (338, 'Ring Binder , 1 \'\' x 44\", Black,Thick', '', 'Ring Binder , 1 \'\' x 44\", Black,Thick', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (339, 'Ring Binder , 1 \'\' x 44\", Royal Blue, Thick', '', 'Ring Binder , 1 \'\' x 44\", Royal Blue, Thick', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (340, 'Ring Binder , 1/2\"X 44\", Assorted colors,Thick', '', 'Ring Binder , 1/2\"X 44\", Assorted colors,Thick', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (341, 'Ring Binder , 1/4\" x 44\", Assorted colors, thick', '', 'Ring Binder , 1/4\" x 44\", Assorted colors, thick', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (342, 'Ring Binder, 2\" x 44\" Black,Thick 10 pcs per bundle', '', 'Ring Binder, 2\" x 44\" Black,Thick 10 pcs per bundle', 'bundle', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (343, 'Ring Binder, Plastic 25mm, 10 pieces per bundle', '', 'Ring Binder, Plastic 25mm, 10 pieces per bundle', 'bundle', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (344, 'Sign pen, Green', '', 'Sign pen, Green', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (345, 'Signature Arrow Stickers', '', 'Signature Arrow Stickers', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (346, 'Staedler pencil (F)', '', 'Staedler pencil (F)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (347, 'Staedler pencil (HB)', '', 'Staedler pencil (HB)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (348, 'Staple HD-3LS 10mm (1215 Fa-H), Max, box of 12\'s', '', 'Staple HD-3LS 10mm (1215 Fa-H), Max, box of 12\'s', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (349, 'Staple HD-3LS 15mm (1215 Fa-H), Max box of 10\'s', '', 'Staple HD-3LS 15mm (1215 Fa-H), Max box of 10\'s', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (350, 'Staple HD-3LS 17mm (1215 Fa-H), Max box of 10\'s', '', 'Staple HD-3LS 17mm (1215 Fa-H), Max box of 10\'s', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (351, 'Staple wire #10 (small)', '', 'Staple wire #10 (small)', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (352, 'Stapler, heavy duty with staple remover', '', 'Stapler, heavy duty with staple remover', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (353, 'Sticker paper (Matte), long 10s', '', 'Sticker paper (Matte), long 10s', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (354, 'Sticker Paper (satin white 10\'s)A4', '', 'Sticker Paper (satin white 10\'s)A4', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (355, 'Sticker paper-Long-orange 10s', '', 'Sticker paper-Long-orange 10s', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (356, 'Sticker paper-Long-yellow 10s', '', 'Sticker paper-Long-yellow 10s', 'pack', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (357, 'Tape, transparent, 1/2 inch', '', 'Tape, transparent, 1/2 inch', 'roll', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (358, 'Tracing Paper 82g/m-18, 3mx106.7 cm', '', 'Tracing Paper 82g/m-18, 3mx106.7 cm', 'rolls', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (359, 'Thumbtacks', '', 'Thumbtacks', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (360, 'White Folder, long', '', 'White Folder, long', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (361, 'WorX paper (color: pale cream; size: 8.5 x 13 long; GSM: 200 Sheets 10)', '', 'WorX paper (color: pale cream; size: 8.5 x 13 long; GSM: 200 Sheets 10)', 'set', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (362, 'Yellow Pad', '', 'Yellow Pad', 'pad', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (363, 'Scissors, 8 inches, Multi-purpose heavy duty', '', 'Scissors, 8 inches, Multi-purpose heavy duty', 'pad', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (364, 'Crystal Techpen water gel ballpen 0.7mm-blue', '', 'Crystal Techpen water gel ballpen 0.7mm-blue', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (365, 'Crystal Techpen water gel ballpen 0.7mm-black', '', 'Crystal Techpen water gel ballpen 0.7mm-black', 'box', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (366, 'White expanding folder with green spine, size long', '', 'White expanding folder with green spine, size long', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (367, '3 Holes Puncher (ISO Used)', '', '3 Holes Puncher (ISO Used)', 'piece', 0, 0, NULL, 6, 1, 0, NULL, NULL, NULL);
INSERT INTO `items` VALUES (378, 'Chair', '3216546523631', 'ergonomic chair', 'Unit', 1, 1, 18, 6, 2, 1, 2, '2025-03-10 13:47:01', '2025-03-10 13:47:01');
INSERT INTO `items` VALUES (384, 'Speakers', 'SPK-123123', 'Speakers', 'Unit', 1, 1, 18, 6, 2, 1, 2, '2025-03-11 13:40:27', '2025-03-11 13:40:27');
INSERT INTO `items` VALUES (387, 'Steel Cabinet', 'FF-FF-001', '5 layers steel cabinet with lock color red', 'piece', 1, 1, 12, 41, 2, 1, 2, '2025-03-12 13:47:58', '2025-03-12 13:47:58');
INSERT INTO `items` VALUES (388, 'Mouse', 'MS-123123', 'Mouse', 'Unit', 1, 1, 14, 6, 2, 1, 2, '2025-03-13 13:16:39', '2025-03-13 13:16:39');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_00_00_000000_create_college_office_unit_categories_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_00_00_022742_create_college_office_units_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000000_create_roles_table', 1);
INSERT INTO `migrations` VALUES (4, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (5, '0001_01_01_000001_create_users_table', 1);
INSERT INTO `migrations` VALUES (6, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_10_03_054056_create_privileges_table', 1);
INSERT INTO `migrations` VALUES (9, '2024_10_03_054107_create_user_privileges_table', 1);
INSERT INTO `migrations` VALUES (10, '2024_11_07_022749_create_account_codes_table', 1);
INSERT INTO `migrations` VALUES (11, '2024_11_07_022750_create_bidders_table', 1);
INSERT INTO `migrations` VALUES (12, '2024_11_07_022751_create_suppliers_table', 1);
INSERT INTO `migrations` VALUES (13, '2024_11_07_022752_create_item_categories_table', 1);
INSERT INTO `migrations` VALUES (14, '2024_11_07_022756_create_items_table', 1);
INSERT INTO `migrations` VALUES (15, '2024_11_07_022757_create_item_prices_table', 1);
INSERT INTO `migrations` VALUES (16, '2024_11_07_022830_create_whole_budgets_table', 1);
INSERT INTO `migrations` VALUES (17, '2024_11_07_022845_create_budget_allocations_table', 1);
INSERT INTO `migrations` VALUES (18, '2024_11_07_022852_create_p_p_m_p_s_table', 1);
INSERT INTO `migrations` VALUES (19, '2024_11_07_022853_create_p_p_m_p_items_table', 1);
INSERT INTO `migrations` VALUES (20, '2024_11_07_022854_create_p_p_m_p_comments_table', 1);
INSERT INTO `migrations` VALUES (21, '2024_11_07_023101_create_purchase_requests_table', 1);
INSERT INTO `migrations` VALUES (22, '2024_11_07_023114_create_purchase_request_details_table', 1);
INSERT INTO `migrations` VALUES (23, '2024_11_07_023124_create_procurements_table', 1);
INSERT INTO `migrations` VALUES (24, '2024_11_07_023133_create_r_f_q_s_table', 1);
INSERT INTO `migrations` VALUES (25, '2024_11_07_023141_create_r_f_q_details_table', 1);
INSERT INTO `migrations` VALUES (26, '2024_11_07_023201_create_store_prices_table', 1);
INSERT INTO `migrations` VALUES (27, '2025_02_20_052817_create_canvasses_table', 2);
INSERT INTO `migrations` VALUES (28, '2025_02_20_053223_create_canvass_items_table', 2);
INSERT INTO `migrations` VALUES (29, '2025_03_04_135430_create_requested_items_table', 3);
INSERT INTO `migrations` VALUES (30, '2025_03_04_135531_create_requested_item_attachments_table', 3);
INSERT INTO `migrations` VALUES (31, '2025_03_04_153227_create_requested_items_table', 4);
INSERT INTO `migrations` VALUES (32, '2025_03_04_153243_create_requested_item_attachments_table', 4);
INSERT INTO `migrations` VALUES (33, '2025_03_12_094749_create_purchase_requests_table', 5);

-- ----------------------------
-- Table structure for p_p_m_p_comments
-- ----------------------------
DROP TABLE IF EXISTS `p_p_m_p_comments`;
CREATE TABLE `p_p_m_p_comments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ppmp_id` bigint UNSIGNED NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `p_p_m_p_comments_ppmp_id_foreign`(`ppmp_id` ASC) USING BTREE,
  INDEX `p_p_m_p_comments_from_user_foreign`(`from_user` ASC) USING BTREE,
  CONSTRAINT `p_p_m_p_comments_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `p_p_m_p_comments_ppmp_id_foreign` FOREIGN KEY (`ppmp_id`) REFERENCES `p_p_m_p_s` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of p_p_m_p_comments
-- ----------------------------
INSERT INTO `p_p_m_p_comments` VALUES (6, 31, 'Di nani ma dawat kay late na', 3, '2025-03-03 10:54:47', '2025-03-03 10:54:47');
INSERT INTO `p_p_m_p_comments` VALUES (7, 31, 'Ngeh!', 5, '2025-03-03 11:04:04', '2025-03-03 11:04:04');
INSERT INTO `p_p_m_p_comments` VALUES (8, 31, 'boang', 3, '2025-03-03 11:12:12', '2025-03-03 11:12:12');
INSERT INTO `p_p_m_p_comments` VALUES (9, 33, 'Sample', 3, '2025-03-04 17:04:46', '2025-03-04 17:04:46');
INSERT INTO `p_p_m_p_comments` VALUES (10, 31, 'test', 5, '2025-03-10 13:37:33', '2025-03-10 13:37:33');
INSERT INTO `p_p_m_p_comments` VALUES (11, 35, 'Di kaya sa budget', 3, '2025-03-12 13:55:52', '2025-03-12 13:55:52');
INSERT INTO `p_p_m_p_comments` VALUES (12, 35, 'AH mao ba', 5, '2025-03-12 13:56:15', '2025-03-12 13:56:15');

-- ----------------------------
-- Table structure for p_p_m_p_items
-- ----------------------------
DROP TABLE IF EXISTS `p_p_m_p_items`;
CREATE TABLE `p_p_m_p_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ppmp_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `january_quantity` int NOT NULL,
  `february_quantity` int NOT NULL,
  `march_quantity` int NOT NULL,
  `april_quantity` int NOT NULL,
  `may_quantity` int NOT NULL,
  `june_quantity` int NOT NULL,
  `july_quantity` int NOT NULL,
  `august_quantity` int NOT NULL,
  `september_quantity` int NOT NULL,
  `october_quantity` int NOT NULL,
  `november_quantity` int NOT NULL,
  `december_quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `p_p_m_p_items_ppmp_id_foreign`(`ppmp_id` ASC) USING BTREE,
  INDEX `p_p_m_p_items_item_id_foreign`(`item_id` ASC) USING BTREE,
  CONSTRAINT `p_p_m_p_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `p_p_m_p_items_ppmp_id_foreign` FOREIGN KEY (`ppmp_id`) REFERENCES `p_p_m_p_s` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of p_p_m_p_items
-- ----------------------------
INSERT INTO `p_p_m_p_items` VALUES (24, 31, 4, 2, 1, 3, 2, 1, 3, 1, 2, 3, 2, 3, 1, '2025-02-27 06:01:02', '2025-02-27 06:01:02');
INSERT INTO `p_p_m_p_items` VALUES (25, 33, 27, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2025-02-27 06:10:44', '2025-02-27 06:10:44');
INSERT INTO `p_p_m_p_items` VALUES (26, 34, 101, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, '2025-02-27 06:20:54', '2025-02-27 06:20:54');
INSERT INTO `p_p_m_p_items` VALUES (27, 31, 33, 1, 1, 1, 1, 1, 1, 1, 1, 11, 0, 11, 0, '2025-03-03 02:48:22', '2025-03-03 02:48:22');
INSERT INTO `p_p_m_p_items` VALUES (28, 31, 114, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, '2025-03-03 02:48:34', '2025-03-03 02:48:34');
INSERT INTO `p_p_m_p_items` VALUES (29, 31, 3, 1, 1, 1, 1, 1, 11, 1, 0, 0, 0, 0, 0, '2025-03-04 16:27:58', '2025-03-04 16:27:58');
INSERT INTO `p_p_m_p_items` VALUES (30, 35, 176, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, '2025-03-04 16:34:17', '2025-03-04 16:34:17');
INSERT INTO `p_p_m_p_items` VALUES (31, 31, 378, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-03-10 13:48:03', '2025-03-10 13:48:03');
INSERT INTO `p_p_m_p_items` VALUES (33, 36, 384, 0, 0, 0, 1, 0, 2, 1, 0, 0, 0, 0, 0, '2025-03-11 13:46:11', '2025-03-11 13:46:11');
INSERT INTO `p_p_m_p_items` VALUES (34, 37, 98, 0, 0, 0, 5, 0, 5, 0, 5, 0, 0, 0, 0, '2025-03-12 13:30:43', '2025-03-12 13:30:43');
INSERT INTO `p_p_m_p_items` VALUES (35, 38, 387, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, '2025-03-12 13:53:33', '2025-03-12 13:53:33');

-- ----------------------------
-- Table structure for p_p_m_p_s
-- ----------------------------
DROP TABLE IF EXISTS `p_p_m_p_s`;
CREATE TABLE `p_p_m_p_s`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `budget_allocation_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `ppmp_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_submitted` bigint NOT NULL,
  `approval_status` bigint NOT NULL,
  `incrementing_number` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `p_p_m_p_s_budget_allocation_id_foreign`(`budget_allocation_id` ASC) USING BTREE,
  INDEX `p_p_m_p_s_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `p_p_m_p_s_budget_allocation_id_foreign` FOREIGN KEY (`budget_allocation_id`) REFERENCES `budget_allocations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `p_p_m_p_s_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of p_p_m_p_s
-- ----------------------------
INSERT INTO `p_p_m_p_s` VALUES (31, 1, 5, 'CISC-OSE-022025-1', 1, 1, 1, '2025-02-27 06:00:47', '2025-03-10 13:51:39');
INSERT INTO `p_p_m_p_s` VALUES (32, 2, 5, 'CISC-IOS-022025-2', 0, 0, 2, '2025-02-27 06:09:34', '2025-02-27 06:09:34');
INSERT INTO `p_p_m_p_s` VALUES (33, 4, 6, 'OUA-OSE-022025-1', 1, 2, 1, '2025-02-27 06:10:34', '2025-03-03 02:27:36');
INSERT INTO `p_p_m_p_s` VALUES (34, 4, 6, 'OUA-OSE-022025-2', 1, 0, 2, '2025-02-27 06:20:42', '2025-02-27 06:20:57');
INSERT INTO `p_p_m_p_s` VALUES (35, 5, 5, 'CISC-OSE-032025-3', 1, 1, 3, '2025-03-04 16:33:59', '2025-03-12 14:02:45');
INSERT INTO `p_p_m_p_s` VALUES (36, 7, 5, 'CISC-OSE-032025-4', 0, 0, 4, '2025-03-04 17:06:06', '2025-03-04 17:06:06');
INSERT INTO `p_p_m_p_s` VALUES (37, 8, 5, 'CISC-OSE-032025-5', 0, 0, 5, '2025-03-12 13:26:27', '2025-03-12 13:26:27');
INSERT INTO `p_p_m_p_s` VALUES (38, 10, 5, 'CISC-SFFABE-032025-6', 0, 0, 6, '2025-03-12 13:53:10', '2025-03-12 13:53:10');
INSERT INTO `p_p_m_p_s` VALUES (39, 1, 5, 'CISC-OSE-032025-7', 0, 0, 7, '2025-03-22 15:45:56', '2025-03-22 15:45:56');
INSERT INTO `p_p_m_p_s` VALUES (40, 4, 6, 'OUA-OSE-032025-3', 0, 0, 3, '2025-03-22 15:48:14', '2025-03-22 15:48:14');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for privileges
-- ----------------------------
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `privilege_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of privileges
-- ----------------------------
INSERT INTO `privileges` VALUES (1, 'CREATE', NULL, NULL);
INSERT INTO `privileges` VALUES (2, 'RETRIEVE', NULL, NULL);
INSERT INTO `privileges` VALUES (3, 'UPDATE', NULL, NULL);
INSERT INTO `privileges` VALUES (4, 'DELETE', NULL, NULL);

-- ----------------------------
-- Table structure for procurements
-- ----------------------------
DROP TABLE IF EXISTS `procurements`;
CREATE TABLE `procurements`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of procurements
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_requests
-- ----------------------------
DROP TABLE IF EXISTS `purchase_requests`;
CREATE TABLE `purchase_requests`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pr_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppmp_id` bigint UNSIGNED NOT NULL,
  `purpose` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_submitted` bigint NOT NULL DEFAULT 0,
  `date_submitted` datetime NULL DEFAULT NULL,
  `approval_status` bigint NOT NULL DEFAULT 0,
  `date_approved` datetime NULL DEFAULT NULL,
  `prepared_by` bigint UNSIGNED NOT NULL,
  `college_office_unit_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `incrementing_number` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `purchase_requests_ppmp_id_foreign`(`ppmp_id` ASC) USING BTREE,
  INDEX `purchase_requests_prepared_by_foreign`(`prepared_by` ASC) USING BTREE,
  INDEX `purchase_requests_colleg_office_unit_id_foreign`(`college_office_unit_id` ASC) USING BTREE,
  CONSTRAINT `purchase_requests_colleg_office_unit_id_foreign` FOREIGN KEY (`college_office_unit_id`) REFERENCES `college_office_units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `purchase_requests_ppmp_id_foreign` FOREIGN KEY (`ppmp_id`) REFERENCES `p_p_m_p_s` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `purchase_requests_prepared_by_foreign` FOREIGN KEY (`prepared_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_requests
-- ----------------------------
INSERT INTO `purchase_requests` VALUES (8, 'CISC-PR-032025-1', 31, NULL, 1, '2025-03-22 16:46:07', 0, NULL, 5, 2, '2025-03-22 16:22:07', '2025-03-22 16:22:07', 1);

-- ----------------------------
-- Table structure for requested_item_attachments
-- ----------------------------
DROP TABLE IF EXISTS `requested_item_attachments`;
CREATE TABLE `requested_item_attachments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `requested_item_id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` double NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_selected` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `requested_item_attachments_requested_item_id_foreign`(`requested_item_id` ASC) USING BTREE,
  CONSTRAINT `requested_item_attachments_requested_item_id_foreign` FOREIGN KEY (`requested_item_id`) REFERENCES `requested_items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of requested_item_attachments
-- ----------------------------
INSERT INTO `requested_item_attachments` VALUES (13, 5, 'Acer', '0923 531 2413', 50000, 'requested_items/college-of-information-sciences-and-computing/5_laptop/acer_laptop_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-06 09:30:02', '2025-03-06 09:30:02');
INSERT INTO `requested_item_attachments` VALUES (14, 5, 'ASUS', '0943 256 2431', 55000, 'requested_items/college-of-information-sciences-and-computing/5_laptop/asus_laptop_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-06 09:30:02', '2025-03-06 09:30:02');
INSERT INTO `requested_item_attachments` VALUES (15, 5, 'DELL', '0954 643 2524', 60000, 'requested_items/college-of-information-sciences-and-computing/5_laptop/dell_laptop_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-06 09:30:02', '2025-03-06 09:30:02');
INSERT INTO `requested_item_attachments` VALUES (16, 6, 'company 1', '0932 343 2432', 10000, 'requested_items/college-of-information-sciences-and-computing/6_chair/company-1_chair_laboratory-activity-13.pdf', NULL, '2025-03-10 13:41:48', '2025-03-10 13:41:48');
INSERT INTO `requested_item_attachments` VALUES (17, 6, 'Company 2', '0943 253 2452', 9000, 'requested_items/college-of-information-sciences-and-computing/6_chair/company-2_chair_laboratory-activity-13.pdf', NULL, '2025-03-10 13:41:48', '2025-03-10 13:41:48');
INSERT INTO `requested_item_attachments` VALUES (18, 6, 'Company 3', '0932 423 4324', 8800, 'requested_items/college-of-information-sciences-and-computing/6_chair/company-3_chair_laboratory-activity-13.pdf', NULL, '2025-03-10 13:41:48', '2025-03-10 13:41:48');
INSERT INTO `requested_item_attachments` VALUES (19, 7, 'Beats', '0923 452 4511', 5000, 'requested_items/college-of-information-sciences-and-computing/7_speakers/beats_speakers_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-11 10:05:09', '2025-03-11 10:05:09');
INSERT INTO `requested_item_attachments` VALUES (20, 7, 'Sony', '0998 427 9341', 6000, 'requested_items/college-of-information-sciences-and-computing/7_speakers/sony_speakers_libnao-tl.pdf', NULL, '2025-03-11 10:05:09', '2025-03-11 10:05:09');
INSERT INTO `requested_item_attachments` VALUES (21, 7, 'Bose', '0945 656 0136', 10000, 'requested_items/college-of-information-sciences-and-computing/7_speakers/bose_speakers_aradillos-dtr.pdf', 1, '2025-03-11 10:05:09', '2025-03-11 13:40:27');
INSERT INTO `requested_item_attachments` VALUES (22, 8, 'IKEA', '0965 106 8651', 25000, 'requested_items/college-of-information-sciences-and-computing/8_steel-cabinet/ikea_steel-cabinet_dr-assessment-form.pdf', NULL, '2025-03-12 13:38:12', '2025-03-12 13:38:12');
INSERT INTO `requested_item_attachments` VALUES (23, 8, 'Home Depot', '0968 409 6862', 22020, 'requested_items/college-of-information-sciences-and-computing/8_steel-cabinet/home-depot_steel-cabinet_226-s-2025.pdf', 1, '2025-03-12 13:38:12', '2025-03-12 13:47:58');
INSERT INTO `requested_item_attachments` VALUES (24, 8, 'CITI Hardware', '0998 409 8416', 20000, 'requested_items/college-of-information-sciences-and-computing/8_steel-cabinet/citi-hardware_steel-cabinet_226-s-2025.pdf', NULL, '2025-03-12 13:38:12', '2025-03-12 13:38:12');
INSERT INTO `requested_item_attachments` VALUES (25, 9, 'Logitech', '0912 312 4125', 6000, 'requested_items/accounting-office/9_mouse/logitech_mouse_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-13 13:16:01', '2025-03-13 13:16:01');
INSERT INTO `requested_item_attachments` VALUES (26, 9, 'ASUS', '0912 431 3514', 5000, 'requested_items/accounting-office/9_mouse/asus_mouse_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', 1, '2025-03-13 13:16:01', '2025-03-13 13:16:39');
INSERT INTO `requested_item_attachments` VALUES (27, 9, 'ACER', '0934 562 4512', 4000, 'requested_items/accounting-office/9_mouse/acer_mouse_cmu-f-4-bac-002a-request-for-quotation-np-small-value-below-50k.pdf', NULL, '2025-03-13 13:16:01', '2025-03-13 13:16:01');

-- ----------------------------
-- Table structure for requested_items
-- ----------------------------
DROP TABLE IF EXISTS `requested_items`;
CREATE TABLE `requested_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `unit_of_measure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_status` bigint NOT NULL,
  `college_office_unit_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `requested_items_college_office_unit_id_foreign`(`college_office_unit_id` ASC) USING BTREE,
  INDEX `requested_items_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `requested_items_college_office_unit_id_foreign` FOREIGN KEY (`college_office_unit_id`) REFERENCES `college_office_units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `requested_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of requested_items
-- ----------------------------
INSERT INTO `requested_items` VALUES (5, 'Laptop', 'Laptop', 'Unit', 1, 2, 5, '2025-03-06 09:30:02', '2025-03-10 13:23:28');
INSERT INTO `requested_items` VALUES (6, 'Chair', 'ergonomic chair', 'Unit', 1, 2, 5, '2025-03-10 13:41:47', '2025-03-10 13:47:01');
INSERT INTO `requested_items` VALUES (7, 'Speakers', 'Speakers', 'Unit', 1, 2, 5, '2025-03-11 10:05:09', '2025-03-11 13:40:27');
INSERT INTO `requested_items` VALUES (8, 'Steel Cabinet', '5 layers steel cabinet with lock', 'piece', 1, 2, 5, '2025-03-12 13:38:11', '2025-03-12 13:47:58');
INSERT INTO `requested_items` VALUES (9, 'Mouse', 'Mouse', 'Unit', 1, 10, 6, '2025-03-13 13:16:01', '2025-03-13 13:16:39');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'BAC', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'Budget', NULL, NULL);
INSERT INTO `roles` VALUES (4, 'End-User', NULL, NULL);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for user_privileges
-- ----------------------------
DROP TABLE IF EXISTS `user_privileges`;
CREATE TABLE `user_privileges`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `privilege_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_privileges_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `user_privileges_privilege_id_foreign`(`privilege_id` ASC) USING BTREE,
  CONSTRAINT `user_privileges_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_privileges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_privileges
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_office_unit_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `account_status` bigint NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `users_college_office_unit_id_foreign`(`college_office_unit_id` ASC) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `users_college_office_unit_id_foreign` FOREIGN KEY (`college_office_unit_id`) REFERENCES `college_office_units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Allen Keith', 'Anib', 'Aradillos', '', '1', '9096743922', 'admin@gmail.com', 1, 1, 1, '2025-01-15 14:53:23', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', '', NULL, NULL);
INSERT INTO `users` VALUES (2, 'Weljo Chesedh', 'P', 'Libnao', '', '1', '9123456789', 'bac@gmail.com', 27, 2, 1, '2025-01-15 14:53:21', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', '', NULL, NULL);
INSERT INTO `users` VALUES (3, 'Jeovannie', 'C', 'Manhulad', '', '1', '9123456789', 'budget@gmail.com', 25, 3, 1, '2025-01-15 14:53:19', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', '', NULL, NULL);
INSERT INTO `users` VALUES (4, 'Lorie', 'M', 'Cagalitan', '', '1', '9123456789', 'sdd@gmail.com', 20, 4, 1, '2025-01-15 14:53:16', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', '', NULL, NULL);
INSERT INTO `users` VALUES (5, 'Krshnon Kyle', 'A', 'Padilla', '', '1', '9123456789', 'cisc@gmail.com', 2, 4, 1, '2025-01-15 14:53:16', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'Yudi', 'S', 'Tubungbanua', NULL, '0', '09654235185', 'accounting@gmail.com', 10, 4, 1, '2025-01-15 14:53:16', '$2y$12$R.HzwLdWEA99oN8/OK.AJ.7XX.i3EnVfvedNbzG49AkWxIPTljQB2', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for whole_budgets
-- ----------------------------
DROP TABLE IF EXISTS `whole_budgets`;
CREATE TABLE `whole_budgets`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `year` year NOT NULL,
  `source_of_fund` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_budget` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of whole_budgets
-- ----------------------------
INSERT INTO `whole_budgets` VALUES (1, 50000000, 2025, 'General Fund', 'Main', NULL, NULL);
INSERT INTO `whole_budgets` VALUES (2, 70000000, 2025, 'Trust Fund', 'Main', NULL, NULL);
INSERT INTO `whole_budgets` VALUES (3, 100000000, 2025, 'Special Trust Fund', 'Main', NULL, NULL);
INSERT INTO `whole_budgets` VALUES (10, 50000000, 2026, 'General Fund', 'Main', NULL, NULL);
INSERT INTO `whole_budgets` VALUES (11, 225467980, 2026, 'General Fund', 'Main', '2025-01-22 03:15:00', '2025-01-22 03:15:00');
INSERT INTO `whole_budgets` VALUES (12, 50000000, 2025, 'RGMO', 'Main', '2025-02-05 06:34:58', '2025-02-05 06:34:58');
INSERT INTO `whole_budgets` VALUES (13, 50000000, 2026, 'General Fund', 'Main', '2025-02-06 06:53:24', '2025-02-06 06:53:24');
INSERT INTO `whole_budgets` VALUES (14, 2500000, 2025, 'Trust Fund', 'Main', '2025-03-04 17:05:15', '2025-03-04 17:05:15');
INSERT INTO `whole_budgets` VALUES (15, 5000000, 2026, 'General Fund', 'Main', '2025-03-12 13:15:52', '2025-03-12 13:15:52');
INSERT INTO `whole_budgets` VALUES (16, 5000000, 2026, 'Special Trust Fund', 'Main', '2025-03-12 13:24:00', '2025-03-12 13:24:00');

SET FOREIGN_KEY_CHECKS = 1;
