-- Insertion des rôles utilisateur
INSERT INTO UserRole (libelle) VALUES
('Admin'),
('Conducteur'),
('Passager');

-- Insertion des utilisateurs
INSERT INTO User (pseudo, mail, mot_de_passe, photo, credit, role_id) VALUES
('johndoe', 'john@example.com', 'hashed_password_1', NULL, 100, 2),
('janedoe', 'jane@example.com', 'hashed_password_2', NULL, 50, 3),
('admin', 'admin@example.com', 'hashed_password_3', NULL, 0, 1);

-- Insertion des voitures
INSERT INTO Voiture (marque, modele, couleur, energie, immatriculation, date_first_immatriculation, user_id) VALUES
('Tesla', 'Model 3', 'Noir', 'Électrique', 'AB-123-CD', '2022-05-10', 1),
('Peugeot', '208', 'Bleu', 'Essence', 'XY-456-ZT', '2020-03-15', 2);

-- Insertion des covoiturages
INSERT INTO Covoiturage (date_depart, heure_depart, ville_depart, date_arrivee, heure_arrivee, ville_arrivee, statut, nombre_places, prix_par_personne, voiture_id, conducteur_id) VALUES
('2025-02-20', '08:00:00', 'Paris', '2025-02-20', '12:00:00', 'Lyon', 'Disponible', 3, 25, 1, 1),
('2025-02-22', '14:00:00', 'Marseille', '2025-02-22', '18:00:00', 'Nice', 'Disponible', 2, 15, 2, 2);

-- Insertion des participations
INSERT INTO Participation (user_id, covoiturage_id, role) VALUES
(2, 1, 'Passager'),
(3, 2, 'Conducteur');

-- Insertion des préférences utilisateur
INSERT INTO UserPreference (fumeur, animaux, preference, user_id) VALUES
(FALSE, TRUE, 'Aime la musique en voiture', 1),
(TRUE, FALSE, 'Préférence pour le silence', 2);

-- Insertion des avis
INSERT INTO Avis (note, commentaire, statut, auteur_id, cible_id) VALUES
(5, 'Super trajet, conducteur très sympa!', 'Validé', 2, 1),
(4, 'Ponctuel et agréable', 'Validé', 1, 2);

-- Insertion des plaintes
INSERT INTO Plainte (detail, covoiturage_id, plaignant_id, cible_id) VALUES
('Conducteur trop rapide, conduite dangereuse', 1, 2, 1);
