# trasportilecceeu
 
1) Copiare i files GTFS nella cartella omonima (di default settata come gtfs/lecce)
2) Lanciare updatepw.php (passwordiniziale)
3) Il file index.php richiede la georeferenzazione automatica su https. Se non è disponibile, utilizzare direttamente locator.php con i parametri di lat e lon. [Esempio](https://www.piersoft.it/trasportilecceeu/locator.php?lat=40.346118920850095&lon=18.16610813140869)

Si raccomanda di cambiare la password nel file updatepw.php. Se si cambiano GTFS di altra città, sostituire il path gtfs/nomecittà nei file updatepw.php, fermate.php

I dati dei trasporti sono forniti dal Comune di Lecce in Lic. CCBY 4.0

Logica:
Con la creazione del file (geo)json iniziae, si creano non solo i pin sulla mappa relativi alle fermate ma si inseriscono anche altre proprietà come il nome, stop_id, stop_code ect

Il file fermate.php è file che elabora gli incroci dei file GTFS partendo dallo stop_id/stop_code. 

Il parametro può essere passato sia perchè l'utente ha cliccato il pin della fermata (viene richiamato tmpf.php per gestiore il loading gif) sia direttamente digitando fermata.php?id=114&name=Stazione%20FS (name è opzionale).

Questa caratteristica è stata inserita perchè in alcuni quartieri di Lecce, in attività di Civic Hacking, verranno incollati adesivi con il QR Code per ciascuna fermata in modo che inquadrandolo si hanno gli orari pianificati.

Il file fermata.php ha alcune "costanti" che sono le posizioni in cui , nei file trips.txt, routes.txt e stops.txt :

....
$idname="";
$trip_idt="2";
$direction_id="4";
$service_idt="1";
$route_idt="0";
.....

dove ad esempio $trip_idt="2" vuol dire che nel file trips.txt nella posizione 2 (partendo da 0) hai il campo trip_id e così via.
Quasi tutti i GTFS provati hanno queste posizioni e standard.

