Application de Gestion de Comptes Bancaires (Laravel)

Mini-Projet 2025/2026 - EST Salé (Université Mohammed V de Rabat)

Ce projet est une application web sécurisée développée avec le framework Laravel. Elle permet la gestion administrative de clients et de leurs comptes bancaires, ainsi que l'exécution de virements sécurisés.

📋 Contexte et Objectifs

L'objectif de ce projet est de mettre en pratique le développement web PHP orienté objet avec Laravel en respectant les standards de l'industrie (MVC, Sécurité, ORM).

Fonctionnalités Principales

Gestion des Clients (CRUD) :

Ajout, modification, suppression et listage des clients.

Données : Nom, Prénom, Email.

Gestion des Comptes Bancaires (CRUD) :

Un client peut posséder plusieurs comptes (Relation One-to-Many).

Données : RIB, Solde, Client associé.

Système de Virements :

Transfert d'argent entre deux comptes distincts.

Utilisation de Transactions SGBD (ACID) pour garantir l'intégrité des données.

Vérification des soldes et gestion des erreurs.

🛠️ Concepts Techniques & Design Patterns

Conformément au cahier des charges, ce projet implémente :

Architecture MVC : Séparation stricte des Modèles, Vues et Contrôleurs.

Eloquent ORM : Gestion des relations (hasMany, belongsTo) et des requêtes BDD.

Sécurité : Protection CSRF sur tous les formulaires et validation stricte des données ($request->validate()).

Design Patterns PHP :

Singleton & Factory (via le conteneur de services Laravel).

Observer (ex: mise à jour automatique ou logs lors d'événements).

🚀 Guide d'Installation

Prérequis : PHP >= 8.1, Composer, MySQL.

Cloner le projet

git clone [https://github.com/Mouad-El-Fadli/bank-management]
cd nom-repo


Installer les dépendances

composer install
npm install && npm run build


Configuration de l'environnement

Dupliquer le fichier .env.example en .env.

Configurer la base de données dans .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base
DB_USERNAME=root
DB_PASSWORD=


Générer la clé d'application

php artisan key:generate


Migrations et Seeders (Jeux de données)

Crée les tables (clients, comptes, etc.) et insère des fausses données pour tester.

php artisan migrate --seed


Lancer le serveur

php artisan serve


Accédez à l'application sur : http://127.0.0.1:8000

📂 Structure de la Base de Données

clients

id (PK)

nom (String)

prenom (String)

email (Unique)

comptes

id (PK)

rib (String, Unique)

solde (Decimal)

client_id (FK -> clients)

📝 Auteurs

el fad mouad 1

boss yassine 2 

École Supérieure de Technologie de Salé - Filière Informatique

Note pour l'évaluation : Le code respecte les conventions PSR-12 et utilise les mécanismes de protection contre les injections SQL via Eloquen
