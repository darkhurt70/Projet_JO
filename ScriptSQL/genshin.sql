CREATE TABLE personnage (
  id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  element VARCHAR(255) NOT NULL,
  unitclass VARCHAR(255) NOT NULL,
  origin VARCHAR(255),
  rarity INT NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img)
VALUES (
  'perso001',
  'Diluc',
  'Pyro',
  'Claymore',
  'Mondstadt',
  5,
  'https://static.wikia.nocookie.net/genshinimpact/images/d/d4/Diluc_carte.png/revision/latest?cb=20231105141815&path-prefix=fr'
);


INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img)
VALUES (
  'perso002',
  'Yoimiya',
  'Pyro',
  'Arc',
  'Mondstadt',
  5,
  'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Diluc_avatar.webp'
);


INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img)
VALUES
  ('perso002', 'Yoimiya',            'Pyro',   'Bow',      'Inazuma',   5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Yoimiya-Portrait.png'),
  ('perso003', 'Venti',              'Anemo',  'Bow',      'Mondstadt', 5, 'https://presseplay.fr/wp-content/uploads/2022/08/Character_Venti_Full_Wish.webp'),
  ('perso004', 'Jean',               'Anemo',  'Sword',    'Mondstadt', 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Jean_avatar.webp'),
  ('perso005', 'Keqing',             'Electro','Sword',    'Liyue',     5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Character_Keqing_Portrait-768x1035.png'),
  ('perso006', 'Zhongli',            'Geo',    'Polearm',  'Liyue',     5, 'https://www.next-stage.fr/wp-content/uploads/2023/07/zhongli-geo-profile-genshin-impact-1.webp'),
  ('perso007', 'Hu Tao',             'Pyro',   'Polearm',  'Liyue',     5, 'https://upload.wikimedia.org/wikipedia/en/b/b2/Hu_Tao_%28Genshin_Impact%29.png'),
  ('perso008', 'Klee',               'Pyro',   'Catalyst', 'Mondstadt', 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Klee_avatar.webp'),
  ('perso009', 'Eula',               'Cryo',   'Claymore', 'Mondstadt', 5, 'https://gaming.lebusmagique.fr/wp-content/uploads/Character_Eula_Portrait-768x1154.png'),
  ('perso010', 'Albedo',             'Geo',    'Sword',    'Mondstadt', 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Albedo_avatar.webp'),
  ('perso011', 'Raiden Shogun',      'Electro','Polearm',  'Inazuma',   5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Shogun_Raiden_avatar.webp'),
  ('perso012', 'Kamisato Ayaka',     'Cryo',   'Sword',    'Inazuma',   5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Kamisato_Ayaka_avatar.webp'),
  ('perso013', 'Kamisato Ayato',     'Hydro',  'Sword',    'Inazuma',   5, 'https://i.redd.it/happy-birthday-kamisato-ayato-v0-qzdorv59jyqe1.jpg?width=3000&format=pjpg&auto=webp&s=7a893edf833e08c348cfc0c46eeda50abd669c7f'),
  ('perso014', 'Tartaglia',          'Hydro',  'Bow',      'Snezhnaya', 5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Tartaglia_avatar.webp'),
  ('perso015', 'Ganyu',              'Cryo',   'Bow',      'Liyue',     5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Ganyu_avatar.webp'),
  ('perso016', 'Xiao',               'Anemo',  'Polearm',  'Liyue',     5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Xiao_avatar.webp'),
  ('perso017', 'Nahida',             'Dendro', 'Catalyst', 'Sumeru',    5, 'https://www.jolie-bobine.fr/wp-content/uploads/2022/11/Genshin-Impact-Meilleures-compositions-dequipe-pour-Nahida.jpg'),
  ('perso018', 'Furina',             'Hydro',  'Sword',    'Fontaine',  5, 'https://upload.wikimedia.org/wikipedia/en/5/56/Furina_%28Genshin_Impact%29.png'),
  ('perso019', 'Neuvillette',        'Hydro',  'Catalyst', 'Fontaine',  5, 'https://hoyo.global/wp-content/uploads/2023/10/neuvillette-character-avatar-profile-genshin-1.webp'),
  ('perso020', 'Clorinde',           'Electro','Sword',    'Fontaine',  5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2024/05/Clorinde_avatar.webp'),
  ('perso021', 'Razor',           'Electro','Claymore',    'Montstad',  5, 'https://lagazettedeteyvat.fr/wp-content/uploads/2022/06/Razor_avatar.webp');
