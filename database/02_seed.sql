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
INSERT INTO users (firstname, lastname, email, password, phone, role) VALUES
('Martin', 'Alexandre', 'alexandre.martin@email.fr', '$2a$12$vHFvPiQR6qBXLXeBzgh0oO8CSuXWVZNH
.i80qKyOX1JK3jsaOEywa', '0612345678', 'user'),
('Dubois', 'Sophie', 'sophie.dubois@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0698765432', 'user'),
('Bernard', 'Julien', 'julien.bernard@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0622446688', 'user'),
('Moreau', 'Camille', 'camille.moreau@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0611223344', 'user'),
('Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0777889900', 'user'),
('Leroy', 'Thomas', 'thomas.leroy@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0655443322', 'user'),
('Mercier', 'Emma', 'emma.mercier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0633221199', 'user'),
('Roux', 'Chloé', 'chloe.roux@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0633221199', 'user'),
('Petit', 'Maxime', 'maxime.petit@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0766778899', 'user'),
('Garnier', 'Laura', 'laura.garnier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688776655', 'user'),
('Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0744556677', 'user'),
('Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0699887766', 'user'),
('Fontaine', 'Louis', 'louis.fontaine@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0655667788', 'user'),
('Chevalier', 'Clara', 'clara.chevalier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0788990011', 'user'),
('Robin', 'Nicolas', 'nicolas.robin@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0644332211', 'user'),
('Gauthier', 'Marine', 'marine.gauthier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0677889922', 'user'),
('Fournier', 'Pierre', 'pierre.fournier@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0722334455', 'user'),
('Renaud', 'Sophie', 'sophie.renaud@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688665544', 'user'),
('Girard', 'Sarah', 'sarah.girard@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0688665544', 'user'),
('Lambert', 'Hugo', 'hugo.lambert@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0611223366', 'user'),
('Masson', 'Julie', 'julie.masson@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0733445566', 'user'),
('Henry', 'Arthur', 'arthur.henry@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0666554433', 'user'),
('Admin', 'Admin', 'admin@email.fr', '$2y$12$EZtiISkHL4.1dqmgf0Vjju4VWjzYzZ1LxCMHsaq6PY54dtJRX.YaO', '0777889900', 'admin');

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