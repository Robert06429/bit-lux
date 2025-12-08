DROP DATABASE IF EXISTS bitlux;
CREATE DATABASE bitlux;
USE bitlux;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin INT NOT NULL
);

INSERT INTO users (username, password, admin)
VALUES 
('Robert', 'hoi', 1),
('andy', 'moi', 0),
('pater', 'stok', 1);

CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    beschrijving TEXT NOT NULL,
    foto1 VARCHAR(255) NOT NULL,
    foto2 VARCHAR(255) NOT NULL,
    foto3 VARCHAR(255) NOT NULL,
    prijs FLOAT NOT NULL,
    materiaal VARCHAR(255) NOT NULL,
    geslacht INT NOT NULL,
    diamant INT NOT NULL,
    categorie VARCHAR(100) NOT NULL
);

CREATE TABLE winkelmand (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productid INT NOT NULL
);

INSERT INTO product (naam, beschrijving, foto1, foto2, foto3, prijs, materiaal, geslacht, diamant, categorie)
VALUES
('mannen armband 1', 'Product uit foto/mannen-armband', 'foto/mannen-armband/11.webp', 'foto/mannen-armband/12.webp', 'foto/mannen-armband/13.webp', 199.99, 'onbekend', 1, 1, 'mannen-armband'),
('mannen armband 2', 'Product uit foto/mannen-armband', 'foto/mannen-armband/21.webp', 'foto/mannen-armband/22.webp', 'foto/mannen-armband/23.webp', 199.99, 'onbekend', 1, 0, 'mannen-armband'),
('mannen armband 3', 'Product uit foto/mannen-armband', 'foto/mannen-armband/31.webp', 'foto/mannen-armband/32.webp', 'foto/mannen-armband/33.webp', 199.99, 'onbekend', 1, 0, 'mannen-armband'),
('mannen armband 4', 'Product uit foto/mannen-armband', 'foto/mannen-armband/41.webp', 'foto/mannen-armband/42.webp', 'foto/mannen-armband/43.webp', 199.99, 'onbekend', 1, 1, 'mannen-armband'),
('mannen armband 5', 'Product uit foto/mannen-armband', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm1.avif', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm2.avif', 'foto/mannen-armband/9K-armband-met-gourmet-schakel-3,9mm3.avif', 199.99, 'onbekend', 1, 0, 'mannen-armband'),
('mannen armband 6', 'Product uit foto/mannen-armband', 'foto/mannen-armband/Zilveren-goldplated-herenschakelarmband1.avif', 'foto/mannen-armband/Zilveren-goldplated-herenschakelarmband2.avif', 'foto/mannen-armband/Zilveren-goldplated-herenschakelarmband3.avif', 199.99, 'onbekend', 1, 0, 'mannen-armband'),

-- mannen-oorbellen
('Men''s Gold Stud Earrings', 'This is a set of men''s gold stud earrings. No diamonds present.', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-1.webp', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-2.avif', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-3.avif', 79.99, 'gold', 1, 0, 'mannen-oorbellen'),
('Men''s Gold Hoop Earrings with Cross', 'This is a pair of men''s gold hoop earrings with a cross detail. No diamonds present.', 'foto/mannen-oorbellen/gouden-herenoorringen-met-kruis-1.avif', NULL, 'foto/mannen-oorbellen/gouden-herenoorringen-met-kruis-3.avif', 79.99, 'gold', 1, 0, 'mannen-oorbellen'),
('Men''s Platinum Gold-Plated Hoop Earrings', 'This is a set of men''s platinum-tone gold-plated hoop earrings with a hanging cross. No diamonds present.', 'foto/mannen-oorbellen/Stalen-goldplated-herenoorringen-met-hanger-kruis (1).avif', NULL, NULL, 74.99, 'platinum (gold-plated)', 1, 0, 'mannen-oorbellen'),
('Men''s Platinum Hoop Earrings', 'This is a set of men''s platinum hoop earrings. No diamonds present.', 'foto/mannen-oorbellen/stalen-heren-oorringen-1.avif', 'foto/mannen-oorbellen/stalen-heren-oorringen-2.avif', 'foto/mannen-oorbellen/stalen-heren-oorringen-3.avif', 74.99, 'platinum', 1, 0, 'mannen-oorbellen'),
('Men''s Silver Gold-Plated Studs', 'This is a set of men''s silver gold-plated stud earrings. No diamonds present.', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-1.avif', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-2.avif', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-3.avif', 69.99, 'silver (gold-plated)', 1, 0, 'mannen-oorbellen'),
('Men''s Silver Round Studs', 'This is a pair of men''s round silver stud earrings. No diamonds present.', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-1.avif', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-2.avif', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-3.avif', 69.99, 'silver', 1, 0, 'mannen-oorbellen'),
('Men''s Silver Square Studs', 'This is a pair of men''s square silver stud earrings. No diamonds present.', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-1.avif', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-2.avif', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-3.avif', 69.99, 'silver', 1, 0, 'mannen-oorbellen'),

-- mannen-ring
('Men''s 14K Gold Signet Ring with Zirconia', 'This is a 14K yellow gold signet ring with zirconia accents. Contains zirconia (diamond-like stone).', 'foto/mannen-ring/14-karaat-geelgouden-zegelring-met-zirkonia1.avif', 'foto/mannen-ring/14-karaat-geelgouden-zegelring-met-zirkonia2.avif', NULL, 249.99, 'gold', 1, 1, 'mannen-ring'),
('Men''s 14K Gold Signet Ring with Diamond', 'This is a 14K gold signet ring with a small diamond accent.', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct1.avif', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct2.avif', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct3.avif', 299.99, 'gold', 1, 1, 'mannen-ring'),
('Men''s Decorative Blue Ring', 'This is a decorative men''s ring with blue detailing. No diamonds present.', 'foto/mannen-ring/blauw1.avif', NULL, NULL, 189.99, 'unknown', 1, 0, 'mannen-ring'),
('Men''s Lion Signet Ring', 'This is a men''s signet ring featuring a lion motif. No diamonds present.', 'foto/mannen-ring/leeuw1.avif', 'foto/mannen-ring/leeuw2.avif', 'foto/mannen-ring/leeuw3.avif', 189.99, 'unknown', 1, 0, 'mannen-ring'),
('Men''s White Ring', 'This is a men''s ring with white accents. No diamonds present.', 'foto/mannen-ring/white1.avif', 'foto/mannen-ring/white2.avif', NULL, 159.99, 'unknown', 1, 0, 'mannen-ring'),
('Men''s Yellow Ring', 'This is a men''s ring with yellow accents. No diamonds present.', 'foto/mannen-ring/yellow.avif', 'foto/mannen-ring/yellow2.avif', 'foto/mannen-ring/yellow3.avif', 159.99, 'unknown', 1, 0, 'mannen-ring'),

-- vrouwen-armband
('Women''s 14K Bicolor Gold Bracelet', 'This is a 14K bicolor gold bracelet — an elegant women''s piece. No diamonds present.', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband1.avif', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband2.avif', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband3.avif', 199.99, 'gold', 0, 0, 'vrouwen-armband'),
('Women''s 14K Gold Heart Bracelet', 'This is a 14K yellow gold bracelet with a heart detail. No diamonds present.', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart1.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart2.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart3.avif', 179.99, 'gold', 0, 0, 'vrouwen-armband'),
('Women''s 14K Gold Cord Bracelet', 'This is a 14K yellow gold cord bracelet with a refined finish. No diamonds present.', 'foto/vrouwen-armband/14-Karaat-geelgouden-armband-koord2.avif', 'foto/vrouwen-armband/14-Karaat-geelgouden-armband-koord3.avif', NULL, 149.99, 'gold', 0, 0, 'vrouwen-armband'),
('Women''s 14K Openwork Heart Bracelet', 'This is a delicate 14K openwork heart bracelet. No diamonds present.', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-opengewerkt-hart2.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-opengewerkt-hart3.avif', NULL, 189.99, 'gold', 0, 0, 'vrouwen-armband'),
('Women''s 14K Gold Bracelet with Zirconia', 'This is a 14K gold bracelet with heart and zirconia accents. Contains zirconia (diamond-like stone).', 'foto/vrouwen-armband/14-Karaat-gouden-armband-hart-en-zirkonia2.avif', 'foto/vrouwen-armband/14-Karaat-gouden-armband-hart-en-zirkonia3.avif', NULL, 219.99, 'gold', 0, 1, 'vrouwen-armband'),

-- mannen-keting
('mannen keting 1', 'Product uit foto/mannen-keting', 'foto/mannen-keting/11.webp', 'foto/mannen-keting/12.webp', 'foto/mannen-keting/13.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),
('mannen keting 2', 'Product uit foto/mannen-keting', 'foto/mannen-keting/21.webp', 'foto/mannen-keting/22.webp', 'foto/mannen-keting/23.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),
('mannen keting 3', 'Product uit foto/mannen-keting', 'foto/mannen-keting/31.webp', 'foto/mannen-keting/32.webp', 'foto/mannen-keting/33.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),
('mannen keting 4', 'Product uit foto/mannen-keting', 'foto/mannen-keting/41.webp', 'foto/mannen-keting/42.webp', 'foto/mannen-keting/43.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),
('mannen keting 5', 'Product uit foto/mannen-keting', 'foto/mannen-keting/51.webp', 'foto/mannen-keting/52.webp', 'foto/mannen-keting/53.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),
('mannen keting 6', 'Product uit foto/mannen-keting', 'foto/mannen-keting/61.webp', 'foto/mannen-keting/62.webp', 'foto/mannen-keting/63.webp', 149.99, 'onbekend', 1, 0, 'mannen-keting'),

-- mannen-oorbellen
('mannen oorbel 1', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-1.webp', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-2.avif', 'foto/mannen-oorbellen/gouden-herenoorknoppen-met-3.avif', 79.99, 'onbekend', 1, 0, 'mannen-oorbellen'),
('mannen oorbel 2', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/gouden-herenoorringen-met-kruis-1.avif', 'foto/mannen-oorbellen/gouden-herenoorringen-met-kruis-3.avif', 'foto/mannen-oorbellen/Stalen-goldplated-herenoorringen-met-hanger-kruis (1).avif', 79.99, 'onbekend', 1, 0, 'mannen-oorbellen'),
('mannen oorbel 3', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/stalen-heren-oorringen-1.avif', 'foto/mannen-oorbellen/stalen-heren-oorringen-2.avif', 'foto/mannen-oorbellen/stalen-heren-oorringen-3.avif', 74.99, 'platinum', 1, 0, 'mannen-oorbellen'),
('mannen oorbel 4', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-1.avif', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-2.avif', 'foto/mannen-oorbellen/Zilveren-met-goldplated-oorknoppen-3.avif', 69.99, 'zilver', 1, 0, 'mannen-oorbellen'),
('mannen oorbel 5', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-1.avif', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-2.avif', 'foto/mannen-oorbellen/Zilveren-oorknoppen-rond-3.avif', 69.99, 'zilver', 1, 0, 'mannen-oorbellen'),
('mannen oorbel 6', 'Product uit foto/mannen-oorbellen', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-1.avif', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-2.avif', 'foto/mannen-oorbellen/Zilveren-voor-heren-oorknoppen-vierkant-3.avif', 69.99, 'zilver', 1, 0, 'mannen-oorbellen'),

-- mannen-ring
('mannen ring 1', 'Product uit foto/mannen-ring', 'foto/mannen-ring/14-karaat-geelgouden-zegelring-met-zirkonia1.avif', 'foto/mannen-ring/14-karaat-geelgouden-zegelring-met-zirkonia2.avif', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct1.avif', 249.99, 'onbekend', 1, 0, 'mannen-ring'),
('mannen ring 2', 'Product uit foto/mannen-ring', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct2.avif', 'foto/mannen-ring/14-Karaat-gouden-zegelring-met-diamant-0,005ct3.avif', 'foto/mannen-ring/blauw1.avif', 299.99, 'onbekend', 1, 1, 'mannen-ring'),
('mannen ring 3', 'Product uit foto/mannen-ring', 'foto/mannen-ring/blauw2.webp', 'foto/mannen-ring/blauw3.webp', 'foto/mannen-ring/leeuw1.avif', 189.99, 'onbekend', 1, 0, 'mannen-ring'),
('mannen ring 4', 'Product uit foto/mannen-ring', 'foto/mannen-ring/leeuw2.avif', 'foto/mannen-ring/leeuw3.avif', 'foto/mannen-ring/white1.avif', 189.99, 'onbekend', 1, 0, 'mannen-ring'),
('mannen ring 5', 'Product uit foto/mannen-ring', 'foto/mannen-ring/white2.avif', 'foto/mannen-ring/white3.webp', 'foto/mannen-ring/yellow.avif', 159.99, 'onbekend', 1, 0, 'mannen-ring'),
('mannen ring 6', 'Product uit foto/mannen-ring', 'foto/mannen-ring/yellow2.avif', 'foto/mannen-ring/yellow3.avif', 'foto/mannen-ring/14-karaat-geelgouden-zegelring-met-zirkonia1.avif', 159.99, 'onbekend', 1, 0, 'mannen-ring'),

-- vrouwen-armband
('vrouwen armband 1', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband1.avif', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband2.avif', 'foto/vrouwen-armband/14-Karaat-bicolor-gouden-armband3.avif', 199.99, 'onbekend', 0, 0, 'vrouwen-armband'),
('vrouwen armband 2', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart1.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart2.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-hart3.avif', 179.99, 'onbekend', 0, 0, 'vrouwen-armband'),
('vrouwen armband 3', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/14-Karaat-geelgouden-armband-koord1.webp', 'foto/vrouwen-armband/14-Karaat-geelgouden-armband-koord2.avif', 'foto/vrouwen-armband/14-Karaat-geelgouden-armband-koord3.avif', 149.99, 'onbekend', 0, 0, 'vrouwen-armband'),
('vrouwen armband 4', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-opengewerkt-hart1.png', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-opengewerkt-hart2.avif', 'foto/vrouwen-armband/14-karaat-geelgouden-armband-opengewerkt-hart3.avif', 189.99, 'onbekend', 0, 0, 'vrouwen-armband'),
('vrouwen armband 5', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/14-Karaat-gouden-armband-hart-en-zirkonia1.webp', 'foto/vrouwen-armband/14-Karaat-gouden-armband-hart-en-zirkonia2.avif', 'foto/vrouwen-armband/14-Karaat-gouden-armband-hart-en-zirkonia3.avif', 219.99, 'onbekend', 0, 1, 'vrouwen-armband'),
('vrouwen armband 6', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/9-Karaat-armband-diamond-cut1.avif', 'foto/vrouwen-armband/9-Karaat-armband-diamond-cut2.avif', 'foto/vrouwen-armband/9-Karaat-armband-diamond-cut3.avif', 159.99, 'onbekend', 0, 0, 'vrouwen-armband'),
('vrouwen armband 7', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/Zilveren-armband-blauwe-zirkonia1.avif', 'foto/vrouwen-armband/Zilveren-armband-blauwe-zirkonia2.avif', 'foto/vrouwen-armband/Zilveren-armband-blauwe-zirkonia3.avif', 139.99, 'zilver', 0, 0, 'vrouwen-armband'),
('vrouwen armband 8', 'Product uit foto/vrouwen-armband', 'foto/vrouwen-armband/Zilveren-goldplated-armband-voor-dames1.avif', 'foto/vrouwen-armband/Zilveren-goldplated-armband-voor-dames2.avif', 'foto/vrouwen-armband/Zilveren-goldplated-armband-voor-dames3.avif', 139.99, 'zilver', 0, 0, 'vrouwen-armband'),

-- vrouwen-ketting
('vrouwen ketting 1', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/9-karaat-bicolor-ketting-met-hanger-open-hart-voor-dames1.webp', 'foto/vrouwen-ketting/9-karaat-bicolor-ketting-met-hanger-open-hart-voor-dames2.avif', 'foto/vrouwen-ketting/9-karaat-bicolor-ketting-met-hanger-open-hart-voor-dames3.avif', 149.99, 'onbekend', 0, 0, 'vrouwen-ketting'),
('vrouwen ketting 2', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-bol-kristal-7mm-voor-dames1.avif', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-bol-kristal-7mm-voor-dames2.avif', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-bol-kristal-7mm-voor-dames3.avif', 129.99, 'onbekend', 0, 0, 'vrouwen-ketting'),
('vrouwen ketting 3', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/9-Karaat-ketting-met-hanger-hoorn1.webp', 'foto/vrouwen-ketting/9-Karaat-ketting-met-hanger-hoorn2.avif', 'foto/vrouwen-ketting/9-Karaat-ketting-met-hanger-hoorn3.avif', 129.99, 'onbekend', 0, 0, 'vrouwen-ketting'),
('vrouwen ketting 4', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-olifant-voor-dames1.avif', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-olifant-voor-dames2.avif', 'foto/vrouwen-ketting/9-karaat-ketting-met-hanger-olifant-voor-dames3.avif', 129.99, 'onbekend', 0, 0, 'vrouwen-ketting'),
('vrouwen ketting 5', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/Zilveren-goldplated-ketting-voor-dames1.webp', 'foto/vrouwen-ketting/Zilveren-goldplated-ketting-voor-dames2.avif', 'foto/vrouwen-ketting/Zilveren-goldplated-ketting-voor-dames3.avif', 129.99, 'zilver', 0, 0, 'vrouwen-ketting'),
('vrouwen ketting 6', 'Product uit foto/vrouwen-ketting', 'foto/vrouwen-ketting/Zilveren-ketting-mat_glans-met-zirkonia1.avif', 'foto/vrouwen-ketting/Zilveren-ketting-mat_glans-met-zirkonia2.avif', 'foto/vrouwen-ketting/Zilveren-ketting-mat_glans-met-zirkonia3.avif', 139.99, 'zilver', 0, 0, 'vrouwen-ketting'),

-- vrouwen-oorbellen
('vrouwen oorbel 1', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/14-karaat-oorbellen-met-hart-1.avif', 'foto/vrouwen-oorbellen/14-karaat-oorbellen-met-hart-2.avif', 'foto/vrouwen-oorbellen/14-karaat-oorbellen-met-hart-3.avif', 129.99, 'goud', 0, 0, 'vrouwen-oorbellen'),
('vrouwen oorbel 2', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/14Karaat-geelgouden-oorbellen-1.avif', 'foto/vrouwen-oorbellen/14Karaat-geelgouden-oorbellen-2.avif', 'foto/vrouwen-oorbellen/14Karaat-geelgouden-oorbellen-3.avif', 149.99, 'goud', 0, 0, 'vrouwen-oorbellen'),
('vrouwen oorbel 3', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/goldplated-oorringen-1.avif', 'foto/vrouwen-oorbellen/goldplated-oorringen-2.avif', 'foto/vrouwen-oorbellen/goldplated-oorringen-3.avif', 109.99, 'onbekend', 0, 0, 'vrouwen-oorbellen'),
('vrouwen oorbel 4', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/Guess-goldplated-oorringhangers-met-kristal-1.avif', 'foto/vrouwen-oorbellen/Guess-goldplated-oorringhangers-met-kristal-2.avif', 'foto/vrouwen-oorbellen/Guess-goldplated-oorringhangers-met-kristal-3.avif', 119.99, 'onbekend', 0, 0, 'vrouwen-oorbellen'),
('vrouwen oorbel 5', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/Zilveren-goldplated-oorknoppen-1.avif', 'foto/vrouwen-oorbellen/Zilveren-goldplated-oorknoppen-2.avif', 'foto/vrouwen-oorbellen/Zilveren-goldplated-oorknoppen-3.avif', 99.99, 'zilver', 0, 0, 'vrouwen-oorbellen'),
('vrouwen oorbel 6', 'Product uit foto/vrouwen-oorbellen', 'foto/vrouwen-oorbellen/Zilveren-oorringen-met-diamant-1.avif', 'foto/vrouwen-oorbellen/Zilveren-oorringen-met-diamant-2.avif', 'foto/vrouwen-oorbellen/Zilveren-oorringen-met-diamant-3.avif', 249.99, 'zilver', 0, 1, 'vrouwen-oorbellen'),

-- vrouwen-ring
('vrouwen ring 1', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-Karaat-bicolour-ring-met-diamant-0,01ct1.webp', 'foto/vrouwen-ring/14-Karaat-bicolour-ring-met-diamant-0,01ct2.avif', 'foto/vrouwen-ring/14-Karaat-bicolour-ring-met-diamant-0,01ct3.avif', 299.99, 'goud', 0, 1, 'vrouwen-ring'),
('vrouwen ring 2', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-Karaat-geelgouden-damesring-hartvorm-zirkonia1.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-damesring-hartvorm-zirkonia2.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-damesring-hartvorm-zirkonia3.avif', 219.99, 'goud', 0, 0, 'vrouwen-ring'),
('vrouwen ring 3', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-karaat-geelgouden-damesring-met-hart1.avif', 'foto/vrouwen-ring/14-karaat-geelgouden-damesring-met-hart2.avif', 'foto/vrouwen-ring/14-karaat-geelgouden-damesring-met-hart3.avif', 199.99, 'goud', 0, 0, 'vrouwen-ring'),
('vrouwen ring 4', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-karaat-geelgouden-ring-met-12-diamanten-0,015ct-slag.1.avif', 'foto/vrouwen-ring/14-karaat-geelgouden-ring-met-12-diamanten-0,015ct-slag.2.avif', 'foto/vrouwen-ring/14-karaat-geelgouden-ring-met-12-diamanten-0,015ct-slag.3.avif', 399.99, 'goud', 0, 1, 'vrouwen-ring'),
('vrouwen ring 5', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-3-zirkonia-stenen1.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-3-zirkonia-stenen2.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-3-zirkonia-stenen3.avif', 179.99, 'goud', 0, 0, 'vrouwen-ring'),
('vrouwen ring 6', 'Product uit foto/vrouwen-ring', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-7-diamanten-0,05ct1.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-7-diamanten-0,05ct2.avif', 'foto/vrouwen-ring/14-Karaat-geelgouden-ring-met-7-diamanten-0,05ct3.avif', 499.99, 'goud', 0, 1, 'vrouwen-ring');
