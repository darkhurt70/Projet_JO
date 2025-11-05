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
  'https://static.wikia.nocookie.net/gensin-impact/images/5/5a/Diluc_Card.png'
);
