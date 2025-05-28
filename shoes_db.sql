CREATE DATABASE IF NOT EXISTS `shoes_db`;
USE `shoes_db`;


CREATE TABLE `marke` (
    `id_marke` int(6) NOT NULL AUTO_INCREMENT,
    `naziv_marke` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id_marke`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `marke` (`naziv_marke`) VALUES ('NIKE'), ('ADIDAS'), ('NEW BALANCE'), ('PUMA');

CREATE TABLE `proizvodi` (
    `id_proizvoda` int(6) NOT NULL AUTO_INCREMENT,
    `naziv` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `id_marke` int(6) NOT NULL,
    `sezona` YEAR NOT NULL,
    `pol` enum('m','z') COLLATE utf8mb4_unicode_ci NOT NULL,
    `cena` int(20) unsigned NOT NULL,
    `popust` int(20) NOT NULL DEFAULT 0,
    `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id_proizvoda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `proizvodi`
    ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`id_marke`) REFERENCES `marke` (`id_marke`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

INSERT INTO `proizvodi` (`naziv`, `id_marke`, `sezona`, `pol`, `cena`, `popust`, `slika`) VALUES
    ('AIR MAX 97', 1, '2021', 'm', 25000, 0, 'slika1.jpg'),
    ('AIR MAX 97', 1, '2021', 'm', 25000, 0, 'slika2.jpg'),
    ('AIR MAX 720', 1, '2021', 'm', 24000, 5, 'slika3.jpg'),
    ('AIR MAX 98 SE', 1, '2021', 'm', 25000, 10, 'slika4.jpg'),
    ('NIKE MX-720', 1, '2020', 'm', 20000, 5, 'slika5.jpg'),
    ('NIKE MX-720', 1, '2020', 'm', 22000, 10, 'slika6.jpg'),
    ('NIKE Air Vapormax 2', 1, '2020', 'z', 30000, 10, 'slika7.jpg'),
    ('NIKE W AIR VAPORMAX ', 1, '2020', 'z', 29000, 35, 'slika8.jpg'),
    ('AIR FORCE', 1, '2020', 'm', 20000, 5, 'slika9.jpg'),
    ('AIR FORCE', 1, '2020', 'm', 20000, 5, 'slika10.jpg'),
    ('NMD_R1', 2, '2020', 'm', 17000, 0, 'slika11.jpg'),
    ('adidas SUPERSTAR', 2, '2020', 'm', 15000, 5, 'slika12.jpg'),
    ('adidas SUPERSTAR', 2, '2020', 'm', 12000, 2, 'slika13.jpg'),
    ('NMD_R1 STEALTH', 2, '2020', 'z', 14000, 5, 'slika14.jpg'),
    ('NITE JOGGER W', 2, '2020', 'z', 15000, 10, 'slika15.jpg'),
    ('NEW BALANCE M997', 3, '2021', 'm', 12000, 0, 'slika16.jpg'),
    ('NEW BALANCE M997', 3, '2021', 'm', 10000, 20, 'slika17.jpg'),
    ('NEW BALANCE W 574', 3, '2020-', 'z', 10000, 15, 'slika18.jpg'),
    ('NEW BALANCE W 997', 3, '2020', 'z', 11000, 15, 'slika19.jpg'),
    ('NEW BALANCE W 997', 3, '2020', 'z', 10000, 25, 'slika20.jpg'),
    ('PUMA CELL ENDURA', 4, '2020', 'm', 15000, 15, 'slika21.jpg'),
    ('PUMA CELL ENDURA', 4, '2020', 'm', 10000, 15, 'slika22.jpg'),
    ('PUMA RS-X PLAY', 4, '2020', 'z', 15000, 35, 'slika23.jpg'),
    ('PUMA RS 2.0 FUTURA', 4, '2020', 'z', 12000, 50, 'slika24.jpg'),
    ('PUMA RS-2K SOFT META', 4, '2020', 'z', 20000, 60, 'slika25.jpg');

CREATE TABLE `slike` (
    `id_slike` int(6) NOT NULL,
    `slika` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id_slike`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `slike` (`id_slike`, `slika`) VALUES
    (101, 'slika1-1.jpg'),
    (102, 'slika1-2.jpg'),
    (103, 'slika1-3.jpg'),
    (201, 'slika2-1.jpg'),
    (202, 'slika2-2.jpg'),
    (203, 'slika2-3.jpg'),
    (204, 'slika2-4.jpg'),
    (301, 'slika3-1.jpg'),
    (302, 'slika3-2.jpg'),
    (303, 'slika3-3.jpg'),
    (401, 'slika4-1.jpg'),
    (402, 'slika4-2.jpg'),
    (403, 'slika4-3.jpg'),
    (404, 'slika4-4.jpg'),
    (501, 'slika5-1.jpg'),
    (502, 'slika5-2.jpg'),
    (503, 'slika5-3.jpg'),
    (504, 'slika5-4.jpg'),
    (601, 'slika6-1.jpg'),
    (602, 'slika6-2.jpg'),
    (603, 'slika6-3.jpg'),
    (604, 'slika6-4.jpg'),
    (701, 'slika7-1.jpg'),
    (702, 'slika7-2.jpg'),
    (703, 'slika7-3.jpg'),
    (704, 'slika7-4.jpg'),
    (801, 'slika8-1.jpg'),
    (802, 'slika8-2.jpg'),
    (803, 'slika8-3.jpg'),
    (901, 'slika9-1.jpg'),
    (902, 'slika9-2.jpg'),
    (1001, 'slika10-1.jpg'),
    (1002, 'slika10-2.jpg'),
    (1101, 'slika11-1.jpg'),
    (1102, 'slika11-2.jpg'),
    (1201, 'slika12-1.jpg'),
    (1202, 'slika12-2.jpg'),
    (1301, 'slika13-1.jpg'),
    (1302, 'slika13-2.jpg'),
    (1401, 'slika14-1.jpg'),
    (1402, 'slika14-2.jpg'),
    (1501, 'slika15-1.jpg'),
    (1601, 'slika16-1.jpg'),
    (1602, 'slika16-2.jpg'),
    (1701, 'slika17-1.jpg'),
    (1702, 'slika17-2.jpg'),
    (1703, 'slika17-3.jpg'),
    (1801, 'slika18-1.jpg'),
    (1802, 'slika18-2.jpg'),
    (1901, 'slika19-1.jpg'),
    (1902, 'slika19-2.jpg'),
    (2001, 'slika20-1.jpg'),
    (2002, 'slika20-2.jpg'),
    (2101, 'slika21-1.jpg'),
    (2102, 'slika21-2.jpg'),
    (2201, 'slika22-1.jpg'),
    (2202, 'slika22-2.jpg'),
    (2301, 'slika23-1.jpg'),
    (2302, 'slika23-2.jpg'),
    (2401, 'slika24-1.jpg'),
    (2402, 'slika24-2.jpg'),
    (2501, 'slika25-1.jpg'),
    (2502, 'slika25-2.jpg'),
    (2503, 'slika25-3.jpg');

CREATE TABLE `proizvodi_slike` (
    `id` int(6) NOT NULL AUTO_INCREMENT,
    `id_proizvoda` int(6) NOT NULL,
    `id_slike` int(6) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `proizvodi_slike`
    ADD CONSTRAINT `proizvodi_slike_ibfk_1` FOREIGN KEY (`id_proizvoda`) REFERENCES `proizvodi` (`id_proizvoda`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    ADD CONSTRAINT `proizvodi_slike_ibfk_2` FOREIGN KEY (`id_slike`) REFERENCES `slike` (`id_slike`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

INSERT INTO `proizvodi_slike` (`id_proizvoda`, `id_slike`) VALUES
    (1, 101),
    (1, 102),
    (1, 103),
    (2, 201),
    (2, 202),
    (2, 203),
    (2, 204),
    (3, 301),
    (3, 302),
    (3, 303),
    (4, 401),
    (4, 402),
    (4, 403),
    (4, 404),
    (5, 501),
    (5, 502),
    (5, 503),
    (5, 504),
    (6, 601),
    (6, 602),
    (6, 603),
    (6, 604),
    (7, 701),
    (7, 702),
    (7, 703),
    (7, 704),
    (8, 801),
    (8, 802),
    (8, 803),
    (9, 901),
    (9, 902),
    (10, 1001),
    (10, 1002),
    (11, 1101),
    (11, 1102),
    (12, 1201),
    (12, 1202),
    (13, 1301),
    (13, 1302),
    (14, 1401),
    (14, 1402),
    (15, 1501),
    (16, 1601),
    (16, 1602),
    (17, 1701),
    (17, 1702),
    (17, 1703),
    (18, 1801),
    (18, 1802),
    (19, 1901),
    (19, 1902),
    (20, 2001),
    (20, 2002),
    (21, 2101),
    (21, 2102),
    (22, 2201),
    (22, 2202),
    (23, 2301),
    (23, 2302),
    (24, 2401),
    (24, 2402),
    (25, 2501),
    (25, 2502),
    (25, 2503);

CREATE TABLE `brojevi` (
    `id` int(6) NOT NULL AUTO_INCREMENT,
    `id_proizvoda` int(6) NOT NULL,
    `broj` float NOT NULL,
    `kolicina` int(10) NOT NULL DEFAULT 100,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `brojevi`
    ADD FOREIGN KEY (`id_proizvoda`)
    REFERENCES `proizvodi`(`id_proizvoda`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

INSERT INTO `brojevi` (`id_proizvoda`, `broj`, `kolicina`) VALUES
(1, 41, 80),
(1, 42, 93),
(1, 43, 12),
(1, 43.5, 95),
(1, 44, 100),
(1, 44.5, 100),
(2, 41, 100),
(2, 41.5, 100),
(2, 43, 100),
(2, 43.5, 100),
(2, 44, 100),
(2, 45, 100),
(3, 41, 100),
(3, 41.5, 100),
(3, 42, 100),
(3, 43, 100),
(3, 44, 100),
(3, 45, 100),
(4, 41, 100),
(4, 41.5, 100),
(4, 42, 100),
(4, 43, 100),
(4, 43.5, 100),
(4, 44, 100),
(4, 45, 100),
(5, 41, 100),
(5, 41.5, 100),
(5, 42, 100),
(5, 43, 100),
(5, 43.5, 100),
(5, 44, 100),
(5, 45, 100),
(6, 41, 100),
(6, 41.5, 100),
(6, 42, 100),
(6, 43, 100),
(6, 43.5, 100),
(6, 44, 100),
(7, 38, 100),
(7, 38.5, 100),
(7, 39, 100),
(7, 40, 100),
(7, 40.5, 100),
(8, 37, 100),
(8, 37.5, 100),
(8, 38, 100),
(8, 38.5, 100),
(8, 39, 100),
(9, 41, 100),
(9, 41.5, 100),
(9, 42, 100),
(9, 43, 100),
(9, 43.5, 100),
(9, 44, 100),
(9, 45, 100),
(10, 41, 75),
(10, 41.5, 85),
(10, 43, 85),
(10, 44, 85),
(10, 45, 85),
(11, 41, 100),
(11, 41.5, 100),
(11, 42, 100),
(11, 43, 100),
(11, 43.5, 100),
(11, 44, 100),
(12, 41.5, 100),
(12, 42, 100),
(12, 43, 100),
(12, 43.5, 100),
(12, 44, 100),
(12, 45, 100),
(13, 41, 100),
(13, 41.5, 100),
(13, 42, 100),
(13, 45, 100),
(14, 37, 100),
(14, 37.5, 100),
(14, 38, 100),
(14, 39, 100),
(14, 39.5, 100),
(14, 40, 100),
(14, 40.5, 100),
(15, 37, 100),
(15, 37.5, 100),
(15, 38, 100),
(15, 39, 100),
(15, 39.5, 37),
(15, 40, 100),
(15, 40.5, 100),
(16, 41, 100),
(16, 41.5, 100),
(16, 42, 100),
(16, 43, 100),
(16, 43.5, 100),
(16, 44, 100),
(16, 45, 100),
(17, 40, 100),
(17, 41.5, 100),
(17, 42.5, 95),
(17, 14, 100),
(17, 44, 100),
(17, 44.5, 100),
(17, 45, 100),
(18, 37, 100),
(18, 37.5, 100),
(18, 38, 100),
(18, 39, 100),
(18, 40.5, 100),
(19, 37, 87),
(19, 37.5, 100),
(19, 38, 100),
(19, 39, 100),
(19, 39.5, 100),
(19, 40, 100),
(19, 40.5, 94),
(20, 37, 100),
(20, 37.5, 100),
(20, 38, 100),
(20, 39, 100),
(20, 39.5, 100),
(20, 40, 100),
(20, 40.5, 100),
(21, 41, 100),
(21, 41.5, 100),
(21, 42, 100),
(21, 43, 100),
(21, 43.5, 100),
(21, 44, 100),
(21, 45, 100),
(22, 42, 100),
(22, 43, 100),
(22, 43.5, 100),
(22, 44, 100),
(22, 45, 100),
(23, 37, 100),
(23, 37.5, 100),
(23, 38, 100),
(23, 39, 100),
(23, 39.5, 88),
(23, 40, 100),
(23, 40.5, 100),
(24, 37, 100),
(24, 37.5, 100),
(24, 38, 100),
(24, 39, 100),
(24, 39.5, 100),
(24, 40, 100),
(25, 38, 100),
(25, 39, 100);

CREATE TABLE `korisnik` (
  `id_korisnika` int(6) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `grad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postanski_broj` int(20) NOT NULL,
  `lozinka` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `nivo` tinyint(1) NOT NULL DEFAULT 0,
   PRIMARY KEY (`id_korisnika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `stavke_korpe` (
    `id_stavke` INT NOT NULL AUTO_INCREMENT ,
    `id_korpe` INT NOT NULL ,
    `id_proizvoda` INT(6) NOT NULL ,
    `broj` FLOAT NOT NULL ,
    `kolicina` INT NOT NULL ,
    PRIMARY KEY (`id_stavke`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

ALTER TABLE `stavke_korpe`
ADD FOREIGN KEY (`id_proizvoda`)
REFERENCES `proizvodi`(`id_proizvoda`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `stavke_korpe`
ADD FOREIGN KEY (`id_korpe`)
REFERENCES `korisnik`(`id_korisnika`)
ON DELETE CASCADE
ON UPDATE CASCADE;

CREATE TABLE `porudzbine` (
    `id_porudzbine` INT NOT NULL AUTO_INCREMENT,
    `id_korisnika` INT NOT NULL,
    `datum_porudzbine` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (`id_porudzbine`)
);

CREATE TABLE `stavke_porudzbine` (
    `id_stavke` INT NOT NULL AUTO_INCREMENT,
    `id_porudzbine` INT NOT NULL,
    `id_proizvoda` INT NOT NULL,
    `broj` INT NOT NULL,
    `kolicina` INT NOT NULL,
    PRIMARY KEY (`id_stavke`),
    FOREIGN KEY (`id_porudzbine`) REFERENCES porudzbine(id_porudzbine) ON DELETE CASCADE
);
