# Gestion de Comptes Bancaires - Laravel

**Mini-Projet 2025/2026 – EST Salé (Université Mohammed V de Rabat)**

Application web sécurisée développée avec **Laravel**, permettant la gestion des clients, de leurs comptes bancaires, et l'exécution de **virements sécurisés**.

---

## 📋 Objectifs

- Mettre en pratique le développement web PHP orienté objet avec **Laravel**  
- Respecter les standards de l'industrie : **MVC, ORM, sécurité**  
- Créer une application fonctionnelle de gestion bancaire

---

## ⚡ Fonctionnalités

### Gestion des Clients (CRUD)
- Ajouter, modifier, supprimer et lister les clients  
- Données : Nom, Prénom, Email

### Gestion des Comptes Bancaires (CRUD)
- Un client peut avoir plusieurs comptes (**relation One-to-Many**)  
- Données : RIB, Solde, Client associé

### Système de Virements
- Transfert sécurisé entre deux comptes  
- Utilisation de **transactions ACID** pour garantir l'intégrité des données  
- Vérification des soldes et gestion des erreurs

---

## 🛠️ Concepts Techniques

- **Architecture MVC** : Séparation Modèles / Vues / Contrôleurs  
- **Eloquent ORM** : Gestion des relations et requêtes BDD  
- **Sécurité** : CSRF, validation des formulaires (`$request->validate()`)  
- **Design Patterns** :  
  - Singleton & Factory via le conteneur de services Laravel  
  - Observer pour les événements (logs, mises à jour automatiques)

---

## 🚀 Installation

**Prérequis** : PHP >= 8.1, Composer, MySQL

1. **Cloner le projet**

git clone https://github.com/Mouad-El-Fadli/bank-management.git
cd bank-management

2. **Installer les dépendances**

composer install
npm install && npm run build

3. **Configurer l'environnement**
   
cp .env.example .env

**Modifier les paramètres de la base de données dans .env :**

- DB_CONNECTION=mysql 
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=nom_de_votre_base
- DB_USERNAME=root
- DB_PASSWORD=

4. **Générer la clé d'application**

php artisan key:generate


5. **Migrations et Seeders**

php artisan migrate --seed


6. **Lancer le serveur**

php artisan serve


7. **Accéder à l'application :** http://127.0.0.1:8000




Contributors : 

- [@Mouad-El-Fadli] (https://github.com/Mouad-El-Fadli)
- [@BenOthman-BG] (https://github.com/BenOthman-BG)
- [@yassinebld] (https://github.com/yassinebld)
  

École Supérieure de Technologie de Salé - Filière Informatique

Note pour l'évaluation : Le code respecte les conventions PSR-12 et utilise les mécanismes de protection contre les injections SQL via Eloquen
