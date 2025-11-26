# Projet_JO
Projet_Genshin
Genshin Impact - Gestionnaire de Personnages
============================================

Ce projet est une application PHP permettant de gérer les personnages du jeu Genshin Impact : ajout, modification, suppression, et gestion de leurs attributs (éléments, origines, classes).  
Il inclut également une gestion des logs et un début de système d’authentification.

------------------------------------------------------
Fonctionnalités
------------------------------------------------------
- Authentification utilisateur (login/logout) non fonctionnel
- CRUD des personnages (Create, Read, Update, Delete)
- Ajout dynamique des attributs : éléments, origines, classes
- Visualisation des logs d’activités
- Architecture MVC claire avec DAO, services et routeurs

------------------------------------------------------
Technologies utilisées
------------------------------------------------------
- Langage : PHP 8+
- Base de données : MySQL
- IDE recommandé : PHPStorm
- Template engine : Plates
- Architecture : MVC (Modèle-Vue-Contrôleur)

------------------------------------------------------
Structure du projet
------------------------------------------------------
Projet_JO/  
├── Config/            → Configuration (DSN, utilisateur, mot de passe)       
├── Controllers/       → Contrôleurs MVC    
├── Helpers/           → Classes utilitaires (logs, messages)   
├── logs/              → Fichiers de logs générés automatiquement   
├── Models/            → Entités et DAO (accès à la BDD)    
├── Public/            → Css du projet  
├── ScriptSQL/         → Script SQL pour créer la BDD   
├── Services/          → Hydratation des objets métier  
├── Vendor/            → Plates     
├── Views/             → Fichiers HTML  
├── Index.php          → Point d'entrée principal   
└── README.md         → Ce fichier 

------------------------------------------------------
Prérequis
------------------------------------------------------
- PHP 8.1 ou plus
- MySQL (testé sur VsCode avec les 2 premières extension lorsque l'on cherche Mysql)

------------------------------------------------------
Installation
------------------------------------------------------
1. Cloner le projet :
   git clone <url-du-dépôt>

2. Ouvrir le projet dans PHPStorm

3. Créer la base de données :
    - Ouvrir phpMyAdmin ou tout client MySQL
    - Exécuter le fichier SQL : ScriptSQL/create_db.sql


4. Configurer la base de données :
   copier Config/dev_sample.ini et Modifier le fichier en `Config/dev.ini` :

```ini
[database]
dsn = "mysql:host=localhost;dbname=genshin;charset=utf8"
user = "root"
pass = ""
```

5. Lancer l'application :
   php -S localhost:8000 -t .

6. Accéder à l'application :
   http://localhost:8000/index.php


------------------------------------------------------
Informations complémentaires
------------------------------------------------------
- Les fichiers de logs sont générés dans le dossier "logs/".

------------------------------------------------------
Auteur
------------------------------------------------------
Développé par : Julien Onillon  
Établissement : Eseo  
Année : 2025
