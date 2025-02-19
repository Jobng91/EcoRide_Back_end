CREATE DATABASE ecoride_db;

USE ecoride_db;

CREATE TABLE UserRole(
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL UNIQUE,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);




CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    mail VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    photo BLOB,
    credit INT NOT NULL DEFAULT 0 CHECK (credit >= 0),
    role_id INT NOT NULL DEFAULT 1,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES UserRole(id) ON DELETE CASCADE
);

CREATE TABLE Voiture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    couleur VARCHAR(50) NOT NULL,
    energie VARCHAR(50) NOT NULL,
    immatriculation VARCHAR(50) NOT NULL UNIQUE,
    date_first_immatriculation DATE NOT NULL,
    user_id INT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE SET NULL
);


CREATE TABLE Covoiturage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    ville_depart VARCHAR(100) NOT NULL,
    date_arrivee DATE NOT NULL,
    heure_arrivee TIME NOT NULL,
    ville_arrivee VARCHAR(100) NOT NULL,
    statut ENUM('Disponible', 'Complet', 'À venir', 'En cours', 'En attente de validation', 'Terminé', 'Annulé') NOT NULL DEFAULT 'Disponible',
    nombre_places INT NOT NULL CHECK (nombre_places > 0),
    prix_par_personne INT NOT NULL CHECK (prix_par_personne >= 0),
    voiture_id INT NULL,
    conducteur_id INT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (voiture_id) REFERENCES Voiture(id) ON DELETE SET NULL,
    FOREIGN KEY (conducteur_id) REFERENCES User(id) ON DELETE SET NULL
);



CREATE TABLE Participation (
    user_id INT NOT NULL,
    covoiturage_id INT NOT NULL,
    role ENUM('Conducteur', 'Passager') NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, covoiturage_id),
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (covoiturage_id) REFERENCES Covoiturage(id) ON DELETE CASCADE
);



CREATE TABLE UserPreference(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fumeur BOOLEAN NOT NULL DEFAULT FALSE,
    animaux BOOLEAN NOT NULL DEFAULT FALSE,
    preference VARCHAR(100),
    user_id INT NOT NULL UNIQUE,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
);



CREATE TABLE Avis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    note INT NOT NULL CHECK (note >= 0 AND note <= 5),
    commentaire TEXT,
    statut ENUM('En attente', 'Validé', 'Rejeté') DEFAULT 'En attente',
    auteur_id INT NOT NULL,
    cible_id INT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (cible_id) REFERENCES User(id) ON DELETE CASCADE
);


CREATE TABLE Plainte(
    id INT AUTO_INCREMENT PRIMARY KEY,
    detail TEXT NOT NULL,
    covoiturage_id INT NOT NULL,
    plaignant_id INT NOT NULL,
    cible_id INT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (plaignant_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (cible_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (covoiturage_id) REFERENCES Covoiturage(id) ON DELETE CASCADE
);

