-- Créer la base de données
CREATE DATABASE voting_system;

-- Utiliser la base de données
USE voting_system;

-- Créer la table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Créer la table des candidats
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

-- Créer la table des votes
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    candidate_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

-- Ajouter des utilisateurs pour les tests
INSERT INTO users (username, password) VALUES 
('user1', 'user1password'),
('user2', 'user2password');

-- Ajouter des candidats pour les tests
INSERT INTO candidates (name, description) VALUES
('Mamadou Diop', 'Etudiant en ingénierie RSSP, passionné par la technologie et l\'innovation.'),
('Fatou Ndiaye', 'Etudiante en ingénierie GI, spécialisée en gestion des systèmes d\'information.'),
('Ousmane Fall', 'Etudiant en ingénierie GE, avec un fort intérêt pour les énergies renouvelables.'),
('Awa Ba', 'Etudiante en ingénierie CS, développeuse de logiciels et applications mobiles.'),
('Cheikh Touré', 'Etudiant en ingénierie RSSP, engagé dans des projets de sécurité informatique.'),
('Khady Sy', 'Etudiante en ingénierie GI, passionnée par la gestion de projets technologiques.'),
('Amadou Sarr', 'Etudiant en ingénierie GE, avec une forte expertise en génie électrique.'),
('Mariama Diouf', 'Etudiante en ingénierie CS, créatrice de sites web et applications.'),
('Modou Kane', 'Etudiant en ingénierie RSSP, avec un intérêt pour les réseaux et télécommunications.'),
('Aissatou Diallo', 'Etudiante en ingénierie GI, spécialisée en analyse de données et big data.');
