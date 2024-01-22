CREATE TABLE IF NOT EXISTS Libro (
    id_libro INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    isbn VARCHAR(11) NOT NULL,
    lingua VARCHAR(100) NOT NULL,
    anno_pub INT(4) NOT NULL,
    id_dipartimento INT NOT NULL,
    FOREIGN KEY (id_dipartimento) REFERENCES Dipartimento(id_dipartimento)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
/* NOTE:
1.
Se non si specifichiamo l'eliminazioni a catena, ci verrà impedita l'eliminazione dei dati in una tabella se altre tabelle vi fanno riferimento.
Se specifichi questa opzione, quando successivamente elimini una riga nella tabella padre,
il server database elimina anche tutte le righe associate a quella riga (chiavi esterne) in una tabella figlia. 
Il vantaggio principale della funzionalità di eliminazione a cascata è che consente di ridurre la quantità di istruzioni SQL necessarie per eseguire azioni di eliminazione.

Ad esempio, la tabella Dipartimento contiene la colonna id_dipartimento come chiave primaria.
La tabella Libro fa riferimento alla colonna id_dipartimento come chiave esterna.
Poiché per la tabella Libro è specificato ON DELETE CASCADE,
quando viene eliminata una riga della tabella Dipartimento , vengono eliminate anche le righe corrispondenti della tabella Libro
2. Stesso concetto con update
*/
