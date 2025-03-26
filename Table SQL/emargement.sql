-- Supprimer la base si elle existe déjà (optionnel, ATTENTION ⚠️ supprime toutes les données)
DROP DATABASE IF EXISTS emargement;

-- Création de la base de données
CREATE DATABASE emargement CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE emargement;

-- Table `users`
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'formateur', 'apprenant') NOT NULL,
  profile_picture VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion d'utilisateurs de test
INSERT INTO users (username, firstname, lastname, email, password, role, profile_picture) VALUES
('admin1', 'Admin', 'Admin', 'adminemarge123@yopmail.com', 'admin', 'admin', NULL),
('formateur1', 'Formateur', 'Formateur', 'formateuremarge123@yopmail.com', 'formateur', 'formateur', NULL),
('apprenant1', 'Apprenant', 'Apprenant', 'apprenantemarge123@yopmail.com', 'apprenant', 'apprenant', NULL);

-- Table `password_resets`
CREATE TABLE password_resets (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  token VARCHAR(64) NOT NULL UNIQUE,
  expires_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `formations`
CREATE TABLE formations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table `salles`
CREATE TABLE salles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  capacite INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table `groupes`
CREATE TABLE groupes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  formation_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE
);

-- Table `groupes_apprenants`
CREATE TABLE groupes_apprenants (
  groupe_id INT NOT NULL,
  user_id INT NOT NULL,
  PRIMARY KEY (groupe_id, user_id),
  FOREIGN KEY (groupe_id) REFERENCES groupes(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table `feuilles_emargements`
CREATE TABLE feuilles_emargements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  formation_id INT NOT NULL,
  groupe_id INT DEFAULT NULL,
  salle_id INT NOT NULL,
  formateur_id INT NOT NULL,
  date_debut DATETIME NOT NULL,
  date_fin DATETIME NOT NULL,
  statut ENUM('ouvert', 'fermé') DEFAULT 'ouvert',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE,
  FOREIGN KEY (groupe_id) REFERENCES groupes(id) ON DELETE CASCADE,
  FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
  FOREIGN KEY (formateur_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table `feuilles_emargements_signatures`
CREATE TABLE feuilles_emargements_signatures (
  feuille_id INT NOT NULL,
  user_id INT NOT NULL,
  role ENUM('formateur', 'apprenant') NOT NULL,
  signature BOOLEAN DEFAULT FALSE,
  heure_signature DATETIME DEFAULT NULL,
  PRIMARY KEY (feuille_id, user_id),
  FOREIGN KEY (feuille_id) REFERENCES feuilles_emargements(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Données de test
INSERT INTO formations (nom) VALUES 
('Anglais'),
('Cybersécurité'),
('Développement Web');

INSERT INTO users (username, firstname, lastname, email, password, role) VALUES
('formateur2', 'Jean', 'Dupont', 'jean.dupont@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'formateur'),
('formateur3', 'Alice', 'Martin', 'alice.martin@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'formateur'),
('formateur4', 'Paul', 'Durand', 'paul.durand@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'formateur'),
('apprenant7', 'Sophie', 'Lemoine', 'sophie.lemoine@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant'),
('apprenant2', 'Lucas', 'Girard', 'lucas.girard@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant'),
('apprenant3', 'Emma', 'Morel', 'emma.morel@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant'),
('apprenant4', 'Noah', 'Roux', 'noah.roux@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant'),
('apprenant5', 'Clara', 'Perrin', 'clara.perrin@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant'),
('apprenant6', 'Léo', 'Blanc', 'leo.blanc@email.com', '$2y$10$FdAr6FwPUGX5vwPQVU/fj.QPwFBbyPGzfH/pHULtbifbfhzJ3kQpe', 'apprenant');

INSERT INTO groupes (nom, formation_id) VALUES
('Groupe A', 1),
('Groupe B', 2);

-- Exemples avec user_id fictifs à ajuster dynamiquement si besoin
INSERT INTO groupes_apprenants (groupe_id, user_id)
VALUES 
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9);
