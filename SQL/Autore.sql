CREATE TABLE IF NOT EXISTS Autore (
    id_autore INT PRIMARY KEY AUTO_INCREMENT,
    nome_a VARCHAR(90) NOT NULL,
    cognome_a VARCHAR(90) NOT NULL,
    data_nascita DATE NOT NULL,
    luogo_nascita VARCHAR(90) NOT NULL
);
