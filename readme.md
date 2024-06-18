# Configurazioe VirtualHost
Andare sul file:
\xampp\apache\conf\extra\httpd-vhosts.conf
inserire in coda: 

--- esempio ---
<VirtualHost *:80>
DocumentRoot "C:/xampp/htdocs/Esempio"
ServerName esempio.net
</VirtualHost>

Andare sul file:
C:\Windows\System32\drivers\etc\hosts
inserire in coda:
127.0.0.1 esempio.it


# Creazione della Tabella degli Eventi

Per utilizzare questo progetto, è necessario creare una tabella nel tuo database che possa memorizzare gli eventi. Di seguito troverai le istruzioni SQL per creare tale tabella.

## Creazione della Tabella

Apri il tuo gestore di database preferito e crea un nuovo database chiamato `dbeventi` e assicurati di essere connesso ad esso.
Poi esegui il seguente comando SQL per creare la tabella `events`:

```sql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    start DATE NOT NULL,
    end DATE NOT NULL
);
```

# Modifica del File di Configurazione
Infine, modificare il file `db.php` con le credenziali del proprio database.