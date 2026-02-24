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


COMMIT;