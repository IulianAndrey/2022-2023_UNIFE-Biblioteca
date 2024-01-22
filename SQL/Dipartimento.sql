CREATE TABLE IF NOT EXISTS Dipartimento (
    id_d INT PRIMARY KEY AUTO_INCREMENT,
    nome_d VARCHAR(90) NOT NULL,
    via_d VARCHAR(90) NOT NULL,
    civico_d INT NOT NULL,
    cap_d INT(5) NOT NULL,
    citta_d VARCHAR(50) NOT NULL,
    responsabile VARCHAR(50) NOT NULL
);
