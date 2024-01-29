CREATE TABLE IF NOT EXISTS Prestito(
  id INT PRIMARY KEY AUTO_INCREMENT,
  rientrato INT NOT NULL,
  data_rilascio DATE NOT NULL,
  id_libro INT NOT NULL,
  matricola INT NOT NULL,
  data_rientro DATE NULL,
  FOREIGN KEY (id_libro) REFERENCES Libro(id_libro)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (matricola) REFERENCES Utente(matricola)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
