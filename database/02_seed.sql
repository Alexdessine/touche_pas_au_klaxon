-- =======================================================================
--  Database: touche_pas_au_klaxon
-- 02_seed.sql
-- Objectif : Insertion de données de test dans la base de données
-- Contraintes métier :
--   - Insérer au moins 3 utilisateurs avec des rôles différents (user, admin)
--   - Insérer au moins 2 agences de voyage
-- =======================================================================

USE tpak;

SET NAMES utf8mb4;


START TRANSACTION;

DELETE FROM trips;
DELETE FROM agencies;
DELETE FROM users;

ALTER TABLE trips    AUTO_INCREMENT = 1;
ALTER TABLE agencies AUTO_INCREMENT = 1;
ALTER TABLE users    AUTO_INCREMENT = 1;


-- Insertion des utilisateurs
INSERT INTO users (firstname, lastname, email, password, phone, role, created_at) VALUES
('Martin', 'Alexandre', 'alexandre.martin@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0612345678', 'user', '2026-02-23 13:45:05'),
('Dubois', 'Sophie', 'sophie.dubois@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0698765432', 'user', '2026-02-23 13:45:05'),
('Bernard', 'Julien', 'julien.bernard@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0622446688', 'user', '2026-02-23 13:45:05'),
('Moreau', 'Camille', 'camille.moreau@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0611223344', 'user', '2026-02-23 13:45:05'),
('Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0777889900', 'user', '2026-02-23 13:45:05'),
('Leroy', 'Thomas', 'thomas.leroy@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0655443322', 'user', '2026-02-23 13:45:05'),
('Mercier', 'Emma', 'emma.mercier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0633221199', 'user', '2026-02-23 13:45:05'),
('Roux', 'Chloé', 'chloe.roux@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0633221199', 'user', '2026-02-23 13:45:05'),
('Petit', 'Maxime', 'maxime.petit@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0766778899', 'user', '2026-02-23 13:45:05'),
('Garnier', 'Laura', 'laura.garnier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688776655', 'user', '2026-02-23 13:45:05'),
('Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0744556677', 'user', '2026-02-23 13:45:05'),
('Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0699887766', 'user', '2026-02-23 13:45:05'),
('Fontaine', 'Louis', 'louis.fontaine@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0655667788', 'user', '2026-02-23 13:45:05'),
('Chevalier', 'Clara', 'clara.chevalier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0788990011', 'user', '2026-02-23 13:45:05'),
('Robin', 'Nicolas', 'nicolas.robin@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0644332211', 'user', '2026-02-23 13:45:05'),
('Gauthier', 'Marine', 'marine.gauthier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0677889922', 'user', '2026-02-23 13:45:05'),
('Fournier', 'Pierre', 'pierre.fournier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0722334455', 'user', '2026-02-23 13:45:05'),
('Renaud', 'Sophie', 'sophie.renaud@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688665544', 'user', '2026-02-23 13:45:05'),
('Girard', 'Sarah', 'sarah.girard@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688665544', 'user', '2026-02-23 13:45:05'),
('Lambert', 'Hugo', 'hugo.lambert@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0611223366', 'user', '2026-02-23 13:45:05'),
('Masson', 'Julie', 'julie.masson@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0733445566', 'user', '2026-02-23 13:45:05'),
('Henry', 'Arthur', 'arthur.henry@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0666554433', 'user', '2026-02-23 13:45:05'),
('Admin', 'Admin', 'admin@email.fr', '$2y$10$T2amm5zInuoTRxz2XLlJA.wIUmCZS6oTWzoleo9QeifpSX4a4SgUW', '0777889900', 'admin', '2026-02-23 13:45:05');

-- Insertion des agences de voyage
INSERT INTO agencies (name) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- =======================================================================
-- 02_seed_trips.sql (à exécuter après ton seed users + agencies)
-- Compatible avec ton schéma :
-- trips(user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats)
-- Contraintes respectées :
--  - available_seats > 0
--  - arrival_time > departure_time
--  - departure_agency_id <> arrival_agency_id
--  - aucun trajet pour l'admin (admin@email.fr)
-- =======================================================================

INSERT INTO trips (user_id, departure_agency_id, arrival_agency_id, departure_time, arrival_time, available_seats)
VALUES
    -- Alexandre Martin
    ((SELECT id
        FROM users
        WHERE email='alexandre.martin@email.fr' AND role='user'), 1, 2, '2026-03-02 08:00:00', '2026-03-02 10:15:00', 2),
    ((SELECT id
        FROM users
        WHERE email='alexandre.martin@email.fr' AND role='user'), 2, 1, '2026-03-05 17:30:00', '2026-03-05 19:45:00', 1),

    -- Sophie Dubois
    ((SELECT id
        FROM users
        WHERE email='sophie.dubois@email.fr' AND role='user'), 1, 3, '2026-03-03 07:15:00', '2026-03-03 11:30:00', 3),
    ((SELECT id
        FROM users
        WHERE email='sophie.dubois@email.fr' AND role='user'), 3, 1, '2026-03-06 18:00:00', '2026-03-06 22:10:00', 1),

    -- Julien Bernard
    ((SELECT id
        FROM users
        WHERE email='julien.bernard@email.fr' AND role='user'), 4, 5, '2026-03-04 09:00:00', '2026-03-04 15:00:00', 2),
    ((SELECT id
        FROM users
        WHERE email='julien.bernard@email.fr' AND role='user'), 5, 4, '2026-03-07 09:30:00', '2026-03-07 15:20:00', 1),

    -- Camille Moreau
    ((SELECT id
        FROM users
        WHERE email='camille.moreau@email.fr' AND role='user'), 6, 7, '2026-03-08 06:45:00', '2026-03-08 09:40:00', 2),
    ((SELECT id
        FROM users
        WHERE email='camille.moreau@email.fr' AND role='user'), 7, 6, '2026-03-09 18:15:00', '2026-03-09 21:05:00', 1),

    -- Lucie Lefèvre
    ((SELECT id
        FROM users
        WHERE email='lucie.lefevre@email.fr' AND role='user'), 8, 9, '2026-03-10 08:30:00', '2026-03-10 12:10:00', 2),
    ((SELECT id
        FROM users
        WHERE email='lucie.lefevre@email.fr' AND role='user'), 9, 8, '2026-03-11 17:00:00', '2026-03-11 20:40:00', 1),

    -- Thomas Leroy
    ((SELECT id
        FROM users
        WHERE email='thomas.leroy@email.fr' AND role='user'), 10, 11, '2026-03-12 07:00:00', '2026-03-12 11:30:00', 3),
    ((SELECT id
        FROM users
        WHERE email='thomas.leroy@email.fr' AND role='user'), 11, 10, '2026-03-13 16:45:00', '2026-03-13 21:15:00', 1),

    -- Emma Mercier
    ((SELECT id
        FROM users
        WHERE email='emma.mercier@email.fr' AND role='user'), 12, 1, '2026-03-14 09:15:00', '2026-03-14 11:00:00', 1),
    ((SELECT id
        FROM users
        WHERE email='emma.mercier@email.fr' AND role='user'), 1, 12, '2026-03-15 18:30:00', '2026-03-15 20:10:00', 2),

    -- Chloé Roux
    ((SELECT id
        FROM users
        WHERE email='chloe.roux@email.fr' AND role='user'), 2, 5, '2026-03-16 06:30:00', '2026-03-16 12:30:00', 2),
    ((SELECT id
        FROM users
        WHERE email='chloe.roux@email.fr' AND role='user'), 5, 2, '2026-03-17 17:15:00', '2026-03-17 23:15:00', 3),

    -- Maxime Petit
    ((SELECT id
        FROM users
        WHERE email='maxime.petit@email.fr' AND role='user'), 3, 9, '2026-03-18 08:00:00', '2026-03-18 12:10:00', 1),
    ((SELECT id
        FROM users
        WHERE email='maxime.petit@email.fr' AND role='user'), 9, 3, '2026-03-19 18:00:00', '2026-03-19 22:05:00', 2);


COMMIT;