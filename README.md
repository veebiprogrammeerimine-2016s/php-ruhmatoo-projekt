# TLU CarPooling


Joosep Juhanson, Taaniel Kõmmus

Kui vaadata TLU lähedal asuvaid parklaid (kasvõi Mare maja oma), siis näeb et kasutajaid ja
autoga ülikooli sõitvaid töötajaid/õpilasi ikka leidub.
Samas on tihti näha, et autodes istub laias laastus ainult juht.
Sellest tulenevalt ka idee luua TLU-sisene autode jagamise leht, sest eeldada võib,
et sama marsruuti sõitvaid ning sarnaste ajagraafikutega inimesi peaks TLU's olema küllalt.


Sihtrühmaks on eelkõige sõbralikud ja keskkonnast lugupidavad autoomanikud, kes on nõus
oma autot jagama teiste TLU kodanikega ning lisaks ka kõik, kes soovivad autoomaniku
pakutavat "teenust" kasutada.
Enamasti tegelevad carpoolingu teenust pakkuvad lehed pikemate vahemaadega ala Tallinn-Tartu jne.
Meie lahendus piirduks algselt selgelt TLU'sse ja TLU'st sõitmisega ning kasutada saaksid ainult
TLU emaili omavad isikud.

### Sarnased rakendused :
  * Karzoo - Euroopa carpooling
  * Wisemile - sotsiaalne transpordi võrgustik, mis ühendab vahendustasudeta vabu istekohti või pagasiruumi
  omavad autojuhid reisijate või pakisaatjatega.

### Funktsionaalsuse loetelu:
1. Saab teha kasutaja(nimi, kontakt, autonr. jne) ja sisselogida
2. Saab lisada sõidu (stardi asukoht, stardi kellaaeg, sihtkoht, orienteeruv kohale jõudmise kellaaeg, ?hind?)
3. Saab näha registreeritud sõite ja soovi korral sobivale end registreerida + näeb autoomaniku kontakte, et vajadusel ühendust võtta.
4. Autojuht näeb, kes on sõidule registreerinud + kõikide kontakte, et vajadusel ühendust võtta
5. Saab lisada tagasisidet/kommentaare reisijate/autojuhtide kohta
6. Saab näha iga kasutaja kohta kirjutatud kommentaare ja hinnanguid

### Andmebaas:
* Tabel1 - Kasutajad (cp_users)
* Tabel2 - Registreeritud sõidud (cp_rides)
* Tabel3 - Registreeritud kasutajad sõitudele (cp_rideusers)
* Tabel4 - Tagasiside/kommentaarid/hinnangud (cp_feedback)

### MySql:
* CREATE TABLE cp_users (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255) NOT NULL,
password varchar(128) NOT NULL,
name varchar(100) NOT NULL,
surname varchar(100) NOT NULL,
created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
KEY email (email)
);

* CREATE TABLE cp_rides (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
start_location VARCHAR(255) NOT NULL,
start_time DATETIME NOT NULL,
arrival_location VARCHAR(255) NOT NULL,
arrival_time datetime NOT NULL,
free_seats INT NOT NULL,
added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
deleted DATE DEFAULT NULL,
FOREIGN KEY (user_id) REFERENCES cp_users(id)
);

* CREATE TABLE cp_rideusers (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT,
ride_id INT NOT NULL,
timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
deleted DATE DEFAULT NULL,
FOREIGN KEY (user_id) REFERENCES cp_users(id),
FOREIGN KEY (ride_id) REFERENCES cp_rides(id)
);

* CREATE TABLE cp_feedback (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
poster_id INT NOT NULL,
rating INT NOT NULL,
feedback TEXT NOT NULL,
added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
deleted DATE DEFAULT NULL,
FOREIGN KEY (user_id) REFERENCES cp_users(id),
FOREIGN KEY (poster_id) REFERENCES cp_users(id)
);

### Mida juurde õppisime?

* Kõike! Päringud, front-end, andmebaasi kujundamine jne! (Taaniel)
