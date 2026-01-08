# TomTroc

TomTroc est une plateforme web d’échange de livres développée en **PHP (architecture MVC)** avec une base de données **MySQL**.  
Le projet permet aux utilisateurs de publier leurs livres, consulter ceux des autres membres et communiquer via une messagerie interne.

---

## Prérequis

Avant de commencer, assurez-vous d’avoir installé :

- **XAMPP** (ou équivalent)
  - Apache ≥ 2.4
  - PHP ≥ 8.1
  - MySQL ≥ 8.0
- Un navigateur web moderne (Chrome, Firefox, etc.)
- Un outil de gestion de base de données :
  - **phpMyAdmin** (fourni avec XAMPP) ou
  - MySQL Workbench

---

## Installation du projet

### Cloner ou télécharger le projet

Placez le dossier du projet dans le répertoire `htdocs` de XAMPP :

/Applications/XAMPP/xamppfiles/htdocs/Website_TomTroc

Ou sous Windows :

C:\xampp\htdocs\Website_TomTroc

---

### Démarrer les services XAMPP

Ouvrez le panneau de contrôle XAMPP et démarrez :

- Apache
- MySQL

---

## Installation de la base de données

### Créer la base de données

1. Accédez à **phpMyAdmin** :

http://localhost/phpmyadmin

2. Importez la base de données :

```sql
CREATE DATABASE tomtroc_website CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

Importer la structure SQL :

Importez le fichier SQL fourni avec le projet : tomtroc_website.sql

Ce fichier contient l&apos;ensemble des tables et colonnes nécessaires au bon fonctionnement du site.


Configuration de la connexion à la base de données

Configurer les accès MySQL :

Ouvrez le fichier de configuration de la base de données :

/config/config.php


Modifiez les identifiants si nécessaire :

return [
    'host'     => 'localhost',
    'dbname'   => 'tomtroc_website',
    'user'     => 'root',
    'password' => '',
];


(Par défaut, XAMPP utilise root sans mot de passe.)

Lancer le projet
Accéder à l’application

Dans votre navigateur, ouvrez :

http://localhost/Website_TomTroc/index.php

👤 Fonctionnalités principales

Inscription / Connexion utilisateur

Ajout, modification et suppression de livres

Consultation des livres disponibles

Profils utilisateurs (public / privé)

Messagerie interne avec notifications

Compteur de messages non lus

Affichage des derniers livres ajoutés
```
