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
create table trips (
    id int auto_increment primary key,
    user_id int not null,
    agency_id int not null,
    origin varchar(255) not null,
    destination varchar(255) not null,
    departure_time datetime not null,
    arrival_time datetime not null,
    available_seats int not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade,
    foreign key (agency_id) references agencies(id) on delete cascade
);