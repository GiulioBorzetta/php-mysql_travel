# PHP & MYSQL - Travel

## Come avviare il progetto sul proprio pc?

- Duplicare il progetto sul proprio computer
- dalla cartella MYSQL prendere file presente all'interno ed importarlo su MYSQL
- Aprire il terminare e usare il comando `php -S localhost:8000`
- Creare un file .env con le credenziali del database

## Come è strutturato il progetto?

Il sito è progettato solo su una pagina, dove è possibile suddividerlo in 3 parti:

- Il filtro
- La creazione dei paesi
- La creazione dei viaggi

![Filtro](https://github.com/GiulioBorzetta/php-mysql_travel/blob/main/images/filter.png)

In questa immagine si può notare che per cercare le informazioni necessarie, è possibile farlo in due modi:

- Attraverso il nome del paese
- Attraverso la quantità di posti disponibili

Andando ad inserire in uno dei due riquadri o entrambi dei valori, i risultati che trova li mostrerà nella tabella che è presente subito sotto.

![Creazione dei paesi](https://github.com/GiulioBorzetta/php-mysql_travel/blob/main/images/country.png)
![Creazione dei paesi](https://github.com/GiulioBorzetta/php-mysql_travel/blob/main/images/insert_country.png)

Nella parte della creazione dei paesi, si può notare che ci sta una scritta che cliccando riporterà nella pagina per l'inserimento dei paesi ed una volta inserito il paese ritornerà nella pagina principale, ma con il paese aggiunto nella tabella.

![Creazione dei viaggi](https://github.com/GiulioBorzetta/php-mysql_travel/blob/main/images/travel.png)

Nella creazione dei viaggi, possiamo notare una scritta "Add New Travel", dove aprirà una nuova pagina con la possibilità di inserire:

- Numero dei posti disponibili
- Paese 1
- Paese 2
- Paese 3
- Paese 4

![Inserimento dati Viaggi](https://github.com/GiulioBorzetta/php-mysql_travel/blob/main/images/insert_travel.png)

Una volta inseriti tutti i valori (i paesi non devono esser inseriti tutti, in un viaggio potrebbero starci anche solo 2 paesi), si ritornerà nella prima pagina e saranno presenti tutti i viaggi inseriti

## A livello di codice come è costituito?

all'interno è possibile vedere subito index.php che sarebbe la pagina che vediamo appena carichiamo la pagina, poi è presente un cartella "database" con all'interno due file, conn.php e .env, dove il secondo servirà per le credenziali del database. Poi è presente la cartella MYSQL dove è presente il file da inserire nel MYSQL per settare le tabelle. Nelle Cartelle "Travel" e "Country" sono rispettivamente tutta la parte di creazione, modifica e eliminazione dei viaggi e per la cartella "Paese" vale la stessa cosa, solo per la parte dei paesi. è presente anche una cartella "router" che serve per il reindirizzamento delle pagine. La Cartella "images" sono presenti delle foto per il README di GITHUB.

Nella cartella Viaggi i file che sono presenti servono a:

- controller_travel.php, per rendere meglio organizzata la parte di index.php
- delete_travel.php, per eliminare un viaggio creato
- edit_travel.php, per modificare un viaggio creato
- filter_travel.php, è la prima parte del sito, per filtrare i viaggi in base al paese o al numero di posti disponibili
- insert_travel.php, per la creazione di un viaggio
- manage_travel.php, per la visualizzazione nella prima pagina dei viaggi presenti

Nella cartella Paese i file che sono presenti servono a:

- controller_country.php, per rendere meglio organizzata la parte di index.php
- delete_country.php, per eliminare il paese creato
- insert_country.php, per inserire un nuovo paese
- manage_country.php, per vedere i paesi che sono presenti, per poi modificarli e/o eliminarli
- modify_country.php, per modificare il nome del paese
