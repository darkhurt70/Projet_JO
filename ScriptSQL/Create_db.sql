DROP TABLE IF EXISTS personnage;
DROP TABLE IF EXISTS unitclass;
DROP TABLE IF EXISTS element;
DROP TABLE IF EXISTS origin;



CREATE TABLE element (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
);

CREATE TABLE origin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
);

CREATE TABLE unitclass (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
);

CREATE TABLE USERS (
    id VARCHAR(255) PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    hash_pwd VARCHAR(255) NOT NULL
);

CREATE TABLE personnage (
                            id VARCHAR(50) PRIMARY KEY,
                            name VARCHAR(100) NOT NULL,
                            element INT NOT NULL,
                            unitclass INT NOT NULL,
                            origin INT NOT NULL,
                            rarity INT NOT NULL,
                            url_img VARCHAR(255) NOT NULL,
                            FOREIGN KEY (element) REFERENCES element(id) ON DELETE RESTRICT,
                            FOREIGN KEY (unitclass) REFERENCES unitclass(id) ON DELETE RESTRICT,
                            FOREIGN KEY (origin) REFERENCES origin(id) ON DELETE RESTRICT
);

INSERT INTO USERS (id, username, hash_pwd)
VALUES ('6540fae154f12', 'admin', '$2y$10$xNbTdf4ogIX5oDixCcUOi.9PftzWBJP3ZydZbb4F9zBZrcX4WJdCG');




INSERT INTO element (name, url_img) VALUES
('Pyro',    'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/pyro-element-genshin-impact-wiki-guide.png'),
('Anemo',   'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/anemo-element-genshin-impact-wiki-guide.png'),
('Electro', 'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/electro-element-genshin-impact-wiki-guide.png'),
('Geo',     'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/geo-element-genshin-impact-wiki-guide.png'),
('Cryo',    'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/cryo-element-genshin-impact-wiki-guide.png'),
('Hydro',   'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/hydro-element-genshin-impact-wiki-guide.png'),
('Dendro',  'https://genshinimpact.wiki.fextralife.com/file/Genshin-Impact/dendro-element-genshin-impact-wiki-guide.png');

INSERT INTO origin (name, url_img) VALUES
('Mondstadt', 'https://static.wikia.nocookie.net/genshinimpact/images/b/bc/Embl%C3%A8me_Mondstadt.png/revision/latest?cb=20210122124551&path-prefix=fr'),
('Liyue', 'https://static.wikia.nocookie.net/genshin-impact/images/c/c5/Emblema_Liyue.png/revision/latest?cb=20210224103844&path-prefix=pt-br'),
('Inazuma', 'https://static.wikia.nocookie.net/genshin-impact/images/9/9e/Emblem_Inazuma.png/revision/latest?cb=20220501140809&path-prefix=id'),
('Sumeru', 'https://static.wikia.nocookie.net/gensin-impact/images/e/ef/Sumeru_Emblem_Night.png/revision/latest/scale-to-width/360?cb=20231103102413'),
('Fontaine', 'https://static.wikia.nocookie.net/gensin-impact/images/0/06/Fontaine_Emblem_Night.png/revision/latest/scale-to-width/360?cb=20231103102400'),
('Snezhnaya', '');

INSERT INTO unitclass (name, url_img) VALUES
('Sword', 'https://act-webstatic.hoyoverse.com/event-static-hoyowiki-admin/2024/03/27/eb8602badf0ade7c03650a440d188ce1_4346782947893420142.png?x-oss-process=image%2Fformat%2Cwebp'),
('Claymore', 'https://act-webstatic.hoyoverse.com/event-static-hoyowiki-admin/2024/03/27/4b65ed8d8fd30705265fa10ee65c8b61_7363045695641018717.png?x-oss-process=image%2Fformat%2Cwebp'),
('Polearm', 'https://act-webstatic.hoyoverse.com/event-static-hoyowiki-admin/2024/03/27/9c0f0c167f2753035b78c0aed9f01b9f_3170160339356492715.png?x-oss-process=image%2Fformat%2Cwebp'),
('Bow', 'https://act-webstatic.hoyoverse.com/event-static-hoyowiki-admin/2024/03/27/e38debacfd0147020895322333ea9d2a_4867338674175003782.png?x-oss-process=image%2Fformat%2Cwebp'),
('Catalyst', 'https://act-webstatic.hoyoverse.com/event-static-hoyowiki-admin/2024/03/27/91c80bbf63e574fc6d6b1cb8563cf8e3_5665224225336557820.png?x-oss-process=image%2Fformat%2Cwebp');


INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img)
VALUES
('perso002', 'Yoimiya',            1, 4, 3, 5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Yoimiya-Portrait.png'),
('perso003', 'Venti',              2, 4, 1, 5, 'https://presseplay.fr/wp-content/uploads/2022/08/Character_Venti_Full_Wish.webp'),
('perso004', 'Jean',               2, 1, 1, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Jean_avatar.webp'),
('perso005', 'Keqing',             3, 1, 2, 5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Character_Keqing_Portrait-768x1035.png'),
('perso006', 'Zhongli',            4, 3, 2, 5, 'https://www.next-stage.fr/wp-content/uploads/2023/07/zhongli-geo-profile-genshin-impact-1.webp'),
('perso007', 'Hu Tao',             1, 3, 2, 5, 'https://upload.wikimedia.org/wikipedia/en/b/b2/Hu_Tao_%28Genshin_Impact%29.png'),
('perso008', 'Klee',               1, 5, 1, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Klee_avatar.webp'),
('perso009', 'Eula',               5, 2, 1, 5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Character_Eula_Portrait-768x1154.png'),
('perso010', 'Albedo',             4, 1, 1, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Albedo_avatar.webp'),
('perso011', 'Raiden Shogun',      3, 3, 3, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Shogun_Raiden_avatar.webp'),
('perso012', 'Kamisato Ayaka',     5, 1, 3, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Kamisato_Ayaka_avatar.webp'),
('perso013', 'Kamisato Ayato',     6, 1, 3, 5, 'https://i.redd.it/happy-birthday-kamisato-ayato-v0-qzdorv59jyqe1.jpg?width=3000&format=pjpg&auto=webp&s=7a893edf833e08c348cfc0c46eeda50abd669c7f'),
('perso014', 'Tartaglia',          6, 4, 6, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Tartaglia_avatar.webp'),
('perso015', 'Ganyu',              5, 4, 2, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Ganyu_avatar.webp'),
('perso016', 'Xiao',               2, 3, 2, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Xiao_avatar.webp'),
('perso017', 'Nahida',             7, 5, 4, 5, 'https://www.jolie-bobine.fr/wp-content/uploads/2022/11/Genshin-Impact-Meilleures-compositions-dequipe-pour-Nahida.jpg'),
('perso018', 'Furina',             6, 1, 5, 5, 'https://upload.wikimedia.org/wikipedia/en/5/56/Furina_%28Genshin_Impact%29.png'),
('perso019', 'Neuvillette',        6, 5, 5, 5, 'https://hoyo.global/wp-content/uploads/2023/10/neuvillette-character-avatar-profile-genshin-1.webp'),
('perso020', 'Clorinde',           3, 1, 5, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2024/05/Clorinde_avatar.webp'),
('perso021', 'Razor',              3, 2, 1, 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Razor_avatar.webp');