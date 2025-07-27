-- Supprimer les tables si elles existent (ordre inverse des dépendances)
DROP TABLE IF EXISTS achat, log, compteur, client, tranche CASCADE;

-- ============================
-- Table Tranche
-- ============================
CREATE TABLE tranche (
    id SERIAL PRIMARY KEY,
    cons_min INT NOT NULL,
    cons_max INT NOT NULL,
    prix_appro FLOAT NOT NULL
);

-- ============================
-- Table Client
-- ============================
CREATE TABLE client (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL
);

-- ============================
-- Table Compteur
-- ============================
CREATE TABLE compteur (
    id SERIAL PRIMARY KEY,
    numero VARCHAR(50) UNIQUE NOT NULL,
    tranche_id INT NOT NULL REFERENCES tranche(id) ON DELETE CASCADE,
    client_id INT NOT NULL REFERENCES client(id) ON DELETE CASCADE
);

-- ============================
-- Table Log
-- ============================
CREATE TABLE log (
    id SERIAL PRIMARY KEY,
    ip VARCHAR(100) NOT NULL,
    statut VARCHAR(50) NOT NULL,
    numero_compteur INT NOT NULL REFERENCES compteur(id) ON DELETE CASCADE,
    code_recharge VARCHAR(100) NOT NULL,
    nombre_kwt FLOAT NOT NULL
);

-- ============================
-- Table Achat
-- ============================
CREATE TABLE achat (
    id SERIAL PRIMARY KEY,
    reference VARCHAR(100) NOT NULL,
    code_recharge VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    prix VARCHAR(50) NOT NULL,
    prix_kwt FLOAT NOT NULL,
    tranche_id INT NOT NULL REFERENCES tranche(id) ON DELETE CASCADE,
    compteur_id INT NOT NULL REFERENCES compteur(id) ON DELETE CASCADE
);

INSERT INTO tranche (cons_min, cons_max, prix_appro)
VALUES (0, 150, 91);

INSERT INTO tranche (cons_min, cons_max, prix_appro)
VALUES (151, 250, 102);

INSERT INTO tranche (cons_min, cons_max, prix_appro)
VALUES (251, 400, 116);

INSERT INTO tranche (cons_min, cons_max, prix_appro)
VALUES (401, 999999, 132);


INSERT INTO client (nom, prenom) VALUES
('Diop', 'Aminata'),
('Fall', 'Mamadou');

-- On suppose que tranche.id = 1 et 2 ; client.id = 1 et 2
INSERT INTO compteur (numero, tranche_id, client_id) VALUES
('COMP-0001', 1, 1),
('COMP-0002', 2, 2);

INSERT INTO log (ip, statut, numero_compteur, code_recharge, nombre_kwt) VALUES
('192.168.1.1', 'SUCCÈS', 1, 'RECHG123', 25.5),
('192.168.1.2', 'ÉCHEC', 2, 'RECHG456', 10.0);

INSERT INTO achat (reference, code_recharge, date, heure, prix, prix_kwt, tranche_id, compteur_id) VALUES
('ACHAT-001', 'RECHG123', CURRENT_DATE, CURRENT_TIME, '5000', 25.5, 1, 1),
('ACHAT-002', 'RECHG456', CURRENT_DATE, CURRENT_TIME, '7000', 30.0, 2, 2);
