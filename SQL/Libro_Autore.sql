CREATE TABLE IF NOT EXISTS Libro_Autore (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_libro INT NOT NULL,
    id_autore INT NOT NULL,
    FOREIGN KEY (id_autore) REFERENCES autore (id_autore)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (id_libro) REFERENCES libro(id_libro)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
/* NOTE:
1.
Se non si specifichiamo l'eliminazioni a catena, ci verrà impedita l'eliminazione dei dati in una tabella se altre tabelle vi fanno riferimento.
Se specifichi questa opzione, quando successivamente elimini una riga nella tabella padre,
il server database elimina anche tutte le righe associate a quella riga (chiavi esterne) in una tabella figlia. 
Il vantaggio principale della funzionalità di eliminazione a cascata è che consente di ridurre la quantità di istruzioni SQL necessarie per eseguire azioni di eliminazione.

Ad esempio, la tabella Autore e Libro contengono la colonna id_autore e id_libro come chiavi primarie.
La tabella Libro_Autore fa riferimento a entrambe le chiavi primarie di libro e autore, però come chiave esterna.
Poiché per la tabella Libro_Autore è specificato ON DELETE CASCADE,
quando viene eliminata una riga delle tabelle Libro e Autore, vengono eliminate anche le righe corrispondenti della tabella Libro_Autore
2. Stesso concetto con update
*/
