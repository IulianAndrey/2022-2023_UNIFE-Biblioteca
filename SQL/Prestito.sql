CREATE TABLE IF NOT EXISTS Prestito(
  cod_libro INT PRIMARY KEY AUTO_INCREMENT,
  matricola INT NOT NULL,
  id_libro INT NOT NULL,
  data_rilascio DATE NOT NULL,
  data_rientro DATE NOT NULL,
  FOREIGN KEY (id_libro) REFERENCES Libro(id_libro)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (matricola) REFERENCES Utente(matricola)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
