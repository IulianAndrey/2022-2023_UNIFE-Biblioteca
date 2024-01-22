CREATE TABLE IF NOT EXISTS Utente (
    matricola INT PRIMARY KEY,
    nome_u VARCHAR(90) NOT NULL,
    cognome_u VARCHAR(90) NOT NULL,
    via_u VARCHAR(90) NOT NULL,
    civico_u INT NOT NULL,
    cap_u INT NOT NULL,
    citta_u VARCHAR(50) NOT NULL,
    telefono_u VARCHAR(20) NOT NULL UNIQUE
);
