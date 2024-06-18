# Creazione della Tabella degli Eventi

Per utilizzare questo progetto, è necessario creare una tabella nel tuo database che possa memorizzare gli eventi. Di seguito troverai le istruzioni SQL per creare tale tabella.

## Creazione della Tabella

Apri il tuo gestore di database preferito e esegui il seguente comando SQL per creare la tabella `events`:

```sql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    start DATE NOT NULL,
    end DATE NOT NULL
);