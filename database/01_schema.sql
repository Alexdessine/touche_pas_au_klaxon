-- ==========================================================================
-- Database: touche_pas_au_klaxon
-- ==========================================================================

-- ==========================================================================
-- 01_schema.sql
-- Objectif : Création de la structure de la base de données
-- Contraintes métier : 
--   - Un utilisateur peut créer plusieurs trajets
--   - Un trajet doit être associé à un utilisateur
--   - Un trajet doit avoir une origine, une destination, une date et un nombre de places disponibles
-- ==========================================================================

use tpak;

-- Suppression des tables existantes pour éviter les conflits
drop table if exists trips;
drop table if exists agencies;
drop table if exists users;


-- Création de la table users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Création de la table agencies
create table agencies (
    id int auto_increment primary key,
    name varchar(100) not null UNIQUE,
    created_at timestamp default current_timestamp
);


-- Création de la table trips
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    available_seats INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (departure_agency_id) REFERENCES agencies(id),
    FOREIGN KEY (arrival_agency_id) REFERENCES agencies(id),

    CHECK (available_seats > 0),
    CHECK (arrival_time > departure_time),
    CHECK (departure_agency_id <> arrival_agency_id)
);
